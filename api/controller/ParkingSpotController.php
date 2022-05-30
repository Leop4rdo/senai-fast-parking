<?php
/***********************************************\
 * 
 *  Controller layer for parking spots
 * 
 *  Author : Leonardo antunes
 *  version : 1.0
 * 
\***********************************************/

use Slim\Http\Request;
use Slim\Http\Response;

require_once "services/ParkingSpotService.php";

class ParkingSpotController {
    private $service;

    function __construct() {
        $this->service = new ParkingSpotService();
    }

    function getAll(Request $request, Response $response, array $args) {
        $resData = (array) $this->service->list();

        return $response->withStatus($resData['status'])
                ->withHeader("Content-Type", "application/json")
                ->write(json_encode($resData));
    }

    /*
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
        $resData = (array) $this->service->delete($args["id"]);

        return $response->withStatus($resData['status'])
                ->withHeader("Content-Type", "application/json")
                ->write(json_encode($resData));
    }
    */
}