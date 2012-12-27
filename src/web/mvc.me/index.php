<?php 

//turn error reporting on
error_reporting(E_ALL);
ini_set('display_errors', '1');

define('BASE_PATH', dirname(realpath(__FILE__)) . '/');
define('APP_PATH', BASE_PATH.'app/');

include BASE_PATH. '/lib/Core.php';