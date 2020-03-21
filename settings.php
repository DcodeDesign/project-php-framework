<?php
/** ************************** **/
/** ********** Routes ******** **/
/** ************************** **/

$routes = [
    '' => 'home',
    'accueil' => 'home',
    'contact' => 'contact',
    'login' => 'login'
];

$apiRoutes = [
    'contact' => 'contact'
];

/** ************************** **/
/** ******* Connect DB ******* **/
/** ************************** **/

define('HOST', 'localhost');
define('USER', 'root');
define('PASSWORD', 'root');
define('DATABASE', 'framework_php');

/** ************************** **/
/** *********** INI ********** **/
/** ************************** **/

ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', dirname(__file__) . '/logs.txt');
error_reporting(E_ALL);
ini_set('memory_limit', '1024M');

/** *************************** **/
/** ********* Requires ******** **/
/** *************************** **/
require "./core/Router.php";

