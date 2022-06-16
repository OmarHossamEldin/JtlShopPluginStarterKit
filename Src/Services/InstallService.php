<?php

namespace MvcCore\Jtl\Services;

use MvcCore\Jtl\Database\Migrations\DataBaseMigrations;
use MvcCore\Jtl\Database\Seeders\DatabaseSeeder;
use MvcCore\Jtl\Support\Debug\Debugger;
use MvcCore\Jtl\Support\Facades\Filesystem\Storage;

class InstallService
{

    private Storage $storage;

    private DataBaseMigrations $dataBaseMigrations;

    private DatabaseSeeder $databaseSeeder;

    public function __construct()
    {
        $this->storage = new Storage();
        $this->dataBaseMigrations = new DataBaseMigrations();
        $this->databaseSeeder = new DatabaseSeeder();
    }
    /**
     * * it's migrate database tables  and create seeders when plugin installed
     */

    public function install()
    {
        $start = microtime(true);
        $this->dataBaseMigrations->run_up();

        $this->databaseSeeder->run();

        $this->storage->load_resources('Resources', 'images');

        $end = microtime(true);
        $debugger = new Debugger();
        $time = $end - $start;
        $debugger->log("installed in $time seconds");
    }

    public function unInstall()
    {
        $this->dataBaseMigrations->run_down();
        $this->storage->unload_resources('Resources/images');
    }
}
