<?php

namespace MvcCore\Jtl\Database\Initialization;

class Migration
{
    public function call(array $tables, string $type)
    {
        foreach ($tables as $table) {
            $table = new $table();
            if ($type === 'run_up') {
                $table->run_up();
            } else if ($type === 'run_down') {
                $table->run_down();
            }
        }
    }
}
