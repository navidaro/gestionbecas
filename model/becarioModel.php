<?php

include 'Database.php';
include 'Becario.php';

/**
 * Description of modelBecario
 *
 * @author IvánDarío
 */
class becarioModel {

    public function insertarB($cedula, $fecha_ini, $fecha_fin, $carrera, $cuenta, $cod_beca) {
        $hoy = getdate();
        $finaFecha = explode("-", $fecha_fin);
        $inicialFecha = explode("-", $fecha_ini);
        if ($hoy["year"] > $inicialFecha[0]) {
            throw new Exception("LA FECHA INICIAL ES UNA FECHA PASADA");
        } else {
            if ($hoy["mon"] > $inicialFecha[1]) {
                throw new Exception("LA FECHA INICIAL ES UNA FECHA PASADA(mes anterior)");
            } else {
                if (($hoy["mday"] - 1) > $inicialFecha[2]) {
                    throw new Exception("LA FECHA INICIAL ES UNA FECHA PASADA(dia anterior)");
                }
            }
        }
        if ($finaFecha[0] < $inicialFecha[0]) {
            throw new Exception("LA FECHA INICIAL ES MAYOR A LA FINAL");
        } else {
            if ($finaFecha[1] < $inicialFecha[1]) {
                throw new Exception("LA FECHA INICIAL ES MAYOR A LA FINAL(mes anterior)");
            } else {
                if ($finaFecha[2] < $inicialFecha[2]) {
                    throw new Exception("LA FECHA INICIAL ES MAYOR A LA FINAL(dia anterior)");
                }
            }
        }
        $becarios = $this->getBecarios();
        foreach ($becarios as $val) {
            if ($cedula == $val->getCedula()) {
                throw new Exception("El postulante ya es becario (no puede ser acreditado a otra beca o a la misma dos veces)");
            }
        }
        $pdo = Database::connect();
        $sql = "insert into becarios values(?,?,?,?,?,?)";
        $consulta = $pdo->prepare($sql);
        //Ejecutamos y pasamos los parametros:
        try {
            $consulta->execute(array($cedula, $fecha_ini, $fecha_fin, $carrera, $cuenta, $cod_beca));
        } catch (PDOException $e) {
            Database::disconnect();
            throw new Exception("El postulante ya es becario (no puede ser acreditado a otra beca o a la misma dos veces)");
        }
        $_SESSION['confirmadoBecario'] = "true";
        Database::disconnect();
    }

    public function getBecarios() {
        //obtenemos la informacion de la bdd:
        $pdo = Database::connect();
        $sql = "select * from becarios";
        $resultado = $pdo->query($sql);
//transformamos los registros en objetos de tipo Beca:
        $listado = array();
        foreach ($resultado as $res) {
            $becario = new Becario($res['cedula'], $res['fecha_ini'], $res['fecha_fin'], $res['carrera'], $res['cuenta'], $res['cod_beca']);
            array_push($listado, $becario);
        }
        Database::disconnect();
//retornamos el listado resultante:
        return $listado;
    }

    public function getBecario($cedula) {
        //obtenemos la informacion de la bdd:
        $pdo = Database::connect();
        $sql = "select * from becarios where cedula=?";
        $consulta = $pdo->prepare($sql);
        $consulta->execute(array($cedula));
        //obtenemos la factura especifica:
        $res = $consulta->fetch(PDO::FETCH_ASSOC);
        $becario = new Becario($res['cedula'], $res['fecha_ini'], $res['fecha_fin'], $res['carrera'], $res['cuenta'], $res['cod_beca']);
        Database::disconnect();
        //retornamos el postulante encontrada:
        return $becario;
    }

    public function eliminarBecario($cedula) {
//Preparamos la conexion a la bdd:
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "delete from becarios where cedula=?";
        $consulta = $pdo->prepare($sql);
//Ejecutamos la sentencia incluyendo a los parametros:
        $consulta->execute(array($cedula));
        Database::disconnect();
    }

    public function actualizarBecario($cedula, $fecha_ini, $fecha_fin, $carrera, $cuenta) {
        $hoy = getdate();
        $inicialFecha = split("-", $fecha_ini);
        $finaFecha = split("-", $fecha_fin);
        if ($hoy["year"] > $inicialFecha[0]) {
            throw new Exception("LA FECHA INICIAL ES UNA FECHA PASADA");
        } else {
            if ($hoy["mon"] > $inicialFecha[1]) {
                throw new Exception("LA FECHA INICIAL ES UNA FECHA PASADA(mes anterior)");
            } else {
                if (($hoy["mday"] - 1) > $inicialFecha[2]) {
                    throw new Exception("LA FECHA INICIAL ES UNA FECHA PASADA(dia anterior)");
                }
            }
        }
        if ($finaFecha[0] < $inicialFecha[0]) {
            throw new Exception("LA FECHA INICIAL ES MAYOR A LA FINAL");
        } else {
            if ($finaFecha[1] < $inicialFecha[1]) {
                throw new Exception("LA FECHA INICIAL ES MAYOR A LA FINAL(mes anterior)");
            } else {
                if ($finaFecha[2] < $inicialFecha[2]) {
                    throw new Exception("LA FECHA INICIAL ES MAYOR A LA FINAL(dia anterior)");
                }
            }
        }
        $pdo = Database::connect();
        $sql = "update becarios set fecha_ini=?, fecha_fin=?,carrera=?,cuenta=? where cedula=?";
        $consulta = $pdo->prepare($sql);
        //Ejecutamos y pasamos los parametros:
        try {
            $consulta->execute(array($fecha_ini, $fecha_fin, $carrera, $cuenta, $cedula));
        } catch (PDOException $e) {
            Database::disconnect();
            throw new Exception($e->getMessage());
        }
        $_SESSION['actualizadoBecario'] = "true";
        Database::disconnect();
    }

}
