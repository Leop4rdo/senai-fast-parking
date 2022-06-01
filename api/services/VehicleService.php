<?php

use Slim\Http\Request;
use Slim\Http\Response;

require_once "repository/VehicleRepository.php";

class VehicleService {
    private $repository;

    function __construct() {
        $this->repository = new VehicleRepository();
    }

    function list() {
        $res = $this->repository->list();

        // if no data is returned
        if (count($res) === 0) return array("message" => "data not found!", "status" => 404);

        // catch errors in repository
        if (!empty($res["status"])) return array("message" => $res["message"], "status" => $res["status"]);

        return array("data" => $res, "status" => 200);
    }
    
    function find($id) {

        if (!is_numeric($id) || $id < 0) return array("message" => "Invalid id!", "status" => 400);

        $res = $this->repository->find("id", $id);

        // if no data is returned
        if (count($res) === 0) return array("message" => "data not found!", "status" => 404);

        // catch errors in repository
        if (!empty($res["status"])) return array("message" => $res["message"], "status" => $res["status"]);

        return array("data" => $res, "status" => 200);
    }

    function create($body) {
        if (empty($body) || empty($body["name"]) ) {
            return array("message" => "not enough data!", "status" => 400);
        }

        $hashedBody = $body;;

        $res = $this->repository->create($body);

        return array("message" => $res["message"], "status" => $res["status"]);
    }

    function delete($id) {
        if (!is_numeric($id) || $id < 0) return array("message" => "Invalid id!", "status" => 400);

        $vehicle = $this->repository->find("id", $id);
        // if vehicle does not exists
        if (count($vehicle) === 0) return array("message" => "data not found!", "status" => 404);

        $res = $this->repository->delete($id);

        return array("message" => $res["message"], "status" => $res["status"]);
    }
}