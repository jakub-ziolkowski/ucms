<?php

class Router {

    /**
     *
     * @var Application
     */
    protected $app;
    public $extensionsPath = null;

    function __construct($path, Application $app) {
        $this->app = $app;
        $this->extensionsPath = $path . "/app";
    }

    /**
     * Get canonical request string (without $_GET variables)
     * @return String $req
     */
    public static function getRequestString() {
        $req = filter_input(INPUT_GET, "r");
        if (is_null($req)) {
            $req = "";
        }
        return $req;
    }

    /**
     * Get request array based on $r
     * @return Array $request_array
     */
    public static function getRequestArray() {
        $request_array = explode("/", Router::getRequestString());
        return $request_array;
    }

    /**
     * Run controller 
     * @param String $modulePath
     * @param JsonSerializable $params
     * @return Controller
     */
    public function runController($modulePath, $params) {
        $path = $this->extensionsPath . "/" . $modulePath . ".php";
        $_path = explode("/", $modulePath);
        $controllerName = $_path[count($_path) - 1];
        if (file_exists($path)) {
            include $path;
            return new $controllerName($params, $this->app);
        }
    }

}
