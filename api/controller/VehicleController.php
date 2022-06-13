<?php
    use Slim\Http\Request;
    use Slim\Http\Response;
    
    require_once "services/VehicleService.php";
    
    class VehicleController {
        private $service;
    
        function __construct() {
            $this->service = new VehicleService();
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
    
        function getByCustomerId(Request $request, Response $response, array $args) {
            
            $customerId = $request->getQueryParam("customer");

            $resData = (array) $this->service->findBy("customer.id", $customerId);

            return $response->withStatus($resData['status'])
                            ->withHeader("Content-Type", "application/json")
                            ->write(json_encode($resData));
        }

        function create(Request $request, Response $response, array $args) {
            $body = $request->getParsedBody();
    
            $resData = (array) $this->service->create($body);
    
            return $response->withStatus($resData['status'])
                            ->withHeader("Content-Type", "application/json")
                            ->write(json_encode($resData));
        }

        function getByLicensePlate(Request $request, Response $response, array $args) {
            $plate = $request->getQueryParam("plate");

            $resData = (array) $this->service->findBy("vehicle.plate", $plate);

            return $response->withStatus($resData['status'])
                            ->withHeader("Content-Type", "application/json")
                            ->write(json_encode($resData));
        }

        function update(Request $request, Response $response, array $args) {
            $resData = (array) $this->service->update($args["id"], $request->getParsedBody());
    
            return $response->withStatus($resData['status'])
                    ->withHeader("Content-Type", "application/json")
                    ->write(json_encode($resData));
        }

    }
?>