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
        <meta httpequiv="refresh" content="0; url=view/index.php" />
        <link   href="../css/bootstrap.min.css" rel="stylesheet">
        <script src="../smoke.js-master/smoke.js"></script>
        <script src="../smoke.js-master/smoke.min.js"></script>
        <script src="../smoke.js-master/bower.json"></script>
        <link   href="../smoke.js-master/smoke.css" rel="stylesheet">
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
    <body background='../img/fondo.jpg'>
        <div class="container-fluid">
            <ul class="nav nav-pills">
                <li class="active"><a href="../controller/controllerPostulante.php?opcion=listarP">INICIO</a></li>
                <li><a href="../controller/controllerbecario.php?opcion=listarB">LISTA BECARIOS</a></li>
                <li><a href="../controller/controllerPostulante.php?opcion=listarPostulantes">LISTA POSTULANTES</a></li>
                <li><a href="../controller/controllerBeca.php?opcion=listarResumen">RESUMEN BECAS</a></li>
                <li><a href="../controller/controllerUniversidad.php?opcion=listarU">CRUD UNIVERSIDADES</a></li>
                <li><a href="../controller/controllerBeca.php?opcion=listarBeca">CRUD BECAS</a></li>
                <li><a href="../controller/controllerProvincia.php?opcion=listarProv">CRUD PROVICNCIAS</a></li>
                <li><a href="../controller/controllerCarrera.php?opcion=listarC">CRUD CARRERAS</a></li>
            </ul>
            <?php
            if (isset($_SESSION['mensaje'])) {
                echo "<div class='alert alert-danger'>" . $_SESSION['mensaje'] . "</div>";
            }
            ?>
            <form action="../controller/controllerBecario.php">
                <table class="table table-bordered table-hover">
                    <tr>
                        <td colspan="2">
                            <h3>ACREDITAR POSTULANTE</h3>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <?php
                            $carreraModel = new carreraModel();
                            $postulante = unserialize($_SESSION['postulante']);
                            echo "<h4 class='text-info text-center'>SE VA A PROCEDER A ACREDITAR LA BECA DEL POSTULANTE <b>" . $postulante->getNombres() .
                            "</b> <b>" . $postulante->getApellidos() . "</b> CON NUMERO DE CEDULA <b>" .
                            $postulante->getCedula() . "</b> PARA LA BECA DE <b>" . $carreraModel->getBeca($postulante->getCod_beca())->getNombre();
                            "</b></h4>";
                            ?>
                            <input type="hidden" name="cod_beca" value="<?php echo $postulante->getCod_beca(); ?>">
                            <input type="hidden" name="cedula" value="<?php echo $postulante->getCedula(); ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            FECHA DE INICIO
                        </td>
                        <td>
                            <input value="" type="date" name="fecha_ini" size="10" maxlength="10" required="true">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            FECHA  DE  FINALIZACION 
                        </td>
                        <td>
                            <input value="" type="date" name="fecha_fin" size="10" maxlength="10" required="true">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            CARRERA A ESTUDIAR
                        </td>
                        <td>
                            <select class="text-info" name="cod_carrera" style="width: auto">
                                <?php
                                $listado = $carreraModel->getCarreras();
                                foreach ($listado as $carrera) {
                                    echo "<option value='" . $carrera->getCod_carrera() . "'>" . $carrera->getNombre() . "</option>";
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>CUENTA</td>
                        <td><input type="text" name="cuenta" maxlength="10" size="10" required pattern="[0-9]*"> - (NNNNNNNNNN)</td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="opcion" value="insertarB">
                            <input class='btn btn-primary ' class='btn btn-ttc' type="submit" value="CONCEDER BECA" >
                        </td>
                    </tr>
                </table>
            </form>
            <table class="table table-striped table-bordered">
                <tr>
            </table>
        </div>
    </body>
</html>
