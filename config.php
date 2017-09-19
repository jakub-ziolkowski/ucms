<?php
require_once './core/Config.php';

// domain setup
Config::$base_url = 'http://localhost/~jziolkowski/ucms';

// app root directory
Config::$dir = __DIR__;

// database settings
Config::$server = 'localhost';
Config::$database = 'ucms';
Config::$user = 'root';
Config::$password = 'qpalzm';

// for debug purpose (more verbose messaging)
Config::$debug = FALSE;
