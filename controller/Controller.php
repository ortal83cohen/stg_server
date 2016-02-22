<?php

/**
 * Created by PhpStorm.
 * User: ortal
 * Date: 2/7/2016
 */
abstract class Controller extends F3instance
{
    protected $data = array();
    protected $request = array();

    public function render()
    {
        $view = new ViewStgJson($this->data);
        $view->display();

    }

    public function beforeAction()
    {
    }

    public function afterAction()
    {
        $this->render();
    }

    public function setRequest($request)
    {
        $this->request = $request;
    }

    public function action()
    {
        $this->beforeAction();

//            call_user_func($actionName . 'Action');
        switch ($_SERVER['REQUEST_METHOD']) {
            case "GET":
                $this->getAction();
                break;
            case "POST":
                $this->postAction();
                break;
            case "PUT":
                $this->putAction();
                break;
        }

        $this->afterAction();

    }

}