<?php

namespace MvcCore\Jtl\Controllers\Repository\Checkout;

use MvcCore\Jtl\Support\Http\HttpRequest;
use MvcCore\Jtl\Support\Debug\Debugger;
use MvcCore\Jtl\Models\TokenParameter;
use MvcCore\Jtl\Models\ApiCredentials;
use Carbon\Carbon;
use stdClass;

class TokenValidatorRepository
{
        private TokenParameter $tokenParameter;
        private stdClass $tokenData;

        public function __construct()
        {
                $this->tokenParameter = new TokenParameter();
                $this->tokenData = new stdClass();
        }

        public function createToken(): bool
        {
                if ($this->check()) {
                        return true;
                }
                $credentials     = new ApiCredentials();
                $credentials    = $credentials->select('client_id', 'secret_key')->first();
                if (!$credentials) {
                        $debugger = new Debugger();
                        $debugger->log('paypal credentials must be set');
                        return false;
                } else {
                        $auth = base64_encode("$credentials->client_id:$credentials->secret_key");
                        $curl = new HttpRequest('https://api-m.sandbox.paypal.com/v1/');
                        $checkCredentials = $curl->post(
                                "oauth2/token",
                                "Basic",
                                'grant_type=client_credentials',
                                [
                                        "Content-Type: application/x-www-form-urlencoded",
                                        "Authorization: Basic $auth",
                                ]
                        );

                        TokenParameter::create([
                                'token_name' => $checkCredentials['access_token'],
                                'token_type' => $checkCredentials['token_type'],
                                'token_expiration' => $checkCredentials['expires_in'],
                        ]);
                        $this->set_token_data($checkCredentials['access_token'], $checkCredentials['token_type']);
                }
                return true;
        }

        public function get_token_data(): array
        {
                return [$this->tokenData->accessToken, $this->tokenData->type];
        }

        private function set_token_data($accessToken, $type): void
        {
                $this->tokenData->accessToken = $accessToken;
                $this->tokenData->type = $type;
        }

        private function check(): bool
        {
                $tokenParameter = $this->tokenParameter
                        ->select('token_name', 'token_type', 'token_expiration', 'created_at')
                        ->orderBy('created_at', 'desc')->first();
                if (!$tokenParameter) {
                        return false;
                }
                $expirationTime = $tokenParameter->token_expiration / 3600;
                $creationTime = $tokenParameter->created_at;

                $creationTime = Carbon::parse($creationTime);
                $currentTime = Carbon::now();
                $addedTime = $creationTime->addHours($expirationTime);

                $difference = $currentTime->diffInSeconds($addedTime, false);
                if ($difference < 0) {
                        return false;
                } else {
                        $this->set_token_data($tokenParameter->token_name, $tokenParameter->token_type);
                        return true;
                }
        }
}
