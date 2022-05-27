<?php
use Slim\Http\Request;
use Slim\Http\Response;

require_once "controller/VehicleTypeController.php";

$app->get("/v1/vehicle-type/",  function (Request $request, Response $response, array $args) {
    $controller = new VehicleTypeController();

    return $controller->getAll($request, $response, $args);
});

$app->get("/v1/vehicle-type/{id}",  function (Request $request, Response $response, array $args) {
    $controller = new VehicleTypeController();

    return $controller->getById($request, $response, $args);
});


$app->patch("/v1/vehicle-type/{id}", function (Request $request, Response $response, array $args) {
    $controller = new VehicleTypeController();

    return $controller->updatePrice($request, $response, $args);
});
?>
