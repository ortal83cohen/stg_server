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

}