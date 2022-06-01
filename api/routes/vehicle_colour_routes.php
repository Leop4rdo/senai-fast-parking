<?php

use Slim\Http\Request;
use Slim\Http\Response;

require_once "controller/VehicleColourController.php";

$app->get('/v1/vehicle-colour/',  function (Request $request, Response $response, array $args) {
    
    $controller = new VehicleColourController();

    return $controller->getAll($request, $response, $args);

});

$app->get("/v1/vehicle-colour/{id}",  function (Request $request, Response $response, array $args) {
    
    $controller = new VehicleColourController();

    return $controller->getById($request, $response, $args);

});

$app->post("/v1/vehicle-colour/",  function (Request $request, Response $response, array $args) {
    
    $controller = new VehicleColourController();

    return $controller->create($request, $response, $args);

});

$app->delete("/v1/vehicle-colour/{id}", function (Request $request, Response $response, array $args) {
    $controller = new VehicleColourController();

    return $controller->delete($request, $response, $args);
});

?>