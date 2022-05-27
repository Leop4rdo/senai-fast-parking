<?php

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

}