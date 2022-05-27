<?php 
/***********************************************\
 *  Api made for FastParking project 
 * 
 *  author      : Leonardo Antunes
 *  created At  : 26/05/22
 *  version     : 1.0
 * 
\***********************************************/

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

require_once "vendor/autoload.php";

// LOADING ROUTES :
require_once "routes/customer_routes.php"; // customer routes
?>