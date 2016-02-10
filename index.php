<?php
/**
 * Created by PhpStorm.
 * User: ortal
 * Date: 2/7/2016
 */


// Kickstart the framework
$f3 = require(__DIR__ . '/fatfree/lib/base.php');
$f3->set('AUTOLOAD', 'model/; controller/; view/; db/; worker/');


// Load configuration
$f3->config('config.ini');

//define router
$f3->route('GET /',
    function () {
        $controller = new ControllerHome();
        $controller->render();
    }
);;

$f3->route('GET /records',
    function () {
        $controller = new ControllerRecords();
        $controller->setRequestParameters($_GET['lat'], $_GET['lan'],$_GET['lang']);
        $controller->fetchData();
        $controller->render();
    }
);


$f3->run();
