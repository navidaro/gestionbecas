<?php

require_once '../model/postulanteModel.php';
session_start();
$postulanteModel = new postulanteModel();
//recibimos la opcion desde la vista:
$opcion = $_REQUEST['opcion'];
unset($_SESSION['mensaje']);
switch ($opcion) {

    case "insertarP":
        //obtenemos los parametros del formulario:
        $cedula = $_REQUEST['cedula'];
        $cod_beca = unserialize($_SESSION['becas_postuladas']);
        $nombres = $_REQUEST['nombres'];
        $apellidos = $_REQUEST['apellidos'];
        $promedio = $_REQUEST['promedio'];
        try {
            $postulanteModel->insertarP($cedula, $cod_beca, $nombres, $apellidos, $promedio);
        } catch (Exception $e) {
            $mensaje = $e->getMessage();
            $_SESSION['mensaje'] = $mensaje;
        }
        unset($_SESSION['becas_postuladas']);
//actualizamos lista de postulantes:
        $listado = $postulanteModel->getPostulantes();
        $_SESSION['listadoP'] = serialize($listado);
        header('Location: ../index.php');

        break;

    case "eliminar":
        $cedula = $_REQUEST['cedula'];
        $cod_beca = $_REQUEST['cod_beca'];
        $postulanteModel->eliminarProstulante($cedula, $cod_beca);
        //obtenemos la lista de facturas:
        $listado = $postulanteModel->getPostulantes();
//y los guardamos en sesion:
        $_SESSION['listadoP'] = serialize($listado);
//redireccionamos a la pagina index para visualizar:
        header('Location: ../view/lstaPostulantes.php');
        break;

    case "actualizar":
        //obtenemos los parametros del formulario:
        $cedula = $_REQUEST['cedula'];
        $cod_beca = $_REQUEST['cod_beca'];
        //Buscamos los datos
        $postulante = $postulanteModel->getPostulante1($cedula, $cod_beca);
        //guardamos en sesion para edicion posterior:
        $_SESSION['postulante'] = serialize($postulante);
        //redirigimos la navegación al formulario de edicion:
        header('Location: ../view/actualizarPostulante.php');
        break;

    case "actualizacion":
        //obtenemos los parametros del formulario:
        $cedula = $_REQUEST['cedula'];
        $cod_beca = $_REQUEST['cod_beca'];
        $nombres = $_REQUEST['nombres'];
        $apellidos = $_REQUEST['apellidos'];
        $promedio = $_REQUEST['promedio'];
        try {
            $postulanteModel->actualizarPostulante($cedula, $cod_beca, $nombres, $apellidos, $promedio);
        } catch (Exception $e) {
            $mensaje = $e->getMessage();
            $_SESSION['mensaje'] = $mensaje;
        }
        //actualizamos lista de facturas:
        $listado = $postulanteModel->getPostulantes();
        $_SESSION['listadoP'] = serialize($listado);
        header('Location: ../view/lstaPostulantes.php');
        break;

    case "listarP":
//obtenemos la lista de facturas:
        $listado = $postulanteModel->getPostulantes();
//y los guardamos en sesion:
        $_SESSION['listadoP'] = serialize($listado);
//redireccionamos a la pagina index para visualizar:
        header('Location: ../index.php');
        break;

    case "listarPostulantes":
//obtenemos la lista de facturas:
        $listado = $postulanteModel->getPostulantes();
//y los guardamos en sesion:
        $_SESSION['listadoP'] = serialize($listado);
//redireccionamos a la pagina index para visualizar:
        header('Location: ../view/lstaPostulantes.php');
        break;

    case "acreditar":
//obtenemos la lista de facturas:
        $cedula = $_REQUEST['cedula'];
        $postulante = $postulanteModel->getPostulante($cedula);
//y los guardamos en sesion:
        $_SESSION['postulante'] = serialize($postulante);
//redireccionamos a la pagina index para visualizar:
        header('Location: ../view/acreditar.php');
        break;

    default:
//si no existe la opcion recibida por el controlador, siempre redirigimos la navegacion a la pagina index:
        header('Location: ../index.php');
}
