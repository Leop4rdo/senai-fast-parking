<?php

use Slim\Http\Request;
use Slim\Http\Response;

require_once "controller/ParkingSpotController.php";

$app->get('/v1/parking-spots',  function (Request $request, Response $response, array $args) {
    $controller = new ParkingSpotController();

    return $controller->getAll($request, $response, $args);
});


$app->get("/v1/parking-spots/{id}",  function (Request $request, Response $response, array $args) {
    $controller = new ParkingSpotController();

    return $controller->getById($request, $response, $args);
});

$app->post('/v1/parking-spots',  function (Request $request, Response $response, array $args) {
    $controller = new ParkingSpotController();

    return $controller->create($request, $response, $args);
});


$app->delete("/v1/parking-spots/{id}", function (Request $request, Response $response, array $args) {
    $controller = new ParkingSpotController();

    return $controller->delete($request, $response, $args);
});

$app->put("/v1/parking-spots/{id}", function (Request $request, Response $response, array $args) {
    $controller = new ParkingSpotController();

    return $controller->update($request, $response, $args);
});
