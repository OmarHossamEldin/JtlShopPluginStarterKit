<?php

namespace MvcCore\Jtl\Controllers\Repository\Subscription;

use MvcCore\Jtl\Support\Http\HttpRequest;
use MvcCore\Jtl\Support\Http\Server;
use MvcCore\Jtl\Helpers\Response;
use MvcCore\Jtl\Models\PlanLinks;
use MvcCore\Jtl\Models\Plan;
use MvcCore\Jtl\Models\RegisteredProduct;
use MvcCore\Jtl\Controllers\Repository\CreateSubscriptionRepository;

class CreatePlanRepository
{
        private TokenValidatorRepository $tokenValidatorRepository;

        public function __construct()
        {
                $this->tokenValidatorRepository = new TokenValidatorRepository();
        }

        public function prepare_plan($product_id, $plan_name, $interval_unit, $interval_count, $tenure_type, $fixed_price, $currency_code, $total_cycles, $product_name)
        {
                if ($this->tokenValidatorRepository->createToken()) {
                        [$token, $tokenType] = $this->tokenValidatorRepository->get_token_data();

                        $randomId = mt_rand(10000000, 99999999);
                        $randomSecondId = mt_rand(100, 999);


                        $headers = [
                                "Content-Type: application/json",
                                "Authorization: $tokenType $token",
                                "PayPal-Request-Id: PLAN-$randomId-$randomSecondId",
                        ];

                        $values = [
                                "product_id" => $product_id,
                                "name" => $plan_name,
                                "billing_cycles" => [
                                        [
                                                "frequency" => [
                                                        "interval_unit" => $interval_unit,
                                                        "interval_count" => $interval_count
                                                ],
                                                "tenure_type" => $tenure_type,
                                                "sequence" => 1,
                                                "total_cycles" => $total_cycles,
                                                "pricing_scheme" => [
                                                        "fixed_price" => [
                                                                "value" => $fixed_price,
                                                                "currency_code" => $currency_code
                                                        ]
                                                ]
                                        ],
                                ],
                                "payment_preferences" => [
                                        "auto_bill_outstanding" => true,
                                ],
                        ];

                        $data = $this->prepare_product_data($values);

                        $curl = new HttpRequest('https://api-m.sandbox.paypal.com/v1');
                        $plan = $curl->post('/billing/plans', $tokenType, $data, $headers);

                        //$product_name
                        $planModel = new Plan();
                        $planModel->create([
                                'product_name' => $product_name,
                                'type' => $interval_unit,
                                'count' => $total_cycles,
                                'plan_id' => $plan['id'],
                        ]);

                        $links = $plan['links'];

                        $planLinks = new PlanLinks;

                        foreach ($links as $link) {
                                $planLinks->create([
                                        'link' => $link['href'],
                                        'type' => $link['rel'],
                                        'method' => $link['method'],
                                        'plan_id' => $plan['id'],
                                ]);
                        }

                        $subscriptionRepository = new CreateSubscriptionRepository();
                        $subscriptionLink = $subscriptionRepository->prepare_subscription($plan['id'], $tokenType, $token, $headers);


                        return Response::json([
                                ['link' =>  $subscriptionLink]
                        ], 201);
                }
                return Response::json([
                        ['message' => 'please contact the admin of the website for critical issue']
                ], 206);
        }

        private function prepare_product_data(array $data)
        {
                return json_encode($data);
        }
}
