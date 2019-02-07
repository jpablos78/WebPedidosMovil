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

    public function login($send) {
        $us_pass = $send['us_pass'];
        $us_login = $send['us_login'];
        $jwt = $send['jwt'];

        $key = 'XYZ99';
        echo $us_pass;
        $password = crypt($us_pass, strtoupper($us_login));
        echo '<br>';
        echo $password;
        //$password = 'SUJuyhk5m6gpg';
        //$objetoBaseDatos = new ClaseBaseDatos();
        $objetoBaseDatos = new ClaseBaseDatos();

        if ($jwt != '') {
            try {
                $data = JWT::decode($jwt, $key, array('HS256'));

                //print_r($data);

                $us_login = $data->data->us_login;
                $us_pass = $data->data->us_pass;
            } catch (\Exception $e) {
                //echo 'Exception catched: ', $e->getMessage(), "\n";
                //return;
            }
        }



        $parametros = array(
            'json' => false
        );

        $query = "
            EXEC SP_WP_LOGIN
            @in_us_login = '$us_login',
            @in_us_pass = '$password',
            @in_operacion = 'LOG'
        ";
        echo $query;
        $objetoBaseDatos->setParametros($parametros);
        $result = $objetoBaseDatos->query($query);

        if ($result['success']) {
            if ($result['ok'] != 'N') {
                $iss = "http://www.webpedidos.net";
                $token = array(
                    "data" => array(
                        "us_login" => $us_login,
                        "us_pass" => $us_pass
                    )
                );

                $jwt = JWT::encode($token, $key);

                //echo $jwt;


                $result['jwt'] = $jwt;

                //return $result;
            }
        }

        return ClaseJson::getJson($result);
    }

    public function logOut() {
        return 'en logOut';
    }

}
