<?php

//include_once 'ClaseBaseDatos.php';
//require_once './../librerias/vendor/autoload.php';
//require_once('../librerias/vendor/autoload.php');
use \Firebase\JWT\JWT;
/**
 * Description of ClaseLogin
 *
 * @author jpablos
 */
class ClaseLogin {

    public function login($parametros) {
        $us_pass = $parametros['us_pass'];
        $us_login = $parametros['us_login'];
        $jwt = $parametros['jwt'];

        $password = crypt($us_pass, strtoupper($us_login));
        $password = 'SUJuyhk5m6gpg';
        //$objetoBaseDatos = new ClaseBaseDatos();
        $objetoBaseDatos = new ClaseBaseDatos();

        if ($jwt != '') {
            try {
                $data = JWT::decode($jwt, $key, array('HS256'));
            } catch (\Exception $e) {
                echo 'Exception catched: ', $e->getMessage(), "\n";
                return;
            }
        }

        $query = "
            EXEC SP_WP_LOGIN
            @in_us_login = '$us_login',
            @in_us_pass = '$password',
            @in_operacion = 'LOG'
        ";

        return $objetoBaseDatos->query($query);
    }

    public function logOut() {
        return 'en logOut';
    }

}
