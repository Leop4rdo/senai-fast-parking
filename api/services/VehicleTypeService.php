<?php

require_once "repository/VehicleTypeRepository.php";

class VehicleTypeService {
    private $repository;

    function __construct() {
        $this->repository = new VehicleTypeRepository();
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

    function updatePrice($body, $id) {
        if (!is_numeric($id) || $id < 0) return array("message" => "Invalid id!", "status" => 400);
        if (!is_numeric($body["price"]) || $body["price"] < 0) return array("message" => "Invalid price!", "status" => 400);

        $res = $this->repository->find("id", $id);

        // if no data is returned
        if (count($res) === 0) return array("message" => "data not found!", "status" => 404);

        $res = $this->repository->updateValue("price", $body["price"], $id);

        return array("message" => $res["message"], "status" => $res["status"]);
    }
}