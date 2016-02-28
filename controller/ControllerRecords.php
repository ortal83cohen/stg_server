<?php

/**
 * Created by PhpStorm.
 * User: ortal
 * Date: 2/7/2016
 */
class ControllerRecords extends Controller
{
    private $sql;

    public function getAction()
    {
        $this->fetchData();
    }

    public function beforeAction()
    {
        $this->sql = new MySql();
    }

    public function fetchData()
    {
        switch ($this->request['type']) {
            case "service_gps_viewport":
                $this->data = $this->sql->getServiceGpsViewportRecords($this->request);
                break;
            default:
                $this->data = $this->sql->getRecords($this->request);
                break;
        }

    }

    public function postAction()
    {

        $id = $this->sql->setRecords($this->request);
        $title = str_replace(' ', '', $this->request["title"] . $id);

        $decodedImage = base64_decode($this->request["image"]);
        $decodedRecord = base64_decode($this->request["record"]);
        file_put_contents($this->get("IMAGE_LIBRARY") . $title . $this->get("IMAGE_TYPE"), $decodedImage);
        file_put_contents($this->get("RECORD_LIBRARY") . $title . $this->get("RECORD_TYPE"), $decodedRecord);

    }

    public function putAction()
    {

        $this->sql->updateRecords($this->request);
    }

}