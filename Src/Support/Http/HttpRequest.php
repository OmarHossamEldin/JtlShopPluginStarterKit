<?php

namespace Plugin\JtlShopPluginStarterKit\Src\Support\Http;

use Plugin\JtlShopPluginStarterKit\Src\Exceptions\InvalidRequestException;
use Plugin\JtlShopPluginStarterKit\Src\Exceptions\UnsupportedAuthenticationType;
use Plugin\JtlShopPluginStarterKit\Src\Exceptions\UnsupportedRequestType;

class HttpRequest
{
    /**
     * curl instance
     *
     * @var [curl]
     */
    private $curl;

    /**
     * headers of the request
     *
     * @var array
     */
    private array $headers;

    /**
     * baseUrl of the request
     *
     * @var array
     */
    private string $baseUrl;

    public function __construct(string $baseUrl, array $headers = ['Content-type' => 'application/json'])
    {
        $this->curl = curl_init();
        $this->headers = $headers;
        $this->baseUrl = $baseUrl;
    }

    /**
     * get Request
     *
     * @param string $url
     * @param array $data
     * @param array $headers
     * @return void
     */
    public function get(string $url, array $data = [], array $headers = ['Content-type' => 'application/json'], string $authType)
    {
        $url = $this->baseUrl . $url;
        $this->headers = $headers;
        return $this->send_request($url, $data, 'GET', $authType);
    }

    /**
     * POST Request
     *
     * @param string $url
     * @param array $data
     * @param array $headers
     * @return void
     */
    public function post(string $url, array $data = [], array $headers = ['Content-type' => 'application/json'], string $authType)
    {
        $url = $this->baseUrl . $url;
        $this->headers = $headers;
        return $this->send_request($url, $data, 'POST', $authType);
    }

    /**
     * PATCH Request
     *
     * @param string $url
     * @param array $data
     * @param array $headers
     * @return void
     */
    public function patch(string $url, array $data = [], array $headers = ['Content-type' => 'application/json'], string $authType)
    {
        $url = $this->baseUrl . $url;
        $this->headers = $headers;
        return $this->send_request($url, $data, 'PATCH', $authType);
    }

    /**
     * PUT Request
     *
     * @param string $url
     * @param array $data
     * @param array $headers
     * @return void
     */
    public function put(string $url, array $data = [], array $headers = ['Content-type' => 'application/json'], string $authType)
    {
        $url = $this->baseUrl . $url;
        $this->headers = $headers;
        return $this->send_request($url, $data, 'PUT', $authType);
    }

    /**
     * DELETE Request
     *
     * @param string $url
     * @param array $data
     * @param array $headers
     * @return void
     */
    public function delete(string $url, array $data = [], array $headers = ['Content-type' => 'application/json'], string $authType)
    {
        $url = $this->baseUrl . $url;
        $this->headers = $headers;
        return $this->send_request($url, $data, 'DELETE', $authType);
    }

    /**
     * for sending request 
     *
     * @param array $data
     * @param boolean $token
     * @return array $response
     */
    public function send_request(string $url, array $data, string $method, string $authType)
    {
        curl_setopt($this->curl, CURLOPT_URL, $url);
        curl_setopt($this->curl, CURLOPT_HTTPHEADER, $this->headers);

        if ($method === 'POST') {
            curl_setopt($this->curl, CURLOPT_POST, true);
        }
        switch ($method) {
            case 'POST':
            case 'PUT':
            case 'PATCH':
                //$data = json_encode($data);

                curl_setopt($this->curl, CURLOPT_CUSTOMREQUEST, $method);
                curl_setopt($this->curl, CURLOPT_POSTFIELDS, 'grant_type=client_credentials');
                break;
            case 'GET':
            case 'DELETE':
                curl_setopt($this->curl, CURLOPT_POSTFIELDS, http_build_query($data));
            default:
                throw new UnsupportedRequestType();
        }
        switch ($authType) {
            case 'Bearer':
                curl_setopt($this->curl, CURLOPT_HTTPAUTH, CURLAUTH_BEARER);
                break;
            case 'Basic':
                curl_setopt($this->curl, CURLOPT_HTTPHEADER, $this->headers);
                break;
            default:
                throw new UnsupportedAuthenticationType();
        }

        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($this->curl);
        curl_close($this->curl);
        if (!$response) {
            throw new InvalidRequestException();
        }
        $response = json_decode($response, true);

        return $response;
    }
}
