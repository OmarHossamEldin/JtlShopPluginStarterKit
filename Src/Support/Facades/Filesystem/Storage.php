<?php

namespace Plugin\JtlShopPluginStarterKit\Src\Support\Facades\Filesystem;

use Plugin\JtlShopPluginStarterKit\Src\Validations\Alerts;

class Storage
{
    public static function load_resources()
    {
        $loadingPathFrom = Directory::get_resources();
        $loadingPathTo = Directory::get_root() . '/mediafiles/Resources';
        if (!file_exists($loadingPathTo) && !is_dir($loadingPathTo)) {
            exec("cp -r $loadingPathFrom $loadingPathTo");
        } else {
            $loadingPathFrom .= '/*';
            exec("cp -r $loadingPathFrom $loadingPathTo");
        }
    }

    public static function unload_resources()
    {
        $unLoadingPath = Directory::get_root() . '/mediafiles/Resources';
        exec("rm -r $unLoadingPath");
    }

    public function uploadFile($file, $folder)
    {

        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];
        $fileType = $file['type'];

        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allowed = ['jpg', 'jpeg', 'png'];

        if (in_array($fileActualExt, $allowed)) {
            if ($fileError === 0) {
                if ($fileSize < 1000_000) {
                    $fileNameNew = uniqid() . "." . $fileActualExt;
                    // check $folder is existed

                    $uploadPath = $_SERVER['DOCUMENT_ROOT'] . '/mediafiles';

                    $dirname = $uploadPath . '/' . $folder . '/';
                    if (!file_exists($dirname)) {
                        mkdir($uploadPath . '/' . $folder . '/', 0777);
                    }

                    $fileDestination = $dirname . $fileNameNew;

                    move_uploaded_file($fileTmpName, $fileDestination);

                    return $fileNameNew;
                    // end here
                } else {
                    Alerts::show('warning', ['Error:' => 'file size is too big']);
                }
            } else {

                Alerts::show('warning', ['error' => 'Error while uploading file']);
            }
        } else {

            Alerts::show('warning', ['Error:' => 'file extension is not allowed']);
        }
    }
}
