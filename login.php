<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token, X-EXAMPLE-HEADER, authorization');
//error_reporting(E_ALL ^ E_WARNING);
error_reporting(E_ERROR | E_PARSE);
//include_once 'clases/ClaseLogin.php';

include_once 'clases/ClaseGenerica.php';
include_once 'librerias/vendor/autoload.php';
include_once 'librerias/vendor/firebase/php-jwt/src/BeforeValidException.php';
include_once 'librerias/vendor/firebase/php-jwt/src/ExpiredException.php';
include_once 'librerias/vendor/firebase/php-jwt/src/SignatureInvalidException.php';
include_once 'librerias/vendor/firebase/php-jwt/src/JWT.php';
include_once 'clases/ClaseLogin.php';


$action = isset($_GET['action']) ? $_GET['action'] : (isset($_POST['action']) ? $_POST['action'] : null);
//$action = 'login';
$objetoLogin = new ClaseLogin();

switch ($action) {
    case 'login':
        login($objetoLogin);
        break;
    case 'logOut':
        logOut($objetoLogin);
        break;
}

function login($objetoLogin) {
    $us_login = $_POST['login'];
    $us_pass = $_POST['password'];
    $jwt = '';//eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJkYXRhIjp7InVzX2xvZ2luIjoic3VwZXJ2aXNvciIsInVzX3Bhc3MiOiJTVUp1eWhrNW02Z3BnIn19.8L2FQal_OvFgbjT_jQtOgsQy3Leeb3_C7tWo_3SPQ3k';

    $headers = getallheaders();
    foreach ($headers as $header => $val) {
        //echo $key . ': ' . $val . '<br>';
        if ($header == 'authorization') {
            $jwt = $val;
        }
    }

    //$us_login = 'supervisor';
    //$us_pass = 'SUJuyhk5m6gpg';

    //implementar funcion que valide los campos

    $send = array(
        'us_login' => $us_login,
        'us_pass' => $us_pass,
        'jwt' => $jwt
    );

    echo $objetoLogin->login($send);
}

function logOut($objetoLogin) {
    echo $objetoLogin->logOut();
}
