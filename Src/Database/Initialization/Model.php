<?php

namespace Plugin\JtlShopPluginStarterKit\Src\Database\Initialization;

use JTL\DB\ReturnType;
use Plugin\JtlShopPluginStarterKit\Src\Exceptions\DatabaseQueryException;
use Plugin\JtlShopPluginStarterKit\Src\Exceptions\RelationClassException;

abstract class Model extends Connection
{
    /**
     * table name $table
     */
    protected $table  = '';

    /**
     * table name $table
     */
    protected $primaryKey  = 'kArtikel';

    /**
     * columns to insert for access
     */
    protected $fillable = [];

    /**
     * columns to select
     */
    private $columns = '*';

    /**
     * timestamp
     */
    protected $createdAt = 'created_at';

    /**
     * update timestamp
     */
    protected $updatedAt = 'updated_at';

    /**
     * query will fetch
     */
    private $query = '';

    public function select(String ...$columns)
    {

        $this->columns = implode(',', $columns);

        $this->query = <<<QUERY
        SELECT $this->columns FROM $this->table
        QUERY;
        return $this;
    }

    public function selectWith(String ...$columns)
    {

        $this->columns = implode(',', $columns);

        $this->query = <<<QUERY
        SELECT $this->columns
        QUERY;
        return $this;
    }

    public function groupBy($table, String $column)
    {
        $this->query .= <<<QUERY
           GROUP BY $table.$column
        QUERY;
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
            WHERE $column LIKE '%$value%'
        QUERY;
        return $this;
    }

    public function whereBetween(String $column, String $start, String $end)
    {
        $this->query .= <<<QUERY
            WHERE $column BETWEEN '$start' AND '$end'
        QUERY;
        return $this;
    }

    public function whereAnd(String $firstColumn, String $start, String $secondColumn, String $end)
    {
        $this->query .= <<<QUERY
            WHERE $firstColumn >= '$start' AND  $secondColumn <= '$end'
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
        array_push($this->fillable, $this->createdAt, $this->updatedAt);
        $columns = implode(',', $this->fillable);
        $binds  = array_map(fn ($colum) => $colum = ":$colum", $this->fillable);
        $binds  = implode(',', $binds);
        $this->query = <<<QUERY
            INSERT INTO $this->table 
            ($columns) VALUES ($binds)
        QUERY;

        $date = new \DateTime();
        $values['created_at'] = $date->format('Y-m-d H:i:s');
        $values['updated_at'] = $date->format('Y-m-d H:i:s');

        $result = $this->db->queryPrepared($this->query, $values, ReturnType::QUERYSINGLE);

        if (!!$result->queryString === false) {
            throw new DatabaseQueryException();
        }
        return $result;
    }

    public function update(array $values, int $id)
    {
        $keys = array_keys($values);

        $binds  = array_map(fn ($colum) => $colum = "$colum = :$colum", $keys);

        $binds  = implode(',', $binds);

        $this->query = <<<QUERY
            UPDATE $this->table
            SET   $binds
            WHERE $this->primaryKey= :$this->primaryKey
        QUERY;

        $values['id'] = $id;

        $result = $this->db->queryPrepared($this->query, $values, ReturnType::QUERYSINGLE);
        if (!!$result->queryString === false) {
            throw new DatabaseQueryException();
        }
        return $result;
    }

    public function delete(int $id)
    {
        $this->query = <<<QUERY
            DELETE FROM $this->table
            WHERE $this->primaryKey=:$this->primaryKey
        QUERY;

        $value['id'] = $id;
        $result = $this->db->queryPrepared($this->query, $value, ReturnType::QUERYSINGLE);
        if (!!$result->queryString === false) {
            throw new DatabaseQueryException();
        }
        return $result;
    }

    public function patch($column, $value, $id)
    {
        $this->query = <<<QUERY
            UPDATE $this->table
            SET $column = "$value"
            WHERE $this->primaryKey=:$this->primaryKey
        QUERY;

        $data['id'] = $id;

        $result = $this->db->queryPrepared($this->query, $data, ReturnType::QUERYSINGLE);
        if (!!$result->queryString === false) {
            throw new DatabaseQueryException();
        }
        return $result;
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
        $result = $this->db->executeQuery($this->query, ReturnType::ARRAY_OF_OBJECTS);
        return $result;
    }

