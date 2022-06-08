<?php

require_once "database_connection.php";

class VehicleInOutRepository {
    private mysqli $db;

    function __construct() {
        $this->db = connectToDatabase();
    }

    function list() {
        $query = "
            select 
                vehicle_in_out.id, 
                vehicle_in_out.total_price, 
                vehicle_in_out.entrance_time, 
                vehicle_in_out.exit_time,
                vehicle_in_out.vehicle_id,
                vehicle.plate as vehicle_plate
            from vehicle_in_out
                inner join vehicle
                    on vehicle.id = vehicle_in_out.vehicle_id;
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
                vehicle.plate as vehicle_plate
            FROM vehicle_in_out
                INNER JOIN vehicle
                    on vehicle.id = vehicle_in_out.vehicle_id
            WHERE vehicle_in_out.$param = $value;
        ";

        $queryRes = $this->db->query($query);

        if ($this->db->errno) return array("message" => "error: ". $this->db->error, "status" => 400);

        $res = array();
        while ($row = $queryRes->fetch_assoc()) $res[] = $this->formatRecord($row);

        return $res;
    }

    function create( array $body ) {
        $query = "INSERT INTO vehicle_in_out (entrance_time, vehicle_id, parking_spot_id) values (
            '". $body["entrance_time"]."', ". $body["vehicle_id"] .", ". $body["vehicle_id"] ."
        );";

        $this->db->query($query);
        
        if ($this->db->errno) return array("message" => "error: " . $this->db->error, "status" => 400);

        return array("message" => "successfully created vehicle in out", "status" => 200);
    }

    function update( array $body ) {
        $query = "UPDATE vehicle_in_out SET
                    exit_time = '".$body["exit_time"]."', 
                    total_price = '".$body["total_price"]."'
                    where id = ".$body["id"].";";
        
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
                "plate" => $record["vehicle_plate"]
            )
        );
    }
}


