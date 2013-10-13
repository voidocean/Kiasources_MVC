<?php

include 'Kiasources_MVC/Config/route.php';
include 'Kiasources_MVC/Config/controllerConfig.php';
include 'Kiasources_MVC/Controller/Controller.php';


$controller = new controllerConfig();
$_controller = $controller->search();

$route = new Route($_controller);

$route->submit();
