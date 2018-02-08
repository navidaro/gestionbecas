<!DOCTYPE html>
<?php
session_start();
include_once '../model/universidadModel.php';
include_once '../model/Beca.php';
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
        <script src="js/jquery-2.1.4.js"></script>
        <script language="JavaScript">
            function actualizacion() {
                smoke.signal("LA BECA HA SIDO ACTUALIZADA", function (e) {
                }, {
                    duration: 3000,
                    classname: "custom-class"
                });
            }
        </script>
        <script language="JavaScript">
            function confirmacion() {
                smoke.signal("LA BECA HA SIDO GUARDADA", function (e) {
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
        if (isset($_SESSION['confirmadoBeca'])) {
            echo " <script language='JavaScript'>confirmacion();</script>";
            unset($_SESSION['confirmadoBeca']);
        }
        if (isset($_SESSION['actualizadoBeca'])) {
            echo " <script language='JavaScript'>actualizacion();</script>";
            unset($_SESSION['actualizadoBeca']);
        }
        ?>
        <div class="container">
            <form action="../controller/controllerBeca.php">
                <input type="hidden" name="opcion" value="insertarBeca">
                <h4>Ingreso Beca</h4>
                <div class="divider"></div>
                <br>
                <br>
                <div class="row">
                    <div class="input-field col s4">
                        <input id="nombre" type="text" name="nombre" class="validate" required pattern="[a-zA-Z- ]*">
                        <label for="nombre">Nombre</label>
                    </div>
                    <div class="input-field col s4">
                        <input id="monto" type="text" name="monto" class="validate" size="3" maxlength="3" pattern="[0-9]*" required>
                        <label for="monto">Monto</label>
                    </div>
                    <div class="input-field col s4">
                        <select class="text-info" name="cod_universidad" style="width: auto">
                            <?php
                            $universidadModel = new universidadModel();
                            $listado = $universidadModel->getUniversidades();
                            foreach ($listado as $uni) {
                                echo "<option value='" . $uni->getCod_universidad() . "'>" . $uni->getNombre() . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12">
                        <button class="waves-effect waves-light btn red lighten-2" type="submit" name="action">Insertar
                        </button>
                    </div>
                </div>
            </form>
            <br>
            <div class="divider"></div>
            <br>
            <form action="../controller/controllerBeca.php">
                <input type="hidden" name="opcion" value="listarBeca">
                <div class="row">
                    <div class="col s12">
                        <button class="waves-effect waves-light btn red lighten-2" type="submit" name="action" value="">Consultar Listado
                        </button>
                    </div>
                </div>
            </form>
            <table data-toggle="table" data-pagination="true" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>CODIGO BECA</th>
                        <th>CODIGO DE UNIVERSIDAD</th>
                        <th>NOMBRE</th>
                        <th>MONTO</th>
                        <th align="center">ELIMINAR</th>
                        <th>ACTUALIZAR</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
//verificamos si existe en sesion el listado de becaes:
                    if (isset($_SESSION['listadoBeca'])) {
                        $listado = unserialize($_SESSION ['listadoBeca']);
                        foreach ($listado as $beca) {
                            echo "<tr>";
                            echo "<td>" . $beca->getCod_beca() . "</td>";
                            echo "<td>" . $beca->getCod_universidad() . "</td>";
                            echo "<td>" . $beca->getNombre() . "</td>";
                            echo "<td>" . $beca->getMonto() . "</td>";
                            echo "<td align='center'><a onclick='return confirmar()' href='../controller/controllerBeca.php?opcion=eliminar&cod_beca=" . $beca->getCod_beca() . "'><i class='material-icons'>delete</i></a></td>";
                            echo "<td align='center'><a href='../controller/controllerBeca.php?opcion=actualizar&cod_beca=" . $beca->getCod_beca() . "'><i class='material-icons'>edit</i></a></td>";
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
            ?>
        </div>
        <?php ?>
        <!--JavaScript at end of body for optimized loading-->
        <script type="text/javascript" src="../js/materialize.min.js"></script>
    </body>
</html>
