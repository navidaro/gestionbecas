<!DOCTYPE html>
<?php
session_start();
include_once '../model/universidadModel.php';
include_once '../model/Universidad.php';
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
        <meta httpequiv="refresh" content="0; url=view/main.php" />
        <script src="../smoke.js-master/smoke.js"></script>
        <script src="../smoke.js-master/smoke.min.js"></script>
        <script src="../smoke.js-master/bower.json"></script>
        <link   href="../smoke.js-master/smoke.css" rel="stylesheet">
        <script src="../js/jquery-2.1.4.js"></script>
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
                smoke.signal("EL POSTULANTE HA SIDO GUARDADO", function (e) {
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
                    <br>
                    <h4>Editar Beca</h4>
                    <div class="divider"></div>
                </div>
                <div class="row">
                    <?php
                    $beca = unserialize($_SESSION['beca']);
                    ?>
                    <form action="../controller/controllerBeca.php">
                        <input type="hidden" name="opcion" value="actualizacion">
                        <div class="row">
                            <div class="input-field col s3">
                                Codigo de Beca
                                <br><br>
                                <?php echo $beca->getCod_beca(); ?>
                            </div>
                            <input type="hidden" name="cod_beca" value="<?php echo $beca->getCod_beca(); ?>" />
                            <div class="input-field col s3">
                                Nombre
                                <input id="nombre" type="text" name="nombre" class="validate" value="<?php echo $beca->getNombre(); ?>"  pattern="[a-zA-Z- ]*" required>
                            </div>
                            <div class="input-field col s3">
                                Universidad
                                <select name="cod_universidad">
                                    <?php
                                    $universidadModel = new universidadModel();
                                    $listado = $universidadModel->getUniversidades();
                                    foreach ($listado as $uni) {
                                        if ($beca->getCod_universidad() == $uni->getCod_universidad())
                                            echo "<option selected=true value='" . $uni->getCod_universidad() . "'>" . $uni->getNombre() . "</option>";
                                        else
                                            echo "<option value='" . $uni->getCod_universidad() . "'>" . $uni->getNombre() . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="input-field col s3">
                                Monto
                                <input id="cuenta" type="text" name="monto" class="validate"  value="<?php echo $beca->getMonto(); ?>" maxlength="10" size="10" pattern="[0-9]*" required="true">
                            </div>
                        </div>
                        <button class="waves-effect waves-light btn red lighten-2" type="submit" name="action">Actualizar
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <!--JavaScript at end of body for optimized loading-->
        <script type="text/javascript" src="../js/materialize.min.js"></script>
    </body>
</html>
