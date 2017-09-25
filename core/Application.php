<?php

require 'utils/Utils.php';
require 'utils/FormUtils.php';
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
        session_start();
        $this->sql = $this->getConnection("utf8");
        $this->model = new ApplicationModel($this->sql);
        $this->router = new Router($path, $this);
        Config::$db = &$this->sql;
        $errorHandlerView = new ApplicationErrorHandler();
        $route = $this->model->getRoute();
        if (!empty($route)) {
            $controller = $this->router->runController($route['controllerClass'], $route['params']);
            if (!is_null($controller)) {
                if (filter_input(INPUT_SERVER, "REQUEST_METHOD") === 'POST') {
                    $controller->processPostRequest();
                }
                $controller->processRequest();
            } else {
                header(filter_input(INPUT_SERVER, "SERVER_PROTOCOL") . ' 500 Internal Server Error', true, 500);
                echo $errorHandlerView->render500();
            }
        } else {
            header(filter_input(INPUT_SERVER, "SERVER_PROTOCOL") . " 404 Not Found", true, 404);
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
                $sql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            $sql->query("SET NAMES $encoding");
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
        return $sql;
    }

}
