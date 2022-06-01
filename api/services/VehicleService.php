<?php

use Slim\Http\Request;
use Slim\Http\Response;

require_once "repository/VehicleRepository.php";

class VehicleService {
    private $repository;
    private $vehicleColourRepository;
    private $vehicleTypeRepository;
    private $vehicleModelRepository;
    private $customerRepository;

    function __construct() {
        $this->repository               = new VehicleRepository();
        $this->vehicleColourRepository  = new VehicleColourRepository();
        $this->vehicleTypeRepository    = new VehicleTypeRepository();
        $this->vehicleModelRepository   = new VehicleModelRepository();
        $this->customerRepository       = new CustomerRepository();
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
        // validating body
        if (empty($body) || empty($body["plate"])) return array("message" => "not enough data!", "status" => 400);

        // validating id
        if (!is_numeric($body["vehicle_colour_id"]) || $body["vehicle_colour_id"] < 0) return array("message" => "Invalid vehicle colour!", "status" => 400);
        if (!is_numeric($body["vehicle_type_id"]) || $body["vehicle_type_id"] < 0) return array("message" => "Invalid vehicle type!", "status" => 400);
        if (!is_numeric($body["vehicle_model_id"]) || $body["vehicle_model_id"] < 0) return array("message" => "Invalid vehicle model!", "status" => 400);
        if (!is_numeric($body["customer_id"]) || $body["customer_id"] < 0) return array("message" => "Invalid customer!", "status" => 400);

        // if vehicle colour doesn't exists, return an error message
        $vehicleColour = $this->vehicleColourRepository->find("id", $body["vehicle_colour_id"]);
        if (count($vehicleColour) === 0) return array("message" => "vehicle colour doesn't exists in database!", "status" => 404);

        // if vehicle type doesn't exists, return an error message
        $vehicleType = $this->vehicleTypeRepository->find("id", $body["vehicle_type_id"]);
        if (count($vehicleType) === 0) return array("message" => "vehicle type doesn't exists in database!", "status" => 404);

        // if vehicle model doesn't exists, return an error message
        $vehicleModel = $this->vehicleModelRepository->find("id", $body["vehicle_model_id"]);
        if (count($vehicleModel) === 0) return array("message" => "vehicle model doesn't exists in database!", "status" => 404);

        // if customer doesn't exists, return an error message
        $customer = $this->customerRepository->find("id", $body["customer_id"]);
        if (count($customer) === 0) return array("message" => "customer doesn't exists in database!", "status" => 404);

        // sending data to repository
        $res = $this->repository->create($body);

        return array("message" => $res["message"], "status" => $res["status"]);
    }

    function update($id, $body) {
        if (!is_numeric($id) || $id < 0) return array("message" => "Invalid id!", "status" => 400);

        // if vehicle does not exists
        $vehicle = $this->repository->find("id", $id);
        if ( count($vehicle) === 0 ) return array("message" => "vehicle does not exists in database!", "status" => 400);

        // validating body
        if (empty($body) || empty($body["plate"])) return array("message" => "not enough data!", "status" => 400);

        // updating vehicle ->
        return $res = $this->repository->update($id, $body);
    }

}