<?php

include_once 'ClaseBaseDatos.php';

/**
 * Description of ClaseLogin
 *
 * @author jpablos
 */
class ClaseLogin {

    public function login($parametros) {
        $us_pass = $parametros['us_pass'];  
        $us_login = $parametros['us_login'];
        
        $password = crypt($us_pass, strtoupper($us_login));
        
        //$objetoBaseDatos = new ClaseBaseDatos();
        $objetoBaseDatos = new ClaseBaseDatos();

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
