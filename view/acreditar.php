<!DOCTYPE html>
<?php
session_start();
include_once '../model/Beca.php';
include_once '../model/Becario.php';
include_once '../model/Postulante.php';
include_once '../model/carreraModel.php';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>ACREDITACION</title>
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
            function confirmacion() {
                smoke.signal("EL POSTULANTE HA SIDO GUARDADO", function (e) {
                }, {
                    duration: 3000,
                    classname: "custom-class"
                });
            }
        </script>
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
        ?>
        <div class="container">
            <form action="../controller/controllerBecario.php">
                <h4>Acreditar Postulante</h4>
                <div class="divider"></div>
                <?php
                $carreraModel = new carreraModel();
                $postulante = unserialize($_SESSION['postulante']);
                echo "<p>Se va a proceder a acreditar al postulante <b>" . $postulante->getNombres() .
                "</b> <b>" . $postulante->getApellidos() . "</b> con el numero de cedula <b>" .
                $postulante->getCedula() . "</b> para la beca de <b>" . $carreraModel->getBeca($postulante->getCod_beca())->getNombre();
                "</b><p>";
                ?>
                <br>
                <br>
                <br>
                <input type="hidden" name="cod_beca" value="<?php echo $postulante->getCod_beca(); ?>">
                <input type="hidden" name="cedula" value="<?php echo $postulante->getCedula(); ?>">
                <div class="row">
                    <div class="input-field col s6">
                        <input placeholder="Fecha de Inicio" type="text" class="datepicker" name="fecha_ini">
                    </div>

                    <div class="input-field col s6">
                        <input placeholder="Fecha de Finalizacion" type="text" class="datepicker" name="fecha_fin">
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <select class="text-info" name="cod_carrera" style="width: auto">
                            <?php
                            $listado = $carreraModel->getCarreras();
                            foreach ($listado as $carrera) {
                                echo "<option value='" . $carrera->getCod_carrera() . "'>" . $carrera->getNombre() . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="input-field col s6">
                        <input id="cuenta" type="text" name="cuenta" class="validate"  maxlength="10" size="10" required pattern="[0-9]*">
                        <label for="cuenta">Cuenta</label>
                    </div>
                </div>
                <div class="row">
                    <input type="hidden" name="opcion" value="insertarB">
                    <button class="waves-effect waves-light btn red lighten-2" type="submit" name="action">CONCERDER BECA
                    </button>
                </div>
            </form>
        </div>
        <!--JavaScript at end of body for optimized loading-->
        <script type="text/javascript" src="../js/materialize.min.js"></script>
    </body>
</html>
