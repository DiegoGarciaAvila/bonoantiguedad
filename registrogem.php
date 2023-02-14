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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>


    <?php include_once 'cabecera_sistema/cabecera_login.php';
    include_once 'librerias/PDOConsultas.php';
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
                        <div class="row">
                            <div class="form-group ">
                                <label for="claveservidorpublico">CLAVE SERVIDOR PÚBLICO</label>
                                <input  required type="number" class="form-control" id="claveservidorpublico" name="claveservidorpublico" aria-describedby="claveservidorpublico" placeholder="Clave servidor público" value="<?php  echo $_POST['claveservidorpublico'] ?>">
                                <small id="claveservidorpublicoHelp" class="form-text text-muted">Clave de Servidor Público</small>
                            </div>
                            <div class="form-group ">
                                <label for="nombreservidor">NOMBRE</label>
                                <input required type="text" class="form-control" id="nombreservidor" name="nombreservidor" aria-describedby="nombreservidor" placeholder="Nombre"  value="<?php  echo $_POST['nombreservidor'] ?>">
                                <small id="nombreservidorHelp" class="form-text text-muted">Nombre</small>
                            </div>
                            <div class="form-group ">
                                <label for="telcd">TELÉFONO</label>
                                <input required type="number" class="form-control" id="telcd" name="telcd" aria-describedby="telcd" placeholder="Telefono de domicilio" value="<?php  echo $_POST['telcd'] ?>">
                                <small id="telcdHelp" class="form-text text-muted">Teléfono</small>
                            </div>
                            <div class="form-group ">
                                <label for="correo">CORREO</label>
                                <input required type="email" class="form-control" id="correo" name="correo" aria-describedby="correo" placeholder="Correo" pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}"  value="<?php  echo $_POST['correo'] ?>">
                                <small id="correoHelp" class="form-text text-muted">Correo</small>
                            </div>
                            <div class="form-group ">
                                <label for="password">CONTRASEÑA</label>
                                <div class="input-group">
                                    <input required type="password" class="form-control" id="password" name="password" placeholder="Contraseña">
                                    <div class="input-group-append">
                                        <button id="show_password" class="btn btn-primary" type="button" onclick="mostrarPassword2()"> <span class="fa fa-eye-slash icon"></span> </button>
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
                        </div>

                        </br>
                        <button id="botonregistroaux" class="btn btn-primary" name="botonregistroaux">Registrarse</button>
                    </form>
                </div>
            </div>
        </div>
    </div>




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


<script>
        $(document).ready(function() {

            $("#botonregistroaux").click(function(e) {
                e.preventDefault();

                // Recoger el formulario
                const form = document.getElementById("fomrgem");

                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                    form.classList.add("was-validated");
                    Swal.fire({
                        title: "Atención!",
                        html: "Su solicitud no será enviada, hasta que se completen todos los campos obligatorios, por favor valide y vuelva a intentarlo. ",
                        type: "warning"
                    });
                } else {
                    guardaRegistro();
                }

            });

            function guardaRegistro() {
                const formData = new FormData();
                formData.append("claveservidorpublico", $('#claveservidorpublico').val());
                formData.append("nombreservidor", $('#nombreservidor').val());
                formData.append("telcd", $('#telcd').val());
                formData.append("correo", $('#correo').val());
                formData.append("password", $('#password').val());
                formData.append("passwordconfirmar", $('#passwordconfirmar').val());

                console.log(formData);
                $.ajax({
                    url: "ajax_sistema/registro_gem.php",
                    type: "post",
                    dataType: "html",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false
                }).done(function(res) {
                    if (res == "1") {
                        Swal.fire({
                            position: 'top-center',
                            icon: 'warning',
                            title: 'YA EXISTE EL REGISTRO',
                            showConfirmButton: false,

                        });
                    } else if (res == "2") {
                        Swal.fire({
                            position: 'top-center',
                            icon: 'error',
                            title: 'LAS CONTRASEÑAS SON DIFERENTES',
                            showConfirmButton: false,
                            timer: 1700
                        });
                    } else if (res == "3") {
                        Swal.fire({
                            position: 'top-center',
                            icon: 'success',
                            title: 'CUENTA CREADA',
                            text: 'Ya puedes ingresar con tu clave de servidor',
                            showConfirmButton: true,
                        }).then((result) => {
                            /* Read more about isConfirmed, isDenied below */
                            if (result.isConfirmed) {
                                window.location.href = "login.php";
                            }
                        }) ;
                    } else if (res == "4") {
                        Swal.fire({
                            position: 'top-center',
                            icon: 'error',
                            title: 'ERROR EN EL QUERY ',
                            showConfirmButton: false,
                            timer: 1700
                        });
                    } else if (res == "5") {
                        Swal.fire({
                            position: 'top-center',
                            icon: 'warning',
                            title: 'ERROR INSERTANDO DATOS',
                            showConfirmButton: true,
                        });
                    }
                });
            }
        });
    </script>
</body>

</html>