<?php

require_once "database_connection.php";

class VehicleInOutRepository {
    private mysqli $db;

    function __construct() {
        $this->db = connectToDatabase();
    }

    function list() {
        $query = "SELECT * FROM vehicle_in_out;";

        $queryRes = $this->db->query($query);

        if ($this->db->errno) return array("message" => "error: ". $this->db->error, "status" => 400);
        
        $res = array();
        while ($row = $queryRes->fetch_assoc()) {
            $res[] = $row;
        }

        return $res;
    }

    function find($param, $value) {
        $query = "SELECT * FROM vehicle_in_out WHERE $param = '$value'";

        $queryRes = $this->db->query($query);

        if ($this->db->errno) return array("message" => "error: ". $this->db->error, "status" => 400);

        $res = array();
        if ($row = $queryRes->fetch_assoc()) $res = $row;

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
}


