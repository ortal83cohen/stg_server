<?php

/**
 * Created by PhpStorm.
 * User: ortal
 * Date: 2/8/2016
 */
class ViewStgJson extends ViewStg
{
    public function display()
    {

        echo json_encode(array("records" => $this->data));
    }

}