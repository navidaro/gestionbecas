<?php

require_once '../model/provinciaModel.php';
session_start();
$provinciaModel = new provinciaModel();
//recibimos la opcion desde la vista:
$opcion = $_REQUEST['opcion'];
unset($_SESSION['mensaje']);
switch ($opcion) {

    case "listarProv":
//obtenemos la lista de facturas:
        $listado = $provinciaModel->getProvincias();
//y los guardamos en sesion:
        $_SESSION['listadoProv'] = serialize($listado);
//redireccionamos a la pagina main para visualizar:
        header('Location: ../view/crudProvincia.php');
        break;

    case "insertarProv":
        //obtenemos los parametros del formulario:
        $nombre = $_REQUEST['nombre'];
        $provinciaModel->insertarProvincia($nombre);
//actualizamos lista de provincias:
        $listado = $provinciaModel->getProvincias();
        $_SESSION['listadoProv'] = serialize($listado);
        header('Location: ../view/crudProvincia.php');
        break;

    case "eliminar":
        $cod_provincia = $_REQUEST['cod_provincia'];
        $provinciaModel->eliminarProvincia($cod_provincia);
        //obtenemos la lista de facturas:
        $listado = $provinciaModel->getProvincias();
//y los guardamos en sesion:
        $_SESSION['listadoProv'] = serialize($listado);
//redireccionamos a la pagina main para visualizar:
        header('Location: ../view/crudProvincia.php');
        break;

    case "actualizar":
        //obtenemos los parametros del formulario:
        $cod_provincia = $_REQUEST['cod_provincia'];
        //Buscamos los datos
        $provincia = $provinciaModel->getProvincia($cod_provincia);
        //guardamos en sesion para edicion posterior:
        $_SESSION['provincia'] = serialize($provincia);
        //redirigimos la navegación al formulario de edicion:
        header('Location: ../view/actualizarProvincia.php');
        break;

    case "actualizacion":
        //obtenemos los parametros del formulario:
        $cod_provincia = $_REQUEST['cod_provincia'];
        $nombre = $_REQUEST['nombre'];
        $provinciaModel->actualizarProvincia($cod_provincia, $nombre);
        //actualizamos lista de facturas:
        $listado = $provinciaModel->getProvincias();
        $_SESSION['listadoProv'] = serialize($listado);
        header('Location: ../view/crudProvincia.php');
        break;

    default:
//si no existe la opcion recibida por el controlador, siempre redirigimos la navegacion a la pagina main:
        header('Location: ../main.php');
}