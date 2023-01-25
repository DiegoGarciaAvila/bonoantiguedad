<?php
include_once('./configuracion_sistema/configuracion.php');
include_once('./librerias/PDOConsultas.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RegistroGEM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <?php include_once 'cabecera_sistema/cabecera_login.php'
    ?>
</head>
<style>
    .darken {
        background: rgba(0, 0, 0, 0.7);
        display: block;
        position: fixed;
        top: 0px;
        left: 0px;
        z-index: 80;
        height: 100%;
        width: 100%;

    }

    .divform {
        background: rgba(254, 254, 254, 1);
        width: 70%;
        color: rgba(255, 255, 255, 1);
        font-family: Arial, Helvetica, sans-serif;
        font-size: 18px;
        text-align: center;
        padding: 33px;
        min-height: 250px;
        border-radius: 22px;
        position: absolute;
        left: 15%;
        top: 10%;
        box-shadow:
            inset 0 -3em 3em rgba(0, 0, 0, 0.0),
            0 0 0 2px rgb(254, 254, 254),
            0.3em 0.3em 1em rgba(0, 0, 0, 0.3);
    }
</style>

<body class="vertical-layout vertical-menu-modern blank-page navbar-floating footer-static " data-open="click" data-menu="vertical-menu-modern" data-col="blank-page">
    <div class="app-content content ">
        <div class="content-wrapper">
            <div class="content-body ">
                <div id="divform" class="divform">
                    <h1 class="card-title fw-bold mb-1" style="text-align:center;"><b><a href="login.php"><?= $NOMBRE_CABECERA ?></a></b></h1>
                    <div class="content-header row">&nbsp;</div>
                    <div class="content-header row">&nbsp;</div>
                    <div class="content-header row"><img src="./imagenes_sistema/linea.png" width="15%"></div>
                    <div class="content-header row">&nbsp;</div>
                    <div class="content-header row">&nbsp;</div>
                    <div class="content-header row">&nbsp;</div>
                    <h5 class="card-title fw-bold mb-1" style="text-align:center;"><b><?= $NOMBRE_SUBCABECERA ?></b></h5>
                    <form method="POST" id="fomrgem">
                        <div class="form-group ">
                            <label for="claveservidorpublico">CLAVE SERVIDOR PUBLICO</label>
                            <input  required type="number" class="form-control" id="claveservidorpublico" name="claveservidorpublico" aria-describedby="claveservidorpublico" placeholder="Clave servidor publico">
                            <small id="claveservidorpublicoHelp" class="form-text text-muted">Clave de servidor</small>
                        </div>
                        <div class="form-group ">
                            <label for="nombreservidor">NOMBRE</label>
                            <input required type="text" class="form-control" id="nombreservidor" name="nombreservidor" aria-describedby="nombreservidor" placeholder="Nombre">
                            <small id="nombreservidorHelp" class="form-text text-muted">Nombre</small>
                        </div>
                        <div class="form-group ">
                            <label for="telcd">TELEFONO DE DOMICILIO</label>
                            <input required type="number" class="form-control" id="telcd" name="telcd" aria-describedby="telcd" placeholder="Telefono de domicilio">
                            <small id="telcdHelp" class="form-text text-muted">Telefono de domicilio</small>
                        </div>
                        <div class="form-group ">
                            <label for="correo">CORREO</label>
                            <input required type="email" class="form-control" id="correo" name="correo" aria-describedby="correo" placeholder="Correo" pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}">
                            <small id="correoHelp" class="form-text text-muted">Correo</small>
                        </div>
                        <div class="form-group ">
                            <label for="password">CONTRASEÑA</label>
                            <div class="input-group">
                                <input required type="password" class="form-control" id="password" name="password" placeholder="Contraseña">
                                <div class="input-group-append">
                                    <button id="show_password2" class="btn btn-primary" type="button" onclick="mostrarPassword2()"> <span class="fa fa-eye-slash icon"></span> </button>
                                </div>
                            </div>

                        </div>
                        <div class="form-group ">


                            <label for="passwordconfirmar">CONTRASEÑA CONFIRMAR</label>
                            <div class="input-group">
                                <input required type="password" class="form-control" id="passwordconfirmar" name="passwordconfirmar" placeholder="Contraseña">
                                <div class="input-group-append">
                                    <button id="show_password2" class="btn btn-primary" type="button" onclick="mostrarPassword()"> <span class="fa fa-eye-slash icon"></span> </button>
                                </div>
                            </div>

                        </div>

                        </br>
                        <button type="submit" class="btn btn-primary" name="botonregistroaux">Registrarse</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php

    if ($_POST != null) {
        $claveservidorpublico = $_POST["claveservidorpublico"];
        $nombreservidor = $_POST["nombreservidor"];
        $telcd = $_POST["telcd"];
        $correo = $_POST["correo"];
        $password = $_POST["password"];
        $passwordconfirmar = $_POST["passwordconfirmar"];
        $hoy = getdate();
        $fecha = $hoy['year'] . '-' . $hoy['mon'] . '-' . $hoy['mday'];


        if ($password == $passwordconfirmar) {

            $passwordcod = base64_encode($password);


            $consulta = new PDOConsultas();
            $consulta->connect($CFG_HOST[0], $CFG_USER[0], $CFG_DBPWD[0], $CFG_DBASE[0], $CFG_TIPO[0]);
            $select = $consulta->executeQuery("INSERT INTO sb_usuario (ClaveServidor, nom_usuario, telcd ,email,passwd,des_usuario,cve_estatus,cve_perfil,cve_usergroup,CveM,CveE,FecRegSis)
            VALUES ( 
                '$claveservidorpublico ',
                '$nombreservidor' , 
                '$telcd' ,
                '$correo' ,
                '$passwordcod' ,
                'SERVIDOR PUBLICO' ,
                1 ,
                4,
                2 , 
                1,
                5 ,
                '$fecha'
                );");


            if ($consulta->lastInsertId != 'null') {
                if (isset($consulta->error)) {
                    $array_error = $consulta->error;
                    $error_cadena = substr($array_error[0], 1, 14);
                    if ($error_cadena == "QLSTATE[23000]") {

    ?>
                        <script>
                            Swal.fire(
                                "YA EXISTE EL REGISTRO"
                            )
                        </script>
                    <?php
                    } else {
                    ?>
                        <script>
                            error = <?= $consulta->error; ?>

                            Swal.fire(
                                error + ""
                            )
                        </script>
                    <?php
                    }
                } else {
                    ?>
                    <script>
                        Swal.fire({
                            title: 'CUENTA CREADA',
                            confirmButtonText: 'ACEPTAR',
                        }).then((result) => {
                            /* Read more about isConfirmed, isDenied below */
                            if (result.isConfirmed) {
                                window.location.href = "./login.php";

                            }
                        })
                    </script>
                <?php
                }
            } else {

                ?>
                <script>
                    error = <?= $consulta->error; ?>

                    Swal.fire(
                        error + ""
                    )
                </script>
            <?php
            }
        } else {
            ?>
            <script>
                Swal.fire(
                    "Las contraseñas son diferentes"
                )
            </script>
    <?php
        }
    }
    ?>
<script>
    var input=  document.getElementById('claveservidorpublico');
    input.addEventListener('input',function(){
        if (this.value.length > 9)
            this.value = this.value.slice(0,9);
    })


    var input=  document.getElementById('telcd');
    input.addEventListener('input',function(){
        if (this.value.length > 10)
            this.value = this.value.slice(0,10);
    })

</script>
    <script type="text/javascript">
        function mostrarPassword2(){
            var cambio = document.getElementById("password");
            if(cambio.type == "password"){
                cambio.type = "text";
                $('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
            }else{
                cambio.type = "password";
                $('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
            }
        }

        $(document).ready(function () {
            //CheckBox mostrar contraseña
            $('#ShowPassword2').click(function () {
                $('#Password').attr('type', $(this).is(':checked') ? 'text' : 'password');
            });
        });
    </script>
    <script type="text/javascript">
        function mostrarPassword(){
            var cambio = document.getElementById("passwordconfirmar");
            if(cambio.type == "password"){
                cambio.type = "text";
                $('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
            }else{
                cambio.type = "password";
                $('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
            }
        }

        $(document).ready(function () {
            //CheckBox mostrar contraseña
            $('#ShowPassword').click(function () {
                $('#Password').attr('type', $(this).is(':checked') ? 'text' : 'password');
            });
        });
    </script>
</body>

</html>