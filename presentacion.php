<?php
include_once('cabecera_sistema/cabecera_calendario.php');
include_once('./configuracion_sistema/configuracion.php');
include_once('./librerias/PDOConsultas.php');
?>
<style>
    .ventana {

        background: rgba(254, 254, 254, 1);
        width: 30%;
        color: rgba(255, 255, 255, 1);
        font-family: Arial, Helvetica, sans-serif;
        font-size: 18px;
        text-align: center;
        padding: 33px;
        min-height: 100px;
        border-radius: 22px;
        position: absolute;
        left: 34%;
        top: 40%;

        box-shadow: inset 0 -3em 3em rgba(0, 0, 0, 0.0),
        0 0 0 2px rgb(254, 254, 254),
        0.3em 0.3em 1em rgba(0, 0, 0, 0.3);
    }

    .ventana2 {

        background: rgba(254, 254, 254, 1);
        width: 60%;
        color: rgba(255, 255, 255, 1);
        font-family: Arial, Helvetica, sans-serif;
        font-size: 18px;
        text-align: center;
        padding: 33px;
        min-height: 100px;
        border-radius: 22px;
        margin: auto;
        left: 20%;
        top: 22%;
        box-shadow: inset 0 -3em 3em rgba(0, 0, 0, 0.0),
        0 0 0 2px rgb(254, 254, 254),
        0.3em 0.3em 1em rgba(0, 0, 0, 0.3);
    }

    .imgventana {
        width: 30%;
        height: 30%;
        margin-bottom: 30px;

    }

</style>
<?php

$consulta = new PDOConsultas();
$consulta->connect($CFG_HOST[0], $CFG_USER[0], $CFG_DBPWD[0], $CFG_DBASE[0]);
$datosPersona = $consulta->executeQuery("SELECT * FROM sb_usuario WHERE cve_usuario = " . $__SESSION->getValueSession('cveusuario'));
$personaPerfil = $datosPersona[0]['cve_perfil'];

$antiguedadAnios = $datosPersona[0]['antia'];
$antiguedadMeses = $datosPersona[0]['antim'];
$antiguedadDias = $datosPersona[0]['antid'];
$estadopersona = $datosPersona[0]['CveE'];
$estadogrupo = $datosPersona[0]['cve_usergroup'];
$CveEstatus=4;

$banderaPrincipal = false;
/*
                                       * 1.-APROBADO
                                       * 2.-RECHAZADO
                                       * 3.-YA TIENE BONO
                                       * 4.-ACTUALIZADO
                                       * 5,.SIN ACTUALIZAR
                                       * 6.-PREREGISTRO
                                       * */
//GEM
if ($estadogrupo == 2) {
    $CveEstatus=4;
    if ($antiguedadAnios >= 30 || ($antiguedadAnios >= 29 && $antiguedadMeses >= 6 && $antiguedadDias >= 1)) {
       // $CveEstatus=1;
        $banderaPrincipal=true;
    } else {
        $banderaPrincipal=false;
        $CveEstatus=2;
        ?>
        <div class="ventana" id="venta">
            <img src="imagenes_sistema/escudo_estado_mexico.png" alt="logo-estado" class="imgventana">

            </br>
            <h2>No cumple con la antiguedad necesaria</h2>
            <h5>Para dudas y aclaraciones contactar a :</h5>
            <h5>correo@edomex.gob.mx</h5>
            <h5>722-000-0000</h5>


        </div>
        <?php
    }
}
//AUX
else {
    $CveEstatus=6;
    $banderaPrincipal=true;
}
?>
<?php


