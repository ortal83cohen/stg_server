<?php

/**
 * Created by PhpStorm.
 * User: ortal
 * Date: 2/8/2016
 */
abstract class ViewStg
{
    protected $data;

    /**
     * View constructor.
     * @param $data
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function display()
    {

    }
}