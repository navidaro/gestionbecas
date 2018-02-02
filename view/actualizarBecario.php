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
        <meta httpequiv="refresh" content="0; url=view/index.php" />
        <link   href="../css/bootstrap.min.css" rel="stylesheet">
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
    <body background='../img/fondo.jpg'>
        <ul class="nav nav-pills">
            <li class="active"><a href="../controller/controllerPostulante.php?opcion=listarP">INICIO</a></li>
            <li><a href="../controller/controllerPostulante.php?opcion=listarPostulantes">LISTA POSTULANTES</a></li>
            <li><a href="../controller/controllerbecario.php?opcion=listarB">LISTA BECARIOS</a></li>
            <li><a href="../controller/controllerBeca.php?opcion=listarResumen">RESUMEN BECAS</a></li>
            <li><a href="../controller/controllerUniversidad.php?opcion=listarU">CRUD UNIVERSIDADES</a></li>
            <li><a href="../controller/controllerBeca.php?opcion=listarBeca">CRUD BECAS</a></li>
            <li><a href="../controller/controllerProvincia.php?opcion=listarProv">CRUD PROVICNCIAS</a></li>
            <li><a href="../controller/controllerCarrera.php?opcion=listarC">CRUD CARRERAS</a></li>
        </ul>
        <div class="container-fluid">
            <?php
            $becario = unserialize($_SESSION['becario']);
            ?>
            <form action="../controller/controllerBecario.php" method=post name="P">
                <input type="hidden" name="opcion" value="actualizacion">
                <table class="table table-striped table-bordered">
                    <tr>
                        <td colspan="2">
                            <h3>EDITAR BECARIO</h3>
                        </td>
                    </tr>
                    <tr>
                        <td>CEDULA</td>
                        <td>
                            <?php echo $becario->getCedula(); ?>
                            <input type="hidden" name="cedula" value="<?php echo $becario->getCedula(); ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td>FECHA DE INICIO</td>
                        <td>
                            <input id="fecha_ini" class="label-success" type="date" name="fecha_ini" value="<?php echo $becario->getFecha_ini(); ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td>FECHA FIN</td>
                        <td>
                            <input id="fecha_fin" class="label-success" value="<?php echo $becario->getFecha_fin(); ?>" type="date" name="fecha_fin" required="true">
                        </td>
                    </tr>
                    <tr>
                        <td>CARRERA</td>
                        <td>
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
                        </td>
                    </tr>
                    <tr>
                        <td>CUENTA</td>
                        <td>
                            <input value="<?php echo $becario->getCuenta(); ?>" type="text" maxlength="10" size="10" name="cuenta" required="true"> - (NNNNNNNNN)
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><input  class='btn btn-info' type="submit" value="ACTUALIZAR BECARIO"></td>
                    </tr>
                </table>
            </form>
        </div>
    </body>
</html>