    public function get()
    {
        $result = $this->db->executeQuery($this->query, ReturnType::ARRAY_OF_OBJECTS);
        return $result;
    }

    public function first()
    {
        $this->query .= <<<QUERY
            LIMIT 1
        QUERY;
        $result = $this->db->executeQuery($this->query, ReturnType::ARRAY_OF_OBJECTS);
        return $result;
    }

    public function with(string ...$relations)
    {
        array_map(function ($relation) {
            if (method_exists($this, $relation)) {
                return call_user_func([$this, $relation]);
            }
        }, $relations);
        return $this;
    }


    public function join($table, $foreign, $lastTable, $lastTableId)
    {
        $this->query .= <<<QUERY
         JOIN $lastTable
        ON  $table.$foreign = $lastTable.$lastTableId
        QUERY;
        return  $this;
    }


    public function belongsTo($class, $foreign = null)
    {
        if (class_exists($class)) {
            $class = new $class;
            $table = $class->table;
            $primary_key = $class->primaryKey;
        } else {
            new RelationClassException();
        }

        $foreign ??= $primary_key;

        $this->query .= <<<QUERY
         FROM $this->table JOIN $table
        ON  $this->table.$foreign = $table.$primary_key
        QUERY;
        $rows = $this->db->executeQuery($this->query, ReturnType::ARRAY_OF_OBJECTS);

        return $rows;
    }

    public function hasMany($class, $id)
    {
        if (class_exists($class)) {
            $class = new $class;
            $table = $class->table;
            // $primary_key = $class->primaryKey;
        } else {
            new RelationClassException();
        }

        //$foreign ??= $primary_key;

        $this->query .= <<<QUERY
         FROM $this->table JOIN $table
        ON  $this->table.$this->primaryKey = $table.$id
        QUERY;
        $rows = $this->db->executeQuery($this->query, ReturnType::ARRAY_OF_OBJECTS);

        return $rows;
    }

    public function belongsToMany($class, $pivot, $foreignKey, $joiningTableForeignKey)
    {
        if (class_exists($class)) {
            $class = new $class;
            $table = $class->table;
            $primary_key = $class->primaryKey;
        } else {
            new RelationClassException();
        }

        $this->query .= <<<QUERY
         FROM  $pivot JOIN $this->table
        ON $pivot.$foreignKey = $this->table.$this->primaryKey
        JOIN $table ON $pivot.$joiningTableForeignKey   = $table.$primary_key
        QUERY;
        $this->db->executeQuery($this->query, ReturnType::ARRAY_OF_OBJECTS);

        return $this;
    }

    public function attach($pivot, int $id, $foreignKey, $attachedIds, $joiningTableForeignKey, string $column = '', $value = NULL)
    {

        for ($i = 0; $i < count($attachedIds); $i++) {

            $this->query = <<<QUERY
            INSERT INTO $pivot
            ($joiningTableForeignKey,$foreignKey,created_at,updated_at) 
            VALUES (:ForeignKeyValue,:foreignKey,:created_at,:updated_at)
            QUERY;

            $values['ForeignKeyValue'] = $attachedIds[$i];
            $values['foreignKey'] = $id;

            $date = new \DateTime();
            $values['created_at'] = $date->format('Y-m-d H:i:s');
            $values['updated_at'] = $date->format('Y-m-d H:i:s');

            $result = $this->db->queryPrepared($this->query, $values, ReturnType::QUERYSINGLE);

            if (!!$result->queryString === false) {
                throw new DatabaseQueryException();
            }
        }
        return $result;
    }

    public function detach($pivot, $detachingTableForeignKey, $foreignKeyValue)
    {

        $this->query = <<<QUERY
        DELETE FROM $pivot
        WHERE $detachingTableForeignKey =:$detachingTableForeignKey
        QUERY;

        $value["$detachingTableForeignKey"] = $foreignKeyValue;

        $result = $this->db->queryPrepared($this->query, $value, ReturnType::QUERYSINGLE);

        if (!!$result->queryString === false) {
            throw new DatabaseQueryException();
        }
        return $result;
    }
}
