<?php

namespace MvcCore\Jtl\Models;

use MvcCore\Jtl\Database\Initialization\Model;
use JTL\DB\ReturnType;

class PlanLinks extends Model
{
    protected $table    = 'tec_see_plan_links';

    protected $primaryKey  = 'id';

    protected $fillable = [
        'link',
        'type',
        'method',
        'plan_id',
    ];


    public function getLinkWithPlanId($id)
    {
        $query = <<<QUERY
        SELECT link FROM tec_see_plan_links 
        WHERE plan_id="$id" AND method="GET"
        QUERY;

        return $this->getDb()->executeQuery($query, ReturnType::ARRAY_OF_OBJECTS);
    }



}
