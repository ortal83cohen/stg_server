<?php

/**
 * Created by PhpStorm.
 * User: ortal
 * Date: 2/7/2016
 */
class ControllerRecords extends Controller
{
    public function getAction()
    {
        $this->fetchData();
    }

    public function fetchData()
    {
        $sql = new MySql();
        $this->data = $sql->getRecords();

    }

    public function postAction()
    {
        $sql = new MySql();
        $this->data = $sql->setRecords($this->request);

        $decodedImage = base64_decode($this->request["image"]);
        file_put_contents($this->get("IMAGE_LIBRARY") . $this->request["title"] . $this->get("IMAGE_TYPE"), $decodedImage);
    }

}