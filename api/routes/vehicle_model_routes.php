<?php

use Slim\Http\Request;
use Slim\Http\Response;

require_once "controller/VehicleModelController.php";

$app->get('/v1/vehicle-model/',  function (Request $request, Response $response, array $args) {
    
    $controller = new VehicleModelController();

    return $controller->getAll($request, $response, $args);

});

$app->get("/v1/vehicle-model/{id}",  function (Request $request, Response $response, array $args) {
    
    $controller = new VehicleModelController();

    return $controller->getById($request, $response, $args);

});

$app->post("/v1/vehicle-model/",  function (Request $request, Response $response, array $args) {
    
    $controller = new VehicleModelController();

    return $controller->create($request, $response, $args);

});

$app->delete("/v1/vehicle-model/{id}", function (Request $request, Response $response, array $args) {
    $controller = new VehicleModelController();

    return $controller->delete($request, $response, $args);
});

?>