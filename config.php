<?php
require 'environment.php';
global $config;
$config = array();

if( ENVIRONMENT == 'development'){
    define("BASE_URL" , "http://localhost/testes/webservice/api-devstagram");
    $config['dbname'] = 'todo';
    $config['host']   = 'localhost';
    $config['dbuser'] = 'root';
    $config['dbpass'] = 'magalhaes10';
    $config['jwt_secret_key'] = "uesleisales";
}else{
    define("BASE_URL" , "http://www.meusite.com/");
    $config['dbname'] = 'estrutura_mvc';
    $config['host']   = 'localhost';
    $config['dbuser'] = 'root';
    $config['dbpass'] = 'magalhaes10';
    $config['jwt_secret_key'] = "uesleisales";
}

global $db;
try{
       $db = new PDO("mysql:dbname=".$config['dbname'].";host=".$config['host'] , $config['dbuser'] , $config['dbpass']);
}catch(PDOException $e){
        echo "Erro: ".$e->getMessage();
        exit;
}