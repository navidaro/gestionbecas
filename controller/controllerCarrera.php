<?php

require_once '../model/carreraModel.php';
session_start();
$carreraModel = new carreraModel();
//recibimos la opcion desde la vista:
$opcion = $_REQUEST['opcion'];
unset($_SESSION['mensaje']);
switch ($opcion) {

    case "listarC":
//obtenemos la lista de facturas:
        $listado = $carreraModel->getCarreras();
//y los guardamos en sesion:
        $_SESSION['listadoC'] = serialize($listado);
//redireccionamos a la pagina main para visualizar:
        header('Location: ../view/crudCarrera.php');
        break;

    case "insertarC":
        //obtenemos los parametros del formulario:
        $nombre = $_REQUEST['nombre'];
        $carreraModel->insertarCarrera($nombre);
//actualizamos lista de carreras:
        $listado = $carreraModel->getCarreras();
        $_SESSION['listadoC'] = serialize($listado);
        header('Location: ../view/crudCarrera.php');
        break;

    case "eliminar":
        $cod_carrera = $_REQUEST['cod_carrera'];
        $carreraModel->eliminarCarrera($cod_carrera);
        //obtenemos la lista de facturas:
        $listado = $carreraModel->getCarreras();
//y los guardamos en sesion:
        $_SESSION['listadoC'] = serialize($listado);
//redireccionamos a la pagina main para visualizar:
        header('Location: ../view/crudCarrera.php');
        break;

    case "actualizar":
        //obtenemos los parametros del formulario:
        $cod_carrera = $_REQUEST['cod_carrera'];
        //Buscamos los datos
        $carrera = $carreraModel->getCarrera($cod_carrera);
        //guardamos en sesion para edicion posterior:
        $_SESSION['carrera'] = serialize($carrera);
        //redirigimos la navegación al formulario de edicion:
        header('Location: ../view/actualizarCarrera.php');
        break;

    case "actualizacion":
        //obtenemos los parametros del formulario:
        $cod_carrera = $_REQUEST['cod_carrera'];
        $nombre = $_REQUEST['nombre'];
        $carreraModel->actualizarCarrera($cod_carrera, $nombre);
        //actualizamos lista de facturas:
        $listado = $carreraModel->getCarreras();
        $_SESSION['listadoC'] = serialize($listado);
        header('Location: ../view/crudCarrera.php');
        break;

    default:
//si no existe la opcion recibida por el controlador, siempre redirigimos la navegacion a la pagina main:
        header('Location: ../main.php');
}