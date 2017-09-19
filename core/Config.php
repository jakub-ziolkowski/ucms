<?php

class Config {
    /* defaults */

    public static $base_url = "http://localhost/";
    public static $server = "127.0.0.1";
    public static $database = "cms";
    public static $user = "root";
    public static $password = ""; // xD
    public static $debug = true;
    public static $dir = "";
    public static $db;
    public static $version = "1.0.1";

    public static function getConfig($name) {
        $sql = self::$db->prepare('SELECT * from `registry` where name = ?');
        $sql->execute(array($name));
        $data = $sql->fetchAll();
        return (empty($data)) ? null : $data[0]['value'];
    }

    public function setConfig($name, $value) {
        $sql = self::$db->prepare('UPDATE `registry` SET `value` = ? where name = ?');
        $sql->execute(array($value, $name));
    }

}
