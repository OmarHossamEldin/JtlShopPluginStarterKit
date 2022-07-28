<?php

namespace MvcCore\Jtl\Database\Initialization;

use Illuminate\Database\Capsule\Manager as Capsule;

class Database
{
    private string $host;
    private string $database;
    private string $user;
    private string $pass;

    public function __construct()
    {
        $this->host = \DB_HOST;
        $this->database = \DB_NAME;
        $this->user = \DB_USER;
        $this->pass = \DB_PASS;
    }

    /**
     * start connection to database using elequent
     *
     * @return void
     */
    public function connect()
    {
        $params = [
            "driver" => "mysql",
            "host" => $this->host,
            "database" => $this->database,
            "username" => $this->user,
            "password" => $this->pass,
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => 'tec_see_',
        ];
        $capsule = new Capsule();
        $capsule->addConnection($params);

        $capsule->setAsGlobal();
        $capsule->bootEloquent();
    }
}
