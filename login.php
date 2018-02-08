<html>
    <head>
        <!--Import Google Icon Font-->
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!--Import materialize.css-->
        <link type="text/css" rel="stylesheet" href="css/materialize.min.css"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <style>
            body {
                display: flex;
                min-height: 100vh;
                flex-direction: column;
            }

            body {
                background: #fff;
            }

            .input-field input[type=date]:focus + label,
            .input-field input[type=text]:focus + label,
            .input-field input[type=email]:focus + label,
            .input-field input[type=password]:focus + label {
                color: #e91e63;
            }

            .input-field input[type=date]:focus,
            .input-field input[type=text]:focus,
            .input-field input[type=email]:focus,
            .input-field input[type=password]:focus {
                border-bottom: 2px solid #e91e63;
                box-shadow: none;
            }
        </style>
    </head>
    <body>
        <div class="section"></div>
    <center>
        <img class="responsive-img" style="width: 250px;" src="http://eduvirtual.utn.edu.ec/images/sello_UTN_f.png" />
        <div class="section"></div>
        <div class="container">
            <div id="form" class="z-depth-1 grey lighten-4 row" style="width: 500px; display: inline-table; padding: 32px 48px 0px 48px; border: 1px solid #EEE;">
                <form class="col s12" action="controller/controllerLogin.php">
                    <div class='row'>
                        <div class='col s12'>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='input-field col s12'>
                            <input class='validate' type='text' name='user' id='email' />
                            <label class="left-align" for='email'>Usuario</label>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='input-field col s12'>
                            <input class='validate' type='password' name='pass' id='password' />
                            <label class="left-align" for='password'>Contrasena</label>
                        </div>
                    </div>
                    <br/>
                    <div class='row'>
                        <input type="hidden" name="opcion" value="Ingreso">
                        <button type='submit' name="action" class='col s12 btn btn-large waves-effect indigo' id="connect">Ingresar</button>
                    </div>
                </form>
            </div>
            <div class="row" id="snipper" style="width: 500px; display: inline-table;">
                <div class="progress col s12">
                    <div class="indeterminate red lighten-2"></div>
                </div>
            </div>
        </div>
    </center>
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#snipper').hide();
            $('#connect').click(function () {
                $('#snipper').show();
                $('#form').hide();
                $('#connect').hide();
            });
        });
    </script>
</body>
</html>