<?php 

require_once "database_connection.php";

class VehicleRepository {
    private mysqli $db;

    function __construct() {
        $this->db = connectToDatabase();
    }
 
    function list() {
        
        $query = "SELECT * FROM vehicle ORDER BY id ASC";

        $queryRes = $this->db->query($query);

        if ($this->db->errno) return array("message" => "error: " . $this->db->error, "status" => 400);

        $res = array();
        while ($row = $queryRes->fetch_assoc()) {
            $res[] = $row;
        }

        return $res;
    }

    function find($param, $value) {
        $query = "SELECT * FROM vehicle where $param = $value";

        $queryRes = $this->db->query($query);

        if ($this->db->errno) return array("message" => "error: " . $this->db->error, "status" => 400);

        $res = array();
        if ($row = $queryRes->fetch_assoc()) {
            $res = $row;
        }

        return $res;
    } 

    function create( array $body ) {
        $query = "INSERT INTO vehicle (name) values (
                        '". $body["name"] ."')";
                         
        $this->db->query($query);

        if ($this->db->errno) return array("message" => "error: " . $this->db->error, "status" => 400);

        return array("message" => "successfully created vehicle", "status" => 200); 
    }

    function delete($id) {
        $query = "DELETE FROM vehicle WHERE id = $id";

        $queryRes =$this->db->query($query);

        if ($this->db->errno) return array("message" => "error: " . $this->db->error, "status" => 400);

        return array("message" => "successfully deleted vehicle", "status" => 200); 
    }
}

?>