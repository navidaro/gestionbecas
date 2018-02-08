<!DOCTYPE html>
<?php
session_start();
include_once '../model/becaModel.php';
include_once '../model/Beca.php';
include_once '../model/Becario.php';
include_once '../model/Carrera.php';
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
        <script src="../smoke.js-master/smoke.js"></script>
        <script src="../smoke.js-master/smoke.min.js"></script>
        <script src="../smoke.js-master/bower.json"></script>
        <link   href="../smoke.js-master/smoke.css" rel="stylesheet">
        <script src="../js/jquery-2.1.4.js"></script>
        <link href="../img/glyphicons-halflings-white.png" rel="stylesheet">
        <link href="../img/glyphicons-halflings.png" rel="stylesheet">
        <script language="JavaScript">
            function actualizacion() {
                smoke.signal("EL BECARIO HA SIDO ACTUALIZADO", function (e) {
                }, {
                    duration: 3000,
                    classname: "custom-class"
                });
            }
        </script>
        <script language="JavaScript">
            function confirmar() {
                return confirm("ESTA SEGURO DE DESACREDITAR EL BECARIO");
            }
        </script>
        <script language="JavaScript">
            function confirmacion() {
                smoke.signal("EL POSTULANTE HA SIDO ACREDITADO", function (e) {
                }, {
                    duration: 3000,
                    classname: "custom-class"
                });
            }
        </script>
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
                    <a href="../index.php" class="brand-logo"><img src="../img/sello.png" width="150 px" height="50 px" ></a>
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
            if (isset($_SESSION['confirmadoBecario'])) {
                echo " <script language='JavaScript'>confirmacion();</script>";
                unset($_SESSION['confirmadoBecario']);
            }
            if (isset($_SESSION['actualizadoBecario'])) {
                echo " <script language='JavaScript'>actualizacion();</script>";
                unset($_SESSION['actualizadoBecario']);
            }
            ?>
            <div class="container">
                <div class="section"><h5></h5></div>
                <h4>Becarios Inscritos</h4>
                <div class="divider"></div>
                <div class="section"><h5></h5></div>
                <table data-toggle="table" data-pagination="true" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>CEDULA</th>
                            <th>BECA</th>
                            <th>FECHA DE INICIO</th>
                            <th>FECHA FIN</th>
                            <th>CARRERA</th>
                            <th>CUENTA</th>
                            <th>DESACREDITAR</th>
                            <th align="center">MANTENIMIENTO</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
//verificamos si existe en sesion el listado de becarios:
                        $becaModel = new becaModel();
                        if (isset($_SESSION['listadoB'])) {
                            $listado = unserialize($_SESSION ['listadoB']);
                            foreach ($listado as $becario) {
                                echo "<tr>";
                                echo "<td>" . $becario->getCedula() . "</td>";
                                echo "<td>" . $becaModel->getBeca($becario->getCod_beca())->getNombre() . "</td>";
                                echo "<td align='center'>" . $becario->getFecha_ini() . "</td>";
                                echo "<td>" . $becario->getFecha_fin() . "</td>";
                                echo "<td>" . $becaModel->getCarrera($becario->getCarrera())->getNombre() . "</td>";
                                echo "<td>" . $becario->getCuenta() . "</td>";
                                echo "<td align='center'><a onclick='return confirmar()' href='../controller/controllerBecario.php?opcion=desacreditar&cedula=" . $becario->getCedula() . "'><i class='material-icons'>clear</i></a></td>";
                                echo "<td align='center'><a href='../controller/controllerBecario.php?opcion=actualizar&cedula=" . $becario->getCedula() . "'><i class='material-icons'>build</i></a></td>";
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
