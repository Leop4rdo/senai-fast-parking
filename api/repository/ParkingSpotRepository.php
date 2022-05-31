<?php

require_once "database_connection.php";

class ParkingSpotRepository {
    private mysqli $db;

    function __construct() {
        $this->db = connectToDatabase();
    }

    function list() {
        $query = "SELECT * FROM parking_spot;";

        $queryRes = $this->db->query($query);

        if ($this->db->errno) return array("message" => "error: ". $this->db->error, "status" => 400);

        $res = array();
        while ($row = $queryRes->fetch_assoc()) {
            $res[] = $row;
        }

        return $res;
    }

    function find($param, $value) {
        $query = "SELECT * FROM parking_spot WHERE $param = '$value'";

        $queryRes = $this->db->query($query);

        if ($this->db->errno) return array("message" => "error: ". $this->db->error, "status" => 400);

        $res = array();
        if ($row = $queryRes->fetch_assoc()) $res = $row;

        return $res;
    }

    function create( array $body ) {
        $query = "INSERT INTO parking_spot (name, vehicle_type_id) values (
            '". $body["name"]."', ". $body["vehicle_type_id"] .");";

        $this->db->query($query);
        
        if ($this->db->errno) return array("message" => "error: " . $this->db->error, "status" => 400);

        return array("message" => "successfully created parking spot", "status" => 200);
    }

    function delete($id) {
        $query = "DELETE FROM parking_spot WHERE id = $id";
        $queryRes =$this->db->query($query);

        if ($this->db->errno) return array("message" => "error: " . $this->db->error, "status" => 400);

        return array("message" => "successfully deleted customer", "status" => 200); 
    }    

    function update($id, $body) {
        $query = "UPDATE parking_spot SET 
                    name = '". $body["name"] ."',
                    vehicle_type_id = '". $body["vehicle_type_id"] ."'
                    where id = $id;";

        $queryRes = $this->db->query($query);

        // if there's an error in the database side we'll just return the error messsage with status 400
        if ($this->db->errno) return array("message" => "error: " . $this->db->error, "status" => 400);

        return array("message" => "successfully updated parking spot", "status" => 200); 
    }
}