<?php

abstract class Controller {

    /**
     *
     * @var Application
     */
    protected $app;
    protected $params;

    function __construct($params, $app) {
        $this->params = json_decode($params);
        $this->app = $app;
        $this->init();
    }

    public abstract function init();
    
    public abstract function processPostRequest();

    public abstract function processRequest();

    /**
     * Redirect to specified url
     * @param String $url
     */
    public function redirect($url) {
        header("Location: " + $url);
    }

}
