<?php

require_once "database_connection.php";

class VehicleInOutRepository {
    private mysqli $db;

    function __construct() {
        $this->db = connectToDatabase();
    }

    function list() {
        $query = "
            SELECT 
                vehicle_in_out.id, 
                vehicle_in_out.total_price, 
                vehicle_in_out.entrance_time, 
                vehicle_in_out.exit_time,
                vehicle_in_out.vehicle_id,
                vehicle.plate as vehicle_plate,
                vehicle.customer_id as customer_id,
                vehicle.vehicle_type_id as vehicle_type,
                vehicle_in_out.parking_spot_id,
                parking_spot.id as parking_spot_id,
                parking_spot.name as parking_spot
            FROM vehicle_in_out
                INNER JOIN vehicle
                    ON vehicle.id = vehicle_in_out.vehicle_id
                INNER JOIN parking_spot
                    ON parking_spot.id = vehicle_in_out.parking_spot_id;
        ";

        $queryRes = $this->db->query($query);

        if ($this->db->errno) return array("message" => "error: ". $this->db->error, "status" => 400);
        
        $res = array();
        while ($row = $queryRes->fetch_assoc()) {
            $res[] = $this->formatRecord($row);
        }

        return $res;
    }

    function find($param, $value) {
        $query = "
            SELECT 
                vehicle_in_out.id, 
                vehicle_in_out.total_price, 
                vehicle_in_out.entrance_time, 
                vehicle_in_out.exit_time,
                vehicle_in_out.vehicle_id,
                vehicle.plate as vehicle_plate,
                vehicle.vehicle_type_id as vehicle_type,
                vehicle.customer_id as customer_id,
                vehicle_in_out.parking_spot_id,
                parking_spot.id as parking_spot_id,
                parking_spot.name as parking_spot
            FROM vehicle_in_out
                INNER JOIN vehicle
                    ON vehicle.id = vehicle_in_out.vehicle_id
                INNER JOIN parking_spot
                    ON parking_spot.id = vehicle_in_out.parking_spot_id
            WHERE $param = $value;
        ";

        $queryRes = $this->db->query($query);

        if ($this->db->errno) return array("message" => "error: ". $this->db->error, "status" => 400);

        $res = array();
        while ($row = $queryRes->fetch_assoc()) $res[] = $this->formatRecord($row);

        return $res;
    }

    function create( array $body ) {
        $query = "INSERT INTO vehicle_in_out (vehicle_id, parking_spot_id) values (
            ". $body["vehicle_id"] .", ". $body["parking_spot_id"] ."
        );";

        $this->db->query($query);
        
        if ($this->db->errno) return array("message" => "error: " . $this->db->error, "status" => 400);

        return array("message" => "successfully created vehicle in out", "status" => 200);
    }

    function update( array $body ) {
        $query = "UPDATE vehicle_in_out SET
                    exit_time = '".$body["exit_time"]."', 
                    total_price = '".$body["total_price"]."'
                    where vehicle_in_out.id = ".$body["id"].";";
        
        $queryRes = $this->db->query($query);

        // if there's an error in the database side we'll just return the error messsage with status 400
        if ($this->db->errno) return array("message" => "error: " . $this->db->error, "status" => 400);

        return array("message" => "successfully updated vehicle_in_out", "status" => 200); 
    
    }

    function formatRecord($record) {
        return array(
            "id" => $record["id"],
            "total_price" => $record["total_price"],
            "entrance_time" => $record["entrance_time"],
            "exit_time" => $record["exit_time"],
            "vehicle" => array(
                "id" => $record["vehicle_id"],
                "plate" => $record["vehicle_plate"],
                "type" => $record["vehicle_type"],
                "customer" => $record["customer_id"]
            ),
            "parking_spot" => array(
                "id" => $record["parking_spot_id"],
                "name" => $record["parking_spot"]
            )
        );
    }
}


