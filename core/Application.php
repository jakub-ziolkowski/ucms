<?php

require 'Utils.php';
require 'mvc/Model.php';
require 'mvc/View.php';
require 'mvc/Controller.php';
require 'Router.php';
require 'ApplicationModel.php';
require 'ApplicationErrorHandler.php';

class Application {

    /**
     *
     * @var PDO
     */
    public $sql;

    /**
     *
     * @var ApplicationModel
     */
    public $model;

    /**
     *
     * @var Router
     */
    public $router;

    function __construct($path) {
        $this->sql = $this->getConnection("utf-8");
        $this->model = new ApplicationModel($this->sql);
        $this->router = new Router($path, $this->model);
        Config::$db = &$this->sql;
        $route = $this->model->getRoute();
        $errorHandlerView = new ApplicationErrorHandler();
        if (!empty($route)) {
            $controller = $this->router->runController($route['controllerClass'], $route['params']);
            if (!is_null($controller)) {
                $controller->process();
            } else {
                header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
                echo $errorHandlerView->render500();
            }
        } else {
            header($_SERVER['SERVER_PROTOCOL'] . " 404 Not Found", true, 404);
            echo $errorHandlerView->render404();
        }
    }

    /**
     * Create PDO connection to database using config.php values
     * @param String $encoding Database encoding
     * @return PDO
     * @throws Exception
     */
    private function getConnection($encoding) {
        try {
            $sql = new PDO('mysql:host=' . Config::$server . ';dbname=' . Config::$database, Config::$user, Config::$password);
            if (config::$debug) {
                $this->sql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            $sql->query("SET NAMES $encoding");
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
        return $sql;
    }

}
