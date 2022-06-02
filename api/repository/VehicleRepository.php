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
        
        $query = "SELECT * FROM vehicle WHERE $param = $value";

        $queryRes = $this->db->query($query);

        if ($this->db->errno) return array("message" => "error: " . $this->db->error, "status" => 400);

        $res = array();
        if ($row = $queryRes->fetch_assoc()) {
            $res = $row;
        }

        return $res;
    }

    function findByCostumerId($param, $value) {
        
        $query = "SELECT * FROM vehicle WHERE $param = $value";

        $queryRes = $this->db->query($query);

        if ($this->db->errno) return array("message" => "error: " . $this->db->error, "status" => 400);

        $res = array();
        while ($row = $queryRes->fetch_assoc()) {
            $res[] = $row;
        }

        return $res;
    }

    function create( array $body ) {
        $query = "INSERT INTO vehicle (
                                        plate,
                                        vehicle_colour_id, 
                                        vehicle_type_id, 
                                        vehicle_model_id, 
                                        customer_id
                                      ) 
                  VALUES              (
                                        '". $body["plate"] ."', 
                                        '". $body["vehicle_colour_id"] ."', 
                                        '". $body["vehicle_type_id"] ."', 
                                        '". $body["vehicle_model_id"] ."', 
                                        '". $body["customer_id"] ."' 
                                      );";
                         
        $this->db->query($query);

        if ($this->db->errno) return array("message" => "error: " . $this->db->error, "status" => 400);

        return array("message" => "successfully created vehicle", "status" => 200); 
    }

    function update($id, $body) {
        $query = "UPDATE vehicle SET 
                    plate               = '". $body["plate"] ."',
                    vehicle_colour_id   = '". $body["vehicle_colour_id"] ."',
                    vehicle_type_id     = '". $body["vehicle_type_id"] ."',
                    vehicle_model_id    = '". $body["vehicle_model_id"] ."',
                    customer_id         = '". $body["customer_id"] ."'
                    where id = $id;";

        $queryRes = $this->db->query($query);

        // if there's an error in the database side we'll just return the error message with status 400
        if ($this->db->errno) return array("message" => "error: " . $this->db->error, "status" => 400);

        return array("message" => "successfully updated vehicle", "status" => 200); 
    }

}

?>