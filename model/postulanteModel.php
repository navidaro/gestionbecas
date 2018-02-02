<?php

include 'Database.php';
include 'Postulante.php';
include 'Beca.php';

/**
 * Description of modelPostulante
 *
 * @author IvánDarío
 */
class postulanteModel {

    public function insertarP($cedula, $cod_beca, $nombres, $apellidos, $promedio) {

        function validarCI($strCedula) {

            if (is_null($strCedula) || empty($strCedula)) {//compruebo si que el numero enviado es vacio o null
                return -1;
            } else {//caso contrario sigo el proceso
                if (is_numeric($strCedula)) {
                    $total_caracteres = strlen($strCedula); // se suma el total de caracteres
                    if ($total_caracteres == 10) {//compruebo que tenga 10 digitos la cedula
                        $nro_region = substr($strCedula, 0, 2); //extraigo los dos primeros caracteres de izq a der
                        if ($nro_region >= 1 && $nro_region <= 24) {// compruebo a que region pertenece esta cedula//
                            $ult_digito = substr($strCedula, -1, 1); //extraigo el ultimo digito de la cedula
//extraigo los valores pares//
                            $valor2 = substr($strCedula, 1, 1);
                            $valor4 = substr($strCedula, 3, 1);
                            $valor6 = substr($strCedula, 5, 1);
                            $valor8 = substr($strCedula, 7, 1);
                            $suma_pares = ($valor2 + $valor4 + $valor6 + $valor8);
//extraigo los valores impares//
                            $valor1 = substr($strCedula, 0, 1);
                            $valor1 = ($valor1 * 2);
                            if ($valor1 > 9) {
                                $valor1 = ($valor1 - 9);
                            } else {
                                
                            }
                            $valor3 = substr($strCedula, 2, 1);
                            $valor3 = ($valor3 * 2);
                            if ($valor3 > 9) {
                                $valor3 = ($valor3 - 9);
                            } else {
                                
                            }
                            $valor5 = substr($strCedula, 4, 1);
                            $valor5 = ($valor5 * 2);
                            if ($valor5 > 9) {
                                $valor5 = ($valor5 - 9);
                            } else {
                                
                            }
                            $valor7 = substr($strCedula, 6, 1);
                            $valor7 = ($valor7 * 2);
                            if ($valor7 > 9) {
                                $valor7 = ($valor7 - 9);
                            } else {
                                
                            }
                            $valor9 = substr($strCedula, 8, 1);
                            $valor9 = ($valor9 * 2);
                            if ($valor9 > 9) {
                                $valor9 = ($valor9 - 9);
                            } else {
                                
                            }

                            $suma_impares = ($valor1 + $valor3 + $valor5 + $valor7 + $valor9);
                            $suma = ($suma_pares + $suma_impares);
                            $dis = substr($suma, 0, 1); //extraigo el primer numero de la suma
                            $dis = (($dis + 1) * 10); //luego ese numero lo multiplico x 10, consiguiendo asi la decena inmediata superior
                            $digito = ($dis - $suma);
                            if ($digito == 10) {
                                $digito = '0';
                            } else {
                                
                            }//si la suma nos resulta 10, el decimo digito es cero
                            if ($digito == $ult_digito) {//comparo los digitos final y ultimo
                                return 0;
                            } else {
                                return -1;
                            }
                        } else {
                            return -1;
                        }
                        return -1;
                    } else {
                        return -1;
                    }
                } else {
                    return -1;
                }
            }
        }

        if ($promedio < 8) {
            throw new Exception("El promedio menor que 8 no es apto para postular a una beca.");
        }
        if ($promedio > 10) {
            throw new Exception("El promedio ingresado es incorrecto.");
        }
        $c = validarCI($cedula);
        if ($c < 0) {
            throw new Exception("La cedula es incorrecta o no pertenece a Ecuador.");
        }
        if ($cod_beca == NULL) {
            throw new Exception("No se han agregado becas a la postulacion.");
        }
        $postulantes = $this->getPostulantes();
        foreach ($postulantes as $post) {
            foreach ($cod_beca as $valor) {
                if ($post->getCedula() == $cedula && $post->getCod_beca() == $valor->getCod_beca()) {
                    throw new Exception("El estudiante ya esta postulado para la beca con codigo: " . $post->getCod_beca() . " por favor repita");
                }
            }
        }
        $pdo = Database::connect();
        foreach ($cod_beca as $res) {
            $sql = "insert into postulantes values(?,?,?,?,?)";
            $consulta = $pdo->prepare($sql);
//Ejecutamos y pasamos los parametros:
            try {
                $consulta->execute(array($cedula, $res->getCod_beca(), $nombres, $apellidos, $promedio));
            } catch (PDOException $e) {
                Database::disconnect();
                throw new Exception($e->getMessage());
            }
        }
        $_SESSION['confirmado'] = "true";
        Database::disconnect();
    }

