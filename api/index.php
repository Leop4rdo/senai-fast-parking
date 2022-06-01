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
use Slim\Http\Request;
use Slim\Http\Response;

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

require_once "vendor/autoload.php";

// SLIM APP CONFIG
$app = new App([
    'settings' => [
        'displayErrorDetails' => true
    ]
]);

// health check endpoint
$app->get("/v1/health-check/", function (Request $request, Response $response, array $args) {
    $response->withStatus(200)
            ->withHeader('Content-Type', 'application/json')
            ->write('{"message": "Api is working properly!"}');
});

// LOADING ROUTES :
require_once "routes/customer_routes.php";      // importing customer end routes...
require_once "routes/vehicle_routes.php";       // importing vehicle endpoints...
require_once "routes/vehicle_colour_routes.php";// importing vehicle colour endpoints...
require_once "routes/vehicle_model_routes.php"; // importing vehicle model endpoints...
require_once "routes/vehicle_type_routes.php";  // importing vehicle type endpoints...
require_once "routes/parking_spot_routes.php";  // importing parking spot endpoints...
// TODO : vehicle_color
// TODO : vehicle
require_once "routes/vehicle_in_out_routes.php"; // importing vehicle in out endpoits

// executing routes
$app->run();
?>