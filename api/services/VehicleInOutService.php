<?php
/***********************************************\
 * 
 *  Service layer for Vehicle in out entity
 * 
 *  Author : Leonardo antunes
 *  version : 1.0
 * 
\***********************************************/

require_once "repository/VehicleInOutRepository.php";

class VehicleInOutService {
    private $repository;
    private $vehicle_repository;

    function __construct() {
        $this->repository = new VehicleInOutRepository();
    }

    function list() {
        $res = $this->repository->list();

         // if no data is found
         if (count($res) == 0) return array("message" => "Data not found!", "status" => "404");

         // catch errors in database
         if (!empty($res["status"])) return array("message" => $res["message"], "status" => $res["status"]);
        
         return array("data" => $res, "status" => 200); 
    }

    function find($id) {
        // validating id
        if (!is_numeric($id) || $id < 0) return array("message" => "Invalid id!", "status" => 400);
        
        $res = $this->repository->find("id", $id);

        // if no data is found
        if (count($res) === 0) return array("message" => "data not found!", "status" => 404);

        // catch errors in database
        if (!empty($res["status"])) return array("message" => $res["message"], "status" => $res["status"]);

        return array("data" => $res, "status" => 200);
    }

    function create($body) {
        // validating body
        if (empty($body)) return array("message" => "not enough data!", "status" => 400);

        // validating vehicle_id
        if (!is_numeric($body["vehicle_type_id"]) || $body["vehicle_type_id"] < 0) return array("message" => "Invalid vehicle type!", "status" => 400);

        $vehicle = 

    }
}