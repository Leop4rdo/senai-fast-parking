<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

require_once "controller/CustomerController.php";

$app = new App();

$base_endpoint = "/v1/customer";

$app->get($base_endpoint,  function (Request $request, Response $response, array $args) {
    $controller = new CustomerController();

    return $controller->getAll($request, $response, $args);
});

$app->get($base_endpoint . "/{id}",  function (Request $request, Response $response, array $args) {
    $controller = new CustomerController();

    return $controller->getById($request, $response, $args);
});

$app->post($base_endpoint,  function (Request $request, Response $response, array $args) {
    $controller = new CustomerController();

    return $controller->create($request, $response, $args);
});

$app->delete($base_endpoint . "/{id}", function (Request $request, Response $response, array $args) {
    $controller = new CustomerController();

    return $controller->delete($request, $response, $args);
});


$app->run();