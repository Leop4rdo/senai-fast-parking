<?php 

require_once "database_connection.php";

class VehicleRepository {
    private mysqli $db;

    function __construct() {
        $this->db = connectToDatabase();
    }
 
    function list() {
        
        // $query = "SELECT * FROM vehicle ORDER BY id ASC";

        $query = "
            select 
                vehicle.id, vehicle.plate, 
                vehicle.vehicle_colour_id as colour_id, 
                vehicle_colour.name as colour,
                vehicle.vehicle_model_id as model_id,
                vehicle_model.name as model,
                vehicle.customer_id,
                customer.name as customer_name,
                customer.email as customer_email,
                customer.cpf as customer_cpf,
                customer.phone_number as customer_phone_number
            from vehicle
                inner join vehicle_colour
                    on vehicle.vehicle_colour_id = vehicle_colour.id
                inner join vehicle_model
                    on vehicle_model.id = vehicle.vehicle_model_id
                inner join customer
                    on customer.id = vehicle.customer_id;
        ";

        $queryRes = $this->db->query($query);

        if ($this->db->errno) return array("message" => "error: " . $this->db->error, "status" => 400);

        $res = array();
        while ($row = $queryRes->fetch_assoc()) {
            // $res[] = $row;

            $res[] = $this->formatRecord($row);
        }

        return $res;
    }

    function find($param, $value) {
        
        $query = "
            select 
                vehicle.id, vehicle.plate, 
                vehicle.vehicle_colour_id as colour_id, 
                vehicle_colour.name as colour,
                vehicle.vehicle_model_id as model_id,
                vehicle_model.name as model,
                vehicle.customer_id,
                customer.name as customer_name,
                customer.email as customer_email,
                customer.cpf as customer_cpf,
                customer.phone_number as customer_phone_number
            from vehicle
                inner join vehicle_colour
                    on vehicle.vehicle_colour_id = vehicle_colour.id
                inner join vehicle_model
                    on vehicle_model.id = vehicle.vehicle_model_id
                inner join customer
                    on customer.id = vehicle.customer_id
            where vehicle.$param = $value;
        ";

        $queryRes = $this->db->query($query);

        if ($this->db->errno) return array("message" => "error: " . $this->db->error, "status" => 400);

        $res = array();
        while ($row = $queryRes->fetch_assoc()) {
            $res[] = $this->formatRecord($row);
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

    function formatRecord($record) {
        return array(
            "id" => $record["id"],
            "plate" => $record["plate"],
            "colour" => array(
                "id" => $record["colour_id"],
                "name" => $record["colour"],
            ),
            "model" => array(
                "id" => $record["model_id"],
                "name" => $record["model"]
            ),
            "customer" => array(
                "id"  => $record["customer_id"],
                "name" => $record["customer_name"],
                "email" => $record["customer_email"],
                "cpf" => $record["customer_cpf"],
                "phone_number" => $record["customer_phone_number"]
            )
        );
    }
}

?>