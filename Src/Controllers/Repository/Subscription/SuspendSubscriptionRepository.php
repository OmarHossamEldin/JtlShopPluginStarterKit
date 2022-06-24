<?php

namespace MvcCore\Jtl\Controllers\Repository;

use MvcCore\Jtl\Support\Http\HttpRequest;
use MvcCore\Jtl\Support\Http\Server;
use MvcCore\Jtl\Helpers\Response;
use MvcCore\Jtl\Models\Subscription;
use MvcCore\Jtl\Support\Debug\Debugger;

class SuspendSubscriptionRepository
{

        private TokenValidatorRepository $tokenValidatorRepository;

        public function __construct()
        {
                $this->tokenValidatorRepository = new TokenValidatorRepository();
        }

        public function suspend_subscription($subscription_id)
        {

                if ($this->tokenValidatorRepository->createToken()) {
                        [$token, $tokenType] = $this->tokenValidatorRepository->get_token_data();

                        $headers = [
                                "Content-Type: application/json",
                        ];

                        $values = [
                                "reason" => "Items are back in stock",
                        ];

                        $data = $this->prepare_subscription_data($values);

                        $curl = new HttpRequest('https://api-m.sandbox.paypal.com/v1');
                        $subscription = $curl->post("/billing/subscriptions/$subscription_id/suspend", $tokenType, $data, $headers);

                        if (empty($subscription['debug_id'])) {

                                $subscriptionModel = new Subscription();

                                //$subscription_id

                                $getId = $subscriptionModel->getSubscriptionId($subscription_id);
                                $id = $getId[0]->id;

                                $subscriptionModel->update(
                                        [
                                                "status" => "suspended",
                                        ],
                                        $id
                                );

                                return Response::json([
                                        ['message' => 'Subscription is suspended successfully']
                                ], 204);
                        } else {
                                return Response::json([
                                        ['message' => $subscription['message']]
                                ], 206);
                        }
                }
                return Response::json([
                        ['message' => 'please contact the admin of the website for critical issue']
                ], 206);
        }

        private function prepare_subscription_data(array $data)
        {
                return json_encode($data);
        }
}
