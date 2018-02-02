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
        <meta httpequiv="refresh" content="0; url=view/index.php" />
        <link   href="../css/bootstrap.min.css" rel="stylesheet">
        <script src="../smoke.js-master/smoke.js"></script>
        <script src="../smoke.js-master/smoke.min.js"></script>
        <script src="../smoke.js-master/bower.json"></script>
        <link   href="../smoke.js-master/smoke.css" rel="stylesheet">
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
                <h3>EDITAR BECA</h3>
            </div>
            <div class="row">
                <?php
                $beca = unserialize($_SESSION['beca']);
                ?>
                <form action="../controller/controllerBeca.php">
                    <input type="hidden" name="opcion" value="actualizacion">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <td>CODIGO DE BECA</td>
                            <td>
                                <?php echo $beca->getCod_beca(); ?>
                                <input type="hidden" name="cod_beca" value="<?php echo $beca->getCod_beca(); ?>" />
                            </td>
                        </tr>
                        <tr>
                            <td>NOMBRE</td>
                            <td>
                                <input type="text" name="nombre" pattern="[a-zA-Z- ]*" value="<?php echo $beca->getNombre(); ?>" />
                            </td>
                        </tr>
                        <tr>
                            <td>UNIVERSIDAD</td>
                            <td>
                                <select name="cod_universidad" style="width: auto">
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
                            </td>
                        </tr>
                        <tr>
                            <td>MONTO</td>
                            <td>
                                <input class="label-success" value="<?php echo $beca->getMonto(); ?>" type="text" name="monto" maxlength="10" size="10" pattern="[0-9]*" required="true"> - (999)
                            </td>
                        <tr>
                            <td colspan="2"><input class='btn btn-info' type="submit" value="ACTUALIZAR BECA"></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </body>
</html>
