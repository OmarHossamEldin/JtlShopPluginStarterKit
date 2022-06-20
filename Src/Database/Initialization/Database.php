<?php

namespace MvcCore\Jtl\Database\Initialization;

use Illuminate\Database\Capsule\Manager as Capsule;

class Database
{
    public string $host;
    public string $name;
    public string $user;
    public string $pass;

    public function __construct()
    {
        $this->host = \DB_HOST;
        $this->name = \DB_NAME;
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
        $capsule = new Capsule();
        $capsule->addConnection([
            "driver" => "mysql",
            "host" => $this->host,
            "database" => $this->database,
            "username" => $this->user,
            "password" => $this->pass
        ]);
        
        $capsule->setAsGlobal();
        $capsule->bootEloquent();
    }

}