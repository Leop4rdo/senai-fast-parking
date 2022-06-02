<?php 

require_once "database_connection.php";

class VehicleModelRepository {
    private mysqli $db;

    function __construct() {
        $this->db = connectToDatabase();
    }
 
    function list() {
        
        $query = "SELECT * FROM vehicle_model";

        $queryRes = $this->db->query($query);

        if ($this->db->errno) return array("message" => "error: " . $this->db->error, "status" => 400);

        $res = array();
        while ($row = $queryRes->fetch_assoc()) {
            $res[] = $row;
        }

        return $res;
    }

    function find($param, $value) {
        $query = "SELECT * FROM vehicle_model where $param = $value";

        $queryRes = $this->db->query($query);

        if ($this->db->errno) return array("message" => "error: " . $this->db->error, "status" => 400);

        $res = array();
        if ($row = $queryRes->fetch_assoc()) {
            $res = $row;
        }

        return $res;
    } 

    function create( array $body ) {
        $query = "INSERT INTO vehicle_model (name) values (
                        '". $body["name"] ."')";
                         
        $this->db->query($query);

        if ($this->db->errno) return array("message" => "error: " . $this->db->error, "status" => 400);

        return array("message" => "successfully created vehicle model", "status" => 200); 
    }

    function update($id, $body) {
        $query = "UPDATE vehicle_model SET 
                    name = '". $body["name"] ."'
                    where id = $id;";

        $queryRes = $this->db->query($query);

        // if there's an error in the database side we'll just return the error message with status 400
        if ($this->db->errno) return array("message" => "error: " . $this->db->error, "status" => 400);

        return array("message" => "successfully updated vehicle model", "status" => 200); 
    }

    function delete($id) {
        $query = "DELETE FROM vehicle_model WHERE id = $id";

        $queryRes =$this->db->query($query);

        if ($this->db->errno) return array("message" => "error: " . $this->db->error, "status" => 400);

        return array("message" => "successfully deleted vehicle model", "status" => 200); 
    }
}

?>