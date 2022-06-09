<?php

require_once "database_connection.php";

class ParkingSpotRepository {
    private mysqli $db;

    function __construct() {
        $this->db = connectToDatabase();
    }

    function list() {
        $query = "
            SELECT 
                parking_spot.id,
                parking_spot.name,
                parking_spot.vehicle_type_id AS type_id,
                vehicle_type.name AS type_name,
                vehicle_type.price AS type_price
            FROM parking_spot
                INNER JOIN vehicle_type
                    ON vehicle_type.id = parking_spot.vehicle_type_id
            ORDER BY parking_spot.name DESC;
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
                parking_spot.id,
                parking_spot.name,
                parking_spot.vehicle_type_id AS type_id,
                vehicle_type.name AS type_name,
                vehicle_type.price AS type_price
            FROM parking_spot
                INNER JOIN vehicle_type
                    ON vehicle_type.id = parking_spot.vehicle_type_id
            WHERE $param = '$value';
        ";

        $queryRes = $this->db->query($query);

        if ($this->db->errno) return array("message" => "error: ". $this->db->error, "status" => 400);

        $res = array();
        if ($row = $queryRes->fetch_assoc()) $res = $this->formatRecord($row);

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
        $query = "DELETE FROM parking_spot WHERE parking_spot.id = $id";
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

    function formatRecord($record) {
        return array(
            "id" => $record["id"],
            "name" => $record["name"],
            "type" => array(
                "id" => $record["type_id"],
                "name" => $record["type_name"],
                "price" => $record["type_price"]
            )
        );
    }
}