<?php
    use Slim\Http\Request;
    use Slim\Http\Response;
    
    require_once "services/VehicleColourService.php";
    
    class VehicleColourController {
        private $service;
    
        function __construct() {
            $this->service = new VehicleColourService();
        }
    
        function getAll(Request $request, Response $response, array $args) {
            
            $resData = (array) $this->service->list();
    
            return $response    ->withStatus($resData['status'])
                                ->withHeader("Content-Type", "application/json")
                                ->write(json_encode($resData));
        }
    
        function getById(Request $request, Response $response, array $args) {
            $resData = (array) $this->service->find($args["id"]);
    
            return $response->withStatus($resData['status'])
                            ->withHeader("Content-Type", "application/json")
                            ->write(json_encode($resData));
        }
    }
?>