if ($banderaPrincipal){
    if ($personaPerfil == 4){
        switch ($datosPersona[0]['CveE']) {
        case 1:
            ?>
            <div class="ventana" id="venta">
                <img src="imagenes_sistema/escudo_estado_mexico.png" alt="logo-estado" class="imgventana">

                </br>

                <h2>Su solicitud para recibir la recompensa ha sido aprobada</h2>

            </div>
            <?php
            break;

        case 2:
            ?>
            <div class="ventana" id="venta">
                <img src="imagenes_sistema/escudo_estado_mexico.png" alt="logo-estado" class="imgventana">

                </br>
                <h2>Su solicitud para recibir la recompensa ha sido rechazada</h2>
                <h5>Para dudas y aclaraciones contactar a :</h5>
                <h5>correo@edomex.gob.mx</h5>
                <h5>722-000-0000</h5>

            </div>
            <?php
            break;

        case 3:
            ?>
            <div class="ventana" id="venta">
                <img src="imagenes_sistema/escudo_estado_mexico.png" alt="logo-estado" class="imgventana">

                </br>
                <h2>Ya le han dado la recompensa por permanencia en el servicio, ya no puede realizar otra paticion</h2>
                <h5>Para dudas y aclaraciones contactar a :</h5>
                <h5>correo@edomex.gob.mx</h5>
                <h5>722-000-0000</h5>

            </div>
            <?php
            break;

        case 5:
            ?>
            <div class="ventana2 " id="venta2">
                <h2>Es necesario actualizar su informacion</h2>
                <form id="editUserFormIN" class="row" method="POST">
                    <div class="col-12 col-md-">
                        <label class="form-label" for="ClaveServidorIN">CLAVE SERVIDOR PUBLICO </label>
                        <input type="text" id="ClaveServidorIN" name="ClaveServidorIN" class="form-control" readonly
                               value="<?= $ClaveServidor ?>" data-msg="Please enter your first name"/>
                    </div>
                    <div class="col-12 col-md-3">
                        <label class="form-label" for="NombreUsuarioIN">NOMBRE</label>
                        <input type="text" id="NombreUsuarioIN" name="NombreUsuarioIN" class="form-control"
                               value="<?= $nomusuario ?>" data-msg="Please enter your last name" required/>
                    </div>
                    <div class="col-12 col-md-3">
                        <label class="form-label" for="ApellidoPaternoIN">APELLIDO PATERNO</label>
                        <input type="text" id="ApellidoPaternoIN" name="ApellidoPaternoIN" class="form-control"
                               value="<?= $ApePat ?>" data-msg="Please enter your last name" required/>
                    </div>
                    <div class="col-12 col-md-3">
                        <label class="form-label" for="ApellidoMaternoIN">APELLIDO MATERNO</label>
                        <input type="text" id="ApellidoMaternoIN" name="ApellidoMaternoIN" class="form-control"
                               value="<?= $ApeMat ?>" data-msg="Please enter your last name" required/>
                    </div>
                    <div class="col-12 col-md-3">
                        <label class="form-label" for="RfcIN">RFC</label>
                        <input type="text" id="RfcIN" name="RfcIN" class="form-control" value="<?= $Rfc ?>"
                               data-msg="Please enter your last name" required/>
                    </div>
                    <div class="col-6 ">
                        <label class="form-label" for="CorreoIN">CORREO</label>
                        <input required type="email" id="CorreoIN" name="CorreoIN" class="form-control"
                               value="<?= $email ?>"
                               data-msg="Please enter your last name"
                               pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}"/>
                    </div>
                    <div class="col-6 ">
                        <label class="form-label" for="CveAdsIN">ADSCRIPCION</label>
                        <select class="form-control" name="CveAdsIN" id="CveAdsIN" required>
                            <option value="">--SELECCION UNA OPCION--</option>
                            <?php
                            foreach ($cat_adscripcion as $keyads) {
                                $ads++;
                                switch ($keyads['ADescripcion']) {
                                    case $ADescripcion:
                                        echo("<option selected value= \"" . $ads . "\" > " . $keyads['AClave'] . "</option> ");
                                        break;
                                    default:
                                        echo("<option  value= \"" . $ads . "\" > " . $keyads['AClave'] . "</option> ");
                                        break;
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-6 ">
                        <label class="form-label" for="CvePFIN">PUESTO FUNCIONAL</label>
                        <select class="form-control" name="CvePFIN" id="CvePFIN" required>
                            <option value="">--SELECCION UNA OPCION--</option>
                            <?php
                            foreach ($cat_puesto as $keypf) {
                                $pf++;
                                switch ($keypf['PDescripcion']) {
                                    case $PDescripcion:
                                        echo("<option selected value= \"" . $pf . "\" > " . $keypf['PClave'] . "</option> ");
                                        break;
                                    default:
                                        echo("<option  value= \"" . $pf . "\" > " . $keypf['PClave'] . "</option> ");
                                        break;
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-6 ">
                        <label class="form-label" for="CveAJIN">ACTIVO/JUBILADO</label>
                        <select class="form-control" name="CveAJIN" id="CveAJIN" required>
                            <option value="">--SELECCION UNA OPCION--</option>
                            <?php
                            foreach ($cat_activojubilado as $keyac) {
                                $ac++;
                                switch ($keyac['AJDescripcion']) {
                                    case $AJDescripcion:
                                        echo("<option selected value= \"" . $ac . "\" > " . $keyac['AJDescripcion'] . "</option> ");
                                        break;
                                    default:
                                        echo("<option  value= \"" . $ac . "\" > " . $keyac['AJDescripcion'] . "</option> ");
                                        break;
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-6 ">
                        <label class="form-label" for="CveADIN">ADMINISTRATIVO/DOCENTE</label>
                        <select class="form-control" name="CveADIN" id="CveADIN" required>
                            <option value="">--SELECCION UNA OPCION--</option>
                            <?php
                            foreach ($cat_admindocente as $keyad) {
                                $ad++;
                                switch ($keyad['ADDescripcion']) {
                                    case $ADDescripcion:
                                        echo("<option selected value= \"" . $ad . "\" > " . $keyad['ADDescripcion'] . "</option> ");
                                        break;
                                    default:
                                        echo("<option  value= \"" . $ad . "\" > " . $keyad['ADDescripcion'] . "</option> ");
                                        break;
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-6 ">
                        <label class="form-label" for="CveZEIN">ZONA ESCOLAR</label>
                        <select class="form-control" name="CveZEIN" id="CveZEIN">
                            <option value="">--SELECCION UNA OPCION--</option>
                            <?php
                            foreach ($cat_zonaescolar as $keyze) {
                                $ze++;
                                switch ($keyze['ZEDescripcion']) {
                                    case $ZEDescripcion:
                                        echo("<option selected value= \"" . $ze . "\" > " . $keyze['ZEDescripcion'] . "</option> ");
                                        break;
                                    default:
                                        echo("<option  value= \"" . $ze . "\" > " . $keyze['ZEDescripcion'] . "</option> ");
                                        break;
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <div class="col-4 form-group">
                        <label class="form-label" for="CvEEstIN">ESTADO DOMICILIO</label>
                        <select class="form-control" name="CvEEstIN" id="CvEEstIN" required>

                            <option value="">--SELECCION UNA OPCION--</option>
                            <?php

                            foreach ($cat_estado as $keyed) {
                                $ed++;
                                switch ($keyed['cve_estado']) {
                                    case $numcd:
                                        echo("<option selected value= \"" . $ed . "\" > " . $keyed['des_estado'] . "</option> ");

                                        break;

                                    default:
                                        echo("<option  value= \"" . $ed . "\" > " . $keyed['des_estado'] . "</option> ");

                                        break;
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <div class="col-4 form-group">
                        <label class="form-label" for="CveCDIN">CIUDAD DOMICILIO</label>
                        <select class="form-control" name="CveCDIN" id="CveCDIN" required>

                            <option value="">--SELECCION UNA OPCION--</option>
                            <?php

                            foreach ($listaCD as $keycd) {
                                $cd++;
                                switch ($keycd['CDDescripcion']) {
                                    case $CDDescripcion:
                                        echo("<option selected value= \"" . $cd . "\" > " . $keycd['CDDescripcion'] . "</option> ");

                                        break;

                                    default:
                                        echo("<option  value= \"" . $cd . "\" > " . $keycd['CDDescripcion'] . "</option> ");

                                        break;
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <div class="col-4 ">
                        <label class="form-label" for="TelCDIN">TELEFONO DOMICILIO</label>
                        <input type="number" id="TelCDIN" name="TelCDIN" class="form-control" value="<?= $TelCD ?>"
                               data-msg="Please enter your last name"/>
                    </div>

                    <div class="col-4 form-group">
                        <label class="form-label" for="CvEEst2IN">ESTADO TRABAJO</label>
                        <select class="form-control" name="CvEEst2IN" id="CvEEst2IN" required>

                            <option value="">--SELECCION UNA OPCION--</option>
                            <?php

                            foreach ($cat_estado as $keyed2) {
                                $ed2++;
                                switch ($keyed2['cve_estado']) {
                                    case $numtd:
                                        echo("<option selected value= \"" . $ed2 . "\" > " . $keyed2['des_estado'] . "</option> ");

                                        break;

                                    default:
                                        echo("<option  value= \"" . $ed2 . "\" > " . $keyed2['des_estado'] . "</option> ");

                                        break;
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <div class="col-4 form-group">
                        <label class="form-label" for="CveCTIN">CIUDAD TRABAJO</label>
                        <select class="form-control" name="CveCTIN" id="CveCTIN" required>

                            <option value="">--SELECCION UNA OPCION--</option>
                            <?php

                            foreach ($listaCT as $keyct) {
                                $ct++;
                                switch ($keyct['CTDescripcion']) {
                                    case $CTDescripcion:
                                        echo("<option selected value= \"" . $ct . "\" > " . $keyct['CTDescripcion'] . "</option> ");

                                        break;


                                    default:
                                        echo("<option  value= \"" . $ct . "\" > " . $keyct['CTDescripcion'] . "</option> ");

                                        break;
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-4 ">
                        <label class="form-label" for="TelCTIN">TELEFONO TRABAJO</label>
                        <input type="number" id="TelCTIN" name="TelCTIN" class="form-control" value="<?= $TelCT ?>"
                               data-msg="Please enter your last name"/>
                    </div>
                    <div class="col-6 ">
                        <label class="form-label" for="IssemmymIN">ISSEMMYM</label>
                        <input type="number" id="IssemmymIN" name="IssemmymIN" class="form-control" value="<?= $Issemmym ?>"
                               data-msg="Please enter your last name"/>
                    </div>
                    <div class="col-6 ">
                        <label class="form-label" for="CveUAIN">UNIDAD ADMINISTRATIVA</label>
                        <select class="form-control" name="CveUAIN" id="CveUAIN" required>
                            <option value="0">--SELECCION UNA OPCION--</option>
                            <?php
                            foreach ($cat_unidadejecutora as $keyue) {
                                $ue++;
                                switch ($keyue['UEDescripcion']) {
                                    case $UEDescripcion:
                                        echo("<option selected value= \"" . $ue . "\" > " . $keyue['UEDescripcion'] . "</option> ");
                                        break;
                                    default:
                                        echo("<option  value= \"" . $ue . "\" > " . $keyue['UEDescripcion'] . "</option> ");
                                        break;
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-6 ">
                        <label class="form-label" for="SindicalizadoIN">SINDICALIZADO</label>
                        <select class="form-control" name="SindicalizadoIN" id="SindicalizadoIN" required>
                            <option value="">--SELECCION UNA OPCION--</option>
                            <?php
                            foreach ($listaSin as $keyselect => &$valselect) {
                                switch ($valselect['cve_perfil']) {
                                    case $Sindicalizado:
                                        echo("<option selected value= \"" . $valselect['cve_perfil'] . "\" > " . $valselect['cve_perfil'] . "</option> ");
                                        break;
                                    default:
                                        echo("<option  value= \"" . $valselect['cve_perfil'] . "\" > " . $valselect['cve_perfil'] . "</option> ");
                                        break;
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-6 ">
                        <label class="form-label" for="NivelRangoIN">NIVEL Y RANGO</label>
                        <input type="text" id="NivelRangoIN" name="NivelRangoIN" class="form-control"
                               value="<?= $NivelRango ?>" data-msg="Please enter your last name"/>
                    </div>
                    <div class="col-12 text-center mt-2 pt-50">
                        <button class="btn btn-primary me-1" id="submit_btnIN" name="submit_btnIN">ACTUALIZAR</button>
                        IN
                    </div>
                </form>
            </div>

            <?php


            ?>
            <?php
            break;
        default:
        ?>
        <!-- BEGIN: Content-->
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- Dashboard Analytics Start -->
                <section id="dashboard-analytics">
                    <div class="row match-height">
                        <!-- Timeline Card -->
                        <div class="col-lg-4 col-12">
                            <div class="card card-user-timeline">
                                <div class="card-header">
                                    <div class="d-flex align-items-center">
                                        <i data-feather="list" class="user-timeline-title-icon"></i>
                                        <h5 class="card-title">ALERTAS DEL DÍA</h5>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <ul class="timeline ml-50">

                                        <?php
                                        for ($puntero = 0; $puntero < 15; $puntero++) {
                                            echo '  
                                                            <li class="timeline-item">
                                                                <span class="timeline-point timeline-point-indicator"></span>
                                                                <!-- <p>DIFEM</p> -->
                                                                <div class="media align-items-center">
                                                                    <h6 class="media-body mb-0">    <a href="#">DIFEM</a></h6>                    
                                                                </div>
                                                                </li>
                                                                ';
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--/ Timeline Card -->

                        <!-- App Design Card -->
                        <div class="col-lg-8 col-12">
                            <div class="card card-app-design">
                                <div class="card-body">

                                    <section>
                                        <div class="app-calendar overflow-hidden border">
                                            <div class="row g-0">
                                                <!-- Sidebar -->
                                                <div class="col app-calendar-sidebar flex-grow-0 overflow-hidden d-flex flex-column"
                                                     id="app-calendar-sidebar">
                                                    <div class="sidebar-wrapper">
                                                        <div class="card-body d-flex justify-content-center">
                                                            <button class="btn btn-primary btn-toggle-sidebar w-100"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#add-new-sidebar">
                                                                <span class="align-middle">AGREGAR EVENTO</span>
                                                            </button>
                                                        </div>
                                                        <div class="card-body pb-0">
                                                            <h5 class="section-label mb-1">
                                                                <span class="align-middle">FILTRO</span>
                                                            </h5>
                                                            <div class="form-check mb-1">
                                                                <input type="checkbox" class="form-check-input select-all"
                                                                       id="select-all"
                                                                       checked/>
                                                                <label class="form-check-label" for="select-all">VER
                                                                    TODO</label>
                                                            </div>
                                                            <div class="calendar-events-filter">
                                                                <div class="form-check form-check-danger mb-1">
                                                                    <input type="checkbox" class="form-check-input input-filter"
                                                                           id="personal" data-value="personal" checked/>
                                                                    <label class="form-check-label" for="personal">UNIDADES
                                                                        AUXILIARES</label>
                                                                </div>
                                                                <div class="form-check form-check-primary mb-1">
                                                                    <input type="checkbox" class="form-check-input input-filter"
                                                                           id="business" data-value="business" checked/>
                                                                    <label class="form-check-label"
                                                                           for="business">EVENTOS</label>
                                                                </div>
                                                                <div class="form-check form-check-warning mb-1">
                                                                    <input type="checkbox" class="form-check-input input-filter"
                                                                           id="family"
                                                                           data-value="family" checked/>
                                                                    <label class="form-check-label"
                                                                           for="family">NOTICIAS</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mt-auto">
                                                        <img src="imagenes_sistema/escudo_estado_mexico.png"
                                                             alt="Calendar illustration"
                                                             class="img-fluid"/>
                                                    </div>
                                                </div>
                                                <!-- /Sidebar -->

                                                <!-- Calendar -->
                                                <div class="col position-relative">
                                                    <div class="card shadow-none border-0 mb-0 rounded-0">
                                                        <div class="card-body pb-0">
                                                            <div id="calendar"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /Calendar -->
                                                <div class="body-content-overlay"></div>
                                            </div>
                                        </div>
                                        <!-- Calendar Add/Update/Delete event modal-->
                                        <div class="modal modal-slide-in event-sidebar fade" id="add-new-sidebar">
                                            <div class="modal-dialog sidebar-lg">
                                                <div class="modal-content p-0">
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close">×
                                                    </button>
                                                    <div class="modal-header mb-1">
                                                        <h5 class="modal-title">AGREGAR EVENTO</h5>
                                                    </div>
                                                    <div class="modal-body flex-grow-1 pb-sm-0 pb-3">
                                                        <form class="event-form needs-validation" data-ajax="false" novalidate>
                                                            <div class="mb-1">
                                                                <label for="title" class="form-label">TíTULO</label>
                                                                <input type="text" class="form-control" id="title" name="title"
                                                                       placeholder="TÍTULO" required/>
                                                            </div>
                                                            <div class="mb-1">
                                                                <label for="select-label" class="form-label">TIPO DE
                                                                    MENSSAJE</label>
                                                                <select class="select2 select-label form-select w-100"
                                                                        id="select-label"
                                                                        name="select-label">
                                                                    <option data-label="primary" value="UNIDAD AUXILIAR"
                                                                            selected>UNIDAD
                                                                        AUXILIAR
                                                                    </option>
                                                                    <option data-label="danger" value="EVENTOS">EVENTOS</option>
                                                                    <option data-label="warning" value="NOTICIAS">NOTICIAS
                                                                    </option>
                                                                </select>
                                                            </div>
                                                            <div class="mb-1 position-relative">
                                                                <label for="start-date" class="form-label">FECHA DE
                                                                    INICIO</label>
                                                                <input type="text" class="form-control" id="start-date"
                                                                       name="start-date"
                                                                       placeholder="FECHA DE INICIO"/>
                                                            </div>
                                                            <div class="mb-1 position-relative">
                                                                <label for="end-date" class="form-label">FECHA DE FINAL</label>
                                                                <input type="text" class="form-control" id="end-date"
                                                                       name="end-date"
                                                                       placeholder="FECHA DE INICIO"/>
                                                            </div>
                                                            <div class="mb-1">
                                                                <div class="form-check form-switch">
                                                                    <input type="checkbox"
                                                                           class="form-check-input allDay-switch"
                                                                           id="customSwitch3"/>
                                                                    <label class="form-check-label" for="customSwitch3">TODO EL
                                                                        DIA</label>
                                                                </div>
                                                            </div>
                                                            <div class="mb-1">
                                                                <label for="event-url" class="form-label">LINK DE PAGINA</label>
                                                                <input type="url" class="form-control" id="event-url"
                                                                       placeholder="https://www.google.com"/>
                                                            </div>
                                                            <!-- <div class="mb-1 select2-primary">
                                                        <label for="event-guests" class="form-label">Add Guests</label>
                                                        <select class="select2 select-add-guests form-select w-100" id="event-guests" multiple>
                                                            <option data-avatar="1-small.png" value="Jane Foster">Jane Foster</option>
                                                            <option data-avatar="3-small.png" value="Donna Frank">Donna Frank</option>
                                                            <option data-avatar="5-small.png" value="Gabrielle Robertson">Gabrielle Robertson</option>
                                                            <option data-avatar="7-small.png" value="Lori Spears">Lori Spears</option>
                                                            <option data-avatar="9-small.png" value="Sandy Vega">Sandy Vega</option>
                                                            <option data-avatar="11-small.png" value="Cheryl May">Cheryl May</option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-1">
                                                        <label for="event-location" class="form-label">Location</label>
                                                        <input type="text" class="form-control" id="event-location" placeholder="Enter Location" />
                                                    </div> -->
                                                            <div class="mb-1">
                                                                <label class="form-label">DESCRIPCION</label>
                                                                <textarea name="event-description-editor"
                                                                          id="event-description-editor"
                                                                          class="form-control"></textarea>
                                                            </div>
                                                            <div class="mb-1 d-flex">
                                                                <button type="submit"
                                                                        class="btn btn-primary add-event-btn me-1">AGREGAR
                                                                </button>
                                                                <button type="button"
                                                                        class="btn btn-outline-secondary btn-cancel"
                                                                        data-bs-dismiss="modal">CANCELAR
                                                                </button>
                                                                <button type="submit"
                                                                        class="btn btn-primary update-event-btn d-none me-1">
                                                                    ACTUALIZAR
                                                                </button>
                                                                <button class="btn btn-outline-danger btn-delete-event d-none">
                                                                    ELIMINAR
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/ Calendar Add/Update/Delete event modal-->
                                    </section>
                                </div>
                            </div>
                            <?php include_once('pie_sistema/pie_calendario.php') ?>

                            <?php
                            //echo("Error con el usuario");
            break;
        }
    }
    else{
                        ?>
                        <!-- BEGIN: Content-->
                        <div class="content-wrapper container-xxl p-0">
                            <div class="content-header row">
                            </div>
                            <div class="content-body">
                                <!-- Dashboard Analytics Start -->
                                <section id="dashboard-analytics">
                                    <div class="row match-height">
                                        <!-- Timeline Card -->
                                        <div class="col-lg-4 col-12">
                                            <div class="card card-user-timeline">
                                                <div class="card-header">
                                                    <div class="d-flex align-items-center">
                                                        <i data-feather="list" class="user-timeline-title-icon"></i>
                                                        <h5 class="card-title">ALERTAS DEL DÍA</h5>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <ul class="timeline ml-50">

                                                        <?php
                                                        for ($puntero = 0; $puntero < 15; $puntero++) {
                                                            echo '  
                                                        <li class="timeline-item">
                                                            <span class="timeline-point timeline-point-indicator"></span>
                                                            <!-- <p>DIFEM</p> -->
                                                            <div class="media align-items-center">
                                                                <h6 class="media-body mb-0">    <a href="#">DIFEM</a></h6>                    
                                                            </div>
                                                            </li>
                                                            ';
                                                        }
                                                        ?>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/ Timeline Card -->

                                        <!-- App Design Card -->
                                        <div class="col-lg-8 col-12">
                                            <div class="card card-app-design">
                                                <div class="card-body">

                                                    <section>
                                                        <div class="app-calendar overflow-hidden border">
                                                            <div class="row g-0">
                                                                <!-- Sidebar -->
                                                                <div class="col app-calendar-sidebar flex-grow-0 overflow-hidden d-flex flex-column"
                                                                     id="app-calendar-sidebar">
                                                                    <div class="sidebar-wrapper">
                                                                        <div class="card-body d-flex justify-content-center">
                                                                            <button class="btn btn-primary btn-toggle-sidebar w-100"
                                                                                    data-bs-toggle="modal"
                                                                                    data-bs-target="#add-new-sidebar">
                                                                                <span class="align-middle">AGREGAR EVENTO</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="card-body pb-0">
                                                                            <h5 class="section-label mb-1">
                                                                                <span class="align-middle">FILTRO</span>
                                                                            </h5>
                                                                            <div class="form-check mb-1">
                                                                                <input type="checkbox"
                                                                                       class="form-check-input select-all"
                                                                                       id="select-all"
                                                                                       checked/>
                                                                                <label class="form-check-label"
                                                                                       for="select-all">VER TODO</label>
                                                                            </div>
                                                                            <div class="calendar-events-filter">
                                                                                <div class="form-check form-check-danger mb-1">
                                                                                    <input type="checkbox"
                                                                                           class="form-check-input input-filter"
                                                                                           id="personal"
                                                                                           data-value="personal" checked/>
                                                                                    <label class="form-check-label"
                                                                                           for="personal">UNIDADES
                                                                                        AUXILIARES</label>
                                                                                </div>
                                                                                <div class="form-check form-check-primary mb-1">
                                                                                    <input type="checkbox"
                                                                                           class="form-check-input input-filter"
                                                                                           id="business"
                                                                                           data-value="business" checked/>
                                                                                    <label class="form-check-label"
                                                                                           for="business">EVENTOS</label>
                                                                                </div>
                                                                                <div class="form-check form-check-warning mb-1">
                                                                                    <input type="checkbox"
                                                                                           class="form-check-input input-filter"
                                                                                           id="family"
                                                                                           data-value="family" checked/>
                                                                                    <label class="form-check-label"
                                                                                           for="family">NOTICIAS</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mt-auto">
                                                                        <img src="imagenes_sistema/escudo_estado_mexico.png"
                                                                             alt="Calendar illustration"
                                                                             class="img-fluid"/>
                                                                    </div>
                                                                </div>
                                                                <!-- /Sidebar -->

                                                                <!-- Calendar -->
                                                                <div class="col position-relative">
                                                                    <div class="card shadow-none border-0 mb-0 rounded-0">
                                                                        <div class="card-body pb-0">
                                                                            <div id="calendar"></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- /Calendar -->
                                                                <div class="body-content-overlay"></div>
                                                            </div>
                                                        </div>
                                                        <!-- Calendar Add/Update/Delete event modal-->
                                                        <div class="modal modal-slide-in event-sidebar fade"
                                                             id="add-new-sidebar">
                                                            <div class="modal-dialog sidebar-lg">
                                                                <div class="modal-content p-0">
                                                                    <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal" aria-label="Close">×
                                                                    </button>
                                                                    <div class="modal-header mb-1">
                                                                        <h5 class="modal-title">AGREGAR EVENTO</h5>
                                                                    </div>
                                                                    <div class="modal-body flex-grow-1 pb-sm-0 pb-3">
                                                                        <form class="event-form needs-validation"
                                                                              data-ajax="false" novalidate>
                                                                            <div class="mb-1">
                                                                                <label for="title"
                                                                                       class="form-label">TíTULO</label>
                                                                                <input type="text" class="form-control"
                                                                                       id="title" name="title"
                                                                                       placeholder="TÍTULO" required/>
                                                                            </div>
                                                                            <div class="mb-1">
                                                                                <label for="select-label"
                                                                                       class="form-label">TIPO DE
                                                                                    MENSSAJE</label>
                                                                                <select class="select2 select-label form-select w-100"
                                                                                        id="select-label"
                                                                                        name="select-label">
                                                                                    <option data-label="primary"
                                                                                            value="UNIDAD AUXILIAR"
                                                                                            selected>UNIDAD
                                                                                        AUXILIAR
                                                                                    </option>
                                                                                    <option data-label="danger"
                                                                                            value="EVENTOS">EVENTOS
                                                                                    </option>
                                                                                    <option data-label="warning"
                                                                                            value="NOTICIAS">NOTICIAS
                                                                                    </option>
                                                                                </select>
                                                                            </div>
                                                                            <div class="mb-1 position-relative">
                                                                                <label for="start-date" class="form-label">FECHA
                                                                                    DE INICIO</label>
                                                                                <input type="text" class="form-control"
                                                                                       id="start-date" name="start-date"
                                                                                       placeholder="FECHA DE INICIO"/>
                                                                            </div>
                                                                            <div class="mb-1 position-relative">
                                                                                <label for="end-date" class="form-label">FECHA
                                                                                    DE FINAL</label>
                                                                                <input type="text" class="form-control"
                                                                                       id="end-date" name="end-date"
                                                                                       placeholder="FECHA DE INICIO"/>
                                                                            </div>
                                                                            <div class="mb-1">
                                                                                <div class="form-check form-switch">
                                                                                    <input type="checkbox"
                                                                                           class="form-check-input allDay-switch"
                                                                                           id="customSwitch3"/>
                                                                                    <label class="form-check-label"
                                                                                           for="customSwitch3">TODO EL
                                                                                        DIA</label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="mb-1">
                                                                                <label for="event-url" class="form-label">LINK
                                                                                    DE PAGINA</label>
                                                                                <input type="url" class="form-control"
                                                                                       id="event-url"
                                                                                       placeholder="https://www.google.com"/>
                                                                            </div>
                                                                            <!-- <div class="mb-1 select2-primary">
                                                                        <label for="event-guests" class="form-label">Add Guests</label>
                                                                        <select class="select2 select-add-guests form-select w-100" id="event-guests" multiple>
                                                                            <option data-avatar="1-small.png" value="Jane Foster">Jane Foster</option>
                                                                            <option data-avatar="3-small.png" value="Donna Frank">Donna Frank</option>
                                                                            <option data-avatar="5-small.png" value="Gabrielle Robertson">Gabrielle Robertson</option>
                                                                            <option data-avatar="7-small.png" value="Lori Spears">Lori Spears</option>
                                                                            <option data-avatar="9-small.png" value="Sandy Vega">Sandy Vega</option>
                                                                            <option data-avatar="11-small.png" value="Cheryl May">Cheryl May</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="mb-1">
                                                                        <label for="event-location" class="form-label">Location</label>
                                                                        <input type="text" class="form-control" id="event-location" placeholder="Enter Location" />
                                                                    </div> -->
                                                                            <div class="mb-1">
                                                                                <label class="form-label">DESCRIPCION</label>
                                                                                <textarea name="event-description-editor"
                                                                                          id="event-description-editor"
                                                                                          class="form-control"></textarea>
                                                                            </div>
                                                                            <div class="mb-1 d-flex">
                                                                                <button type="submit"
                                                                                        class="btn btn-primary add-event-btn me-1">
                                                                                    AGREGAR
                                                                                </button>
                                                                                <button type="button"
                                                                                        class="btn btn-outline-secondary btn-cancel"
                                                                                        data-bs-dismiss="modal">CANCELAR
                                                                                </button>
                                                                                <button type="submit"
                                                                                        class="btn btn-primary update-event-btn d-none me-1">
                                                                                    ACTUALIZAR
                                                                                </button>
                                                                                <button class="btn btn-outline-danger btn-delete-event d-none">
                                                                                    ELIMINAR
                                                                                </button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--/ Calendar Add/Update/Delete event modal-->
                                                    </section>
                                                </div>
                                            </div>
                                            <?php include_once('pie_sistema/pie_calendario.php');
                                            }

 }

?>
