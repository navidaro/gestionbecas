<!DOCTYPE html>
<?php
session_start();
include_once '../model/becaModel.php';
include_once '../model/Postulante.php';
include_once '../model/Beca.php';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>GESTION BECAS</title>
        <meta charset="UTF-8">
        <meta httpequiv="refresh" content="0; url=view/main.php" />
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
        <link   href="../smoke.js-master/smoke.css" rel="stylesheet">
        <script src="../js/Validaciones.js"></script>
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
            <div class="row">
                <h4>Editar Postulante</h4>
                <div class="divider"></div>
                <br>
            </div>
            <div class="row">
                <?php
                $postulante = unserialize($_SESSION['postulante']);
                ?>
                <form action="../controller/controllerPostulante.php" method=post name="P">
                    <div class="row">
                        <input type="hidden" name="opcion" value="actualizacion">
                        <b>CEDULA</b>
                        <?php echo $postulante->getCedula(); ?>
                    </div>
                    <div class="row">
                        <input type="hidden" name="cedula" pattern="[0-9]*" maxlength="10" size="10" value="<?php echo $postulante->getCedula(); ?>" />
                        <div class="input-field col s6">
                            Beca de Postulacion
                            <?php
                            $becaModel = new becaModel();
                            ?>
                            <br><br>
                            <?php echo $becaModel->getBeca($postulante->getCod_beca())->getNombre(); ?>
                            <input type="hidden" name="cod_beca" value="<?php echo $postulante->getCod_beca() ?>" />
                        </div>
                        <div class="input-field col s6">
                            Nombres
                            <input class="label-success" value="<?php echo $postulante->getNombres(); ?>" type="text" pattern="[a-zA-Z- ]*" name="nombres" required="true">
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            Apellidos
                            <input value="<?php echo $postulante->getApellidos(); ?>" type="text" name="apellidos" pattern="[a-zA-Z- ]*" required="true">
                        </div>
                        <div class="input-field col s6">
                            Promedio
                            <input id="nota" value="<?php echo $postulante->getPromedio(); ?>" type="text" pattern="[0-9]*" name="promedio" required="true">
                        </div>
                    </div>
                    <button class="waves-effect waves-light btn red lighten-2" type="submit" name="action">Actualizar
                    </button>
                </form>
            </div>
        </div>
        <!--JavaScript at end of body for optimized loading-->
        <script type="text/javascript" src="../js/materialize.min.js"></script>
    </body>
</html>
