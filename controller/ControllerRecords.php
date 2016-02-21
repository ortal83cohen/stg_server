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
        $id = $sql->setRecords($this->request);
        $title = str_replace(' ', '', $this->request["title"] . $id);

        $decodedImage = base64_decode($this->request["image"]);
        $decodedRecord = base64_decode($this->request["record"]);
        file_put_contents($this->get("IMAGE_LIBRARY") . $title . $this->get("IMAGE_TYPE"), $decodedImage);
        file_put_contents($this->get("RECORD_LIBRARY") . $title . $this->get("RECORD_TYPE"), $decodedRecord);

    }

}