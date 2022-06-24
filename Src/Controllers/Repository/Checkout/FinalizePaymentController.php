<?php

namespace MvcCore\Jtl\Controllers\Repository\Checkout;

use MvcCore\Jtl\Helpers\Response;
use MvcCore\Jtl\Models\TokenParameter;
use Carbon\Carbon;
use MvcCore\Jtl\Models\ApiCredentials;
use MvcCore\Jtl\Support\Http\HttpRequest;
use MvcCore\Jtl\Support\Http\Server;
use MvcCore\Jtl\Helpers\Redirect;
use MvcCore\Jtl\Support\Http\Request;
use JTL\Session\AbstractSession;
use MvcCore\Jtl\Models\OrderLink;

class FinalizePaymentController
{
        private TokenValidatorRepository $tokenValidatorRepository;

        public function __construct()
        {
                $this->tokenValidatorRepository = new TokenValidatorRepository();
        }

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

                                [$tokenName, $tokenType] = $this->tokenValidatorRepository->get_token_data();


                                $curl = new HttpRequest(
                                        $orderUrl
                                );

                                $requestSent = $curl->get(
                                        '',
                                        $tokenType,
                                        [],
                                        [
                                                "Content-Type: application/json",
                                                "Authorization: $tokenType $tokenName"
                                        ]   
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

                                [$tokenName, $tokenType] = $this->tokenValidatorRepository->get_token_data();

                                $curl = new HttpRequest($completeUrl);

                                $completePaymentUrl = $curl->post(
                                        '',
                                        $tokenType,
                                        [
                                                "intent" => "CAPTURE",
                                        ],
                                        [
                                                "Content-Type: application/json",
                                                "Authorization: $tokenType $tokenName"
                                        ]
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
