<?php
/***********************************************\
 * 
 *  Controller layer for customers
 * 
 *  author : Leonardo Antunes
 *  version : 1.0
 * 
\***********************************************/


use Slim\Http\Request;
use Slim\Http\Response;

require_once "services/CustomerService.php";

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

    function getByCpf(Request $request, Response $response, array $args) {
        $cpf = $request->getQueryParam("cpf");

        $resData = (array) $this->service->findByCpf($cpf);

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

    function update(Request $request, Response $response, array $args) {
        $body = $request->getParsedBody();

        $resData = (array) $this->service->update($body, $args["id"]);

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
}