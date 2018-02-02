<?php

include 'Database.php';
include 'Carrera.php';

class carreraModel {

    public function getCarreras() {
        //obtenemos la informacion de la bdd:
        $pdo = Database::connect();
        $sql = "select * from carreras";
        $resultado = $pdo->query($sql);
//transformamos los registros en objetos de tipo Universidad:
        $listado = array();
        foreach ($resultado as $res) {
            $carrera = new Carrera($res['cod_carrera'], $res['nombre']);
            array_push($listado, $carrera);
        }
        Database::disconnect();
//retornamos el listado resultante:
        return $listado;
    }

    public function getBeca($cod_beca) {
//obtenemos la informacion de la bdd:
        $pdo = Database::connect();
        $sql = "select * from becas where cod_beca=?";
        $consulta = $pdo->prepare($sql);
        $consulta->execute(array($cod_beca));
//obtenemos la factura especifica:
        $res = $consulta->fetch(PDO::FETCH_ASSOC);
        $beca = new Beca($res['cod_beca'], $res['cod_universidad'], $res['nombre'], $res['monto']);
        Database::disconnect();
//retornamos el postulante encontrada:
        return $beca;
    }

    public function insertarCarrera($nombre) {
        $pdo = Database::connect();
        $sql = "insert into carreras (nombre) values(?)";
        $consulta = $pdo->prepare($sql);
        //Ejecutamos y pasamos los parametros:
        try {
            $consulta->execute(array($nombre));
        } catch (PDOException $e) {
            Database::disconnect();
            throw new Exception($e->getMessage());
        }
        $_SESSION['confirmadoCarrera'] = "true";
        Database::disconnect();
    }

    public function eliminarCarrera($cod_carrera) {
//Preparamos la conexion a la bdd:
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "delete from carreras where cod_carrera=?";
        $consulta = $pdo->prepare($sql);
//Ejecutamos la sentencia incluyendo a los parametros:
        $consulta->execute(array($cod_carrera));
        Database::disconnect();
    }

    public function getCarrera($cod_carrera) {
        //obtenemos la informacion de la bdd:
        $pdo = Database::connect();
        $sql = "select * from carreras where cod_carrera=?";
        $consulta = $pdo->prepare($sql);
        $consulta->execute(array($cod_carrera));
        //obtenemos la factura especifica:
        $res = $consulta->fetch(PDO::FETCH_ASSOC);
        $carrera = new Carrera($res['cod_carrera'], $res['nombre']);
        Database::disconnect();
        //retornamos el postulante encontrada:
        return $carrera;
    }

    public function actualizarCarrera($cod_carrera, $nombre) {
        $pdo = Database::connect();
        $sql = "update carreras set nombre=? where cod_carrera=?";
        $consulta = $pdo->prepare($sql);
        //Ejecutamos y pasamos los parametros:
        try {
            $consulta->execute(array($nombre, $cod_carrera));
        } catch (PDOException $e) {
            Database::disconnect();
            throw new Exception($e->getMessage());
        }
        $_SESSION['actualizadoCarrera'] = "true";
        Database::disconnect();
    }

}
