<?php
/**
 * Created by JetBrains PhpStorm.
 * User: DScorp
 * Date: 14.03.12
 * Time: 21:49
 * To change this template use File | Settings | File Templates.
 */
 
ini_set( "display_errors", true );
ini_set('log_error', false);
ini_set( "error_reporting", A_ALL | A_STRICT );
date_default_timezone_set( "Asia/Dushanbe" );

define('DB_DNS', "localhost");
define('DB_USER', "root");
define('DB_PASS', "vertrigo");
define('DB_NAME', "FinCrow");
define('CLASSPATH', "/classes");

function exception_handler($exception){
    echo "Oops we have an exception :-(";
    error_log($exception->getMessage());
}

function error_handler($number, $string, $file, $line, $context){
    echo "Oops we have an error :-(";
    $error = "Number: [$number] ";
    $error .= "String: [$string] ";
    $error .= "File: [$file] ";
    $error .= "Line: [$line] ";
    $error .= "Context: [". print_r($context)."]";
    error_log( $error);
}

set_exception_handler('exception_handler');
set_error_handler('error_handler');

