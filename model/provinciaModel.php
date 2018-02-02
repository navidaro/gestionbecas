<?php

include 'Database.php';
include 'Provincia.php';

class provinciaModel {

    public function getProvincias() {
        //obtenemos la informacion de la bdd:
        $pdo = Database::connect();
        $sql = "select * from provincias";
        $resultado = $pdo->query($sql);
//transformamos los registros en objetos de tipo Universidad:
        $listado = array();
        foreach ($resultado as $res) {
            $provincia = new Provincia($res['cod_provincia'], $res['nombre']);
            array_push($listado, $provincia);
        }
        Database::disconnect();
//retornamos el listado resultante:
        return $listado;
    }

    public function insertarProvincia($nombre) {
        $pdo = Database::connect();
        $sql = "insert into provincias (nombre) values(?)";
        $consulta = $pdo->prepare($sql);
        //Ejecutamos y pasamos los parametros:
        try {
            $consulta->execute(array($nombre));
        } catch (PDOException $e) {
            Database::disconnect();
            throw new Exception($e->getMessage());
        }
        $_SESSION['confirmadoProvincia'] = "true";
        Database::disconnect();
    }

    public function eliminarProvincia($cod_provincia) {
//Preparamos la conexion a la bdd:
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "delete from provincias where cod_provincia=?";
        $consulta = $pdo->prepare($sql);
//Ejecutamos la sentencia incluyendo a los parametros:
        $consulta->execute(array($cod_provincia));
        Database::disconnect();
    }

    public function getProvincia($cod_provincia) {
        //obtenemos la informacion de la bdd:
        $pdo = Database::connect();
        $sql = "select * from provincias where cod_provincia=?";
        $consulta = $pdo->prepare($sql);
        $consulta->execute(array($cod_provincia));
        //obtenemos la factura especifica:
        $res = $consulta->fetch(PDO::FETCH_ASSOC);
        $provincia = new Provincia($res['cod_provincia'], $res['nombre']);
        Database::disconnect();
        //retornamos el postulante encontrada:
        return $provincia;
    }

    public function actualizarProvincia($cod_provincia, $nombre) {
        $pdo = Database::connect();
        $sql = "update provincias set nombre=? where cod_provincia=?";
        $consulta = $pdo->prepare($sql);
        //Ejecutamos y pasamos los parametros:
        try {
            $consulta->execute(array($nombre, $cod_provincia));
        } catch (PDOException $e) {
            Database::disconnect();
            throw new Exception($e->getMessage());
        }
        $_SESSION['actualizadoProvincia'] = "true";
        Database::disconnect();
    }

}
