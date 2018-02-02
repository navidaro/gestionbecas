<?php

require_once '../model/becaModel.php';
session_start();
$becaModel = new becaModel();
//recibimos la opcion desde la vista:
$opcion = $_REQUEST['opcion'];
unset($_SESSION['mensaje']);
switch ($opcion) {

    case "listarBeca":
//obtenemos la lista de facturas:
        $listado = $becaModel->getBecas();
//y los guardamos en sesion:
        $_SESSION['listadoBeca'] = serialize($listado);
//redireccionamos a la pagina index para visualizar:
        header('Location: ../view/crudBecas.php');
        break;

    case "listarResumen":
//obtenemos la lista de facturas:
        $listado = $becaModel->Resumen();
//y los guardamos en sesion:
        $_SESSION['listadoResumen'] = serialize($listado);
//redireccionamos a la pagina index para visualizar:
        header('Location: ../view/resumenBecas.php');
        break;

    case "insertarBeca":
        //obtenemos los parametros del formulario:
        $cod_universidad = $_REQUEST['cod_universidad'];
        $nombre = $_REQUEST['nombre'];
        $monto = $_REQUEST['monto'];
        $becaModel->insertarBeca($cod_universidad, $nombre, $monto);
//actualizamos lista de becas:
        $listado = $becaModel->getBecas();
        $_SESSION['listadoBeca'] = serialize($listado);
        header('Location: ../view/crudBecas.php');
        break;

    case "eliminar":
        $cod_beca = $_REQUEST['cod_beca'];
        $becaModel->eliminarBeca($cod_beca);
        //obtenemos la lista de facturas:
        $listado = $becaModel->getBecas();
//y los guardamos en sesion:
        $_SESSION['listadoBeca'] = serialize($listado);
//redireccionamos a la pagina index para visualizar:
        header('Location: ../view/crudBecas.php');
        break;

    case "actualizar":
        //obtenemos los parametros del formulario:
        $cod_beca = $_REQUEST['cod_beca'];
        //Buscamos los datos
        $beca = $becaModel->getBeca($cod_beca);
        //guardamos en sesion para edicion posterior:
        $_SESSION['beca'] = serialize($beca);
        //redirigimos la navegación al formulario de edicion:
        header('Location: ../view/actualizarBeca.php');
        break;

    case "actualizacion":
        //obtenemos los parametros del formulario:
        $cod_beca = $_REQUEST['cod_beca'];
        $cod_universidad = $_REQUEST['cod_universidad'];
        $nombre = $_REQUEST['nombre'];
        $monto = $_REQUEST['monto'];
        $becaModel->actualizarBeca($cod_beca, $cod_universidad, $nombre, $monto);
        //actualizamos lista de facturas:
        $listado = $becaModel->getBecas();
        $_SESSION['listadoBeca'] = serialize($listado);
        header('Location: ../view/crudBecas.php');
        break;

    case "agregarBeca":
        $cod_beca = $_REQUEST['cod_beca'];
        try{
        $becaModel->agregarBeca($cod_beca);
        } catch (Exception $e) {
            $mensaje = $e->getMessage();
            $_SESSION['mensaje'] = $mensaje;
        }
        header('Location: ../index.php');
        break;

    case "eliminarPostulacion":
        $cod_beca = $_REQUEST['cod_beca'];
        $becaModel->eliminarPostulacion($cod_beca);
        header('Location: ../index.php');
        break;


    default:
//si no existe la opcion recibida por el controlador, siempre redirigimos la navegacion a la pagina index:
        header('Location: ../index.php');
}