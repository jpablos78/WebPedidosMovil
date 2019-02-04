<?php

include_once './clases/ClaseLogin.php';

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

    //implementar funcion que valide los campos

    $parametros = array(
        'us_login' => $us_login,
        'us_pass' => $us_pass
    );

    echo $objetoLogin->login($parametros);
}

function logOut($objetoLogin) {
    echo $objetoLogin->logOut();
}
