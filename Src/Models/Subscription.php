<?php

namespace MvcCore\Jtl\Models;
use JTL\DB\ReturnType;

use MvcCore\Jtl\Database\Initialization\Model;

class Subscription extends Model
{
    protected $table    = 'tec_see_subscriptions';

    protected $primaryKey  = 'id';

    protected $fillable = [
        'status',
        'subscripton_id',
        'plan_id',
        'start_time',
        'create_time',
        'customerId',
        'tec_see_job_id'        
    ];

    public function subscription_links()
    {
        return $this->hasMany(SubscriptionLinks::class, 'tec_see_subscription_id');
    }


    public function getAllSubscriptionsForThisCustomer($customerId): array
    {
        $query = <<<QUERY
        SELECT id,status,subscripton_id,plan_id,start_time,create_time
         FROM tec_see_subscriptions WHERE customerId="$customerId"
        QUERY;

        return $this->getDb()->executeQuery($query, ReturnType::ARRAY_OF_OBJECTS);
    }

    public function getSubscriptionById($id)
    {
        $query = <<<QUERY
        SELECT subscripton_id FROM tec_see_subscriptions 
        WHERE tec_see_job_id="$id"
        QUERY;

        return $this->getDb()->executeQuery($query, ReturnType::ARRAY_OF_OBJECTS);
    }



    public function getSubscriptionId($id)
    {
        $query = <<<QUERY
        SELECT id FROM tec_see_subscriptions 
        WHERE subscripton_id="$id"
        QUERY;

        return $this->getDb()->executeQuery($query, ReturnType::ARRAY_OF_OBJECTS);
    }


}
