<?php

/**
 * Created by PhpStorm.
 * User: user
 * Date: 17/02/2016
 * Time: 12:21
 */
class ControllerImage extends Controller
{

    public function getAction()
    {
        $dir = __DIR__ . "/../pictures";
        $file = $dir . "/" . $this->request['name'] . ".JPG";
//        print_r($file);
        header('Content-Type: image/JPG');

        echo file_get_contents($file);
    }

    public function render()
    {
    }

}