    public function eliminarProstulante($cedula, $cod_beca) {
//Preparamos la conexion a la bdd:

        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "delete from postulantes where cedula=? and cod_beca=?";
        $consulta = $pdo->prepare($sql);
//Ejecutamos la sentencia incluyendo a los parametros:
        $consulta->execute(array($cedula, $cod_beca));
        Database::disconnect();
    }

    public function getPostulantes() {
//obtenemos la informacion de la bdd:
        $pdo = Database::connect();
        $sql = "select * from postulantes";
        $resultado = $pdo->query($sql);
//transformamos los registros en objetos de tipo Beca:
        $listado = array();
        foreach ($resultado as $res) {
            $postulante = new Postulante($res['cedula'], $res['cod_beca'], $res['nombres'], $res['apellidos'], $res["promedio"]);
            array_push($listado, $postulante);
        }
        Database::disconnect();
//retornamos el listado resultante:
        return $listado;
    }

    public function getPostulante($cedula) {
//obtenemos la informacion de la bdd:
        $pdo = Database::connect();
        $sql = "select * from postulantes where cedula=?";
        $consulta = $pdo->prepare($sql);
        $consulta->execute(array($cedula));
//obtenemos la factura especifica:
        $res = $consulta->fetch(PDO::FETCH_ASSOC);
        $postulante = new Postulante($res['cedula'], $res['cod_beca'], $res['nombres'], $res['apellidos'], $res["promedio"]);
        Database::disconnect();
//retornamos el postulante encontrada:
        return $postulante;
    }
    
    public function getPostulante1($cedula, $cod_beca) {
//obtenemos la informacion de la bdd:
        $pdo = Database::connect();
        $sql = "select * from postulantes where cedula=? and cod_beca=?";
        $consulta = $pdo->prepare($sql);
        $consulta->execute(array($cedula,$cod_beca));
//obtenemos la factura especifica:
        $res = $consulta->fetch(PDO::FETCH_ASSOC);
        $postulante = new Postulante($res['cedula'], $res['cod_beca'], $res['nombres'], $res['apellidos'], $res["promedio"]);
        Database::disconnect();
//retornamos el postulante encontrada:
        return $postulante;
    }

    public function actualizarPostulante($cedula, $cod_beca, $nombres, $apellidos, $promedio) {
        if ($promedio < 8) {
            throw new Exception("El promedio menor que 8 no es apto para postular a una beca.");
        }
        if ($promedio > 10) {
            throw new Exception("El promedio ingresado es incorrecto.");
        }
        $postulantes = $this->getPostulantes();
        $pdo = Database::connect();
        $sql = "update postulantes set cod_beca=?,nombres=?,apellidos=?,promedio=? where cedula=? and cod_beca=?";
        $consulta = $pdo->prepare($sql);
//Ejecutamos y pasamos los parametros:
        try {
            $consulta->execute(array($cod_beca, $nombres, $apellidos, $promedio, $cedula, $cod_beca));
        } catch (PDOException $e) {
            Database::disconnect();
            throw new Exception($e->getMessage());
        }
//        $cont = 0;
//        foreach ($postulantes as $post1) {
//            echo "".$post1->getCedula()." == ".$cedula." &&".$post1->getCod_beca()." == ".$cod_beca."<br>";
//            if ($post1->getCedula() == $cedula && $post1->getCod_beca() == $cod_beca) {
//                $cont++;
//            }
//        }
//        if ($cont > 1) {
////            $sql = "rollback";
//            $consulta = $pdo->prepare($sql);
//            throw new Exception("EEROR: El estudiante ya esta postulado para la beca con codigo: " . $post1->getCod_beca() . " por favor repita");
//        }
//        echo "cont ".   $cont;
        $_SESSION['actualizadoPostulante'] = "true";
        Database::disconnect();
    }

}
