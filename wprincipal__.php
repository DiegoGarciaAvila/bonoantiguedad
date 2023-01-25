<?php
if (strlen(session_id()) == 0) {
    session_start();
    include_once("configuracion_sistema/configuracion.php");
}
$str_check = FALSE;
include_once("configuracion_sistema/configuracion.php");
include_once("includes/sb_check.php");
ini_set("display_errors", 1);
if ($str_check) {
?>
    <!DOCTYPE html>
    <html class="loading" lang="es" data-textdirection="ltr">
    <!-- BEGIN: Head-->

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
        <meta name="description" content="">
        <meta name="keywords" content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
        <meta name="author" content="PIXINVENT">
        <title>SECTOR AUXILIAR</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <link rel="apple-touch-icon" href="imagenes_sistema/escudo_estado_mexico.png">
        <link rel="shortcut icon" type="image/x-icon" href="imagenes_sistema/escudo_estado_mexico.png">
        <link href="app-assets/fonts/font-awesome/css/font-awesome.css" rel="stylesheet">

        <script src="js_sistema/jquery.min.js"></script>
        <link href="assets/sweet/sweetalert2.css" rel="stylesheet" type="text/css" />
        <!-- BEGIN: Vendor CSS-->
        <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/vendors.min.css">
        <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/pickers/pickadate/pickadate.css">
        <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css">
        <!-- END: Vendor CSS-->

        <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/calendars/fullcalendar.min.css">
        <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/forms/select/select2.min.css">



        <!-- BEGIN: Theme CSS-->
        <link rel="stylesheet" type="text/css" href="app-assets/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="app-assets/css/bootstrap-extended.css">
        <link rel="stylesheet" type="text/css" href="app-assets/css/colors.css">
        <link rel="stylesheet" type="text/css" href="app-assets/css/components.css">
        <link rel="stylesheet" type="text/css" href="app-assets/css/themes/dark-layout.css">
        <link rel="stylesheet" type="text/css" href="app-assets/css/themes/bordered-layout.css">
        <link rel="stylesheet" type="text/css" href="app-assets/css/themes/semi-dark-layout.css">
        <!-- <link href="css_sistema/normalize.css" rel="stylesheet" type="text/css" /> -->
        <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/extensions/tether-theme-arrows.css">
        <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/extensions/tether.min.css">
        <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/extensions/shepherd.min.css">
        <!-- BEGIN: Page CSS-->
        <link rel="stylesheet" type="text/css" href="app-assets/css/core/menu/menu-types/vertical-menu.css">
        <link rel="stylesheet" type="text/css" href="app-assets/css/plugins/forms/form-validation.css">
        <link rel="stylesheet" type="text/css" href="app-assets/css/plugins/forms/pickers/form-flat-pickr.css">
        <link rel="stylesheet" type="text/css" href="app-assets/css/pages/app-calendar.css">
        <link rel="stylesheet" type="text/css" href="app-assets/css/plugins/forms/pickers/form-pickadate.css">
        <!-- END: Page CSS-->


        <!-- BEGIN: Custom CSS-->
        <link rel="stylesheet" type="text/css" href="assets/css/style.css">
        <!-- END: Custom CSS-->
        <link href="jquery/jquery-ui.structure.min.css" rel="stylesheet" type="text/css" />
        <link href="jquery/jquery-ui.theme.min.css" rel="stylesheet" type="text/css" />

        <link rel="stylesheet" type="text/css" href="app-assets/css/plugins/extensions/ext-component-tour.css">
    </head>
    <!-- END: Head-->
    <!-- BEGIN: Body-->

    <body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="">
        <?php
        $field = array();
        $modulo = 0;
        $dmenu = false;
        $pag_centro = "presentacion.php";
        $strInclude = '';


        if (isset($_GET['mod'])) {
            $modulo = $_GET['mod'];
            $__SESSION->setValueSession('opc', '0');
            $__SESSION->setValueSession('msg', '0');
            $__SESSION->setValueSession('pag', '1');
            $__SESSION->setValueSession('mod', $modulo);
            if ($__SESSION->getValueSession('niv') <> "") {
                $__SESSION->unsetSession('niv');
            }
            if ($__SESSION->getValueSession('valSearch') <> "") {
                $__SESSION->unsetSession('valSearch');
                $__SESSION->unsetSession('itemSearch');
            }
        } else {
            if ($__SESSION->getValueSession('mod') <> "") {
                $modulo = $__SESSION->getValueSession('mod');
            } else {
                $perfil = $__SESSION->getValueSession('cveperfil');
                $modulo = $__SESSION->getValueSession('mod');
            }
        }
        /*******************************SECCION DE LAS POSICIONES Y DE LAS LLAVES PRINCIPALES*******************************************************************/
        if ($modulo > 0) {

            $IdPrin = $__SESSION->getValueSession('cveperfil');
            $consulta = new PDOConsultas();
            $consulta->connect($CFG_HOST[0], $CFG_USER[0], $CFG_DBPWD[0], $CFG_DBASE[0], $CFG_TIPO[0]);
            $modulo_acceso = $consulta->executeQuery("SELECT *
                                                                FROM
                                                                sb_perfil_modulo, sb_modulo
                                                                Where sb_perfil_modulo.cve_perfil =$IdPrin
                                                                and sb_perfil_modulo.cve_modulo =$modulo
                                                                and sb_perfil_modulo.cve_modulo = sb_modulo.cve_modulo
                                                                and sb_modulo.status_modulo <>0");
            if ($consulta->totalRows > 0) {
                $strInclude = $modulo_acceso[0]['url_include'];
            }
        }
        /********************************************************************************************************************************************************/

        if (strlen($strInclude) > 0) {

            if (isset($_GET['pila'])) {

                $array_auxiliar = explode(',', $_GET['pila']);
                $CONSULTA_NIVELES = new PDOConsultas();
                $CONSULTA_NIVELES->connect($CFG_HOST[0], $CFG_USER[0], $CFG_DBPWD[0], $CFG_DBASE[0], $CFG_TIPO[0]);
                $REDIRECCIONA_ARCHIVO = $CONSULTA_NIVELES->executeQuery("SELECT 
                    cve_modulo, descripcion_modulo, status_modulo, 
                    url_modulo, grupo_modulo, posicion_modulo, nivel_modulo, 
                    url_include, tipo_nivel, nivel_padre, nivel_hijo, icono
                    FROM sb_modulo
                    WHERE
                    cve_modulo=" . $modulo);

                if ($CONSULTA_NIVELES->totalRows > 0) {
                    $strInclude = base64_decode($array_auxiliar[2]);
                    $modulo = $REDIRECCIONA_ARCHIVO[0]['cve_modulo'];
                    $array_niveles[] = array(
                        "clave" => (base64_decode($array_auxiliar[0])),
                        "llave" => (base64_decode($array_auxiliar[1])),
                        "modulo" => ($REDIRECCIONA_ARCHIVO[0]['descripcion_modulo']),
                        "anterior" => $_SERVER['HTTP_REFERER'],
                        "mod" => (base64_decode($array_auxiliar[3])),
                        "nivelpadre" => (base64_decode($array_auxiliar[4]))
                    );

                    $__SESSION->setValueSession('niveles', $array_niveles);
                } else {
                    echo "ERRROR AL OBTENER EL CODIGO DE INCLUDE";
                }
            } else {
                $__SESSION->unsetSession('niveles');
                // header('Location: ../../index.php?mod='. $modulo );
            }

            include_once('includes/' . $strInclude);

            $pag_centro = $str_entidad;
            $str_back = "";
            $footer = true;

            if (isset($_POST['opc'])) {
                if ($_POST['opc'] == 2) {
                    $__SESSION->setValueSession('opc', 2);
                }
                if ($_POST['opc'] == 3) {
                    $__SESSION->setValueSession('opc', 3);
                }
            }
            if ($__SESSION->getValueSession('opc') <> "") {
                switch ($__SESSION->getValueSession('opc')) {
                    case 2:
                        $pag_centro = $str_addentidad;
                        break;
                    case 3:
                        $pag_centro = $str_updentidad;
                        break;
                }
            }
        }/* termina conf modulo a visualizar */

        ?>
        <!-- BEGIN: Header-->
        <nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow container-xxl">
            <div class="navbar-container d-flex content">
                <div class="bookmark-wrapper d-flex align-items-center">
                    <ul class="nav navbar-nav d-xl-none">
                        <li class="nav-item"><a class="nav-link menu-toggle" href="#"><i class="ficon" data-feather="menu"></i></a></li>
                    </ul>
                    <!-- <ul class="nav navbar-nav bookmark-icons">
                        <li class="nav-item d-none d-lg-block"><a class="nav-link" href="app-email.html" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Email"><i class="ficon" data-feather="mail"></i></a></li>
                        <li class="nav-item d-none d-lg-block"><a class="nav-link" href="app-chat.html" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Chat"><i class="ficon" data-feather="message-square"></i></a></li>
                        <li class="nav-item d-none d-lg-block"><a class="nav-link" href="app-calendar.html" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Calendar"><i class="ficon" data-feather="calendar"></i></a></li>
                        <li class="nav-item d-none d-lg-block"><a class="nav-link" href="app-todo.html" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Todo"><i class="ficon" data-feather="check-square"></i></a></li>
                    </ul> -->
                    <!-- <ul class="nav navbar-nav">
                        <li class="nav-item d-none d-lg-block"><a class="nav-link bookmark-star"><i class="ficon text-warning" data-feather="star"></i></a>
                            <div class="bookmark-input search-input">
                                <div class="bookmark-input-icon"><i data-feather="search"></i></div>
                                <input class="form-control input" type="text" placeholder="Bookmark" tabindex="0" data-search="search">
                                <ul class="search-list search-list-bookmark"></ul>
                            </div>
                        </li>
                    </ul> -->
                    <div class="card-header">
                        <h6><?= $NOMBRE_CABECERA ?></h6>
                    </div>

                </div>
                <ul class="nav navbar-nav align-items-center ms-auto">
                    <!-- <li class="nav-item dropdown dropdown-language"><a class="nav-link dropdown-toggle" id="dropdown-flag" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="flag-icon flag-icon-mx"></i><span class="selected-language"></span></a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-flag"><a class="dropdown-item" href="#" data-language="en"><i class="flag-icon flag-icon-mx"></i> English</a><a class="dropdown-item" href="#" data-language="fr"><i class="flag-icon flag-icon-fr"></i> French</a><a class="dropdown-item" href="#" data-language="de"><i class="flag-icon flag-icon-de"></i> German</a><a class="dropdown-item" href="#" data-language="pt"><i class="flag-icon flag-icon-pt"></i> Portuguese</a></div>
                    </li>
                    <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-style"><i class="ficon" data-feather="moon"></i></a></li>
                    <li class="nav-item nav-search"><a class="nav-link nav-link-search"><i class="ficon" data-feather="search"></i></a>
                        <div class="search-input">
                            <div class="search-input-icon"><i data-feather="search"></i></div>
                            <input class="form-control input" type="text" placeholder="Explore Vuexy..." tabindex="-1" data-search="search">
                            <div class="search-input-close"><i data-feather="x"></i></div>
                            <ul class="search-list search-list-main"></ul>
                        </div>
                    </li> -->
                    <!-- <li class="nav-item dropdown dropdown-cart me-25"><a class="nav-link" href="#" data-bs-toggle="dropdown"><i class="ficon" data-feather="shopping-cart"></i><span class="badge rounded-pill bg-primary badge-up cart-item-count">6</span></a>
                        <ul class="dropdown-menu dropdown-menu-media dropdown-menu-end">
                            <li class="dropdown-menu-header">
                                <div class="dropdown-header d-flex">
                                    <h4 class="notification-title mb-0 me-auto">My Cart</h4>
                                    <div class="badge rounded-pill badge-light-primary">4 Items</div>
                                </div>
                            </li>
                            <li class="scrollable-container media-list">
                                <div class="list-item align-items-center"><img class="d-block rounded me-1" src="app-assets/images/pages/eCommerce/1.png" alt="donuts" width="62">
                                    <div class="list-item-body flex-grow-1"><i class="ficon cart-item-remove" data-feather="x"></i>
                                        <div class="media-heading">
                                            <h6 class="cart-item-title"><a class="text-body" href="app-ecommerce-details.html"> Apple watch 5</a></h6><small class="cart-item-by">By Apple</small>
                                        </div>
                                        <div class="cart-item-qty">
                                            <div class="input-group">
                                                <input class="touchspin-cart" type="number" value="1">
                                            </div>
                                        </div>
                                        <h5 class="cart-item-price">$374.90</h5>
                                    </div>
                                </div>
                                <div class="list-item align-items-center"><img class="d-block rounded me-1" src="app-assets/images/pages/eCommerce/7.png" alt="donuts" width="62">
                                    <div class="list-item-body flex-grow-1"><i class="ficon cart-item-remove" data-feather="x"></i>
                                        <div class="media-heading">
                                            <h6 class="cart-item-title"><a class="text-body" href="app-ecommerce-details.html"> Google Home Mini</a></h6><small class="cart-item-by">By Google</small>
                                        </div>
                                        <div class="cart-item-qty">
                                            <div class="input-group">
                                                <input class="touchspin-cart" type="number" value="3">
                                            </div>
                                        </div>
                                        <h5 class="cart-item-price">$129.40</h5>
                                    </div>
                                </div>
                                <div class="list-item align-items-center"><img class="d-block rounded me-1" src="app-assets/images/pages/eCommerce/2.png" alt="donuts" width="62">
                                    <div class="list-item-body flex-grow-1"><i class="ficon cart-item-remove" data-feather="x"></i>
                                        <div class="media-heading">
                                            <h6 class="cart-item-title"><a class="text-body" href="app-ecommerce-details.html"> iPhone 11 Pro</a></h6><small class="cart-item-by">By Apple</small>
                                        </div>
                                        <div class="cart-item-qty">
                                            <div class="input-group">
                                                <input class="touchspin-cart" type="number" value="2">
                                            </div>
                                        </div>
                                        <h5 class="cart-item-price">$699.00</h5>
                                    </div>
                                </div>
                                <div class="list-item align-items-center"><img class="d-block rounded me-1" src="app-assets/images/pages/eCommerce/3.png" alt="donuts" width="62">
                                    <div class="list-item-body flex-grow-1"><i class="ficon cart-item-remove" data-feather="x"></i>
                                        <div class="media-heading">
                                            <h6 class="cart-item-title"><a class="text-body" href="app-ecommerce-details.html"> iMac Pro</a></h6><small class="cart-item-by">By Apple</small>
                                        </div>
                                        <div class="cart-item-qty">
                                            <div class="input-group">
                                                <input class="touchspin-cart" type="number" value="1">
                                            </div>
                                        </div>
                                        <h5 class="cart-item-price">$4,999.00</h5>
                                    </div>
                                </div>
                                <div class="list-item align-items-center"><img class="d-block rounded me-1" src="app-assets/images/pages/eCommerce/5.png" alt="donuts" width="62">
                                    <div class="list-item-body flex-grow-1"><i class="ficon cart-item-remove" data-feather="x"></i>
                                        <div class="media-heading">
                                            <h6 class="cart-item-title"><a class="text-body" href="app-ecommerce-details.html"> MacBook Pro</a></h6><small class="cart-item-by">By Apple</small>
                                        </div>
                                        <div class="cart-item-qty">
                                            <div class="input-group">
                                                <input class="touchspin-cart" type="number" value="1">
                                            </div>
                                        </div>
                                        <h5 class="cart-item-price">$2,999.00</h5>
                                    </div>
                                </div>
                            </li>
                            <li class="dropdown-menu-footer">
                                <div class="d-flex justify-content-between mb-1">
                                    <h6 class="fw-bolder mb-0">Total:</h6>
                                    <h6 class="text-primary fw-bolder mb-0">$10,999.00</h6>
                                </div><a class="btn btn-primary w-100" href="app-ecommerce-checkout.html">Checkout</a>
                            </li>
                        </ul>
                    </li> -->
                    <!-- <li class="nav-item dropdown dropdown-notification me-25"><a class="nav-link" href="#" data-bs-toggle="dropdown"><i class="ficon" data-feather="bell"></i><span class="badge rounded-pill bg-danger badge-up">5</span></a>
                        <ul class="dropdown-menu dropdown-menu-media dropdown-menu-end">
                            <li class="dropdown-menu-header">
                                <div class="dropdown-header d-flex">
                                    <h4 class="notification-title mb-0 me-auto">Notifications</h4>
                                    <div class="badge rounded-pill badge-light-primary">6 New</div>
                                </div>
                            </li>
                            <li class="scrollable-container media-list"><a class="d-flex" href="#">
                                    <div class="list-item d-flex align-items-start">
                                        <div class="me-1">
                                            <div class="avatar"><img src="<?= $__SESSION->getValueSession("user_image_file"); ?>" alt="avatar" width="32" height="32"></div>
                                        </div>
                                        <div class="list-item-body flex-grow-1">
                                            <p class="media-heading"><span class="fw-bolder">Congratulation Sam 🎉</span>winner!</p><small class="notification-text"> Won the monthly best seller badge.</small>
                                        </div>
                                    </div>
                                </a><a class="d-flex" href="#">
                                    <div class="list-item d-flex align-items-start">
                                        <div class="me-1">
                                            <div class="avatar"><img src="<?= $__SESSION->getValueSession("user_image_file"); ?>" alt="avatar" width="32" height="32"></div>
                                        </div>
                                        <div class="list-item-body flex-grow-1">
                                            <p class="media-heading"><span class="fw-bolder">New message</span>&nbsp;received</p><small class="notification-text"> You have 10 unread messages</small>
                                        </div>
                                    </div>
                                </a><a class="d-flex" href="#">
                                    <div class="list-item d-flex align-items-start">
                                        <div class="me-1">
                                            <div class="avatar bg-light-danger">
                                                <div class="avatar-content">MD</div>
                                            </div>
                                        </div>
                                        <div class="list-item-body flex-grow-1">
                                            <p class="media-heading"><span class="fw-bolder">Revised Order 👋</span>&nbsp;checkout</p><small class="notification-text"> MD Inc. order updated</small>
                                        </div>
                                    </div>
                                </a>
                                <div class="list-item d-flex align-items-center">
                                    <h6 class="fw-bolder me-auto mb-0">System Notifications</h6>
                                    <div class="form-check form-check-primary form-switch">
                                        <input class="form-check-input" id="systemNotification" type="checkbox" checked="">
                                        <label class="form-check-label" for="systemNotification"></label>
                                    </div>
                                </div><a class="d-flex" href="#">
                                    <div class="list-item d-flex align-items-start">
                                        <div class="me-1">
                                            <div class="avatar bg-light-danger">
                                                <div class="avatar-content"><i class="avatar-icon" data-feather="x"></i></div>
                                            </div>
                                        </div>
                                        <div class="list-item-body flex-grow-1">
                                            <p class="media-heading"><span class="fw-bolder">Server down</span>&nbsp;registered</p><small class="notification-text"> USA Server is down due to high CPU usage</small>
                                        </div>
                                    </div>
                                </a><a class="d-flex" href="#">
                                    <div class="list-item d-flex align-items-start">
                                        <div class="me-1">
                                            <div class="avatar bg-light-success">
                                                <div class="avatar-content"><i class="avatar-icon" data-feather="check"></i></div>
                                            </div>
                                        </div>
                                        <div class="list-item-body flex-grow-1">
                                            <p class="media-heading"><span class="fw-bolder">Sales report</span>&nbsp;generated</p><small class="notification-text"> Last month sales report generated</small>
                                        </div>
                                    </div>
                                </a><a class="d-flex" href="#">
                                    <div class="list-item d-flex align-items-start">
                                        <div class="me-1">
                                            <div class="avatar bg-light-warning">
                                                <div class="avatar-content"><i class="avatar-icon" data-feather="alert-triangle"></i></div>
                                            </div>
                                        </div>
                                        <div class="list-item-body flex-grow-1">
                                            <p class="media-heading"><span class="fw-bolder">High memory</span>&nbsp;usage</p><small class="notification-text"> BLR Server using high memory</small>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="dropdown-menu-footer"><a class="btn btn-primary w-100" href="#">Read all notifications</a></li>
                        </ul>
                    </li> -->
                    <li class="nav-item dropdown dropdown-user">
                        <a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="user-nav d-sm-flex d-none">
                                <span class="user-name fw-bolder"><small><?= $__SESSION->getValueSession("desusuario"); ?></small></span>
                                <span class="user-status"></span>
                            </div>
                            <span class="avatar"><img class="round" src="<?= $__SESSION->getValueSession("user_image_file"); ?>" alt="avatar" height="40" width="40">
                                <span class="avatar-status-online"></span>
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-user">
                            <!-- <a class="dropdown-item" href="page-profile.html">
                                <i class="me-50" data-feather="user"></i> Profile</a>
                            <a class="dropdown-item" href="app-email.html">
                                <i class="me-50" data-feather="mail"></i> Inbox</a>
                            <a class="dropdown-item" href="app-todo.html">
                                <i class="me-50" data-feather="check-square"></i> Task</a>
                            <a class="dropdown-item" href="app-chat.html">
                                <i class="me-50" data-feather="message-square"></i> Chats</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="page-account-settings-account.html"><i class="me-50" data-feather="settings"></i> Settings</a>-->
                            <a class="dropdown-item" href="#" id="tour"><i class="me-50" data-feather="credit-card"></i>RECORRIDO</a>
                            <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editUser">
                                <i class="me-50" data-feather="help-circle"></i>MIS DATOS</a>
                            <a class="dropdown-item" href="../<?= $NOMBRE_CARPETA_PRINCIPAL ?>/logout.php"><i class="me-50" data-feather="power"></i>SALIR</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- <ul class="main-search-list-defaultlist d-none">
            <li class="d-flex align-items-center"><a href="#">
                    <h6 class="section-label mt-75 mb-0">Files</h6>
                </a></li>
            <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between w-100" href="app-file-manager.html">
                    <div class="d-flex">
                        <div class="me-75"><img src="app-assets/images/icons/xls.png" alt="png" height="32"></div>
                        <div class="search-data">
                            <p class="search-data-title mb-0">Two new item submitted</p><small class="text-muted">Marketing Manager</small>
                        </div>
                    </div><small class="search-data-size me-50 text-muted">&apos;17kb</small>
                </a></li>
            <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between w-100" href="app-file-manager.html">
                    <div class="d-flex">
                        <div class="me-75"><img src="app-assets/images/icons/jpg.png" alt="png" height="32"></div>
                        <div class="search-data">
                            <p class="search-data-title mb-0">52 JPG file Generated</p><small class="text-muted">FontEnd Developer</small>
                        </div>
                    </div><small class="search-data-size me-50 text-muted">&apos;11kb</small>
                </a></li>
            <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between w-100" href="app-file-manager.html">
                    <div class="d-flex">
                        <div class="me-75"><img src="app-assets/images/icons/pdf.png" alt="png" height="32"></div>
                        <div class="search-data">
                            <p class="search-data-title mb-0">25 PDF File Uploaded</p><small class="text-muted">Digital Marketing Manager</small>
                        </div>
                    </div><small class="search-data-size me-50 text-muted">&apos;150kb</small>
                </a></li>
            <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between w-100" href="app-file-manager.html">
                    <div class="d-flex">
                        <div class="me-75"><img src="app-assets/images/icons/doc.png" alt="png" height="32"></div>
                        <div class="search-data">
                            <p class="search-data-title mb-0">Anna_Strong.doc</p><small class="text-muted">Web Designer</small>
                        </div>
                    </div><small class="search-data-size me-50 text-muted">&apos;256kb</small>
                </a></li>
            <li class="d-flex align-items-center"><a href="#">
                    <h6 class="section-label mt-75 mb-0">Members</h6>
                </a></li>
            <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between py-50 w-100" href="app-user-view-account.html">
                    <div class="d-flex align-items-center">
                        <div class="avatar me-75"><img src="app-assets/images/portrait/small/avatar-s-8.jpg" alt="png" height="32"></div>
                        <div class="search-data">
                            <p class="search-data-title mb-0">John Doe</p><small class="text-muted">UI designer</small>
                        </div>
                    </div>
                </a></li>
            <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between py-50 w-100" href="app-user-view-account.html">
                    <div class="d-flex align-items-center">
                        <div class="avatar me-75"><img src="app-assets/images/portrait/small/avatar-s-1.jpg" alt="png" height="32"></div>
                        <div class="search-data">
                            <p class="search-data-title mb-0">Michal Clark</p><small class="text-muted">FontEnd Developer</small>
                        </div>
                    </div>
                </a></li>
            <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between py-50 w-100" href="app-user-view-account.html">
                    <div class="d-flex align-items-center">
                        <div class="avatar me-75"><img src="app-assets/images/portrait/small/avatar-s-14.jpg" alt="png" height="32"></div>
                        <div class="search-data">
                            <p class="search-data-title mb-0">Milena Gibson</p><small class="text-muted">Digital Marketing Manager</small>
                        </div>
                    </div>
                </a></li>
            <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between py-50 w-100" href="app-user-view-account.html">
                    <div class="d-flex align-items-center">
                        <div class="avatar me-75"><img src="app-assets/images/portrait/small/avatar-s-6.jpg" alt="png" height="32"></div>
                        <div class="search-data">
                            <p class="search-data-title mb-0">Anna Strong</p><small class="text-muted">Web Designer</small>
                        </div>
                    </div>
                </a></li>
        </ul>
        <ul class="main-search-list-defaultlist-other-list d-none">
            <li class="auto-suggestion justify-content-between"><a class="d-flex align-items-center justify-content-between w-100 py-50">
                    <div class="d-flex justify-content-start"><span class="me-75" data-feather="alert-circle"></span><span>No results found.</span></div>
                </a></li>
        </ul> -->
        <!-- END: Header-->


        <?php
        require_once 'menu_sistema/' . $menu_sistema;
        ?>
        <!-- BEGIN: Content-->
        <div class="app-content content ">
            <div class="content-overlay"></div>
            <div class="header-navbar-shadow"></div>
            <div class="content-wrapper container-xxl p-0">
                <div class="content-header row">
                    <?php
                    //print_r($_SESSION);
                    $vector_niveles = $__SESSION->getValueSession('niveles');
                    $control_niveles = "";
                    foreach ($vector_niveles as $keyniveles => &$valniveles) {
                        $control_niveles .= "
                                    <li class=\"breadcrumb-item\">
                                    <a href=\"" . $valniveles['anterior'] . "\"><i data-feather='arrow-left'></i></a>
                                    </li>";
                    }
                    ?>
                    <!-- <div class="content-header-left col-md-9 col-12 mb-2">
                        <div class="row breadcrumbs-top">
                            <div class="col-12">
                                <h2 class="content-header-title float-start mb-0"><?= $nombre_modulo_padre ?></h2>
                                <div class="breadcrumb-wrapper">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">
                                            <a href="../<?= $NOMBRE_CARPETA_PRINCIPAL ?>/index.php?mod=9999">INICIO</a>
                                        </li>
                                        <?= $control_niveles ?>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <!-- <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
                        <div class="mb-1 breadcrumb-right">
                            <div class="dropdown">
                                <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="grid"></i></button>
                                <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="app-todo.html"><i class="me-1" data-feather="check-square"></i><span class="align-middle">Todo</span></a><a class="dropdown-item" href="app-chat.html"><i class="me-1" data-feather="message-square"></i><span class="align-middle">Chat</span></a><a class="dropdown-item" href="app-email.html"><i class="me-1" data-feather="mail"></i><span class="align-middle">Email</span></a><a class="dropdown-item" href="app-calendar.html"><i class="me-1" data-feather="calendar"></i><span class="align-middle">Calendar</span></a></div>
                            </div>
                        </div>
                    </div> -->
                </div>
                </br>
<?php
 $consulta2 = new PDOConsultas();
 $consulta2->connect($CFG_HOST[0], $CFG_USER[0], $CFG_DBPWD[0], $CFG_DBASE[0]);
 $listaCD= $consulta2->executeQuery("SELECT * FROM cat_ciudaddom");
 

 $listaCT= $consulta2->executeQuery("SELECT * FROM cat_ciudadtra");
 
// echo(count($listaCD));
//print_r($listaCD);
//die($listaCD);
 

 $consulta2 = new PDOConsultas();
 $consulta2->connect($CFG_HOST[0], $CFG_USER[0], $CFG_DBPWD[0], $CFG_DBASE[0]);
 $select= $consulta2->executeQuery("SELECT a.cve_usuario,a.ClaveServidor,a.nom_usuario,a.ApePat,a.ApeMat,
 a.email,a.passwd,a.Rfc, a.des_usuario,b.des_perfil, 
 a.user_image_file,c.ADescripcion,
 d.PDescripcion,m.AJDescripcion, e.ADDescripcion, a.FechaIngAds, 
 f.ZEDescripcion, h.CDDescripcion, a.TelCD, i.CTDescripcion, a.TelCT,
 a.Issemmym,a.FechaIngIss, j.MDescripcion,a.Antiguedad, k.UEDescripcion,
 l.EPDescripcion, a.Sindicalizado, a.NivelRango
 FROM sb_usuario a
 LEFT JOIN sb_perfil b ON (a.cve_perfil=b.cve_perfil)
 LEFT JOIN cat_adscripcion c ON (a.CveAds = c.ACveA)
 LEFT JOIN cat_puesto d ON (a.CvePF = d.PCveP)
 LEFT JOIN cat_admindocente e ON (a.CveAD = e.ADCveAD)
 LEFT JOIN cat_zonaescolar f ON (a.CveZE = f.ZECveZE)
 LEFT JOIN cat_ciudaddom h ON (a.CveCD = h.CDCveCD)
 LEFT JOIN cat_ciudadtra i ON (a.CveCT = i.CTCveCT)
 LEFT JOIN cat_modalidad j ON (a.CveM = j.MCveM)
 LEFT JOIN cat_unidadejecutora k ON (a.CveUA= k.UECveUE)
 LEFT JOIN estper l ON (a.CveE=l.EPCveEP)
 LEFT JOIN cat_activojubilado m ON (a.CveAJ=m.AJCveAJ)
 WHERE a.cve_usuario= '" .$__SESSION->getValueSession('cveusuario'). "'"
 );

 //print_r($select);
 //die();

 $cveusuario=$select[0]['cve_usuario'];
 $ClaveServidor=$select[0]['ClaveServidor'];
 $nomusuario=$select[0]['nom_usuario'];
 $ApePat=$select[0]['ApePat'];
 $ApeMat=$select[0]['ApeMat'];
 $email=$select[0]['email'];
 $passwd=$select[0]['passwd'];
 $Rfc=$select[0]['Rfc'];
 $desusuario=$select[0]['des_usuario'];
 $desperfil=$select[0]['des_perfil'];
 $userimagefile=$select[0]['user_image_file'];
 $ADescripcion=$select[0]['ADescripcion'];
 $PDescripcion=$select[0]['PDescripcion'];
 $AJDescripcion=$select[0]['AJDescripcion'];
 $ADDescripcion=$select[0]['ADDescripcion'];
 $FechaIngAds=$select[0]['FechaIngAds'];
 $ZEDescripcion=$select[0]['ZEDescripcion'];
 $CDDescripcion=$select[0]['CDDescripcion'];
 $TelCD=$select[0]['TelCD'];
 $CTDescripcion=$select[0]['CTDescripcion'];
 $TelCT=$select[0]['TelCT'];
 $Issemmym=$select[0]['Issemmym'];
 $FechaIngIss=$select[0]['FechaIngIss'];
 $MDescripcion=$select[0]['MDescripcion'];
 $Antiguedad=$select[0]['Antiguedad'];
 $UEDescripcion=$select[0]['UEDescripcion'];
 $EPDescripcion=$select[0]['EPDescripcion'];
 $Sindicalizado=$select[0]['Sindicalizado'];
 $NivelRango=$select[0]['NivelRango'];
 


//  onsubmit="return false"
?>


                <div class="content-body">
                    <!-- Edit User Modal -->
                    <div class="modal fade" id="editUser" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
                            <div class="modal-content">
                                <div class="modal-header bg-transparent">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body pb-5 px-sm-5 pt-50">
                                    <div class="text-center mb-2">
                                        <h1 class="mb-1">ACTUALIZAR DATOS DEL USUARIO</h1>
                                        <p>ACTUALIZAR DATOS DEL USUARIO</p>
                                    </div>
                                  
                                    <form id="editUserForm" class="row gy-1 pt-75" action="" method="POST" >
                                        <div class="col-12 col-md-">
                                            <label class="form-label" for="ClaveServidor">CLAVE SERVIDOR PUBLICO </label>
                                            <input type="text" id="ClaveServidor" name="ClaveServidor" readonly class="form-control-plaintext" value="<?=$ClaveServidor?>" data-msg="Please enter your first name" />
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <label class="form-label" for="NombreUsuario">NOMBRE</label>
                                            <input type="text" id="NombreUsuario" name="NombreUsuario" readonly class="form-control"  value="<?=$nomusuario ?>"  data-msg="Please enter your last name" />
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <label class="form-label" for="ApellidoPaterno">APELLIDO PATERNO</label>
                                            <input type="text" id="ApellidoPaterno" name="ApellidoPaterno" class="form-control" readonly value="<?=$ApePat?>" data-msg="Please enter your last name" />
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <label class="form-label" for="ApellidoMaterno">APELLIDO MATERNO</label>
                                            <input type="text" id="ApellidoMaterno" name="ApellidoMaterno" class="form-control" readonly value="<?=$ApeMat?>" data-msg="Please enter your last name" />
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <label class="form-label" for="Rfc">RFC</label>
                                            <input type="text" id="Rfc" name="Rfc" class="form-control"  value="<?=$Rfc?>" readonly data-msg="Please enter your last name" />
                                        </div>
                                        <div class="col-6 ">
                                            <label class="form-label" for="Correo">CORREO</label>
                                            <input type="email" id="Correo" name="Correo" class="form-control"  value="<?=$email?>" data-msg="Please enter your last name" />
                                        </div>
                                        <div class="col-6 ">
                                            <label class="form-label" for="PASS">PASSWORD</label>
                                            <input type="password" id="PASS" name="PASS" class="form-control"  value="<?=$passwd?>" readonly data-msg="Please enter your last name" />
                                        </div>
                                        <div class="col-12 ">
                                            <label class="form-label" for="desusuario">DESCRIPCION USUARIO</label>
                                            <input type="text" id="desusuario" name="desusuario" class="form-control" readonly value="<?=$desusuario?>" data-msg="Please enter your last name" />
                                        </div>
                                        <div class="col-12 ">
                                            <label class="form-label" for="desperfil">ROL</label>
                                            <input type="text" id="desperfil" name="desperfil" class="form-control" readonly value="<?=$desperfil?>" data-msg="Please enter your last name" />
                                        </div>                             
                                        <div class="col-6 ">
                                            <label class="form-label" for="CveAds">ADSCRIPCION</label>
                                            <input type="text" id="CveAds" name="CveAds" class="form-control" readonly value="<?=$ADescripcion?>" data-msg="Please enter your last name" />
                                        </div>
                                        <div class="col-6 ">
                                            <label class="form-label" for="FechaIngAds">FECHA INGRESO A ADSCRIPCION</label>
                                            <input type="date" id="FechaIngAds" name="FechaIngAds" class="form-control" readonly value="<?=$FechaIngAds?>" data-msg="Please enter your last name" />
                                        </div>
                                        <div class="col-12 ">
                                            <label class="form-label" for="CvePF">PUESTO FUNCIONAL</label>
                                            <input type="text" id="CvePF" name="CvePF" class="form-control" readonly value="<?=$PDescripcion?>" data-msg="Please enter your last name" />
                                        </div>
                                        <div class="col-12 ">
                                            <label class="form-label" for="CveAJ">ACTIVO/JUBILADO</label>
                                            <input type="text" id="CveAJ" name="CveAJ" class="form-control" readonly value="<?=$AJDescripcion?>" data-msg="Please enter your last name" />
                                        </div>
                                        <div class="col-12 ">
                                            <label class="form-label" for="CveAD">ADMINISTRATIVO/DOCENTE</label>
                                            <input type="text" id="CveAD" name="CveAD" class="form-control" readonly value="<?=$ADDescripcion?>" data-msg="Please enter your last name" />
                                        </div>
                                        <div class="col-12 ">
                                            <label class="form-label" for="CveZE">ZONA ESCOLAR</label>
                                            <input type="text" id="CveZE" name="CveZE" class="form-control" readonly value="<?=$ZEDescripcion?>" data-msg="Please enter your last name" />
                                        </div>

                                        <div class="col-6 form-group">
                                            <label class="form-label" for="CveCD">CIUDAD DOMICILIO</label>
                                            <select class="form-control" name="CveCD" id="CveCD" required>
                                            
                                                <option value="">--SELECCION UNA OPCION--</option>
                                                <?php for($i = 0; $i < count($listaCD); $i++){ ?>
                                                    <option value="<?PHP echo $i+1; ?>"> <?=$listaCD[$i]['CDDescripcion']?></option>
                                                <?php } ?>
                                            </select>                                        
                                        </div>
                                        <div class="col-6 ">
                                            <label class="form-label" for="TelCD">TELEFONO DOMICILIO</label>
                                            <input type="number" id="TelCD" name="TelCD" class="form-control" value="<?=$TelCD?>" data-msg="Please enter your last name" />
                                        </div>
                                        
                                        
                                        <div class="col-6 form-group">
                                            <label class="form-label" for="CveCT">CIUDAD TRABAJO</label>
                                            <select class="form-control" name="CveCT" id="CveCT" required>
                                            
                                                <option value="">--SELECCION UNA OPCION--</option>
                                                <?php for($i = 0; $i < count($listaCT); $i++){ ?>
                                                    <option value="<?PHP echo $i+1; ?>"> <?=$listaCT[$i]['CTDescripcion']?></option>
                                                <?php } ?>
                                            </select>                                        
                                        </div>
                                        
                                        <div class="col-6 ">
                                            <label class="form-label" for="TelCT">TELEFONO TRABAJO</label>
                                            <input type="number" id="TelCT" name="TelCT" class="form-control" value="<?=$TelCT?>" data-msg="Please enter your last name" />
                                        </div>

                                        <div class="col-6 ">
                                            <label class="form-label" for="Issemmym">ISSEMMYM</label>
                                            <input type="number" id="Issemmym" name="Issemmym" class="form-control" readonly value="<?=$Issemmym?>" data-msg="Please enter your last name" />
                                        </div>

                                        <div class="col-6 ">
                                            <label class="form-label" for="FechaIngIss">FECHA INGRESO AISSEMMYM</label>
                                            <input type="date" id="FechaIngIss" name="FechaIngIss" class="form-control" readonly value="<?=$FechaIngIss?>" data-msg="Please enter your last name" />
                                        </div>
                                        <div class="col-12 ">
                                            <label class="form-label" for="CveM">MODALIDAD</label>
                                            <input type="text" id="CveM" name="CveM" class="form-control" readonly value="<?=$MDescripcion?>" data-msg="Please enter your last name" />
                                        </div>
                                        <div class="col-12 ">
                                            <label class="form-label" for="Antiguedad">ANTIGUEDAD</label>
                                            <input type="text" id="Antiguedad" name="Antiguedad" class="form-control" readonly value="<?=$Antiguedad?>" data-msg="Please enter your last name" />
                                        </div>
                                        <div class="col-12 ">
                                            <label class="form-label" for="CveUA">UNIDAD ADMINISTRATIVA</label>
                                            <input type="text" id="CveUA" name="CveUA" class="form-control" readonly value="<?=$UEDescripcion?>" data-msg="Please enter your last name" />
                                        </div>
                                        <div class="col-12 ">
                                            <label class="form-label" for="CveE">ESTADO USUARIO</label>
                                            <input type="text" id="CveE" name="CveE" class="form-control" readonly value="<?=$EPDescripcion?>" data-msg="Please enter your last name" />
                                        </div>
                                        <div class="col-12 ">
                                            <label class="form-label" for="Sindicalizado">SINDICALIZADO</label>
                                            <input type="text" id="Sindicalizado" name="Sindicalizado" class="form-control" readonly value="<?=$Sindicalizado?>" data-msg="Please enter your last name" />
                                        </div>
                                        <div class="col-12 ">
                                            <label class="form-label" for="NivelRango">NIVEL Y RANGO</label>
                                            <input type="text" id="NivelRango" name="NivelRango" class="form-control" readonly value="<?=$NivelRango?>" data-msg="Please enter your last name" />
                                        </div>
                                        <div class="col-12 text-center mt-2 pt-50">
                                            <button type="submit" class="btn btn-primary me-1" name="submit_btn">ENVIAR</button>
                                            <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close">
                                                CANCELAR
                                            </button>
                                        </div>
                                        
                                        
                                        
                                        
                                        
                                        
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ Edit User Modal -->

                    <?php
 if(isset($_REQUEST['submit_btn']))
 {
    $Correo = $_POST["Correo"];
    $CveCD = $_POST["CveCD"];
    $TelCD = $_POST["TelCD"];
    $CveCT = $_POST["CveCT"];
    $TelCT = $_POST["TelCT"];

    
    $consulta2 = new PDOConsultas();
    $consulta2->connect($CFG_HOST[0], $CFG_USER[0], $CFG_DBPWD[0], $CFG_DBASE[0]);
    $actualisausuario= $consulta2->executeQuery(" UPDATE " . $_POST['sb_usuario']. " SET ". 
    " email = '".$Correo."',".
    " CveCD = ".$CveCD.",".
    " TelCD = '".$TelCD."',".
    " CveCT = ".$CveCT.",".
    " TelCT = '".$TelCT."'".
    " WHERE a.cve_usuario = '" .$__SESSION->getValueSession('cveusuario'). "'"
    );
    
 
  
  
  print_r($Correo);
  print_r($CveCD);
  print_r($TelCD);
  print_r($CveCT);
  print_r($TelCT);
  print_r($actualisausuario);
  die();
 }                   
                    ?>
                    <!-- Page layout -->
                    <?php
                    include $pag_centro;
                    ?>
                    <!--/ Page layout -->

                </div>
            </div>
        </div>
        <!-- END: Content-->

        <div class="sidenav-overlay"></div>
        <div class="drag-target"></div>

        <!-- BEGIN: Footer-->
        <footer class="footer footer-static footer-light">
            <p class="clearfix mb-0"><span class="float-md-start d-block d-md-inline-block mt-25"><strong>&copy; Unidad de
                        Inform&aacute;tica de la Direcci&oacute;n General de Personal.</strong><small>Todos los Derechos
                        Reservados</small><i data-feather="heart"></i></span></p>
        </footer>
        <button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
        <!-- END: Footer-->

        <script src="assets/sweet/sweetalert2.js" type="text/javascript"></script>
        <script src="js_sistema/XHConn.js" type="text/javascript"></script>

        <!-- BEGIN: Vendor JS-->
        <script src="app-assets/vendors/js/vendors.min.js"></script>
        <!-- BEGIN Vendor JS-->

        <!-- BEGIN: Page Vendor JS-->
        <script src="app-assets/vendors/js/forms/validation/jquery.validate.min.js"></script>
        <script src="app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js"></script>

        <!-- END: Page Vendor JS-->

        <!-- BEGIN: Page Vendor JS-->
        <script src="app-assets/vendors/js/pickers/pickadate/picker.js"></script>
        <script src="app-assets/vendors/js/pickers/pickadate/picker.date.js"></script>
        <script src="app-assets/vendors/js/pickers/pickadate/picker.time.js"></script>
        <script src="app-assets/vendors/js/pickers/pickadate/legacy.js"></script>
        <!-- END: Page Vendor JS-->

        <script src="app-assets/vendors/js/calendar/fullcalendar.min.js"></script>
        <script src="app-assets/vendors/js/extensions/moment.min.js"></script>
        <script src="app-assets/vendors/js/forms/select/select2.full.min.js"></script>

        <!-- BEGIN: Theme JS-->
        <script src="app-assets/js/core/app-menu.js"></script>
        <script src="app-assets/js/core/app.js"></script>
        <!-- END: Theme JS-->

        <!-- BEGIN: Page JS-->
        <script src="app-assets/js/scripts/forms/form-validation.js"></script>
        <!-- END: Page JS-->

        <!-- BEGIN: Page JS-->
        <script src="app-assets/js/scripts/forms/pickers/form-pickers.js"></script>
        <!-- END: Page JS-->
        <!-- BEGIN: Page JS-->
        <script src="js_sistema/jquery.validate.min.js"></script>
        <!-- END: Page JS-->
        <script src="jquery/jquery-ui.min.js" type="text/javascript"></script>
        <script src="app-assets/vendors/js/extensions/tether.min.js"></script>
        <script src="app-assets/vendors/js/extensions/shepherd.min.js"></script>
        <script src="app-assets/js/scripts/extensions/ext-component-tour.js"></script>
        <script src="app-assets/js/scripts/forms/form-select2.js"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
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
    <!-- END: Body-->

    </html>
<?php
} else {
    include_once("includes/sb_refresh.php");
}
?>