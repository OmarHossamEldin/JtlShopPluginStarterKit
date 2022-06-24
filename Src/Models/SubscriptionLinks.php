<?php

namespace MvcCore\Jtl\Models;

use MvcCore\Jtl\Database\Initialization\Model;
use JTL\DB\ReturnType;

class SubscriptionLinks extends Model
{
    protected $table    = 'tec_see_subscription_links';

    protected $primaryKey  = 'id';

    protected $fillable = [
        'link',
        'type',
        'method',
        'tec_see_subscription_id',
    ];

    public function getLinkWithSubscriptionId($id)
    {
        $query = <<<QUERY
        SELECT link FROM tec_see_subscription_links 
        WHERE tec_see_subscription_id="$id" AND method="GET"
        QUERY;

        return $this->getDb()->executeQuery($query, ReturnType::ARRAY_OF_OBJECTS);
    }



}
