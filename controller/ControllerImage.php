<?php

/**
 * Created by PhpStorm.
 * User: user
 * Date: 17/02/2016
 * Time: 12:21
 */
class ControllerImage extends Controller
{
    public function postAction()
    {
        $decodedImage = base64_decode($this->request["image"]);
        file_put_contents("pictures/" . $this->request["name"] . ".JPG", $decodedImage);
    }
    public function getAction()
    {

        $dir    =__DIR__."/../pictures";

        if (!file_exists($dir)) {
            mkdir($dir, 0777, true);
        }

        $files = scandir($dir, 1);

        print_r($files);

             $file = $dir.$files[0];

    header('Content-Type: image/jpg');
    header('Content-Length: ' . filesize($file));
    echo file_get_contents($file);
    }


}