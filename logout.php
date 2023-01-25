<?php
if (strlen(session_id()) == 0)
    session_start();
include_once('./configuracion_sistema/configuracion.php');

$str_msg_red = "";
$time = 0;
if ($__SESSION->getValueSession('nomusuario') <> "") {
    //    fnEndSession($__SESSION->getAll());
    if (isset($_SESSION[_CFGSBASE]))
        unset($_SESSION[_CFGSBASE]);
    $str_refresh = "index.php";
    $time = 1;
} else {
    $i_intcolor = 25;
    if (strlen(session_id()) == 0)
        session_start();
    if (isset($_SESSION[_CFGSBASE]))
        unset($_SESSION[_CFGSBASE]);
    $str_refresh = "index.php";
    $time = 3;
}
?>
<!DOCTYPE html>

<head>
    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/vendors.min.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/components.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/themes/dark-layout.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/themes/bordered-layout.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/themes/semi-dark-layout.css">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/pages/page-misc.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <!-- END: Custom CSS-->
    <title>CERRANDO SESSION</title>
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
                <!-- Under maintenance-->
                <div class="misc-wrapper"><a class="brand-logo" href="">
                        <h1 class="brand-text text-primary ms-1">DIRECCION GENERAL DE PERSONAL</h1>
                    </a>
                    <div class="misc-inner p-2 p-sm-3">
                        <div class="w-100 text-center">
                            <h1 class="mb-1">CERRANDO SESSION</h1>
                            <p class="mb-3">GRACIAS POR SU VISITA</p>
                            <form class="row row-cols-md-auto row justify-content-center align-items-center m-0 mb-2 gx-3" action="javascript:void(0)">
                                <div class="col-12 m-0 mb-1">
                                    <!-- <input class="form-control" id="notify-email" type="text" placeholder="john@example.com" /> -->
                                </div>
                                <!-- <div class="col-12 d-md-block d-grid ps-md-0 ps-auto">
                                    <button class="btn btn-primary mb-1 btn-sm-block" type="submit">Notify</button>
                                </div> -->
                            </form><img class="img-fluid" src="app-assets/images/pages/under-maintenance.svg" alt="Under maintenance page" />
                        </div>
                    </div>
                </div>
                <!-- / Under maintenance-->
            </div>
        </div>
    </div>
    <!-- END: Content-->


    <!-- BEGIN: Vendor JS-->
    <script src="app-assets/vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="app-assets/js/core/app-menu.js"></script>
    <script src="app-assets/js/core/app.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <!-- END: Page JS-->

    <script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })
    </script>
</body>
<?php
echo "<meta http-equiv='refresh' content='" . $time . ";URL=" . $str_refresh . "'>";
