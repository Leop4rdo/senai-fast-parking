<?php 
/***********************************************\
 *  Api made for FastParking project 
 * 
 *  author      : Leonardo Antunes
 *  created At  : 26/05/22
 *  version     : 1.0
 * 
\***********************************************/

use Slim\App;

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

require_once "vendor/autoload.php";

$app = new App();

// LOADING ROUTES :
require_once "routes/vehicle_model_routes.php"; // importing vehicle model endpoints...
require_once "routes/customer_routes.php";      // importing customer end routes...
require_once "routes/vehicle_type_routes.php";  // importing vehicle type endpoints...
require_once "routes/parking_spot_routes.php";  // importing parking spot endpoints...
// TODO : vehicle_color
// TODO : vehicle
// TODO : vehicle_in_out

$app->run();
?>