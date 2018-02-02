<!DOCTYPE html>
<?php
session_start();
include_once '../model/carreraModel.php';
include_once '../model/Carrera.php';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>GESTION BECAS</title>
        <!--Import Google Icon Font-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <script src="../js/jquery-2.1.4.js"></script>
        <script src="../smoke.js-master/smoke.js"></script>
        <script src="../smoke.js-master/smoke.min.js"></script>
        <script src="../smoke.js-master/bower.json"></script>
        <link href="../smoke.js-master/smoke.css" rel="stylesheet">
        <script src="../js/bootstrap-table.js"></script>
        <link href="../css/bootstrap.css" rel="stylesheet">
        <link href="../css/bootstrap-table.css" rel="stylesheet">
        <script src="../js/bootstrap.js"></script>
        <link href="../img/glyphicons-halflings-white.png" rel="stylesheet">
        <link href="../img/glyphicons-halflings.png" rel="stylesheet">
        <script src="../js/Validaciones.js"></script>
        <script src="js/jquery-2.1.4.js"></script>
        <script language="JavaScript">
            function actualizacion() {
                smoke.signal("LA CARRERA HA SIDO ACTUALIZADA", function (e) {
                }, {
                    duration: 3000,
                    classname: "custom-class"
                });
            }
        </script>
        <script language="JavaScript">
            function confirmacion() {
                smoke.signal("LA CARRERA HA SIDO GUARDADA", function (e) {
                }, {
                    duration: 3000,
                    classname: "custom-class"
                });
            }
        </script>
        <script language="JavaScript">
            function confirmar() {
                return confirm("ESTA SEGURO DE ELIMINAR EL REGISTRO");
            }
        </script>
        <title>GESTION BECAS</title>
    </head>
    <body background='../img/fondo.jpg'>
        <div class="container-fluid">
            <ul class="nav nav-pills">
                <li class="active"><a href="../controller/controllerPostulante.php?opcion=listarP">INICIO</a></li>
                <li><a href="../controller/controllerPostulante.php?opcion=listarPostulantes">LISTA POSTULANTES</a></li>
                <li><a href="../controller/controllerbecario.php?opcion=listarB">LISTA BECARIOS</a></li>
                <li><a href="../controller/controllerBeca.php?opcion=listarResumen">RESUMEN BECAS</a></li>
                <li><a href="../controller/controllerUniversidad.php?opcion=listarU">CRUD UNIVERSIDADES</a></li>
                <li><a href="../controller/controllerBeca.php?opcion=listarBeca">CRUD BECAS</a></li>
                <li><a href="../controller/controllerProvincia.php?opcion=listarProv">CRUD PROVICNCIAS</a></li>
                <li><a href="../controller/controllerCarrera.php?opcion=listarC">CRUD CARRERAS</a></li>
            </ul>
            <?php
            if (isset($_SESSION['mensaje'])) {
                echo "<div class='alert alert-danger'>" . $_SESSION['mensaje'] . "</div>";
            }
            if (isset($_SESSION['confirmadoCarrera'])) {
                echo " <script language='JavaScript'>confirmacion();</script>";
                unset($_SESSION['confirmadoCarrera']);
            }
            if (isset($_SESSION['actualizadoCarrera'])) {
                echo " <script language='JavaScript'>actualizacion();</script>";
                unset($_SESSION['actualizadoCarrera']);
            }
            ?>  
            <form action="../controller/controllerCarrera.php">
                <input type="hidden" name="opcion" value="insertarC">
                <table class="table table-bordered table-hover">
                    <tr>
                        <td colspan="2">
                            <h3>INGRESO CARRERA</h3>
                        </td>
                    </tr>
                    <tr>
                        <td>NOMBRE</td>
                        <td><input type="text" name="nombre"required pattern="[a-zA-Z- ]*"> - [a-zA-Z]*</td>
                    </tr>
                    <tr><td colspan="2"><input class='btn btn-primary' type="submit" value="INSERTAR NUEVA CARRERA"></td></tr>
                </table>
            </form>
            <table class="table table-striped table-bordered">
                <tr>
                    <td>
                        <form action="../controller/controllerCarrera.php">
                            <input type="hidden" name="opcion" value="listarC">
                            <input class='btn btn-primary ' class='btn btn-ttc' type="submit" value="CONSULTAR LISTADO">
                        </form>
                    </td>
                </tr>
            </table>
            <table data-toggle="table" data-pagination="true" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>CODIGO CARRERA</th>
                        <th>NOMBRE</th>
                        <th align="center">ELIMINAR</th>
                        <th>ACTUALIZAR</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
//verificamos si existe en sesion el listado de becaes:
                    if (isset($_SESSION['listadoC'])) {
                        $listado = unserialize($_SESSION ['listadoC']);
                        foreach ($listado as $carrera) {
                            echo "<tr>";
                            echo "<td>" . $carrera->getCod_carrera() . "</td>";
                            echo "<td>" . $carrera->getNombre() . "</td>";
                            echo "<td align='center'><a class='btn btn-info' onclick='return confirmar()' href='../controller/controllerCarrera.php?opcion=eliminar&cod_carrera=" . $carrera->getCod_carrera() . "'><i class='material-icons'>delete</i></a></td>";
                            echo "<td align='center'><a class='btn btn-info' href='../controller/controllerCarrera.php?opcion=actualizar&cod_carrera=" . $carrera->getCod_carrera() . "'><span class='glyphicon glyphicon-pencil'></span></a></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "No se han cargado datos.";
                    }
                    ?>
                </tbody>
            </table>
            <?php
            if (isset($_SESSION['mensaje'])) {
                echo "<br>MENSAJE DEL SISTEMA: <font color='red'>" . $_SESSION['mensaje'] . "</font><br>";
            }
            ?>.
        </div>
        <?php ?>
    </body>
</html>
