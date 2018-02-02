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
        <meta httpequiv="refresh" content="0; url=view/index.php" />
        <link   href="../css/bootstrap.min.css" rel="stylesheet">
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
    <body background='../img/fondo.jpg'>
        <div class="container-fluid">
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
            <div class="row">
                <h3>EDITAR POSTULANTE</h3>
            </div>
            <div class="row">
                <?php
                $postulante = unserialize($_SESSION['postulante']);
                ?>
                <form action="../controller/controllerPostulante.php" method=post name="P">
                    <input type="hidden" name="opcion" value="actualizacion">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <td>CEDULA</td>
                            <td>
                                <?php echo $postulante->getCedula(); ?>
                                <input type="hidden" name="cedula" pattern="[0-9]*" maxlength="10" size="10" value="<?php echo $postulante->getCedula(); ?>" />
                            </td>
                        </tr>
                        <tr>
                            <td>BECA DE POSTULACION</td>
                            <td>
                                <?php
                                $becaModel = new becaModel();
                                ?>
                                <?php echo $becaModel->getBeca($postulante->getCod_beca())->getNombre(); ?>
                                <input type="hidden" name="cod_beca" value="<?php echo $postulante->getCod_beca() ?>" />
                            </td>
                        </tr>
                        <tr>
                            <td>NOMBRES</td>
                            <td>
                                <input class="label-success" value="<?php echo $postulante->getNombres(); ?>" type="text" pattern="[a-zA-Z- ]*" name="nombres" required="true">
                            </td>
                        </tr>
                        <tr>
                            <td>APELLIDOS</td>
                            <td>
                                <input value="<?php echo $postulante->getApellidos(); ?>" type="text" name="apellidos" pattern="[a-zA-Z- ]*" required="true">
                            </td>
                        </tr>
                        <tr>
                            <td>PROMEDIO</td>
                            <td>
                                <input id="nota" value="<?php echo $postulante->getPromedio(); ?>" type="text" pattern="[0-9]*" name="promedio" required="true">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2"><input  class='btn btn-info' type="submit" value="ACTUALIZAR POSTULANTE"></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </body>
</html>
