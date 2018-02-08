<?php

/*
 * @author TROLL
 */
include 'Database.php';
include 'Login.php';

class loginModel {

    public function ingresar($username, $password) {
//obtenemos la informacion de la bdd:
        $pdo = Database::connect();
        $sql = "select * from usuarios where username=? and password=?";
        $consulta = $pdo->prepare($sql);
        $consulta->execute(array($username, $password));
//obtenemos la factura especifica:
        $listado = array();
        foreach ($consulta as $res) {
            $Login = new Login($res['username'], $res['password']);
            array_push($listado, $Login);
        }
        sleep(1);
        Database::disconnect();

        if (count($listado) == 1) {
            $log = true;
        } else {
            $log = false;
        }
        return $log;
    }

}
