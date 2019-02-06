<?php

//error_reporting(E_ALL ^ E_WARNING);
//error_reporting(E_ERROR | E_PARSE);
//include_once 'clases/ClaseLogin.php';

include_once 'clases/ClaseGenerica.php';
include_once 'librerias/vendor/autoload.php';
include_once 'librerias/vendor/firebase/php-jwt/src/BeforeValidException.php';
include_once 'librerias/vendor/firebase/php-jwt/src/ExpiredException.php';
include_once 'librerias/vendor/firebase/php-jwt/src/SignatureInvalidException.php';
include_once 'librerias/vendor/firebase/php-jwt/src/JWT.php';
include_once 'clases/ClaseLogin.php';



$action = isset($_GET['action']) ? $_GET['action'] : (isset($_POST['action']) ? $_POST['action'] : null);
$action = 'login';
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
    $us_login = $_POST['us_login'];
    $us_pass = $_POST['us_pass'];
    $jwt = '1';

    $headers = getallheaders();
    foreach ($headers as $header => $val) {
        //echo $key . ': ' . $val . '<br>';
        if ($header == 'authorization') {
            $jwt = $val;
        }
    }

    $us_login = 'supervisor';
    $us_pass = '123456';

    //implementar funcion que valide los campos

    $parametros = array(
        'us_login' => $us_login,
        'us_pass' => $us_pass,
        'jwt' => $jwt
    );

    echo $objetoLogin->login($parametros);
}

function logOut($objetoLogin) {
    echo $objetoLogin->logOut();
}
