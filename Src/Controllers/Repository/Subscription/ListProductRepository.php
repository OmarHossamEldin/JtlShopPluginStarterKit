<?php

namespace MvcCore\Jtl\Controllers\Repository\Subscription;

use MvcCore\Jtl\Support\Http\HttpRequest;
use MvcCore\Jtl\Helpers\Response;

class ListProductRepository
{
        private TokenValidatorRepository $tokenValidatorRepository;

        public function __construct()
        {
                $this->tokenValidatorRepository = new TokenValidatorRepository();
        }

        public function list_products($page_size = 5, $page = 1)
        {
                if ($this->tokenValidatorRepository->createToken()) {
                        [$token, $type] = $this->tokenValidatorRepository->get_token_data();

                        $headers = [
                                "Content-Type: application/json",
                                "Authorization: $type $token"
                        ];

                        $curl = new HttpRequest('https://api-m.sandbox.paypal.com/v1');
                        $products = $curl->get("/catalogs/products?page_size=$page_size&page=$page", $type, '', $headers);

                        return $products;
                }
                return Response::json([
                        [
                                'message' => 'please contact the admin of the website for critical issue',
                                'products' => ''
                        ]
                ], 422);
        }
}
