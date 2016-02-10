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
//for rest api the view will be simple json, we can replace this view with specific xml
        $view = new ViewStgHome(null);
        echo $view->display();
    }

}