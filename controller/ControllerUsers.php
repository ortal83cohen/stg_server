<?php

/**
 * Created by PhpStorm.
 * User: ortal
 * Date: 2/7/2016
 */
class ControllerUsers extends Controller
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
        $this->data = $this->sql->getRecords();
    }

    public function postAction()
    {
        $this->sql->setUsers($this->request);
    }

    public function putAction()
    {
        $this->sql->updateUsers($this->request);
    }

}