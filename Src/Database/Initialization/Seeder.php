<?php

namespace Plugin\JtlShopPluginStarterKit\Src\Database\Initialization;

class Seeder
{
    public function call(array $tablesSeeders)
    {
        foreach ($tablesSeeders as $tableSeeder) {
            $tableSeeder = new $tableSeeder();
            $tableSeeder->create();
        }
    }
}
