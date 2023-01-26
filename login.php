<?php
/*
@AUTOR:ISC.CHRISTOPHER DELGADILLO RAMIREZ 
CONTENIDO DE LOS ESTILOS Y LOS SCRIPTS DE LA PANTALLA PRINCIPAL FUERON SEPARADOS PARA MOSTRAR MAS ORDEN EN EL DESORDEN
FAVOR DE ANOTAR TUS CAMBIOS Y MODIFICACIONES GRACIAS
 */
if (strlen(session_id()) == 0) {
    session_start();
    include_once('./configuracion_sistema/configuracion.php');
    if (isset($_SESSION[_CFGSBASE])) {
    }
    unset($_SESSION[_CFGSBASE]);
} else {
    include_once('./configuracion_sistema/configuracion.php');
    if (isset($_SESSION[_CFGSBASE])) {
        unset($_SESSION[_CFGSBASE]);
    }
}
$intlogin = 0;
$struser = "";

?>
<!DOCTYPE html>
<html lang="es" data-textdirection="ltr">

<!-- BEGIN: Head-->

<head>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <?php include_once 'cabecera_sistema/cabecera_login.php'
    ?>
</head>

<body class="vertical-layout vertical-menu-modern blank-page navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="blank-page">
    <!-- BEGIN: Content-->

    <div class="app-content content " id="fondo">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <div class="auth-wrapper auth-cover">
                    <div class="auth-inner row m-0">
                        <!-- Brand logo-->
                        <a class="brand-logo" href="#">
                            
                            <img src="imagenes_sistema/desiciones.jpg" width="28%">
                            <h2 class="brand-text text-primary ms-1" style="color: black;"></h2>
                            
                            <div style="width:40%; justify-content: space-around; display: flex;" class="align-self-center col-sm-4">
                                <input type="button" class="btn btn-outline-primary " onclick="location.href='./convocatoria_login.php'" value="CONVOCATORIAS" />
                            </div>
                            <div style="width:40%; justify-content: space-around; display: flex;" class="align-self-center col-sm-4">
                                <input type="button" class="btn btn-outline-primary " onclick="location.href='./gacetas_login.php'" value="GACETAS" />

                            </div>
                            <div style="width:25%; justify-content: space-around; display: flex;" class="align-self-center ">


                            </div>
                        </a>
                        <!-- /Brand logo-->
                        <!-- Left Text-->
                        <div class="d-none d-lg-flex col-lg-8 align-items-center p-5">
                            <div class="w-100 d-lg-flex align-items-center justify-content-center px-5"><img class="img-fluid" src="app-assets/images/pages/login-v2.svg" alt="Login V2" /></div>
                        </div>
                        <!-- /Left Text-->
                        <!-- Login-->
                        <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
                            <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
                                <h1 class="card-title fw-bold mb-1" style="text-align:center;"><b><?= $NOMBRE_CABECERA ?></b></h1>
                                <div class="content-header row">&nbsp;</div>
                                <div class="content-header row">&nbsp;</div>
                                <div class="content-header row"><img src="imagenes_sistema/linea.png" width="15%"></div>
                                <div class="content-header row">&nbsp;</div>
                                <div class="content-header row">&nbsp;</div>
                                <div class="content-header row">&nbsp;</div>
                                <h5 class="card-title fw-bold mb-1" style="text-align:center;"><b><?= $NOMBRE_SUBCABECERA ?></b></h5>
                                <form class="auth-login-form mt-2" id="loginform" method="POST" action="index.php">
                                    <input type="hidden" name="hidlogin" value="<?php echo $intlogin; ?>">
                                    <input type="hidden" name="hid_login" value="<?php echo session_id() ?>">
                                    <div class="mb-1">
                                        <label class="form-label" for="labelusuario">USUARIO*</label>
                                        <input class="form-control" id="txtnomusuario" name="txtnomusuario" placeholder="Usuario" value="" type="text" autocomplete="off" required autofocus="" tabindex="1" />
                                    </div>
                                    <div class="mb-1">
                                        <div class="d-flex justify-content-between">
                                            <label class="form-label" for="login-password">CONTRASEÑA*</label>
                                        </div>
                                        <div class="input-group input-group-merge form-password-toggle">
                                            <input class="form-control form-control-merge" id="txtpasswd" placeholder="Password" name="txtpasswd" type="password" autocomplete="off" name="login-password" placeholder="············" aria-describedby="login-password" tabindex="2" /><span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                                        </div>
                                    </div>

                                    <div class="mb-1">
                                        <div class="form-check">
                                            <input class="form-check-input" id="remember-me" type="checkbox" tabindex="3" />
                                            <label class="form-check-label" for="remember-me"> RECORDAR MI CUENTA</label>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary w-100" tabindex="4" id="btningresa">INGRESAR AL SISTEMA</button>
                                </form>
                                <p class="text-center mt-2"><span>¿Eres Nuevo?</span><a data-bs-toggle="collapse" href="#collapseExample" aria-controls="collapseExample"><span>&nbsp;CREAR UNA CUENTA</span></a></p>
                                <div class="collapse" id="collapseExample">
                                    <div class="card card-body">
                                        <p style='text-align: justify;'>Tu usuario y contraseña son los datos de acceso al sistema<b>G2G</b></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Login-->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php


    include_once 'pie_sistema/pie_login.php';
    
    //print_r($_POST);

    if ($_POST == null) {
    ?>
        <script type="text/javascript">
            window.onload = function() {

                Swal.fire({
                    title: '¿YA TIENES CUENTA?',
                    showDenyButton: true,

                    confirmButtonText: 'SI',
                    denyButtonText: `NO`,
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        Swal.fire('COOL', '', 'success')


                    } else if (result.isDenied) {

                        Swal.fire({
                            title: '¿ERES PARTE DEL GEM?',
                            showDenyButton: true,

                            confirmButtonText: 'SI',
                            denyButtonText: `NO`,
                        }).then((result) => {
                            /* Read more about isConfirmed, isDenied below */
                            if (result.isConfirmed) {
                                window.location.href = "./registrogem.php";


                            } else if (result.isDenied) {

                                window.location.href = "./registroaux.php";
                            }
                        })
                    }
                })
            }
        </script>
    <?php
    } else {
    }



    ?>


    <script src="librerias/excepciones/excepxiones.js" type="text/javascript"></script>





</body>

</html>