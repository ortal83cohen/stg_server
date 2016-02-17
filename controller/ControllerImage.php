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


}