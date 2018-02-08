<!DOCTYPE html>
<?php
session_start();
include_once '../model/Provincia.php';
include_once '../model/Universidad.php';
include_once '../model/becaModel.php';
include_once '../model/Beca.php';
include_once '../model/Becario.php';
include_once '../model/Postulante.php';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>GESTION BECAS</title>
        <!--JavaScript at end of body for optimized loading-->
        <script type="text/javascript" src="../js/materialize.min.js"></script>
        <!--Import Google Icon Font-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!--Import materialize.css-->
        <link type="text/css" rel="stylesheet" href="../css/materialize.min.css"  media="screen,projection"/>
        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <script src="../js/jquery-2.1.4.js"></script>
        <script src="../smoke.js-master/smoke.js"></script>
        <script src="../smoke.js-master/smoke.min.js"></script>
        <script src="../smoke.js-master/bower.json"></script>
        <link href="../smoke.js-master/smoke.css" rel="stylesheet">
        <link href="../img/glyphicons-halflings-white.png" rel="stylesheet">
        <link href="../img/glyphicons-halflings.png" rel="stylesheet">
        <script src="../js/Validaciones.js"></script>
        <script language="JavaScript">
            function actualizacion() {
                smoke.signal("EL POSTULANTE HA SIDO ACTUALIZADO", function (e) {
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
    <body>

        <div class="container-fluid">
            <ul id="dropdown1" class="dropdown-content">
                <li><a href="../controller/controllerUniversidad.php?opcion=listarU">CRUD Universidades</a></li>
                <li><a href="../controller/controllerBeca.php?opcion=listarBeca">CRUD Becas</a></li>
                <li><a href="../controller/controllerProvincia.php?opcion=listarProv">CRUD Provincias</a></li>
                <li><a href="../controller/controllerCarrera.php?opcion=listarC">CRUD Carreras</a></li>
            </ul>
            <nav>
                <div class="nav-wrapper red lighten-2">
                    <a href="../main.php" class="brand-logo"><img src="../img/sello.png" width="150 px" height="50 px" ></a>
                    <ul class="right hide-on-med-and-down">
                        <li><a href="../controller/controllerPostulante.php?opcion=listarP">Inicio</a></li>
                        <li><a href="../controller/controllerPostulante.php?opcion=listarPostulantes">Lista de Postulantes</a></li>
                        <li><a href="../controller/controllerBecario.php?opcion=listarB">Lista de Becarios</a></li>
                        <li><a href="../controller/controllerBeca.php?opcion=listarResumen">Resumen de Becas</a></li>
                        <!-- Dropdown Trigger -->
                        <li><a class="dropdown-trigger" href="#!" data-target="dropdown1">Administracion de Variables<i class="material-icons right">arrow_drop_down</i></a></li>
                    </ul>
                </div>
            </nav>
            <?php
            if (isset($_SESSION['mensaje'])) {
                echo "<div class='alert alert-danger'>" . $_SESSION['mensaje'] . "</div>";
            }
            if (isset($_SESSION['actualizadoPostulante'])) {
                echo " <script language='JavaScript'>actualizacion();</script>";
                unset($_SESSION['actualizadoPostulante']);
            }
            if (isset($_SESSION['confirmado'])) {
                echo " <script language='JavaScript'>confirmacion();</script>";
                unset($_SESSION['confirmado']);
            }
            ?>
            <div class="container">
                <div class="section"><h5></h5></div>
                <h4>Postulantes Inscirtos</h4>
                <div class="divider"></div>
                <div class="section"><h5></h5></div>
                <table data-toggle="table" data-pagination="true" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>CEDULA</th>
                            <th>BECA POSTULADA</th>
                            <th>NOMBRES</th>
                            <th>APELLIDOS</th>
                            <th>PROMEDIO</th>
                            <th>ACREDITAR</th>
                            <th  align="center">ELIMINAR</th>
                            <th  align="center">ACTUALIZAR</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
//verificamos si existe en sesion el listado de postulantes:
                        $becaModel = new becaModel();
                        if (isset($_SESSION['listadoP'])) {
                            $listado = unserialize($_SESSION ['listadoP']);
                            foreach ($listado as $postulante) {
                                echo "<tr>";
                                echo "<td>" . $postulante->getCedula() . "</td>";
                                echo "<td align='center'>" . $becaModel->getBeca($postulante->getCod_beca())->getNombre() . "</td>";
                                echo "<td>" . $postulante->getNombres() . "</td>";
                                echo "<td>" . $postulante->getApellidos() . "</td>";
                                echo "<td>" . $postulante->getPromedio() . "</td>";
                                echo "<td align='center'><a  href='../controller/controllerPostulante.php?opcion=acreditar&cedula=" . $postulante->getCedula() . "'><i class='material-icons'>done</i></a></td>";
                                echo "<td align='center'><a onclick='return confirmar()' href='../controller/controllerPostulante.php?opcion=eliminar&cedula=" . $postulante->getCedula() . "&cod_beca=" . $postulante->getCod_beca() . "'><i class='material-icons'>delete</i></a></td>";
                                echo "<td align='center'><a  href='../controller/controllerPostulante.php?opcion=actualizar&cedula=" . $postulante->getCedula() . "&cod_beca=" . $postulante->getCod_beca() . "'><i class='material-icons'>update</i></a></td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "No se han cargado datos.";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!--JavaScript at end of body for optimized loading-->
        <script type="text/javascript" src="../js/materialize.min.js"></script>
    </body>
</html>
