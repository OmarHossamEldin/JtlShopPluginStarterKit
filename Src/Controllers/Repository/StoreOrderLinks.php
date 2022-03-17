<?php

namespace Plugin\JtlShopPluginStarterKit\Src\Controllers\Repository;

use Plugin\JtlShopPluginStarterKit\Src\Models\OrderLink;

class StoreOrderLinks
{

    public function store($request)
    {
        $id = $request['id'];
        $status = $request['status'];
        $links = $request['links'];

        if (!empty($id)) {
            foreach ($links as $link) {
                $orderLink = new OrderLink;
                $orderLink->create([
                    'order_id' => $id,
                    'order_status' => $status,
                    'order_link' => $link['href'],
                    'link_name' => $link['rel'],
                    'order_method' => $link['method'],
                ]);
            }
        } else {
        }
    }
}
