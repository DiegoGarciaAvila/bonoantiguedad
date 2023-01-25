<?php
if (strlen(session_id()) == 0) {
    session_start();
    include_once('./configuracion_sistema/configuracion.php');
    if (isset($_SESSION[_CFGSBASE])) {
    }
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
<html>
<!-- BEGIN: Head-->

<head>

    <?php include_once 'cabecera_sistema/cabecera_login.php' ?>

</head>

<body class="vertical-layout vertical-menu-modern blank-page navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="blank-page">
    <!-- BEGIN: Content-->
    <div class="app-content content ">
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
                        </a>
                        <!-- /Brand logo-->
                        <!-- Left Text-->
                        <div class="d-none d-lg-flex col-lg-8 align-items-center p-5">
                            <div class="w-100 d-lg-flex align-items-center justify-content-center px-5"><img class="img-fluid" src="app-assets/images/pages/reset-password-v2.svg" alt="Register V2" /></div>
                        </div>
                        <!-- /Left Text-->
                        <!-- Reset password-->
                        <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
                            <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
                                <h2 class="card-title fw-bold mb-1">REINICIAR CONTRASEÑA 🔒</h2>
                                <p class="card-text mb-2">ESCRIBIR UNA NUEVA CONTRASEÑA</p>
                                <form class="auth-reset-password-form mt-2" action="../plantilla/login.php" method="POST">
                                    <div class="mb-1">
                                        <div class="d-flex justify-content-between">
                                            <label class="form-label" for="reset-password-new">NUEVA CONTRASEÑA</label>
                                        </div>
                                        <div class="input-group input-group-merge form-password-toggle">
                                            <input class="form-control form-control-merge" id="reset-password-new" type="password" name="reset-password-new" placeholder="············" aria-describedby="reset-password-new" autofocus="" tabindex="1" /><span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                                        </div>
                                    </div>
                                    <div class="mb-1">
                                        <div class="d-flex justify-content-between">
                                            <label class="form-label" for="reset-password-confirm">CONFIRMAR NUEVA CONTRASEÑA</label>
                                        </div>
                                        <div class="input-group input-group-merge form-password-toggle">
                                            <input class="form-control form-control-merge" id="reset-password-confirm" type="password" name="reset-password-confirm" placeholder="············" aria-describedby="reset-password-confirm" tabindex="2" /><span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary w-100" tabindex="3">CONFIRMAR</button>
                                </form>
                                <p class="text-center mt-2"><a href="../plantilla/login.php"><i data-feather="chevron-left"></i>REGRESAR AL LOGIN</a></p>
                            </div>
                        </div>
                        <!-- /Reset password-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>

    <?php include_once 'pie_sistema/pie_login.php' ?>;
    ?>
    <script src="librerias/excepciones/excepxiones.js" type="text/javascript"></script>
</body>

</html>