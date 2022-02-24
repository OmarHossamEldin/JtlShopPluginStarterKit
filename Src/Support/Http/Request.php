<?php

namespace Plugin\JtlShopPluginStarterKit\Src\Support\Http;

class Request
{
    private array $data = [];

    public function __construct()
    {
        if (isset($_GET) & !empty($_GET)) {
            foreach ($_GET as $key => $item) {
                $this->data[$key] = $item;
            }
        }
        if (isset($_POST) & !empty($_POST)) {
            foreach ($_POST as $key => $item) {
                $this->data[$key] = $item;
            }
        }
        if ($data = file_get_contents('php://input')) {
            $data = json_decode($data, true);
            foreach ($data as $key => $item) {
                $this->data[$key] = $item;
            }
        }
    }

    public static function type()
    {
        if (isset($_POST['_method']) && $_POST['_method'] === 'PUT') {
            return strtolower($_POST['_method']);
        }
        if (isset($_POST['_method']) && $_POST['_method'] === 'PATCH') {
            return strtolower($_POST['_method']);
        }
        if (isset($_GET['_method']) && $_GET['_method'] === 'DELETE') {
            return strtolower($_GET['_method']);
        }
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public static function uri()
    {
        return $_SERVER['REQUEST_URI'];
    }

    public function all()
    {
        return $this->data;
    }

    public function referral()
    {
        return isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
    }
}
