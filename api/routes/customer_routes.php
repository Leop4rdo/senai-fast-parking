<?php
/***********************************************\
 * 
 *  Route File for customer enpoints
 * 
 *  author : Leonardo Antunes
 *  version : 1.0
 * 
\***********************************************/

use Slim\Http\Request;
use Slim\Http\Response;

require_once "controller/CustomerController.php";

$app->get('/v1/customers/',  function (Request $request, Response $response, array $args) {
    $controller = new CustomerController();

    return $controller->getAll($request, $response, $args);
});

$app->get("/v1/customers/{id}",  function (Request $request, Response $response, array $args) {
    $controller = new CustomerController();

    return $controller->getById($request, $response, $args);
});

$app->put("/v1/customers/{id}",  function (Request $request, Response $response, array $args) {
    $controller = new CustomerController();

    return $controller->update($request, $response, $args);
});

$app->post('/v1/customers/',  function (Request $request, Response $response, array $args) {
    $controller = new CustomerController();

    return $controller->create($request, $response, $args);
});

$app->delete("/v1/customers/{id}", function (Request $request, Response $response, array $args) {
    $controller = new CustomerController();

    return $controller->delete($request, $response, $args);
});
