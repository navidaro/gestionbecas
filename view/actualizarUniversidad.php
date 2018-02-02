<!DOCTYPE html>
<?php
session_start();
include_once '../model/provinciaModel.php';
include_once '../model/Provincia.php';
include_once '../model/Universidad.php';
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
                smoke.signal("EL POSTULANTE HA SIDO GUARDADO", function (e) {
                }, {
                    duration: 3000,
                    classname: "custom-class"
                });
            }
        </script>
        <script src="js/jquery-2.1.4.js"></script>
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
                <h3>EDITAR UNIVERSIDAD</h3>
            </div>
            <div class="row">
                <?php
                $universidad = unserialize($_SESSION['universidad']);
                ?>
                <form action="../controller/controllerUniversidad.php">
                    <input type="hidden" name="opcion" value="actualizacion">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <td>CODIGO DE LA UNIVERSIDAD</td>
                            <td>
                                <?php echo $universidad->getCod_universidad(); ?>
                                <input type="hidden" name="cod_universidad" value="<?php echo $universidad->getCod_universidad(); ?>" />
                            </td>
                        </tr>
                        <tr>
                            <td>NOMBRE</td>
                            <td>
                                <input type="text" name="nombre" pattern="[a-zA-Z- ]*" value="<?php echo $universidad->getNombre(); ?>" />
                            </td>
                        </tr>
                        <tr>
                            <td>PROVINCIA</td>
                            <td>
                                <select name="cod_provincia" style="width: auto">
                                    <?php
                                    $provinciaModel = new provinciaModel();
                                    $listado = $provinciaModel->getProvincias();
                                    foreach ($listado as $prov) {
                                        if ($prov->getCod_provincia() == $universidad->getCod_provincia())
                                            echo "<option selected=true value='" . $prov->getCod_provincia() . "'>" . $prov->getNombre() . "</option>";
                                        else
                                            echo "<option value='" . $prov->getCod_provincia() . "'>" . $prov->getNombre() . "</option>";
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>TELEFONO</td>
                            <td>
                                <input class="label-success" value="<?php echo $universidad->getTelefono(); ?>" type="text" name="telefono" pattern="[0-9]*" maxlength="10" size="10" required="true"> - (NNNNNNNNN)
                            </td>
                        <tr>
                        <tr>
                            <td>CATEGORIA</td>
                            <td>
                                <select name="categoria" class="text-info">
                                    <option value='PRIVADA'>PRIVADA</option>
                                    <option value='FISCAL'>FISCAL</option>
                                    <option value='FISCOMISIONAL'>FISCOMISIONAL</option>
                                </select>
                            </td>
                        <tr>
                            <td colspan="2"><input class='btn btn-info' type="submit" value="ACTUALIZAR UNIVERSIDAD"></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </body>
</html>
