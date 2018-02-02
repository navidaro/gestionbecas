<?php

require_once '../model/universidadModel.php';
session_start();
$universidadModel = new universidadModel();
//recibimos la opcion desde la vista:
$opcion = $_REQUEST['opcion'];
unset($_SESSION['mensaje']);
switch ($opcion) {

    case "listarU":
//obtenemos la lista de facturas:
        $listado = $universidadModel->getUniversidades();
//y los guardamos en sesion:
        $_SESSION['listadoU'] = serialize($listado);
//redireccionamos a la pagina index para visualizar:
        header('Location: ../view/crudUniversidades.php');
        break;

    case "insertarU":
        //obtenemos los parametros del formulario:
        $cod_provincia = $_REQUEST['cod_provincia'];
        $nombre = $_REQUEST['nombre'];
        $telefono = $_REQUEST['telefono'];
        $categoria = $_REQUEST['categoria'];
        $universidadModel->insertarUniversidad($cod_provincia, $nombre, $telefono, $categoria);
//actualizamos lista de universidads:
        $listado = $universidadModel->getUniversidades();
        $_SESSION['listadoU'] = serialize($listado);
        header('Location: ../view/crudUniversidades.php');
        break;

    case "eliminar":
        $cod_universidad = $_REQUEST['cod_universidad'];
        $universidadModel->eliminarUniversidad($cod_universidad);
        //obtenemos la lista de facturas:
        $listado = $universidadModel->getUniversidades();
//y los guardamos en sesion:
        $_SESSION['listadoU'] = serialize($listado);
//redireccionamos a la pagina index para visualizar:
        header('Location: ../view/crudUniversidades.php');
        break;

    case "actualizar":
        //obtenemos los parametros del formulario:
        $cod_universidad = $_REQUEST['cod_universidad'];
        //Buscamos los datos
        $universidad = $universidadModel->getUniversidad($cod_universidad);
        //guardamos en sesion para edicion posterior:
        $_SESSION['universidad'] = serialize($universidad);
        //redirigimos la navegación al formulario de edicion:
        header('Location: ../view/actualizarUniversidad.php');
        break;

    case "actualizacion":
        //obtenemos los parametros del formulario:
        $cod_universidad = $_REQUEST['cod_universidad'];
        $cod_provincia = $_REQUEST['cod_provincia'];
        $nombre = $_REQUEST['nombre'];
        $telefono = $_REQUEST['telefono'];
        $categoria = $_REQUEST['categoria'];
        $universidadModel->actualizarUniversidad($cod_universidad, $cod_provincia, $nombre, $telefono, $categoria);
        //actualizamos lista de facturas:
        $listado = $universidadModel->getUniversidades();
        $_SESSION['listadoU'] = serialize($listado);
        header('Location: ../view/crudUniversidades.php');
        break;


    default:
//si no existe la opcion recibida por el controlador, siempre redirigimos la navegacion a la pagina index:
        header('Location: ../index.php');
}
