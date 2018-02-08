<!DOCTYPE html>
<?php
session_start();
include_once '../model/Universidad.php';
include_once '../model/provinciaModel.php';
include_once '../model/Provincia.php';
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
        <script src="../js/bootstrap.js"></script>
        <link href="../img/glyphicons-halflings-white.png" rel="stylesheet">
        <link href="../img/glyphicons-halflings.png" rel="stylesheet">
        <script src="../js/Validaciones.js"></script>
        <script src="js/jquery-2.1.4.js"></script>
        <script language="JavaScript">
            function actualizacion() {
                smoke.signal("LA UNIVERSIDAD HA SIDO ACTUALIZADA", function (e) {
                }, {
                    duration: 3000,
                    classname: "custom-class"
                });
            }
        </script>
        <script language="JavaScript">
            function confirmacion() {
                smoke.signal("LA UNIVERSIDAD HA SIDO GUARDADA", function (e) {
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
        if (isset($_SESSION['confirmadoUniversidad'])) {
            echo " <script language='JavaScript'>confirmacion();</script>";
            unset($_SESSION['confirmadoUniversidad']);
        }

        if (isset($_SESSION['actualizadoUniversidad'])) {
            echo " <script language='JavaScript'>actualizacion();</script>";
            unset($_SESSION['actualizadoUniversidad']);
        }
        ?>
        <div class="container">
            <form action="../controller/controllerUniversidad.php">
                <input type="hidden" name="opcion" value="insertarU">
                <div class="row">
                    <h4>Ingreso Universidad</h4>
                    <div class="divider"></div>
                    <br>
                    <div class="section"></div>
                    <div class="row">
                        <div class="input-field col s6">
                            <input id="nombre" type="text" name="nombre" class="validate">
                            <label for="nombre">Nombre</label>
                        </div>
                        <div class="input-field col s6">
                            <input id="telefono" type="text" name="telefono" class="validate" size="10" maxlength="10" pattern="[0-9]*" required>
                            <label for="telefono">Telefono</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <select name="categoria">
                                <option value='PRIVADA'>PRIVADA</option>
                                <option value='FISCAL'>FISCAL</option>
                                <option value='FISCOMISIONAL'>FISCOMISIONAL</option>
                            </select>
                        </div>
                        <div class="input-field col s6">
                            <select class="text-info" name="cod_provincia">
                                <?php
                                $provinciaModel = new provinciaModel();
                                $listado = $provinciaModel->getProvincias();
                                print_r($listado);
                                foreach ($listado as $provincia) {
                                    echo "<option value='" . $provincia->getCod_provincia() . "'>" . $provincia->getNombre() . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="section"></div>
                    <div class="col s12">
                        <button class="waves-effect waves-light btn red lighten-2" type="submit" name="action">Insertar
                        </button> 
                    </div>
                </div>
            </form>
            <div class="divider"></div>
            <br>
            <div class="row">
                <div class="col s12">
                    <form action="../controller/controllerUniversidad.php">
                        <input type="hidden" name="opcion" value="listarU">
                        <button class="waves-effect waves-light btn red lighten-2" type="submit" name="action">Consultar Listado
                        </button>
                    </form>
                </div>
            </div>
            <table data-toggle="table" data-pagination="true" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>CODIGO UNIVERSIDAD</th>
                        <th>CODIGO DE PROVINCIA</th>
                        <th>NOMBRE</th>
                        <th>TELEFONO</th>
                        <th>CATEGORIA</th>
                        <th>ELIMINAR</th>
                        <th>ACTUALIZAR</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
//verificamos si existe en sesion el listado de universidades:
                    if (isset($_SESSION['listadoU'])) {
                        $listado = unserialize($_SESSION ['listadoU']);
                        foreach ($listado as $universidad) {
                            echo "<tr>";
                            echo "<td>" . $universidad->getCod_universidad() . "</td>";
                            echo "<td>" . $universidad->getCod_provincia() . "</td>";
                            echo "<td>" . $universidad->getNombre() . "</td>";
                            echo "<td>" . $universidad->getTelefono() . "</td>";
                            echo "<td>" . $universidad->getCategoria() . "</td>";
                            echo "<td align='center'><a onclick='return confirmar()' href='../controller/controllerUniversidad.php?opcion=eliminar&cod_universidad=" . $universidad->getCod_universidad() . "'><i class='material-icons center-align'>delete</i></a></td>";
                            echo "<td align='center'><a href='../controller/controllerUniversidad.php?opcion=actualizar&cod_universidad=" . $universidad->getCod_universidad() . "'><i class='material-icons center-align'>update</i></a></td>";
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
