<?php

use Slim\Http\Request;
use Slim\Http\Response;

require_once "controller/VehicleInOutController.php";

$app->get('/v1/vehicle-in-out/', function (Request $request, Response $response, array $args) {
    $controller = new VehicleInOutController();

    return $controller->getAll($request, $response, $args);
});

$app->get("/v1/vehicle-in-out/{id}",  function (Request $request, Response $response, array $args) {
    $controller = new VehicleInOutController();

    return $controller->getById($request, $response, $args);
});

$app->post('/v1/vehicle-in-out/', function (Request $request, Response $response, array $args) {
    $controller = new VehicleInOutController();

    return $controller->create($request, $response, $args);
});

$app->put("/v1/vehicle-in-out/exit/{id}",  function (Request $request, Response $response, array $args) {
    $controller = new VehicleInOutController();

    return $controller->setExitTime($request, $response, $args);
});