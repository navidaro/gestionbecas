<?php

require_once '../model/loginModel.php';
session_start();
$loginModel = new loginModel();
//recibimos la opcion desde la vista:
$opcion = $_REQUEST['opcion'];
unset($_SESSION['mensaje']);

switch ($opcion) {
    case "Ingreso":
        $user = $_REQUEST['user'];
        $pass = $_REQUEST['pass'];
        $res = $loginModel->ingresar($user, $pass);
        if ($res) {
            header('Location: ../main.php');
        } else {
            header('Location: ../index.php');
        }
        break;
    default :
}

    