<?php

namespace MvcCore\Jtl\Controllers\Repository;

use MvcCore\Jtl\Support\Http\HttpRequest;
use MvcCore\Jtl\Helpers\Response;
use MvcCore\Jtl\Models\Job;
use MvcCore\Jtl\Models\Subscription;
use MvcCore\Jtl\Models\SubscriptionLinks;
use JTL\Session\Frontend;

class CreateSubscriptionRepository
{

        public function prepare_subscription($plan_id, $tokenType, $token, $headers)
        {

                $values = [
                        "plan_id" => $plan_id,
                ];

                $data = $this->prepare_subscription_data($values);

                $curl = new HttpRequest('https://api-m.sandbox.paypal.com/v1');
                $subscription = $curl->post('/billing/subscriptions', $tokenType, $data, $headers);

                if (empty($subscription['debug_id'])) {


                        $job = new Job();
                        $createdJobs = $job->create([
                            'text' => 'check subscriptions',
                            'status' => 'waiting',
                        ])->first();
            
                        $job_id = $createdJobs->id;


                        $customer          = Frontend::getCustomer();
                        $customerId = $customer->kKunde;
                
                        $subscriptionModel = new Subscription();
                        $createdSubscription = $subscriptionModel->create([
                                'status' => 'pending',
                                'subscripton_id' => $subscription['id'],
                                'plan_id' => $plan_id,
                                'start_time' => date("Y-m-d H:i:s"),
                                'create_time' => date("Y-m-d H:i:s"),
                                'customerId' => $customerId,
                                'tec_see_job_id' => $job_id,
                        ])->first();

                        $subscription_id = $createdSubscription->id;

                        $links = $subscription['links'];

                        $subscriptionLinks = new SubscriptionLinks;

                        foreach ($links as $link) {
                                $subscriptionLinks->create([
                                        'link' => $link['href'],
                                        'type' => $link['rel'],
                                        'method' => $link['method'],
                                        'tec_see_subscription_id' => $subscription_id,
                                ]);
                        }


                        $getLink = $subscriptionLinks->getLinkWithSubscriptionId($subscription_id);

                        $link = $getLink[0]->link;

                        return $link;
                } else {
                        return Response::json([
                                ['message' => 'Error happened while making an subscription']
                        ], 206);
                }
        }

        private function prepare_subscription_data(array $data)
        {
                return json_encode($data);
        }
}
