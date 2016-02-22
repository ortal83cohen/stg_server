<?php

/**
 * Created by PhpStorm.
 * User: ortal
 * Date: 2/7/2016
 */
class ControllerHome extends Controller
{
    public function render()
    {
        $view = new ViewStgHome(null);
        echo $view->display();
    }

    public function getAction()
    {

    }


}