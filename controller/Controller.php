<?php

/**
 * Created by PhpStorm.
 * User: ortal
 * Date: 2/7/2016
 */
abstract class Controller
{
    protected $data = array();
    protected $request = array();

    public function render()
    {
        $view = new ViewStgJson($this->data);
        $view->display();

    }

    public function setRequest($request )
    {
        $this->request = $request;
    }

    public function action($actionName  = null)
    {
        if($actionName) {
//            call_user_func($actionName . 'Action');
            switch ($actionName){
                case "get":
                   $this->getAction();
                    break;
                case "post":
                    $this->postAction();
            }

        }
        $this->render();
    }

}