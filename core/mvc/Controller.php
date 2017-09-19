<?php

abstract class Controller {

    /**
     *
     * @var PDO
     */
    protected $sql;
    protected $params;

    function __construct($params, $sql) {
        $this->params = json_decode($params);
        $this->sql = $sql;
    }

    public abstract function processPOST();
    public abstract function process();

    /**
     * Przekieruj na adres
     * @param String $url
     */
    public function redirect($url) {
        header("Location: " + $url);
    }

}
