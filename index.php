<?php 
session_start();
header("Access-Control-Allow-Origin: *");  //Aceita de todas URLs
header("Access-Control-Allow-Methods: GET,POST,PUT,DELETE"); //Aceita put,delete,post,get,head ..

require 'config.php';
require 'routers.php';
require 'vendor/autoload.php';

$core = new Core\Core();
$core->run();