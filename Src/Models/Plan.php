<?php

namespace MvcCore\Jtl\Models;

use MvcCore\Jtl\Database\Initialization\Model;
use JTL\DB\ReturnType;

class Plan extends Model
{
    protected $table    = 'tec_see_plans';

    protected $primaryKey  = 'id';

    protected $fillable = [
        'product_name',
        'type',
        'count',
        'plan_id',
    ];

    public function getPlanDataByPlanId($id)
    {
        $query = <<<QUERY
        SELECT product_name,type,count,plan_id
         FROM tec_see_plans WHERE plan_id="$id" LIMIT 1
        QUERY;

        return $this->getDb()->executeQuery($query, ReturnType::ARRAY_OF_OBJECTS);
    }




}
