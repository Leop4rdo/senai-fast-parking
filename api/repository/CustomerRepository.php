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
        $query = "INSERT INTO customer (name, email, cpf, phone_number, password) values (
                        '". $body["name"] ."',
                        '". $body["email"] ."',
                        '". $body["cpf"] ."',
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

    function update($id, $body) {
        $query = "UPDATE customer SET
                    name = '". $body["name"] ."',
                    email = '". $body["email"] ."',
                    cpf = '". $body["cpf"] ."',
                    password = '". $body["password"] ."',
                    phone_number = '". $body["phone_number"] ."'
                    where id = $id;";

        $queryRes = $this->db->query($query);

        // if there's an error in the database side we'll just return the error messsage with status 400
        if ($this->db->errno) return array("message" => "error: " . $this->db->error, "status" => 400);

        return array("message" => "successfully updated customer", "status" => 200);
    }
}