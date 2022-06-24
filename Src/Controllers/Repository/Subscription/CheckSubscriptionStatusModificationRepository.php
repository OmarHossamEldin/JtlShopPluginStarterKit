<?php

namespace MvcCore\Jtl\Controllers\Repository;

use MvcCore\Jtl\Support\Http\HttpRequest;
use MvcCore\Jtl\Support\Http\Server;
use MvcCore\Jtl\Helpers\Response;
use MvcCore\Jtl\Models\Subscription;
use MvcCore\Jtl\Support\Debug\Debugger;

class CheckSubscriptionStatusModificationRepository
{

        private TokenValidatorRepository $tokenValidatorRepository;

        public function __construct()
        {
                $this->tokenValidatorRepository = new TokenValidatorRepository();
        }
        public function check_subscription($subscription_id, $status)
        {

                if ($this->tokenValidatorRepository->createToken()) {
                        [$token, $tokenType] = $this->tokenValidatorRepository->get_token_data();

                        $randomId = mt_rand(10000000, 99999999);
                        $randomSecondId = mt_rand(100, 999);
                        //"PayPal-Request-Id: PLAN-$randomId-$randomSecondId"

                        $headers = [
                                "Content-Type: application/json",
                                "Authorization: $tokenType $token",
                        ];


                        $curl = new HttpRequest('https://api-m.sandbox.paypal.com/v1');
                        $subscription = $curl->get("/billing/subscriptions/$subscription_id", $tokenType, [], $headers);

                        if ($subscription) {


                                $subscriptionStatus = strtolower($subscription["status"]);


                                if ($subscriptionStatus === "active") {
                                        return Response::json([
                                                ['message' => 'Subscription is already activated']
                                        ], 206);

                                        $subscriptionModel = new Subscription();

                                        $getId = $subscriptionModel->getSubscriptionId($subscription["id"]);
                                        $id = $getId[0]->id;

                                        $subscriptionModel->update(
                                                [
                                                        "status" => $subscriptionStatus,
                                                ],
                                                $id
                                        );
                                } else {
                                        return true;
                                }
                        } else {
                                return Response::json([
                                        ['message' => 'Subscription is not found']
                                ], 206);
                        }
                }
                return Response::json([
                        ['message' => 'please contact the admin of the website for critical issue']
                ], 206);
        }
}
