<?php

/**
 * Created by PhpStorm.
 * User: ortal
 * Date: 2/7/2016
 */
abstract class Controller
{
    protected $data = array();

    public function render()
    {
        $view = new ViewStgJson($this->data);
        $view->display();

    }


}