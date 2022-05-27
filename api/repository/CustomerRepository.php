<?php 

require_once "database_connection.php";

class CustomerRepository {
    private mysqli $db;

    function __construct() {
        $this->db = connectToDatabase();
    }

    function list() {
        $query = "SELECT * FROM customer";

        $queryRes = $this->db->query($query);

        if ($this->db->errno) return array("message" => "error: " . $this->db->error, "status" => 400);

        $res = array();
        while ($row = $queryRes->fetch_assoc()) {
            unset($row["password"]);
            $res[] = $row;
        }

        return $res;
    }

    function find($param, $value) {
        $query = "SELECT * FROM customer where $param = $value";

        $queryRes = $this->db->query($query);

        if ($this->db->errno) return array("message" => "error: " . $this->db->error, "status" => 400);

        $res = array();
        if ($row = $queryRes->fetch_assoc()) {
            unset($row["password"]);
            $res = $row;
        }

        return $res;
    } 

    function create( array $body ) {
        $query = "INSERT INTO customer (name, email, phone_number, password) values (
                        '". $body["name"] ."',
                        '". $body["email"] ."',
                        '". $body["phone_number"] ."',
                        '". $body["password"] ."')";
        
        $this->db->query($query);

        if ($this->db->errno) return array("message" => "error: " . $this->db->error, "status" => 400);

        return array("message" => "successfully created customer", "status" => 200); 
    }

    function delete($id) {
        $query = "DELETE FROM customer WHERE id = $id";

        $queryRes =$this->db->query($query);

        if ($this->db->errno) return array("message" => "error: " . $this->db->error, "status" => 400);

        return array("message" => "successfully deleted customer", "status" => 200); 
    }
}