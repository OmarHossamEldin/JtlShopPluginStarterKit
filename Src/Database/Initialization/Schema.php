<?php

namespace Plugin\JtlShopPluginStarterKit\Src\Database\Initialization;

use Plugin\JtlShopPluginStarterKit\Src\Database\Initialization\Connection;
use Plugin\JtlShopPluginStarterKit\Src\Exceptions\DatabaseQueryException;

class Schema extends Connection
{
    private static function get_db_connect(): Connection
    {
        return (new Connection);
    }

    public static function create($tableName, callable $callable, $engine = 'ENGINE=InnoDB COLLATE utf8_general_ci')
    {
        $table = new Table($tableName, $engine);
        call_user_func($callable, $table);
        $tableName = $table->get_table_name();
        $columns = $table->columns_to_string();
        $query = <<<QUERY
            CREATE TABLE IF NOT EXISTS $tableName
                ($columns) $engine
        QUERY;

        if (!self::get_db_connect()->db->executeExQuery($query)) {
            throw new DatabaseQueryException();
        }
    }

    public static function dropIfExists(String $tableName)
    {
        if (!self::get_db_connect()->db->executeExQuery("DROP TABLE IF EXISTS $tableName")) {
            throw new DatabaseQueryException();
        }
    }
}
