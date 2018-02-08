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
        <meta httpequiv="refresh" content="0; url=view/main.php" />
        <!--JavaScript at end of body for optimized loading-->
        <script type="text/javascript" src="../js/materialize.min.js"></script>
        <!--Import Google Icon Font-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!--Import materialize.css-->
        <link type="text/css" rel="stylesheet" href="../css/materialize.min.css"  media="screen,projection"/>
        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
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
        <script src="../js/jquery-2.1.4.js"></script>
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
                <br>
                <h4>Editar Universidad</h4>
                <div class="divider"></div>
                <br>
            </div>
            <div class="row">
                <?php
                $universidad = unserialize($_SESSION['universidad']);
                ?>
                <form action="../controller/controllerUniversidad.php">
                    <input type="hidden" name="opcion" value="actualizacion">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <td><b>Codigo de la Universidad</b></td>
                            <td>
                                <?php echo $universidad->getCod_universidad(); ?>
                                <input type="hidden" name="cod_universidad" value="<?php echo $universidad->getCod_universidad(); ?>" />
                            </td>
                        </tr>
                        <tr>
                            <td>Nombre</td>
                            <td>
                                <input type="text" name="nombre" pattern="[a-zA-Z- ]*" value="<?php echo $universidad->getNombre(); ?>" />
                            </td>
                        </tr>
                        <tr>
                            <td>Provincia</td>
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
                            <td>Telefono</td>
                            <td>
                                <input class="label-success" value="<?php echo $universidad->getTelefono(); ?>" type="text" name="telefono" pattern="[0-9]*" maxlength="10" size="10" required="true">
                            </td>
                        <tr>
                        <tr>
                            <td>Categoria</td>
                            <td>
                                <select name="categoria" class="text-info">
                                    <option value='PRIVADA'>PRIVADA</option>
                                    <option value='FISCAL'>FISCAL</option>
                                    <option value='FISCOMISIONAL'>FISCOMISIONAL</option>
                                </select>
                            </td>
                        <tr>
                            <td colspan="2"> <button class="waves-effect waves-light btn red lighten-2" type="submit" name="action">Actualizar
                                </button></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
        <!--JavaScript at end of body for optimized loading-->
        <script type="text/javascript" src="../js/materialize.min.js"></script>
    </body>
</html>
