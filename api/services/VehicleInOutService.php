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
require_once "repository/VehicleRepository.php";
require_once "repository/ParkingSpotRepository.php";

class VehicleInOutService {
    private $repository;
    private $vehicleRepository;

    function __construct() {
        $this->repository = new VehicleInOutRepository();
        $this->vehicleRepository = new VehicleRepository();
        $this->parkingSpotRepository = new ParkingSpotRepository();
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

        // validating vehicle
        try {
            $this->validateVehicle($body["vehicle_id"]);
        } catch (Exception $e) {
            return array("message" => $e->getMessage(), "status" =>400);
        }

        // validating parking_spot
        try {
            $this->validateParkingSpot($body["parking_spot_id"]);
        } catch (Exception $e) {
            return array("message" => $e->getMessage(), "status" =>400);
        }
        
        // validating parking_spot
        if (!is_numeric($body["parking_spot_id"]) || $body["parking_spot_id"] < 0) return array("message" => "Invalid vehicle!", "status" => 400);

        $parkingSpot = $this->parkingSpotRepository->find("id", $body["parking_spot_id"]);
        if ( count($parkingSpot) === 0 ) return array("message" => "Parking spot does not exists!", "status" => 400);
        
        // sending data to repository
        $res = $this->repository->create($body);

        return array("message" => $res["message"], "status" => $res["status"]);
    }   

    private function validateVehicle($id) {
        // validating vehicle_id
        if (!is_numeric($id) || $id < 0) throw new Exception("Invalid vehicle!"); 
        
        $vehicle = $this->vehicleRepository->find("id", $id);
        if ( count($vehicle) === 0 ) throw new Exception("Vehicle does not exists!");

        // validating if vehicle is already parked
        $isVehicleParked = $this->repository->find("vehicle_id", $id);

        if ( count($isVehicleParked) > 0 && $isVehicleParked["exit_time"] == null ) throw new Exception("Vehicle is already parked!");
    }

    private function validateParkingSpot($id) {
        // validating parking_spot
        if (!is_numeric($id) || $id < 0) return array("message" => "Invalid parking spot!", "status" => 400);

        $parkingSpot = $this->parkingSpotRepository->find("id", $id);
        if ( count($parkingSpot) === 0 ) return array("message" => "Parking spot does not exists!", "status" => 400);

        // validating if vehicle is already parked
        $isParkingSpotInUse = $this->repository->find("parking_spot_id", $id);

        if ( count($isParkingSpotInUse) > 0 && $isParkingSpotInUse["exit_time"] == null ) throw new Exception("Parking spot is already in use!");
    }

}