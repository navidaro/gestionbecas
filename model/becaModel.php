<?php

include 'Database.php';
include 'Beca.php';
include 'Resumen.php';

class becaModel {

    public function getBecas() {
//obtenemos la informacion de la bdd:
        $pdo = Database::connect();
        $sql = "select * from becas";
        $resultado = $pdo->query($sql);
//transformamos los registros en objetos de tipo Beca:
        $listado = array();
        foreach ($resultado as $res) {
            $beca = new Beca($res['cod_beca'], $res['cod_universidad'], $res['nombre'], $res['monto']);
            array_push($listado, $beca);
        }
        Database::disconnect();
//retornamos el listado resultante:
        return $listado;
    }

    public function insertarBeca($cod_universidad, $nombre, $monto) {
        $pdo = Database::connect();
        $sql = "insert into becas (cod_universidad,nombre,monto) values(?,?,?)";
        $consulta = $pdo->prepare($sql);
//Ejecutamos y pasamos los parametros:
        try {
            $consulta->execute(array($cod_universidad, $nombre, $monto));
        } catch (PDOException $e) {
            Database::disconnect();
            throw new Exception($e->getMessage());
        }
        $_SESSION['confirmadoBeca'] = "true";
        Database::disconnect();
    }

    public function eliminarBeca($cod_beca) {
//Preparamos la conexion a la bdd:
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "delete from becas where cod_beca=?";
        $consulta = $pdo->prepare($sql);
//Ejecutamos la sentencia incluyendo a los parametros:
        $consulta->execute(array($cod_beca));
        Database::disconnect();
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

    public function actualizarBeca($cod_beca, $cod_universidad, $nombre, $monto) {
        $pdo = Database::connect();
        $sql = "update becas set cod_universidad=?,nombre=?,monto=? where cod_beca=?";
        $consulta = $pdo->prepare($sql);
//Ejecutamos y pasamos los parametros:
        try {
            $consulta->execute(array($cod_universidad, $nombre, $monto, $cod_beca));
        } catch (PDOException $e) {
            Database::disconnect();
            throw new Exception($e->getMessage());
        }
        $_SESSION['actualizadoBeca'] = "true";
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

    public function Resumen() {
//obtenemos la informacion de la bdd:
        $pdo = Database::connect();
        $sql = "select count(B.cedula) AS cedula,becas.nombre AS beca,becas.cod_beca as codigo,
                 round(avg(P.promedio), 2) as promedio from Becarios B
                 inner join postulantes P
                 on B.cedula = P.cedula
                 inner join becas    
                 on becas.cod_beca = P.cod_beca
                 group by becas.nombre";
        $resultado = $pdo->query($sql);
//transformamos los registros en objetos de tipo Beca:
        $listado = array();
        foreach ($resultado as $res) {
            $resumen = new Resumen($res['cedula'], $res['beca'], $res['codigo'], $res['promedio']);
            array_push($listado, $resumen);
        }
        Database::disconnect();
//retornamos el listado resultante:
        return $listado;
    }

    public function agregarBeca($cod_beca) {
        $beca = $this->getBeca($cod_beca);
        if (isset($_SESSION['becas_postuladas'])) {
            $listadoBecas = unserialize($_SESSION['becas_postuladas']);
        } else {
            $listadoBecas = array();
        }
        if (in_array($beca, $listadoBecas)) {
            throw new Exception("La postulacion a esta beca esta registrada ya.");
        }
        array_push($listadoBecas, $beca);
        $_SESSION['becas_postuladas'] = serialize($listadoBecas);
    }

    public function eliminarPostulacion($cod_beca) {
        $aux = array();
        if (isset($_SESSION['becas_postuladas'])) {
            $listadoBecas = unserialize($_SESSION['becas_postuladas']);
        } else {
            $listadoBecas = array();
        }
        foreach ($listadoBecas as $res) {
            if ($res->getCod_beca() == $cod_beca) {
                
            } else {
                array_push($aux, $res);
            }
        }
        $_SESSION['becas_postuladas'] = serialize($aux);
    }

}
