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
    echo $objetoLogin->login();
}

function logOut($objetoLogin) {
    echo $objetoLogin->logOut();
}
