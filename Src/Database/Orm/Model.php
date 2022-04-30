<?php

namespace Plugin\JtlShopPluginStarterKit\Src\Database\Orm;

use JTL\DB\ReturnType;
use Plugin\JtlShopPluginStarterKit\Src\Database\Initialization\Connection;
use Plugin\JtlShopPluginStarterKit\Src\Exceptions\DatabaseQueryException;
use Plugin\JtlShopPluginStarterKit\Src\Exceptions\RelationClassException;
use Plugin\JtlShopPluginStarterKit\Src\Support\Collections\Collection;
use Plugin\JtlShopPluginStarterKit\Src\Support\Debug\Debugger;

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
    private $columns = '';

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

    private $secondTable = [];

    public function select(String ...$columns)
    {

        $columns = array_map(function ($column) {
            $column = $this->table . '.' . $column;
            return $column;
        }, $columns);

        $this->columns .= implode(',', $columns);

        $this->query = <<<QUERY
        SELECT $this->columns FROM $this->table
        QUERY;
        return $this;
    }

    public function selectUnion(String $column, String $firstTable, String $secondTable)
    {
        $this->query = <<<QUERY
        SELECT $column FROM $firstTable
        UNION
        SELECT $column FROM $secondTable
        QUERY;
        return $this;
    }

    public function Having(String $condition)
    {
        $this->query = <<<QUERY
          HAVING $condition
        QUERY;
        return $this;
    }

    public function SelectInto(String $newTable, String ...$columns)
    {
        $this->columns .= implode(',', $columns);

        $this->query = <<<QUERY
        SELECT $this->columns INTO $newTable FROM $this->table
        QUERY;
        return $this;
    }


    public function SelectCase(array $conditions, String $defaultCase, String ...$columns)
    {

        $cases = [];
        foreach ($conditions as $key => $value) {
            $cases[] = "WHEN" . " " . $key . " THEN" .  " '" . $value . "'";
        }

        $cases =  implode(" \r\n ", $cases);

        $this->columns .= implode(',', $columns);

        $this->query = <<<QUERY
        SELECT $this->columns,
         CASE
           $cases
           ELSE "$defaultCase"
         END AS result
         FROM $this->table
        QUERY;
        return $this;
    }

    public function index(String $column)
    {

        $index = 'IX_' . $column;
        $this->query = <<<QUERY
        CREATE INDEX  $index
        ON $this->table ($column);
        QUERY;
        return $this;
    }


    public function ifNull(String $column, String $value)
    {
        $this->query = <<<QUERY
          IFNULL($column, $value)
        QUERY;
        return $this;
    }

    public function rand()
    {
        $this->query = <<<QUERY
        SELECT RAND();
        QUERY;
        return $this;
    }

    public function length($string)
    {
        $this->query = <<<QUERY
        SELECT CHAR_LENGTH($string) AS LengthOfString
        QUERY;
        return $this;
    }

    public function view($view_name)
    {
        $this->query = <<<QUERY
        CREATE VIEW $view_name AS
        QUERY;
        return $this;
    }

    public function averageValue($column)
    {
        $this->query = <<<QUERY
        SELECT AVG($column) AS AverageValue FROM $this->table
        QUERY;
        return $this;
    }

    public function ceiling($value)
    {
        $this->query = <<<QUERY
        SELECT CEILING($value)
        QUERY;
        return $this;
    }

    public function floor($value)
    {
        $this->query = <<<QUERY
        SELECT FLOOR($value)
        QUERY;
        return $this;
    }

    public function selectMinimum(String $column)
    {
        $this->query = <<<QUERY
        SELECT min($column) AS minimumValue FROM $this->table
        QUERY;
        return $this;
    }

    public function selectMaximum(String $column)
    {
        $this->query = <<<QUERY
        SELECT MAX($column) AS maximumValue FROM $this->table
        QUERY;
        return $this;
    }

    public function currentDate()
    {
        $this->query = <<<QUERY
        SELECT CURRENT_DATE()
        QUERY;
        return $this;
    }

    public function currentTime()
    {
        $this->query = <<<QUERY
        SELECT CURRENT_TIME()
        QUERY;
        return $this;
    }

    public function currentTimeStamp()
    {
        $this->query = <<<QUERY
        SELECT CURRENT_TIMESTAMP()
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

    public function and()
    {
        $this->query .= <<<QUERY
            AND 
        QUERY;
        return $this;
    }

    public function isEqual(String $column, String $value)
    {
        $this->query .= <<<QUERY
            $column='$value'
        QUERY;
        return $this;
    }

    public function greaterThan(String $column, String $value)
    {
        $this->query .= <<<QUERY
            $column >= $value
        QUERY;
        return $this;
    }

    public function whereGreaterThan(String $column, String $value)
    {
        $this->query .= <<<QUERY
            WHERE $column >= $value
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

    public function whereBetweenOr(String $column, String $start, String $end, $value)
    {
        $this->query .= <<<QUERY
            WHERE ($column BETWEEN $start AND $end OR $column >= $value)
        QUERY;
        return $this;
    }

    public function whereNotBetween(String $column, String $start, String $end)
    {
        $this->query .= <<<QUERY
            WHERE $column NOT BETWEEN $start AND $end
        QUERY;
        return $this;
    }

    public function whereNotIn(String $column, array $values)
    {
        $data = implode(",", $values);

        $this->query .= <<<QUERY
            WHERE $column NOT IN($data)
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

    public function or(String $column, $value)
    {
        $this->query .= <<<QUERY
            OR $column >= $value
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

    public static function create(array $values): Collection
    {
        $static = new static();
        array_push($static->fillable, $static->createdAt, $static->updatedAt);
        $columns = implode(',', $static->fillable);
        $binds  = array_map(fn ($colum) => $colum = ":$colum", $static->fillable);
        $binds  = implode(',', $binds);
        $static->query = <<<QUERY
            INSERT INTO $static->table 
            ($columns) VALUES ($binds)
        QUERY;


        $values['created_at'] = self::currentTimeStamp();

        $values['updated_at'] = self::currentTimeStamp();

        $values['id'] = $static->db->queryPrepared($static->query, $values, ReturnType::LAST_INSERTED_ID);
        $collection = new Collection($values);

        if (!!$values['id'] === false) {
            throw new DatabaseQueryException();
        }
        return $collection;
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
        $collection = new Collection($values);

        if (!!$result->queryString === false) {
            throw new DatabaseQueryException();
        }
        return $collection;
    }

    public function delete(int $id)
    {
        $this->query = <<<QUERY
            DELETE FROM $this->table
            WHERE $this->primaryKey=:$this->primaryKey
        QUERY;

        $values['id'] = $id;
        $result = $this->db->queryPrepared($this->query, $values, ReturnType::QUERYSINGLE);
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

        $values['id'] = $id;

        $result = $this->db->queryPrepared($this->query, $values, ReturnType::QUERYSINGLE);
        if (!!$result->queryString === false) {
            throw new DatabaseQueryException();
        }
        return $result;
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

    public function toSql(): string
    {
        return $this->query;
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
            if (stripos($relation, ':') !== 0) {
                [$relation, $columns] = explode(':', $relation);
                $this->secondTable = explode(',', $columns);
                if (method_exists($this, $relation)) {
                    return call_user_func([$this, $relation]);
                }
            } else {
                if (method_exists($this, $relation)) {
                    return call_user_func([$this, $relation]);
                }
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


        if ($this->secondTable !== []) {
            $query = explode('FROM', $this->query);
            foreach ($this->secondTable as $secondTableColumns) {
                $secondTableColumns = $table . '.' . $secondTableColumns;
                $query[0] .=  ',' . $secondTableColumns;
            }

            $this->query = implode(' FROM ', $query);
        }


        $this->query .= <<<QUERY
         LEFT JOIN $table
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


        if ($this->secondTable !== []) {
            $query = explode('FROM', $this->query);


            foreach ($this->secondTable as $secondTableColumns) {

                $secondTableColumns = $table . '.' . $secondTableColumns;
                $query[0] .=  ',' . $secondTableColumns;
            }

            $this->query = implode(' FROM ', $query);
        }

        $this->query .= <<<QUERY
          JOIN $table
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


        if ($this->secondTable !== []) {
            $query = explode('FROM', $this->query);

            foreach ($this->secondTable as $secondTableColumns) {
                $secondTableColumns = $table . '.' . $secondTableColumns;
                $query[0] .=  ',' . $secondTableColumns;
            }

            $this->query = implode(' FROM ', $query);
        }

        $this->query .= <<<QUERY
         JOIN  $pivot
        ON  $this->table.$this->primaryKey = $pivot.$foreignKey
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


            $values['created_at'] = self::currentTimeStamp();
            $values['updated_at'] = self::currentTimeStamp();

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

    public function attachWith($pivot, int $id, $foreignKey, array $additionalValues)
    {

        $keys = [];
        $values = [];

        foreach ($additionalValues as $key => $value) {
            $keys[] = $key;
            $values[] = $value;
        }

        $columns = implode(',', $keys);
        $binds  = array_map(fn ($colum) => $colum = ":$colum", $keys);
        $binds  = implode(',', $binds);



        $this->query = <<<QUERY
            INSERT INTO $pivot
            ($foreignKey,$columns,created_at,updated_at) 
            VALUES (:foreignKey,$binds,:created_at,:updated_at)
            QUERY;

        $additionalValues['foreignKey'] = $id;


        $additionalValues['created_at'] = self::currentTimeStamp();
        $additionalValues['updated_at'] = self::currentTimeStamp();

        try {
            $rows = $this->db->queryPrepared(
                $this->query,
                $additionalValues,
                ReturnType::ARRAY_OF_OBJECTS
            );
        } catch (\Exception $e) {
            return $e->getMessage();
        }

        return $rows;
    }
}
