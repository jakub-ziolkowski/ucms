<?php

abstract class Model {

    public $sql;

    function __construct($sql) {
        $this->sql = $sql;
    }

}
