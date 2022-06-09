<?php
/***********************************************\
 * 
 *  Service  layer for parking spots
 * 
 *  Author : Leonardo antunes
 *  version : 1.0
 * 
\***********************************************/

require_once "repository/ParkingSpotRepository.php";
require_once "repository/VehicleTypeRepository.php";

class ParkingSpotService {
    private $repository;
    private $vehicleTypeRepository;

    function __construct() {
        $this->repository = new ParkingSpotRepository();
        $this->vehicleTypeRepository = new VehicleTypeService();
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
        
        $res = $this->repository->find("parking_spot.id", $id);

        // if no data is found
        if (count($res) === 0) return array("message" => "data not found!", "status" => 404);

        // catch errors in database
        if (!empty($res["status"])) return array("message" => $res["message"], "status" => $res["status"]);

        return array("data" => $res, "status" => 200);

    }

    function create($body) {
        // validating body
        if (empty($body) || empty($body["name"])) return array("message" => "not enough data!", "status" => 400);

        // validating id
        if (!is_numeric($body["vehicle_type_id"]) || $body["vehicle_type_id"] < 0) return array("message" => "Invalid vehicle type!", "status" => 400);

        // if parking spot already exists, return an error message
        $parkingSpot = $this->repository->find("name", $body["name"]);

        if ( count($parkingSpot) != 0 ) return array("message" => "parking spot already exists in database!", "status" => 400);

        // if vehicle type doesn't exists, return an error message
        $vehicleType = $this->vehicleTypeRepository->find("id", $body["vehicle_type_id"]);
        if (count($vehicleType) === 0) return array("message" => "vehicle type doesn't exists in database!", "status" => 404);

        // sending data to repository
        $res = $this->repository->create($body);

        return array("message" => $res["message"], "status" => $res["status"]);
    }

    function delete($id) {
        if (!is_numeric($id) || $id < 0) return array("message" => "Invalid id!", "status" => 400);

        // check if parking spot does not exists
        $parkingSpot = $this->repository->find("id", $id);
        if (count($parkingSpot) === 0) return array("message" => "data not found!", "status" => 404);

        $res = $this->repository->delete($id);

        return array("message" => $res["message"], "status" => $res["status"]);
    }

    function update($id, $body) {
        if (!is_numeric($id) || $id < 0) return array("message" => "Invalid id!", "status" => 400);

        // if parking spot does not exists
        $parkingSpot = $this->repository->find("id", $id);
        if ( count($parkingSpot) === 0 ) return array("message" => "parking spot does not exists in database!", "status" => 400);

        // validating body
        if (empty($body) || empty($body["name"])) return array("message" => "not enough data!", "status" => 400);

        // updating parking spot ->
        return $res = $this->repository->update($id, $body);
    }
}