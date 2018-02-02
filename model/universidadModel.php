<?php

include 'Database.php';
include 'Universidad.php';

class universidadModel {

    public function getUniversidades() {
        //obtenemos la informacion de la bdd:
        $pdo = Database::connect();
        $sql = "select * from universidades";
        $resultado = $pdo->query($sql);
//transformamos los registros en objetos de tipo Universidad:
        $listado = array();
        foreach ($resultado as $res) {
            $universidad = new Universidad($res['cod_universidad'], $res['cod_provincia'], $res['nombre'], $res['telefono'], $res['categoria']);
            array_push($listado, $universidad);
        }
        Database::disconnect();
//retornamos el listado resultante:
        return $listado;
    }

    public function insertarUniversidad($cod_provincia, $nombre, $telefono, $categoria) {
        $pdo = Database::connect();
        $sql = "insert into universidades (cod_provincia,nombre,telefono,categoria) values(?,?,?,?)";
        $consulta = $pdo->prepare($sql);
        //Ejecutamos y pasamos los parametros:
        try {
            $consulta->execute(array($cod_provincia, $nombre, $telefono, $categoria));
        } catch (PDOException $e) {
            Database::disconnect();
            throw new Exception($e->getMessage());
        }
        $_SESSION['confirmadoUniversidad'] = "true";
        Database::disconnect();
    }

    public function eliminarUniversidad($cod_universidad) {
//Preparamos la conexion a la bdd:
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "delete from universidades where cod_universidad=?";
        $consulta = $pdo->prepare($sql);
//Ejecutamos la sentencia incluyendo a los parametros:
        $consulta->execute(array($cod_universidad));
        Database::disconnect();
    }

    public function getUniversidad($cod_universidad) {
        //obtenemos la informacion de la bdd:
        $pdo = Database::connect();
        $sql = "select * from universidades where cod_universidad=?";
        $consulta = $pdo->prepare($sql);
        $consulta->execute(array($cod_universidad));
        //obtenemos la factura especifica:
        $res = $consulta->fetch(PDO::FETCH_ASSOC);
        $universidad = new Universidad($res['cod_universidad'], $res['cod_provincia'], $res['nombre'], $res['telefono'], $res['categoria']);
        Database::disconnect();
        //retornamos el postulante encontrada:
        return $universidad;
    }

    public function actualizarUniversidad($cod_universidad, $cod_provincia, $nombre, $telefono, $categoria) {
        $pdo = Database::connect();
        $sql = "update universidades set cod_provincia=?,nombre=?,telefono=?,categoria=? where cod_universidad=?";
        $consulta = $pdo->prepare($sql);
        //Ejecutamos y pasamos los parametros:
        try {
            $consulta->execute(array($cod_provincia, $nombre, $telefono, $categoria, $cod_universidad));
        } catch (PDOException $e) {
            Database::disconnect();
            throw new Exception($e->getMessage());
        }
        $_SESSION['actualizadoUniversidad'] = "true";
        Database::disconnect();
    }

}
