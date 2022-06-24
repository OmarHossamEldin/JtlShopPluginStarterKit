<?php

namespace MvcCore\Jtl\Controllers\Repository\Subscription;

use MvcCore\Jtl\Support\Http\HttpRequest;
use MvcCore\Jtl\Support\Http\Server;
use MvcCore\Jtl\Helpers\Response;
use MvcCore\Jtl\Models\ProductLinks;
use MvcCore\Jtl\Models\RegisteredProduct;
use MvcCore\Jtl\Models\TokenParameter;

class CreateProductRepository
{
        private TokenValidatorRepository $tokenValidatorRepository;

        public function __construct()
        {
                $this->tokenValidatorRepository = new TokenValidatorRepository();
        }

        public function prepare_product($productName,$productType)
        {

                if ($this->tokenValidatorRepository->createToken()) {
                        [$tokenName, $tokenType] = $this->tokenValidatorRepository->get_token_data();

                        $randomId = mt_rand(10000000, 99999999);
                        $randomSecondId = mt_rand(100, 999);

                        $headers = [
                                "Content-Type: application/json",
                                "Authorization: $tokenType $tokenName",
                                "PayPal-Request-Id: PLAN-$randomId-$randomSecondId"
                        ];

                        $curl = new HttpRequest('https://api-m.sandbox.paypal.com/v1');

                                $values = [
                                        "name" => $productName,
                                        "type" => $productType,
                                ];

                                $data = $this->prepare_product_data($values);

                                $addedProduct = $curl->post('/catalogs/products', 'Basic', $data, $headers);

                                $registeredProduct = new RegisteredProduct;
                                $product_id = $registeredProduct->select('id', 'name', 'tec_see_product_id')
                                        ->where('name', $productName)
                                        ->first();

                                $productId = $product_id->id;

                                $registeredProduct->update([
                                        'is_sent' => true,
                                        'tec_see_product_id' => $addedProduct['id'],
                                ], $productId);

                                $links = $addedProduct['links'];

                                foreach ($links as $link) {
                                        ProductLinks::create([
                                                'link' => $link['href'],
                                                'type' => $link['rel'],
                                                'method' => $link['method'],
                                                'product_id' => $addedProduct['id'],
                                        ]);
                                }
     

                        return true;
                }

                return Response::json([
                        ['message' => 'please contact the admin of the website for critical issue']
                ], 422);
        }

        private function prepare_product_data(array $data)
        {
                return json_encode($data);
        }
}
