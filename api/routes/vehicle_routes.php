<?php

use Slim\Http\Request;
use Slim\Http\Response;

require_once "controller/VehicleController.php";

$app->get('/v1/vehicles',  function (Request $request, Response $response, array $args) {
    
    $controller = new VehicleController();

    if( $request->getQueryParam("customer") > 0 )
        return $controller->getByCustomerId($request, $response, $args);
    elseif ($request->getQueryParam("plate")) {
        return $controller->getByLicensePlate($request, $response, $args);
    } else 
        return $controller->getAll($request, $response, $args);

});

$app->get("/v1/vehicles/{id}",  function (Request $request, Response $response, array $args) {
    
    $controller = new VehicleController();

    return $controller->getById($request, $response, $args);

});

$app->post("/v1/vehicles",  function (Request $request, Response $response, array $args) {
    
    $controller = new VehicleController();

    return $controller->create($request, $response, $args);

});

$app->put("/v1/vehicles/{id}", function (Request $request, Response $response, array $args) {
    $controller = new VehicleController();

    return $controller->update($request, $response, $args);
}); 

?>