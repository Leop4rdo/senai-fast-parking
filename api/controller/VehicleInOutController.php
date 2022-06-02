<?php
/***********************************************\
 * 
 *  Controller layer for Vehicle In Out entity
 * 
 *  Author: Leonardo Antunes
 *  version: 1.0
 * 
\***********************************************/
use Slim\Http\Request;
use Slim\Http\Response;

require_once "services/VehicleInOutService.php";

class VehicleInOutController {
    private $service;

    function __construct() {
        $this->service = new VehicleInOutService();
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

    function setExitTime(Request $request, Response $response, array $args) {
        $resData = (array) $this->service->setExitTime($args["id"]);

        
        return $response->withStatus($resData['status'])
                ->withHeader("Content-Type", "application/json")
                ->write(json_encode($resData));
    }

}