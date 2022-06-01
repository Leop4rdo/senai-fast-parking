<?php

use Slim\Http\Request;
use Slim\Http\Response;

require_once "repository/VehicleModelRepository.php";

class VehicleModelService {
    private $repository;

    function __construct() {
        $this->repository = new VehicleModelRepository();
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

        $res = $this->repository->create($body);

        return array("message" => $res["message"], "status" => $res["status"]);
    }

    function update($id, $body) {
        if (!is_numeric($id) || $id < 0) return array("message" => "Invalid id!", "status" => 400);

        // if vehicle model does not exists
        $vehicleModel = $this->repository->find("id", $id);
        if ( count($vehicleModel) === 0 ) return array("message" => "vehicle model does not exists in database!", "status" => 400);

        // validating body
        if (empty($body) || empty($body["name"])) return array("message" => "not enough data!", "status" => 400);

        // updating vehicle model ->
        return $res = $this->repository->update($id, $body);
    }

    function delete($id) {
        if (!is_numeric($id) || $id < 0) return array("message" => "Invalid id!", "status" => 400);

        $vehicleModel = $this->repository->find("id", $id);
        // if vehicle model does not exists
        if (count($vehicleModel) === 0) return array("message" => "data not found!", "status" => 404);

        $res = $this->repository->delete($id);

        return array("message" => $res["message"], "status" => $res["status"]);
    }
}