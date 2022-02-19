<?php

namespace Plugin\JtlShopPluginStarterKit\Src\Support\Http;

use Plugin\JtlShopPluginStarterKit\Src\Exceptions\InvalidRequestException;

class HttpRequest
{
    /**
     * curl instance
     *
     * @var [curl]
     */
    private $curl;

    /**
     * method type
     *
     * @var string
     */
    private string $method;

    /**
     * headers of the request
     *
     * @var array
     */
    private array $headers;

    /**
     * url
     *
     * @var string
     */

    private string $url;

    public function __construct(array $headers, string $method, string $url)
    {
        $this->curl = curl_init();
        $this->headers = $headers;
        $this->method = $method;
        $this->url = $url;
    }

    /**
     * for sending request 
     *
     * @param array $data
     * @param boolean $token
     * @return array $response
     */
    public function send_request(array $data, string $authType = null)
    {
        switch ($this->method) {
            case 'POST':
                curl_setopt($this->curl, CURLOPT_POST, true);
                break;
            case 'PUT':
            case 'PATCH':
            case 'DELETE':
                curl_setopt($this->curl, CURLOPT_CUSTOMREQUEST, $this->method, true);
                break;
            default:
                $this->url = $this->url;
        }
        curl_setopt($this->curl, CURLOPT_URL, $this->url);

        if (($authType === 'Bearer') && ($this->method !== 'GET')) {

            curl_setopt($this->curl, CURLOPT_HTTPAUTH, CURLAUTH_BEARER);
            curl_setopt($this->curl, CURLOPT_HTTPHEADER, $this->headers);
            $data = json_encode($data);
            curl_setopt($this->curl, CURLOPT_POSTFIELDS, $data);
        } else if (($authType === 'Basic') && ($this->method !== 'GET')) {

            curl_setopt($this->curl, CURLOPT_HTTPHEADER, $this->headers);
            curl_setopt($this->curl, CURLOPT_POSTFIELDS, http_build_query($data));
        } else if (($authType === 'Bearer') && ($this->method === 'GET')) {
            curl_setopt($this->curl, CURLOPT_HTTPHEADER, $this->headers);
        } else {
            $data = json_encode($data);
            curl_setopt($this->curl, CURLOPT_POSTFIELDS, $data);
        }

        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($this->curl);

        if ($response === false) {
            throw new InvalidRequestException();
        }
        $response = json_decode($response, true);

        curl_close($this->curl);
        return $response;
    }
}
