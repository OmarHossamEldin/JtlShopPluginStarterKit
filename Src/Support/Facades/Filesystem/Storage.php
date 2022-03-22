<?php

namespace Plugin\JtlShopPluginStarterKit\Src\Support\Facades\Filesystem;

use Plugin\JtlShopPluginStarterKit\Src\Validations\Alerts;

class Storage
{
    private DirectoryComposer $directoryComposer;

    private DirectoryMaker $directoryMaker;

    public function __construct()
    {
        $this->directoryComposer = new DirectoryComposer();
        $this->directoryMaker = new DirectoryMaker();
    }

    public function load_resources($mainFolder, $folder)
    {
        $mainFolderPathTo = "{$this->directoryComposer->get_mediaFiles()}$mainFolder";
        if ($this->directoryMaker->make_directory($mainFolderPathTo)) {
            $loadingPathFrom = "{$this->directoryComposer->resources_root()}/$folder";
            $loadingPathTo = "$mainFolderPathTo/$folder";
            $this->directoryMaker->recurse_copy($loadingPathFrom, $loadingPathTo);
        }
    }

    public function unload_resources($folder)
    {
        $unLoadingPath = $this->directoryComposer->get_mediaFiles() . $folder;
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

                    $uploadPath = $this->directoryComposer->get_mediaFiles();

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
