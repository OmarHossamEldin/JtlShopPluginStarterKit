<?php

namespace MvcCore\Jtl\Models;

use MvcCore\Jtl\Database\Initialization\Model;
use JTL\DB\ReturnType;

class RegisteredProduct extends Model
{
    protected $table    = 'tec_see_registered_products';

    protected $primaryKey  = 'id';

    protected $fillable = [
        'name',
        'is_sent',
        'tec_see_job_id',
        'tec_see_product_id'
    ];


    public function job()
    {
        return $this->belongsTo(Job::class, 'tec_see_job_id');
    }





    public function getRegisteredProducts($limit = 10, $currentPage = 1): array
    {
        $query = <<<QUERY
     SELECT tec_see_registered_products.name AS product_name,tec_see_registered_products.is_sent,tec_see_registered_products.tec_see_product_id AS registerdProductId,tec_see_registered_products.jtl_id ,tec_see_jobs.status FROM  tec_see_registered_products LEFT JOIN tec_see_jobs
     ON  tec_see_registered_products.tec_see_job_id = tec_see_jobs.id
     QUERY;

        //return $this->getDb()->executeQuery($query, ReturnType::ARRAY_OF_OBJECTS);


        $offset = ($currentPage - 1) * $limit;
        $rows = $this->db->executeQuery($query, ReturnType::ARRAY_OF_OBJECTS);
        $count = count($rows);
        $query .= <<<QUERY
         LIMIT $offset, $limit
     QUERY;
        $rows = $this->db->executeQuery($query, ReturnType::ARRAY_OF_OBJECTS);
        $totalPages = ceil($count / $limit);
        $lastPage = $currentPage <= 1 ? '' : $currentPage - 1;
        $nextPage = $currentPage < $totalPages ? $currentPage + 1 : '';
        return [
            'totalPages' => $totalPages,
            'lastPage' => $lastPage,
            'nextPage' => $nextPage,
            'currentPage' => $currentPage,
            'resultPerPage' => $limit,
            'rows'  =>  $rows
        ];
    }



    public function getRegisteredProductsById($id)
    {
        $query = <<<QUERY
        SELECT tec_see_registered_products.name,tec_see_registered_products.is_sent,
        tec_see_registered_products.tec_see_job_id FROM tec_see_registered_products 
        WHERE tec_see_job_id=$id
        QUERY;

        return $this->getDb()->executeQuery($query, ReturnType::ARRAY_OF_OBJECTS);
    }



    public function getRegisteredProductsByName($name)
    {
        $query = <<<QUERY
        SELECT tec_see_product_id AS productId,is_sent FROM tec_see_registered_products 
        WHERE name="$name" LIMIT 1
        QUERY;

        return $this->getDb()->executeQuery($query, ReturnType::ARRAY_OF_OBJECTS);
    }
}
