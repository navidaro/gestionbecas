<!DOCTYPE html>
<?php
session_start();
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
        <meta httpequiv="refresh" content="0; url=view/main.php" />
        <script src="../js/jquery-2.1.4.js"></script>
        <title></title>
    </head>
    <body>
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
        <div class="container">
            <table class="table table-striped table-bordered" data-toggle="table" data-pagination="true">
                <tr>
                    <td colspan="7">
                        <h4>Resumen por Becas</h4>
                    </td>
                </tr>
                <tr><h5></h5></tr>
                <tr></tr>
                <tr>
                    <th>NUMERO DE POSTULANTES</th>
                    <th>NOMBRE DE BECA</th>
                    <th>CODIGO DE BECA</th>
                    <th>PROMEDIO GENERAL POR BECA</th>
                </tr>
                <?php
//verificamos si existe en sesion el listado de becarios:
                $cont = 0;
                $total = 0;
                if (isset($_SESSION['listadoResumen'])) {
                    $listado = unserialize($_SESSION ['listadoResumen']);
                    foreach ($listado as $resumen) {
                        echo "<tr>";
                        echo "<td>" . $resumen->getCedula() . "</td>";
                        echo "<td>" . $resumen->getNombre() . "</td>";
                        echo "<td>" . $resumen->getCodigo() . "</td>";
                        echo "<td>" . $resumen->getPromedio() . "</td>";
                        $total += $resumen->getPromedio();
                        $cont++;
                        echo "</tr>";
                    }
                } else {
                    echo "No se han cargado datos.";
                }
                echo '<tr><td colspan="4"><h4><b>Promedio total: ' . round($total / $cont, 3) . '</b></h4></td></tr>';
                ?>

            </table>
            <?php
            if (isset($_SESSION['mensaje'])) {
                echo "<br>MENSAJE DEL SISTEMA: <font color='red'>" . $_SESSION['mensaje'] . "</font><br>";
            }
            ?>
        </div>
        <!--JavaScript at end of body for optimized loading-->
        <script type="text/javascript" src="../js/materialize.min.js"></script>
    </body>
</html>
