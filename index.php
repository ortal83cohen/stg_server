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
        $_GET['apiKey'];
        $controller = new ControllerRecords();//customerCountryCode=IL&language=en&orderBy=distance&offset=0type=spr&limit=15&order=asc&currency=ILS&context=32.1624241,34.8078849;5.0&apiKey=Ec95jbYA1iuAt&campaignId=280832094
        $controller->setRequestParameters($_GET['context'], $_GET['language'],$_GET['customerCountryCode'],$_GET['orderBy'],$_GET['type'],$_GET['limit'],$_GET['order'],$_GET['currency']);
        $controller->fetchData();
        $controller->render();
    }
);


$f3->run();
