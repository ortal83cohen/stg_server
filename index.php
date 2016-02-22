<?php
/**
 * Created by PhpStorm.
 * User: ortal
 * Date: 2/7/2016
 */


// Kickstart the framework
$f3 = require(__DIR__ . '/fatfree/lib/base.php');
$f3->set('AUTOLOAD', 'model/; controller/; view/; db/; worker/; DynamicConfig');
//$f3->set('DEBUG',3);
// Load configuration

if( $_SERVER['HTTP_HOST'] == 'localhost'){
    $f3->config('configs/localhost_config.ini');
}else{
    $f3->config('configs/config.ini');
}

//define router
$f3->route('GET /',
    function () {
        $controller = new ControllerHome();
        $controller->action();
    }
);;

$f3->route('GET /records',//'ControllerRecords->action'
    function () {
        $_GET['apiKey'];
        $controller = new ControllerRecords();//customerCountryCode=IL&language=en&orderBy=distance&offset=0type=spr&limit=15&order=asc&currency=ILS&context=32.1624241,34.8078849;5.0&apiKey=Ec95jbYA1iuAt&campaignId=280832094
        $controller->setRequest(array("context"=>$_GET['context'], "language"=>$_GET['language'],"customerCountryCode"=>$_GET['customerCountryCode'],"orderBy"=>$_GET['orderBy'],"type"=>$_GET['type'],"limit"=>$_GET['limit'],"order"=>$_GET['order'],"currency"=>$_GET['currency']));
        $controller->action("get");
    }
);

$f3->route('POST /records',//'ControllerRecords->action'
    function ($f3) {
        $controller = new ControllerRecords();//customerCountryCode=IL&language=en&orderBy=distance&offset=0type=spr&limit=15&order=asc&currency=ILS&context=32.1624241,34.8078849;5.0&apiKey=Ec95jbYA1iuAt&campaignId=280832094
        $controller->setRequest(json_decode($f3->get('BODY'),1));
        $controller->action();
    }
);

$f3->route('PUT /records',
    function ($f3) {
        $controller = new ControllerRecords();//customerCountryCode=IL&language=en&orderBy=distance&offset=0type=spr&limit=15&order=asc&currency=ILS&context=32.1624241,34.8078849;5.0&apiKey=Ec95jbYA1iuAt&campaignId=280832094
        $controller->setRequest(json_decode($f3->get('BODY'),1));
        $controller->action();
    }
);
$f3->route('GET /image',
    function () {
        $controller = new ControllerImage();//customerCountryCode=IL&language=en&orderBy=distance&offset=0type=spr&limit=15&order=asc&currency=ILS&context=32.1624241,34.8078849;5.0&apiKey=Ec95jbYA1iuAt&campaignId=280832094
        $controller->action();
    }
);
$f3->route('GET /image/@name',
    function ($f3) {
        $controller = new ControllerImage();//customerCountryCode=IL&language=en&orderBy=distance&offset=0type=spr&limit=15&order=asc&currency=ILS&context=32.1624241,34.8078849;5.0&apiKey=Ec95jbYA1iuAt&campaignId=280832094
        $controller->setRequest(array("name"=>$f3->get('PARAMS.name')));
        $controller->action();
    }
);

$f3->run();
