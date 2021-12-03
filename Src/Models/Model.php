<?php

namespace Plugin\JtlShopStarterKite\Src\Models;

use Plugin\JtlShopStarterKite\Src\Database\Initialization\Connection;
use JTL\DB\ReturnType;

class Model extends Connection
{
    /**
     * table name $table
     */

    protected $table    = '';

    /**
     * table name $table
     */

    protected $primaryKey  = 'kArtikel';
    /**
     * colums to insert for access
     */

    protected $fillable = [];

    /**
     * columns to select
     */
    private $columns = '*';
    /**
     * query will fetch
     */
    private $query = '';

    public function select(String ...$columns)
    {
        $this->columns = implode(',', $columns);
        return $this;
    }

    public function orderBy(String $column, String $orderBy)
    {
        $this->query .= <<<QUERY
            ORDER BY $column $orderBy
        QUERY;
        return $this;
    }

    public function where(String $column, String $value)
    {
        $this->query .= <<<QUERY
            WHERE $column='$value'
        QUERY;
        return $this;
    }

    public function whereLike(String $column, String $value)
    {
        $this->query .= <<<QUERY
            $column LIKE '%$value%'
        QUERY;
        return $this;
    }

    public function count(String $column)
    {
        $query = <<<QUERY
            SELECT COUNT($column) AS count
            FROM $this->table
        QUERY;
        return $this;
    }

    public function paginate($limit = 10, $currentPage = 1)
    {
        $offset = ($currentPage - 1) * $limit;
        $rows = $this->db->executeQuery($this->query, ReturnType::ARRAY_OF_OBJECTS);
        $count = count($rows);
        $this->query .= <<<QUERY
            LIMIT $offset, $limit
        QUERY;
        $rows = $this->db->executeQuery($this->query, ReturnType::ARRAY_OF_OBJECTS);
        $totalPages = ceil($count / $limit);
        $lastPage = $currentPage <= 1 ? '' : $currentPage - 1;
        $nextPage = $currentPage < $totalPages ? $currentPage + 1 : '';
        return [
            'totalPages' => $totalPages,
            'lastPage' => $lastPage,
            'nextPage' => $nextPage,
            'currentPage' => $currentPage,
            'data'  =>  $rows
        ];
    }

    public function create(array $values)
    {
        $columns = implode(',', $this->fillable);
        $binds  = array_map(fn ($colum) => $colum = ":$colum", $this->fillable);
        $binds  = implode(',', $binds);
        $query = <<<QUERY
            INSERT INTO $this->table 
            ($columns,created_at,updated_at) 
            VALUES ($binds,:created_at,:updated_at)
        QUERY;
        $date = new \DateTime();
        $values['created_at'] = $date->format('Y-m-d H:i:s');
        $values['updated_at'] = $date->format('Y-m-d H:i:s');
        try {
            $row = $this->db->queryPrepared(
                $query,
                $values,
                ReturnType::ARRAY_OF_OBJECTS
            );
        } catch (\Exception $e) {
            return $e->getMessage();
        }
        return $row;
    }

    public function update(int $id)
    {
        // foreach ($this->fillable as $key => $colum) {
        //     $colum = ":$colum";
        // }
        // $binds  = array_map(fn ($colum) => $colum = ":$colum", $this->fillable);
        // $binds  = implode(',', $binds);
        // $this->query = <<<QUERY
        //     UPDATE $this->table
        //     SET $columns
        //     WHERE $this->primaryKey=':$this->primaryKey'
        // QUERY;

        // try {
        //     $rows = $this->db->queryPrepared(
        //         $this->query,
        //         $id,
        //         ReturnType::ARRAY_OF_OBJECTS
        //     );
        // } catch (\Exception $e) {
        //     return $e->getMessage();
        // }
        // return $rows;
    }

    public function delete(int $id)
    {
        $this->query = <<<QUERY
            DELETE FROM $this->table
            WHERE $this->primaryKey=':$this->primaryKey'
        QUERY;

        try {
            $rows = $this->db->queryPrepared($this->query, $id, ReturnType::ARRAY_OF_OBJECTS);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
        return $rows;
    }

    public function toSql(): string
    {
        return $this->query;
    }

    public function all()
    {
        $this->query = <<<QUERY
            SELECT $this->columns
            FROM $this->table 
        QUERY;
        $rows = $this->db->executeQuery($this->query, ReturnType::ARRAY_OF_OBJECTS);
        return $rows;
    }

    public function get()
    {
        $rows = $this->db->executeQuery($this->query, ReturnType::ARRAY_OF_OBJECTS);
        return $rows;
    }

    public function first()
    {
        $this->query .= <<<QUERY
            LIMIT 1
        QUERY;
        $rows = $this->db->executeQuery($this->query, ReturnType::ARRAY_OF_OBJECTS);
        return $rows;
    }
}
