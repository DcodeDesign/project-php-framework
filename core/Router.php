<?php
require "Url.php";
require "Model.php";
require "Controller.php";
require "ApiController.php";

class router extends Url {
    public function getPage($routes){
        $name = $this->setPage($routes);

        $fileController = ucfirst($name) . "Controller". ".php";
        $fileModel = ucfirst($name) . "Model". ".php";
        $ClassController = ucfirst($name) . "Controller";
        $ClassModel = ucfirst($name) . "Model";

        if (file_exists( "./pages/" . "page-" . $name . "/" . $fileController ) &&
            file_exists( "./pages/" . "page-" . $name . "/" . $fileModel)) {

            require_once("./pages/" . "page-" . $name . "/" .  $fileController);
            require_once("./pages/" . "page-" . $name . "/" .  $fileModel);

            $controller = new $ClassController($ClassModel);
            $controller->getView("pages/" . "page-" . $name . "/" .  $name . "View.php");

            exit();
        }else{
            echo "Page not Found";
        }
    }

    public function getApi($apiRoutes){
        if(self::getFirstRouterUrl() == "api"){
            $name = $this->setApi($apiRoutes);
            $type = $this->typeRequestMethod();

            $fileController = ucfirst($name) .  ucfirst($type) . ".apiController.php";
            $fileModel = ucfirst($name) .  ucfirst($type) . ".apiModel.php";
            $ClassController = ucfirst($name) .  ucfirst($type) . "_apiController";
            $ClassModel = ucfirst($name) .  ucfirst($type) . "_apiModel";

            if (file_exists( "./WebApi/api-"  . $name . "/" . $name . "-" . $type . "/" .   $fileController) &&
                file_exists("./WebApi/api-"  . $name . "/" . $name . "-" . $type . "/" .  $fileController)) {

                require_once("./WebApi/api-"  . $name . "/" . $name . "-" . $type . "/" .  $fileModel);
                require_once("./WebApi/api-"  . $name . "/" . $name . "-" . $type . "/" .  $fileController);

                $apiModel = new $ClassModel();
                $apiController = new $ClassController($ClassModel, $type);
                $apiController->getInit("./WebApi/api-"  . $name . "/" . $name . "-" . $type . "/" .  $name .  ucfirst($type) . ".php");

                exit();
            }else{
                http_response_code(404);
            }
        }
    }

    private function setPage($routes){
        foreach ($routes as $key => $route){
            if($this->getLastRouterUrl() == $key){
                return $name = $route;
            }
        }
    }

    private function setApi($apiRoutes){
        foreach ($apiRoutes as $key => $route){
            if($this->getLastRouterUrl() == $key){
                return $name = $route;
            }
        }
    }

    private function typeRequestMethod(){
        $type = $_SERVER['REQUEST_METHOD'];
        switch ($type){
            case "GET": return "read";
                break;
            case "PUT": return "update";
                break;
            case "OPTIONS": return "update";
                break;
            case "POST": return "create";
                break;
            case "DELETE": return "delete";
                break;

        }
    }
}

$View = new router();
$View->getApi($apiRoutes);
$View->getPage($routes);