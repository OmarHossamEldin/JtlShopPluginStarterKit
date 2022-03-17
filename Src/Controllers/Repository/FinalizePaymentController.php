<?php

namespace Plugin\JtlShopPluginStarterKit\Src\Controllers\Repository;

use Plugin\JtlShopPluginStarterKit\Src\Helpers\Response;
use Plugin\JtlShopPluginStarterKit\Src\Models\TokenParameter;
use Carbon\Carbon;
use Plugin\JtlShopPluginStarterKit\Src\Models\ApiCredentials;
use Plugin\JtlShopPluginStarterKit\Src\Support\Http\HttpRequest;
use Plugin\JtlShopPluginStarterKit\Src\Support\Http\Server;
use Plugin\JtlShopPluginStarterKit\Src\Helpers\Redirect;
use Plugin\JtlShopPluginStarterKit\Src\Support\Http\Request;
use JTL\Session\AbstractSession;
use Plugin\JtlShopPluginStarterKit\Src\Models\OrderLink;

class FinalizePaymentController
{

        public function confirm_payment(Request $request, $smarty)
        {


                $data = $request->all();
                $orderId = $data['0']['token'];
                // buyerId is existed here
                //$orderId = 'this will come from request';

                $orderLink = new OrderLink;
                $orderLinks = $orderLink->select('order_id', 'order_link', 'link_name')->where('order_id', $orderId)->get();

                $orderLinks = json_decode(json_encode($orderLinks), true);

                $links = array_map(function ($link) use ($orderId, $orderLinks, $smarty) {
                        if ($link['link_name'] === 'self') {
                                $orderUrl = $link['order_link'];
                                // send request 
                                $checkToken = new CheckTokenExpiration;
                                $results = $checkToken->check();

                                $tokenName = $results['tokenName'];
                                $tokenType = $results['tokenType'];


                                $curl = new HttpRequest(
                                        $orderUrl
                                );

                                $requestSent = $curl->get(
                                        '',
                                        [],
                                        [
                                                "Content-Type: application/json",
                                                "Authorization: $tokenType $tokenName"
                                        ],
                                        $tokenType
                                );

                                /** remember to save links in database */
                                $status = $requestSent['status'];

                                if ($status === 'APPROVED') {
                                        /**change status of reservation */
                                }
                        }

                        $reservationStatus = '/**get reservation_status */ ';

                        /**get reservation_status */


                        if ($link['link_name'] === 'capture' && $reservationStatus === 'Approved') {
                                $completeUrl = $link['order_link'];
                                //send post request to this url intent CAPTURE / POST request

                                $checkToken = new CheckTokenExpiration;
                                $results = $checkToken->check();

                                $tokenName = $results['tokenName'];
                                $tokenType = $results['tokenType'];

                                $curl = new HttpRequest($completeUrl);

                                $completePaymentUrl = $curl->post(
                                        '',
                                        [
                                                "intent" => "CAPTURE",
                                        ],
                                        [
                                                "Content-Type: application/json",
                                                "Authorization: $tokenType $tokenName"
                                        ],
                                        $tokenType
                                );

                                $orderId = $completePaymentUrl['id'];
                                $purchase_units = $completePaymentUrl['purchase_units']['0'];
                                $shipping = $purchase_units['shipping'];
                                $payments = $purchase_units['payments'];

                                $orderAddress = $shipping['address']['address_line_1'];
                                $capturedData = $payments['captures']['0'];
                                $orderCreationTime = $capturedData['create_time'];
                                $orderTotalAmount = $capturedData['amount']['value'];

                                $values = [
                                        'id' => $orderId,
                                        'address' => $orderAddress,
                                        'creationTime' => $orderCreationTime,
                                        'totalAmount' => $orderTotalAmount,
                                ];

                                $storeOrder = new StoreOrder;
                                $storeOrder->store($values);
                                // after request is approved
                                // remember to save this in orders table

                                //Header::setHeader('payment', 'success');

                                AbstractSession::set('paymentStatus', 1);

                                Redirect::homeWith('/ressource');
                        }


                        return $link;
                }, $orderLinks);
        }

        public function cancel_payment(Request $request, $smarty)
        {
                $data = $request->all();
                $orderId = $data['0']['token'];

                $link = "https://www.sandbox.paypal.com/checkoutnow?token=$orderId";

                AbstractSession::set('paymentStatus', 0);
                AbstractSession::set('completePayment', $link);

                Redirect::homeWith('/ressource');
        }
}
