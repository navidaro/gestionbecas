<?php

require_once '../model/becarioModel.php';
session_start();
$becarioModel = new becarioModel();
//recibimos la opcion desde la vista:
$opcion = $_REQUEST['opcion'];
unset($_SESSION['mensaje']);
switch ($opcion) {

    case "listarB":
//obtenemos la lista de facturas:
        $listado = $becarioModel->getBecarios();
//y los guardamos en sesion:
        $_SESSION['listadoB'] = serialize($listado);
//redireccionamos a la pagina index para visualizar:
        header('Location: ../view/listaBecarios.php');
        break;

    case "insertarB":
        //obtenemos los parametros del formulario:
        $cedula = $_REQUEST['cedula'];
        $fecha_ini = $_REQUEST['fecha_ini'];
        $fecha_fin = $_REQUEST['fecha_fin'];
        $carrera = $_REQUEST['cod_carrera'];
        $cuenta = $_REQUEST['cuenta'];
        $cod_beca = $_REQUEST['cod_beca'];
        try {
            $becarioModel->insertarB($cedula, $fecha_ini, $fecha_fin, $carrera, $cuenta, $cod_beca);
        } catch (Exception $e) {
            $mensaje = $e->getMessage();
            $_SESSION['mensaje'] = $mensaje;
        }
//actualizamos lista de becarios:
        $listado = $becarioModel->getBecarios();
        $_SESSION['listadoB'] = serialize($listado);
        header('Location: ../view/listaBecarios.php');
        break;

    case "desacreditar":
        $cedula = $_REQUEST['cedula'];
        $becarioModel->eliminarBecario($cedula);
        //obtenemos la lista de facturas:
        $listado = $becarioModel->getBecarios();
//y los guardamos en sesion:
        $_SESSION['listadoB'] = serialize($listado);
//redireccionamos a la pagina index para visualizar:
        header('Location: ../view/listaBecarios.php');
        break;

    case "actualizar":
        //obtenemos los parametros del formulario:
        $cedula = $_REQUEST['cedula'];
        //Buscamos los datos
        $becario = $becarioModel->getBecario($cedula);
        //guardamos en sesion para edicion posterior:
        $_SESSION['becario'] = serialize($becario);
        //redirigimos la navegación al formulario de edicion:
        header('Location: ../view/actualizarBecario.php');
        break;

    case "actualizacion":
        //obtenemos los parametros del formulario:
        $cedula = $_REQUEST['cedula'];
        $fecha_ini = $_REQUEST['fecha_ini'];
        $fecha_fin = $_REQUEST['fecha_fin'];
        $carrera = $_REQUEST['cod_carrera'];
        $cuenta = $_REQUEST['cuenta'];
        try {
            $becarioModel->actualizarBecario($cedula, $fecha_ini, $fecha_fin, $carrera, $cuenta);
        } catch (Exception $e) {
            $mensaje = $e->getMessage();
            $_SESSION['mensaje'] = $mensaje;
        }
        //actualizamos lista de facturas:
        $listado = $becarioModel->getBecarios();
        $_SESSION['listadoB'] = serialize($listado);
        header('Location: ../view/listaBecarios.php');
        break;

    default:
//si no existe la opcion recibida por el controlador, siempre redirigimos la navegacion a la pagina index:
        header('Location: ../index.php');
}
