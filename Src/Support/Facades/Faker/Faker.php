<?php

namespace Plugin\JtlShopPluginStarterKit\Src\Support\Facades\Faker;

class Faker
{
    public function fakerImage($folder, $image)
    {
        $uploadPath = $_SERVER['DOCUMENT_ROOT'] . '/mediafiles';

        $dirname = $uploadPath . '/' . $folder . '/';
        if (!file_exists($dirname)) {
            mkdir($uploadPath . '/' . $folder . '/', 0777);
        }

        $imagePath = $dirname . $image;

        $fp = fopen($imagePath, 'w+');
        $ch = curl_init('https://picsum.photos/200/300');
        curl_setopt($ch, CURLOPT_FILE, $fp);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 1000);
        curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
        curl_exec($ch);

        curl_close($ch);
        fclose($fp);
    }
}
