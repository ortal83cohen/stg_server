<?php

/**
 * Created by PhpStorm.
 * User: ortal
 * Date: 2/7/2016
 */
class ControllerRecords extends Controller
{
    private $lat;
    private $lan;
    private $lang;

    public function setRequestParameters($lat, $lan, $lang)
    {
        $this->lat = $lat;
        $this->lan = $lan;
        $this->lang = $lang;
    }

    public function fetchData()
    {
        $sql = new MySql();
        $this->data = $sql->getRecords();

    }

}