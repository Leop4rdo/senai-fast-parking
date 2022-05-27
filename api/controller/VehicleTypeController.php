<?php

use Slim\http\Response;
use Slim\http\Request;

class VehicleTypeController {
    private $service;

    function __construct() {
        $this->service = new VehicleTypeService();
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
}