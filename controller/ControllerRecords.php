<?php

/**
 * Created by PhpStorm.
 * User: ortal
 * Date: 2/7/2016
 */
class ControllerRecords extends Controller
{
    public function action()
    {
        $this->fetchData();
        parent::action();
    }

    public function fetchData()
    {
        $sql = new MySql();
        $this->data = $sql->getRecords();

    }

}