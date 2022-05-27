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

    function find($search_param, $value) {
        $query = "SELECT * FROM customer where $search_param = $value";

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
}