<!DOCTYPE html>
<?php
session_start();
include_once '../model/carreraModel.php';
include_once '../model/Becario.php';
include_once '../model/Beca.php';
?>
<html>
    <head>
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
            function actualizacion() {
                smoke.signal("EL BECARIO HA SIDO ACTUALIZADO", function (e) {
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
        <div class="container">
            <?php
            $becario = unserialize($_SESSION['becario']);
            ?>
            <form action="../controller/controllerBecario.php" method=post name="P">
                <input type="hidden" name="opcion" value="actualizacion">
                <br>            
                <h4>Editar Becario</h4>
                <div class="divider"></div>
                <div class="row">
                    <br>
                    <div class="col s12">
                        <b>Cedula</b>
                        <?php echo $becario->getCedula(); ?>
                        <input type="hidden" name="cedula" value="<?php echo $becario->getCedula(); ?>" />
                    </div>
                    <br><br>
                    <div class="row">
                        <div class="input-field col s6">
                            Fecha de Inicio    
                            <input placeholder="Fecha de Inicio" type="text" id="fecha_ini" class="datepicker" name="fecha_ini" value="<?php echo $becario->getFecha_ini(); ?>">
                        </div>
                        <div class="input-field col s6">
                            FECHA FIN
                            <input id="fecha_fin" class="label-success" value="<?php echo $becario->getFecha_fin(); ?>" type="date" name="fecha_fin" required="true">
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            CARRERA
                            <select class="text-info" name="cod_carrera" style="width: auto">
                                <?php
                                $carreraModel = new carreraModel();
                                $listado = $carreraModel->getCarreras();
                                foreach ($listado as $carrera) {
                                    if ($becario->getCarrera() == $carrera->getCod_carrera()) {
                                        echo "<option selected=true value='" . $carrera->getCod_carrera() . "'>" . $carrera->getNombre() . "</option>";
                                    } else {
                                        echo "<option value='" . $carrera->getCod_carrera() . "'>" . $carrera->getNombre() . "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="input-field col s6">
                            CUENTA
                            <input value="<?php echo $becario->getCuenta(); ?>" type="text" maxlength="10" size="10" name="cuenta" required="true">
                        </div>
                    </div>
                    <button class="waves-effect waves-light btn red lighten-2" type="submit" name="action">Actualizar
                    </button>
            </form>
        </div>
        <!--JavaScript at end of body for optimized loading-->
        <script type="text/javascript" src="../js/materialize.min.js"></script>
    </body>
</html>
