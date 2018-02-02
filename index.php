<!DOCTYPE html>
<?php
session_start();
include_once 'model/Provincia.php';
include_once 'model/Universidad.php';
include_once 'model/becaModel.php';
include_once 'model/Beca.php';
include_once 'model/Becario.php';
include_once 'model/Postulante.php';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>GESTION BECAS</title>
        <!--JavaScript at end of body for optimized loading-->
        <script type="text/javascript" src="js/materialize.min.js"></script>
        <!--Import Google Icon Font-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!--Import materialize.css-->
        <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <script src="js/jquery-2.1.4.js"></script>
        <script src="smoke.js-master/smoke.js"></script>
        <script src="smoke.js-master/smoke.min.js"></script>
        <script src="smoke.js-master/bower.json"></script>
        <link   href="smoke.js-master/smoke.css" rel="stylesheet">
        <script src="js/Validaciones.js"></script>
        <script language="JavaScript">
            function confirmacion() {
                smoke.signal("EL POSTULANTE HA SIDO GUARDADO", function (e) {
                }, {
                    duration: 3000,
                    classname: "custom-class"
                });
            }

        </script>
        <title>GESTION BECAS</title>
    </head>
    <body>
            <ul id="dropdown1" class="dropdown-content">
                <li><a href="controller/controllerUniversidad.php?opcion=listarU">CRUD Universidades</a></li>
                <li><a href="controller/controllerBeca.php?opcion=listarBeca">CRUD Becas</a></li>
                <li><a href="controller/controllerProvincia.php?opcion=listarProv">CRUD Provincias</a></li>
                <li><a href="controller/controllerCarrera.php?opcion=listarC">CRUD Carreras</a></li>
            </ul>
            <nav>
                <div class="nav-wrapper red lighten-2">
                    <a href="index.php" class="brand-logo"><img src="img/sello.png" width="150 px" height="50 px" ></a>
                    <ul class="right hide-on-med-and-down">
                        <li><a href="controller/controllerPostulante.php?opcion=listarP">Inicio</a></li>
                        <li><a href="controller/controllerPostulante.php?opcion=listarPostulantes">Lista de Postulantes</a></li>
                        <li><a href="controller/controllerbecario.php?opcion=listarB">Lista de Becarios</a></li>
                        <li><a href="controller/controllerBeca.php?opcion=listarResumen">Resumen de Becas</a></li>
                        <!-- Dropdown Trigger -->
                        <li><a class="dropdown-trigger" href="#!" data-target="dropdown1">Administracion de Variables<i class="material-icons right">arrow_drop_down</i></a></li>
                    </ul>
                </div>
            </nav>
            <div id="capa" style="display: none;padding: 10px; background-color: #FFE4C4">
                EL POSTULANTE HA SIDO GUARDADO CON EXITO
            </div>
            <?php
            if (isset($_SESSION['mensaje'])) {
                echo "<script type='text/javascript'>
                         M.toast({html: '" . $_SESSION['mensaje'] . "', classes: 'rounded', displayLength: '1000'});
                      </script>";
            }
            if (isset($_SESSION['confirmado'])) {
                echo " <script language='JavaScript'>confirmacion();</script>";
                unset($_SESSION['confirmado']);
            }
            ?>
            <div class="container">
                <div class="divider"></div>
                <form action="controller/controllerBeca.php" >
                    <table>
                        <td style="width: auto"><b>BECA A POSTULARSE</b></td>
                        <td>
                            <select name="cod_beca" style="width: auto">
                                <?php
                                $becaModel = new becaModel();
                                $listado = $becaModel->getBecas();
                                foreach ($listado as $beca) {
                                    echo "<option value='" . $beca->getCod_beca() . "'>" . $beca->getNombre() . "</option>";
                                }
                                ?>
                            </select>
                        </td>
                        <td></td><td></td>
                        <td>
                            <input type="hidden" name="opcion" value="agregarBeca">
                            <button class="btn-floating btn-large waves-effect waves-light red lighten-2" type="submit" name="action">
                                <i class="material-icons right">add</i>
                            </button>
                        </td>
                    </table>
                </form>
                <form action="controller/controllerPostulante.php" name="P">
                    <input type="hidden" name="opcion" value="insertarP">
                    <h5>INGRESO POSTULANTE</h5>
                    <div class="section"><h5></h5></div>
                    <div class="row">
                        <div class="col s3">
                            CEDULA <input id="cedula" type="text" name="cedula" size="10" maxlength="10" pattern="[0-9]{10}" required>
                        </div>
                        <div class="col s3"> 
                            NOMBRES <input type="text" name="nombres"  pattern="([A-Za-z]*[ ]*)*" required>
                        </div>
                        <div class="col s3">APELLIDOS <input type="text" name="apellidos" pattern="([A-Za-z]*[ ]*)*" required=""></div>
                        <div class="col s3">PROMEDIO <input id="nota" type="text" name="promedio"  required></div>
                    </div>
                    <button class="waves-effect waves-light btn red lighten-2" type="submit" name="action">Postular
                        <i class="material-icons right">add</i>
                    </button>  
                    <div class="section"><h5></h5></div>
                    <div class="divider"></div>
                    <div class="section"><h5></h5></div>
                </form>
            </div>
            <div class="container">
                <table class="highlight centered"> 
                    <thead>
                        <tr>
                            <th>CODIGO BECA</th>
                            <th>UNIVERSIDAD</th>
                            <th>NOMBRE</th>
                            <th>MONTO</th>
                            <th>MANTENIMIENTO</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
//verificamos si existe en sesion el listado de becaes:
                        if (isset($_SESSION['becas_postuladas'])) {
                            $listado = unserialize($_SESSION ['becas_postuladas']);
                            foreach ($listado as $beca) {
                                echo "<tr>";
                                echo "<td>" . $beca->getCod_beca() . "</td>";
                                echo "<td>" . $becaModel->getUniversidad($beca->getCod_universidad())->getNombre() . "</td>";
                                echo "<td>" . $beca->getNombre() . "</td>";
                                echo "<td>" . $beca->getMonto() . "</td>";
                                echo "<td align='center'><a href='controller/controllerBeca.php?opcion=eliminarPostulacion&cod_beca=" . $beca->getCod_beca() . "'><i class='material-icons'>delete</i></a></td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "No se han cargado datos.";
                        }
                        ?>
                        <?php
                        ?>
                    </tbody>
                </table>
            </div>
            <!--JavaScript at end of body for optimized loading-->
            <script type="text/javascript" src="js/materialize.min.js"></script>
    </body>
</html>
