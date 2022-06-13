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
require_once "repository/VehicleTypeRepository.php";

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
        try { $this->validateVehicle($body["vehicle_id"]); } 
        catch (Exception $e) { return array("message" => $e->getMessage(), "status" =>400); }

        // validating parking_spot
        try { $this->validateParkingSpot($body["parking_spot_id"]); } 
        catch (Exception $e) { return array("message" => $e->getMessage(), "status" =>400); }

        
        // sending data to repository
        $res = $this->repository->create($body);

        return array("message" => $res["message"], "status" => $res["status"]);
    }

    function setExitTime($id) {
        // validating id
        if (!is_numeric($id) || $id < 0) return array("message" => "Invalid id!", "status" => 400);

        $inOut = $this->repository->find("id", $id)[0];
        if ( count($inOut) === 0 ) return array("message" => "Vehicle in out does not exists!", "status" => 400);
        if ( @$inOut["exit_time"] != null ) return array("message" => "vehicle in out has already been terminated!", "status" => 400);
        
        // setting exit time
        date_default_timezone_set("America/Sao_Paulo");
        $inOut["exit_time"] = date("Y-m-d H:i:s");

        // getting hour price
        $parkingSpot = $this->parkingSpotRepository->find("id", $inOut["parking_spot"]["id"]);
        $typeRepository = new VehicleTypeRepository();
        
        // setting total price
        $hourPrice = $this->getHourPrice($inOut["parking_spot"]["id"]);
        $inOut["total_price"] = $this->getTotalPrice($hourPrice, $inOut["entrance_time"], $inOut["exit_time"]);

        // updating database
        $res = $this->repository->update($inOut);

        if ($res["status"] != 200) return $res;
        else return array("data" => $inOut, "status" => 200);
    }

    private function validateVehicle($id) {
        // validating vehicle_id
        if (!is_numeric($id) || $id < 0) throw new Exception("Invalid vehicle!"); 
        
        $vehicle = $this->vehicleRepository->find("id", $id);
        if ( count($vehicle) === 0 ) throw new Exception("Vehicle does not exists!");

        // validating if vehicle is already parked
        $isVehicleParked = $this->repository->find("vehicle_id", $id);

        if ( count($isVehicleParked) > 0 && $isVehicleParked["exit_time"] ) throw new Exception("Vehicle is already parked!");
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

    private function getHourPrice($parkingSpotId) {
        $parkingSpot = $this->parkingSpotRepository->find("id", $parkingSpotId);
        $typeRepository = new VehicleTypeRepository();
        return $typeRepository->find("id", $parkingSpot["vehicle"])["type"];
    }

    private function dateIntervalToHours($interval) {
        $yearsInMonths = $interval->y * 12;
        $monthsInDays = ($yearsInMonths + $interval->m) * 30;
        $daysInHours = ($monthsInDays + $interval->d) * 24;
        $hours = $daysInHours + $interval->h;

        return $hours;
    }

    private function getTotalPrice($hourPrice, $entranceTime, $exitTime) {
        $entranceTimeDate = new DateTime($entranceTime);
        $exitTimeDate = new DateTime($exitTime);      

        $interval = date_diff($entranceTimeDate, $exitTimeDate);
        $totalHours = $this->dateIntervalToHours($interval);

        if ($totalHours > 24) return $totalHours * $hourPrice * .5;
        else if ($totalHours > 1) return $totalHours * $hourPrice;
        else return $hourPrice *.5;
    }
}