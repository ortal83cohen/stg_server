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

        $decodedImage = base64_decode($this->data["image"]);
        file_put_contents("pictures/" . $this->data["name"] . "JPG", $decodedImage);
    }


}