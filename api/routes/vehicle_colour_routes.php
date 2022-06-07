<?php

use Slim\Http\Request;
use Slim\Http\Response;

require_once "controller/VehicleColourController.php";

$app->get('/v1/vehicle-colours',  function (Request $request, Response $response, array $args) {
    
    $controller = new VehicleColourController();

    return $controller->getAll($request, $response, $args);

});

$app->get("/v1/vehicle-colours/{id}",  function (Request $request, Response $response, array $args) {
    
    $controller = new VehicleColourController();

    return $controller->getById($request, $response, $args);

});

$app->put("/v1/vehicles-colours/{id}", function (Request $request, Response $response, array $args) {
    $controller = new VehicleColourController();

    return $controller->update($request, $response, $args);
});

?>