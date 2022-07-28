<?php

namespace MvcCore\Jtl\Support\Http;

class Request
{
    private static array $data = [];

    private static array $routeParams = [];

    public function __construct()
    {
        if (!!$_GET) {
            foreach ($_GET as $key => $item) {
                self::$data[$key] = filter_input(INPUT_GET, $key,  FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        if (!!$_POST) {
            foreach ($_POST as $key => $item) {
                self::$data[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        $data = file_get_contents('php://input');
        if (!!$data) {
            $data = json_decode($data, true);
            if ((is_array($data)) && (count($data) > 0)) {
                foreach ($data as $key => $item) {
                    self::$data[$key] = filter_var($item,  FILTER_SANITIZE_SPECIAL_CHARS);
                }
            }
        }
    }

    public static function type()
    {
        if (isset($_POST['_method']) && $_POST['_method'] === 'PUT') {
            return strtoupper($_POST['_method']);
        }
        if (isset($_POST['_method']) && $_POST['_method'] === 'PATCH') {
            return strtoupper($_POST['_method']);
        }
        if (isset($_GET['_method']) && $_GET['_method'] === 'DELETE') {
            return strtoupper($_GET['_method']);
        }
        return strtoupper($_SERVER['REQUEST_METHOD']);
    }

    public static function uri()
    {
        return $_SERVER['REQUEST_URI'];
    }

    public function all()
    {
        return self::$data;
    }

    public function set_route_params($params): self
    {
        foreach ($params as  &$param) {
            filter_var($param,  FILTER_SANITIZE_SPECIAL_CHARS);
        }
        unset($param);
        self::$routeParams = $params;
        return $this;
    }

    public function get_route_params(): array
    {
        return self::$routeParams;
    }

    public function unset(...$elements)
    {
        foreach ($elements as $element) {
            unset(self::$data[$element]);
        }
    }
}
