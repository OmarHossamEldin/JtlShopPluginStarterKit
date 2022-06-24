<?php

namespace MvcCore\Jtl\Controllers\Repository\Subscription;

use MvcCore\Jtl\Support\Http\HttpRequest;
use MvcCore\Jtl\Support\Http\Server;
use MvcCore\Jtl\Helpers\Response;
use MvcCore\Jtl\Models\Subscription;
use MvcCore\Jtl\Support\Debug\Debugger;

class ActivateSubscriptionRepository
{

        private TokenValidatorRepository $tokenValidatorRepository;

        public function __construct()
        {
                $this->tokenValidatorRepository = new TokenValidatorRepository();
        }
        
        public function active_subscription($subscription_id)
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
                        $subscription = $curl->post("/billing/subscriptions/$subscription_id/activate", $tokenType, $data, $headers);

                        if (empty($subscription['debug_id'])) {

                                $subscriptionModel = new Subscription();

                                $getId = $subscriptionModel->getSubscriptionId($subscription_id);
                                $id = $getId[0]->id;

                                $subscriptionModel->update(
                                        [
                                                "status" => "active",
                                        ],
                                        $id
                                );

                                return Response::json([
                                        ['message' => 'Subscription is activated successfully']
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
