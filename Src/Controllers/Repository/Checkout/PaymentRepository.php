<?php

namespace MvcCore\Jtl\Controllers\Repository\Checkout;

use MvcCore\Jtl\Support\Http\HttpRequest;
use MvcCore\Jtl\Support\Http\Server;
use MvcCore\Jtl\Helpers\Response;
class PaymentRepository
{
        private TokenValidatorRepository $tokenValidatorRepository;

        public function __construct()
        {
                $this->tokenValidatorRepository = new TokenValidatorRepository();
        }

        public function prepare_invoice($mount, $currency)
        {
                if ($this->tokenValidatorRepository->createToken()) {
                        [$token, $type] = $this->tokenValidatorRepository->get_token_data();
                        $successUrl = Server::make_link('/resource?return=success');
                        $cancelUrl = Server::make_link('/resource?return=cancel');

                        $headers = [
                                "Content-Type: application/json",
                                "Authorization: $type $token"
                        ];
                        $data = $this->prepare_invoice_data($mount, $currency, $cancelUrl, $successUrl);
                        $curl = new HttpRequest('https://api-m.sandbox.paypal.com/v2');
                        $invoice = $curl->post('/checkout/orders', $type, $data, $headers);

                        return $invoice;
                }
                return Response::json([
                        ['message' => 'please contact the admin of the website for critical issue']
                ], 422);
        }

        public function confirm_invoice_payment(array $invoiceLinks): array
        {
                if ($this->tokenValidatorRepository->createToken()) {
                        $invoiceLink = current(array_filter($invoiceLinks, fn ($link) => $link->link_name === 'self'));
                        [$token, $type] = $this->tokenValidatorRepository->get_token_data();
                        $headers = [
                                "Content-Type: application/json",
                                "Authorization: $type $token"
                        ];
                        [$baseURL, $route] = explode('/v2', $invoiceLink->order_link);
                        $curl = new HttpRequest("$baseURL/v2");
                        $invoice = $curl->get($route, $type, [], $headers);
                        if ($invoice['status'] === 'APPROVED') {
                                $invoiceLink = current(array_filter($invoiceLinks, fn ($link) => $link->link_name === 'capture'));
                                [$baseURL, $route] = explode('/v2', $invoiceLink->order_link);
                                $curl = new HttpRequest("$baseURL/v2");
                                $invoice = $curl->post($route, $type, json_encode(["intent" => "CAPTURE"]), $headers);
                                return ['status' => true, 'invoice' => $invoice];
                        } else {
                                return ['status' => false, 'invoice' => $invoice];
                        }
                }
                return Response::json([
                        ['message' => 'please contact the admin of the website for critical issue']
                ], 422);
        }

        private function prepare_invoice_data(int $mount, string $currency, string $cancelUrl, string $successUrl)
        {
                return json_encode([
                        "intent" => "CAPTURE",
                        "purchase_units" => [
                                [
                                        "amount" => [
                                                "currency_code" => $currency,
                                                "value" => $mount,
                                        ]
                                ]
                        ],
                        "application_context" => [
                                "cancel_url" => "$cancelUrl",
                                "return_url" => "$successUrl"
                        ]
                ]);
        }
}
