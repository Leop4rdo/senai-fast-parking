<?php

use Slim\Http\Request;
use Slim\Http\Response;

require_once "services/UserService.php";

class CustomerController {
    private $service;

    function __construct() {
        $this->service = new CustomerService();
    }

    function getAll(Request $request, Response $response, array $args) {
        $resData = (array) $this->service->list();

        return $response->withStatus($resData['status'])
                ->withHeader("Content-Type", "application/json")
                ->write(json_encode($resData));
    }

    function getById(Request $request, Response $response, array $args) {
        $resData = (array) $this->service->find($args["id"]);

        return $response->withStatus($resData['status'])
                ->withHeader("Content-Type", "application/json")
                ->write(json_encode($resData));
    }

    function create(Request $request, Response $response, array $args) {
        $body = $request->getParsedBody();

        $resData = (array) $this->service->create($body);

        return $response->withStatus($resData['status'])
                ->withHeader("Content-Type", "application/json")
                ->write(json_encode($resData));
    }

    function delete(Request $request, Response $response, array $args) {
        $resData = (array) $this->service->create($args["id"]);

        return $response->withStatus($resData['status'])
                ->withHeader("Content-Type", "application/json")
                ->write(json_encode($resData));
    }
}