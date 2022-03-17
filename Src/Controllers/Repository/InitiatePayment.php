<?php

namespace Plugin\JtlShopPluginStarterKit\Src\Controllers\Repository;

use Plugin\JtlShopPluginStarterKit\Src\Helpers\Response;
use Plugin\JtlShopPluginStarterKit\Src\Models\TokenParameter;
use Carbon\Carbon;
use Plugin\JtlShopPluginStarterKit\Src\Models\ApiCredentials;
use Plugin\JtlShopPluginStarterKit\Src\Support\Http\HttpRequest;
use Plugin\JtlShopPluginStarterKit\Src\Support\Http\Server;

class InitiatePayment
{

        public function initiate()
        {
                $checkToken = new CheckTokenExpiration;
                $results = $checkToken->check();

                $tokenName = $results['tokenName'];
                $tokenType = $results['tokenType'];


                $curl = new HttpRequest('https://api-m.paypal.com/v2/');

                $successUrl = Server::make_link('/ressource?return=success');
                $cancelUrl = Server::make_link('/ressource?return=cancel');

                $currency = 'type currency here';
                $cost = 'type cost here';

                $requestSent = $curl->post(
                        'checkout/orders',
                        [
                                "intent" => "CAPTURE",
                                "purchase_units" => [
                                        [
                                                "amount" => [
                                                        "currency_code" => $currency,
                                                        "value" => $cost,
                                                ]
                                        ]
                                ],
                                "application_context" => [
                                        "cancel_url" => "$cancelUrl",
                                        "return_url" => "$successUrl"
                                ],
                        ],
                        [
                                "Content-Type: application/x-www-form-urlencoded",
                                "Authorization: Basic $tokenName",
                        ],
                        $tokenType
                );


                $storeOrderLinks = new StoreOrderLinks;
                $storeOrderLinks->store($requestSent);

                $links = $requestSent['links'];

                /** add field in reservation table called status */
                $checkoutLink = $links['1']['href'];
                //$reservationData = json_decode(json_encode($rows), true);
                return Response::json([
                        'data' => $checkoutLink,
                        //'reservationData' => $reservationData,
                ], 201);
        }
}
