<?php

namespace Plugin\JtlShopPluginStarterKit\Src\Database\Initialization;

class Table
{
    private $columns;

    private $tableName;

    public function __construct(String $tableName)
    {
        $this->tableName = $tableName;
    }

    public function get_table_name(): string
    {
        return $this->tableName;
    }

    public function columns_to_string(): string
    {
        $string = implode(', ', $this->columns);
        return $string;
    }

    public function id($column = 'id'): self
    {
        $this->int($column)
            ->notNullable($column)
            ->autoIncrement($column)
            ->primaryKey($column);
        return $this;
    }

    public function primaryKey($column): self
    {
        $this->columns[] = "PRIMARY KEY($column)";
        return $this;
    }

    public function int($column, $length = 11): self
    {
        $this->columns[$column] = "$column INT($length)";
        return $this;
    }

    public function autoIncrement($column): self
    {
        $this->columns[$column] .= ' AUTO_INCREMENT';
        return $this;
    }

    public function notNullable($column): self
    {
        $this->columns[$column] .= ' NOT NULL';
        return $this;
    }

    public function nullable($column): self
    {
        $this->columns[$column] .= ' NULL';
        return $this;
    }

    public function unique($column): self
    {
        $this->columns[$column] .= ' UNIQUE';
        return $this;
    }

    public function index($column): self
    {
        $this->columns[] = "INDEX($column)";
        return $this;
    }

    public function string($column, $length = 256): self
    {
        $this->columns[$column] = "$column VARCHAR($length)";
        return $this;
    }

    public function timestamps(String $createdAt = 'created_at', String $updatedAt = 'updated_at'): self
    {
        $this->columns[$createdAt] = "$createdAt DATETIME NULL";
        $this->columns[$updatedAt] = "$updatedAt DATETIME NULL";
        return $this;
    }
}