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

    public function setRequestParameters($context, $language, $customerCountryCode,$orderBy,$type,$limit,$order,$currency)
    {
        $this->lat = $context;
        $this->lan = $context;
        $this->lang = $language;
    }

    public function fetchData()
    {
        $sql = new MySql();
        $this->data = $sql->getRecords();

    }

}