<?php

namespace Plugin\JtlShopPluginStarterKit\Src\Controllers\Repository;

use JTL\Shop;
use JTL\Session\Frontend;

class getDataFromShop
{
    public function getCustomerAddress()
    {
        $sessionCustomer    = Frontend::getCustomer();
        $userAddress = "$sessionCustomer->cHausnummer $sessionCustomer->cStrasse,$sessionCustomer->cOrt";

        return $userAddress;
    }

    public function getProductFullPrice()
    {

        $product     = new Product();
        $products    = $product->
        select('kArtikel', 'CName','fStandardpreisNetto as taxPrice')
        ->whereLike('cName', 'schloss')
        ->orLike('cName', 'lock')
        ->get();
        $shopUrl = Shop::getURL();
        $uploads = $shopUrl . '/media/image/storage/';
        array_walk($products, function ($product) use ($image, $uploads) {
            $tempImage = $image->select('cPfad AS imageName', 'kArtikel')->where('kArtikel', $product->kArtikel)->first();
            $product->image_path = $uploads;
            $product->image_path .= $tempImage ? $tempImage->imageName : 'placeholderImage.png';

            $price = $product->taxPrice / 0.84033613;
            $product->productFullPrice = round($price);

        });
        return $products;
    }


}
