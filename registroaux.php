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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.all.min.js"></script>
    <script src="sweetalert2.min.js"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">
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

        box-shadow: inset 0 -3em 3em rgba(0, 0, 0, 0.0),
        0 0 0 2px rgb(254, 254, 254),
        0.3em 0.3em 1em rgba(0, 0, 0, 0.3);
    }
</style>
<?php
$consulta2 = new PDOConsultas();
$consulta2->connect($CFG_HOST[0], $CFG_USER[0], $CFG_DBPWD[0], $CFG_DBASE[0]);

$listaAds2 = $consulta2->executeQuery("SELECT * FROM cat_adscripcion");
$listaPF2 = $consulta2->executeQuery("SELECT * FROM cat_puesto");
$listaAJ2 = $consulta2->executeQuery("SELECT * FROM cat_activojubilado");
$listaAD2 = $consulta2->executeQuery("SELECT * FROM cat_admindocente");

$listaEst = $consulta2->executeQuery("SELECT * FROM cat_estado");
$listaCD2 = $consulta2->executeQuery("SELECT * FROM cat_ciudaddom");


$listaCT2 = $consulta2->executeQuery("SELECT * FROM cat_ciudadtra");


$listaE2 = $consulta2->executeQuery("SELECT * FROM estper");
$listaUA2 = $consulta2->executeQuery("SELECT * FROM cat_unidadejecutora");
$listaZE2 = $consulta2->executeQuery("SELECT * FROM cat_zonaescolar");


?>
<body class="vertical-layout vertical-menu-modern blank-page navbar-floating footer-static " data-open="click"
      data-menu="vertical-menu-modern" data-col="blank-page">
<div class="app-content content ">
    <div class="content-wrapper">
        <div class="content-body ">
            <div id="divform2" class="divform">
                <h1 class="card-title fw-bold mb-1" style="text-align:center;"><b><a
                                href="login.php"><?= $NOMBRE_CABECERA ?></a></b></h1>
                <div class="content-header row">&nbsp;</div>
                <div class="content-header row">&nbsp;</div>
                <div class="content-header row"><img src="./imagenes_sistema/linea.png" width="15%"></div>
                <div class="content-header row">&nbsp;</div>
                <div class="content-header row">&nbsp;</div>
                <h5 class="card-title fw-bold mb-1" style="text-align:center;"><b><?= $NOMBRE_SUBCABECERA ?></b></h5>

                <form id="fomrgem2" class="align-items-center" method="post" >
                    <div class="row">

                        <div class="col-6 ">
                            <label class="form-label" for="NombreUsuario3">NOMBRE (S)</label>
                            <input required type="text" id="NombreUsuario3" name="NombreUsuario3" class="form-control"
                                   value="<?php echo $_POST["NombreUsuario3"]; ?>" placeholder="NOMBRE(S)"/>
                        </div>

                        <div class="col-6">
                            <label class="form-label" for="ApellidoPaterno3">APELLIDO PATERNO</label>
                            <input required type="text" id="ApellidoPaterno3" name="ApellidoPaterno3"
                                   class="form-control" value="<?php echo $_POST["ApellidoPaterno3"]; ?>" placeholder="APELLIDO PATERNO"/>
                        </div>

                        <div class="col-6 ">
                            <label class="form-label" for="ApellidoMaterno3">APELLIDO MATERNO</label>
                            <input required type="text" id="ApellidoMaterno3" name="ApellidoMaterno3"
                                   class="form-control" value="<?php echo $_POST["ApellidoMaterno3"]; ?>" placeholder="APELLIDO MATERNO"/>
                        </div>

                        <div class="col-6 ">
                            <label class="form-label" for="Rfc3">RFC</label>
                            <input required type="text" id="Rfc3" name="Rfc3" class="form-control" value="<?php echo $_POST["Rfc3"]; ?>" placeholder="RFC"/>
                        </div>

                        <div class="col-4 ">
                            <label class="form-label" for="Correo3">CORREO</label>
                            <input required type="email" id="Correo3" name="Correo3" class="form-control"
                                   value="<?php echo $_POST["Correo3"]; ?>" placeholder="@CORREO.COM"
                                   pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}"/>
                        </div>

                        <div class="col-4 ">
                            <label class="form-label" for="PASS3">CONTRASEÑA</label>
                            <div class="input-group">
                                <input required type="password" id="PASS3" name="PASS3" class="form-control"
                                       placeholder="CONTRASEÑA"/>
                                <div class="input-group-append">
                                    <button id="show_password" class="btn btn-primary" type="button"
                                            onclick="mostrarPassword()"><span class="fa fa-eye-slash icon"></span>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="col-4 ">
                            <label class="form-label" for="PASSCON3">CONFIRMAR CONTRASEÑA</label>
                            <div class="input-group">
                                <input required type="password" id="PASSCON3" name="PASSCON3" class="form-control"
                                        placeholder="CONFIRMAR CONTRASEÑA"/>
                                <div class="input-group-append">
                                    <button id="show_password2" class="btn btn-primary" type="button"
                                            onclick="mostrarPassword2()"><span class="fa fa-eye-slash icon"></span>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="col-6 form-group">
                            <label class="form-label" for="CveAds3">ADSCRIPCIÓN</label>
                            <select class="form-control" name="CveAds3" id="CveAds3" required>

                                <option value="">--SELECCION UNA OPCIÓN--</option>
                                <?php
                                $la = 0;

                                foreach ($listaAds2 as $keyla) {
                                    $la++;
                                    echo("<option  value= \"" . $la . "\" > " . $keyla['AClave'] ." - ". $keyla['ADescripcion']  . "</option> ");

                                }
                                ?>
                            </select>
                        </div>

                        <div class="col-6 ">
                            <label class="form-label" for="FechaIngAds3">FECHA DE INGRESO A DEPENDENCIA</label>
                            <input required type="date" id="FechaIngAds3" name="FechaIngAds3" class="form-control"
                                   value="<?php echo $_POST["FechaIngAds3"]; ?>" placeholder="FECHA DE INGRESO A ADCRIPCION"/>
                        </div>

                        <div class="col-6 form-group">
                            <label class="form-label" for="CvePF3">PUESTO FUNCIONAL</label>
                            <select class="form-control" name="CvePF3" id="CvePF3" required>
                                <option value="">--SELECCION UNA OPCIÓN--</option>
                                <?php
                                $pf = 0;
                                foreach ($listaPF2 as $keypf) {
                                    $pf++;
                                    echo("<option  value= \"" . $pf . "\" > " . $keypf['PClave'] . " - ".$keypf['PDescripcion']  ."</option> ");


                                }
                                ?>
                            </select>
                        </div>

                        <div class="col-6 form-group">
                            <label class="form-label" for="CveAJ3">ACTIVO/JUBILADO</label>
                            <select class="form-control" name="CveAJ3" id="CveAJ3" required>
                                <option value="">--SELECCION UNA OPCIÓN--</option>
                                <?php
                                $aj = 0;
                                foreach ($listaAJ2 as $keyAJ) {
                                    $aj++;
                                    echo("<option  value= \"" . $aj . "\" > " . $keyAJ['AJDescripcion'] . "</option> ");

                                }
                                ?>
                            </select>
                        </div>

                        <div class="col-6 form-group">
                            <label class="form-label" for="CveAD3">ADMINISTRATIVO/DOCENTE</label>
                            <select class="form-control" name="CveAD3" id="CveAD3" required>
                                <option value="">--SELECCION UNA OPCIÓN--</option>
                                <?php
                                $ad = 0;
                                foreach ($listaAD2 as $keyAD) {
                                    $ad++;
                                    echo("<option  value= \"" . $ad . "\" > " . $keyAD['ADDescripcion'] . "</option> ");

                                }
                                ?>
                            </select>
                        </div>

                        <div class="col-6 form-group">
                            <label class="form-label" for="CveZE3">ZONA ESCOLAR</label>
                            <select class="form-control" name="CveZE3" id="CveZE3">
                                <option value="0">--SELECCION UNA OPCIÓN--</option>
                                <?php
                                $ze = 0;
                                foreach ($listaZE2 as $keyZE) {
                                    $ze++;
                                    echo("<option  value= \"" . $ze . "\" > " . $keyZE['ZEClave'] . " - ".$keyZE['ZEDescripcion'] . "</option> ");

                                }
                                ?>
                            </select>
                        </div>

                        <div class="col-4 form-group">
                            <label class="form-label" for="CveEst3">ESTADO DE DOMICILIO</label>
                            <select class="form-control" name="CveEst3" id="CveEst3" required>
                                <option value="">--SELECCION UNA OPCIÓN--</option>
                                <?php
                                $est = 0;
                                foreach ($listaEst as $keyest) {
                                    $est++;
                                    echo("<option  value= \"" . $est . "\" > " . $keyest['des_estado'] . "</option> ");
                                }
                                ?>
                            </select>
                        </div>

                        <div class="col-4 form-group">
                            <label class="form-label" for="CveCD3">CIUDAD DOMICILIO</label>
                            <select class="form-control" name="CveCD3" id="CveCD3" required>
                                <option value="">--SELECCION UNA OPCIÓN--</option>

                            </select>
                        </div>

                        <div class="col-4 ">
                            <label class="form-label" for="TelCD3">TELÉFONO PERSONAL</label>
                            <input required type="number" id="TelCD3" name="TelCD3" class="form-control"
                                   value="<?php echo $_POST["TelCD3"]; ?>" placeholder="TELÉFONO PERSONAL"/>
                        </div>

                        <div class="col-4 form-group">
                            <label class="form-label" for="CveEst32">ESTADO DE TRABAJO</label>
                            <select class="form-control" name="CveEst32" id="CveEst32" required>
                                <option value="">--SELECCION UNA OPCIÓN--</option>
                                <?php
                                $est2 = 0;
                                foreach ($listaEst as $keyest2) {
                                    $est2++;
                                    echo("<option  value= \"" . $est2 . "\" > " . $keyest2['des_estado'] . "</option> ");
                                }
                                ?>
                            </select>
                        </div>

                        <div class="col-4 form-group">
                            <label class="form-label" for="CveCT3">CIUDAD TRABAJO</label>
                            <select class="form-control" name="CveCT3" id="CveCT3" required>

                                <option value="">--SELECCION UNA OPCIÓN--</option>

                            </select>
                        </div>

                        <div class="col-4 ">
                            <label class="form-label" for="TelCT3">TELÉFONO TRABAJO</label>
                            <input required type="number" inputmode="numeric" id="TelCT3" name="TelCT3" class="form-control"
                                value="<?php echo $_POST["TelCT3"]; ?>" placeholder="TELÉFONO DE TRABAJO"/>
                        </div>

                        <div class="col-4 ">
                            <label class="form-label" for="Issemmym3">ISSEMMYM</label>
                            <input required type="number" id="Issemmym3" name="Issemmym3" class="form-control"
                                value="<?php echo $_POST["Issemmym3"]; ?>" placeholder="ISSEMMYM"/>
                        </div>


                        <div class="col-4 form-group">
                            <label class="form-label" for="Sindicalizado3">SINDICALIZADO</label>
                            <select class="form-control" name="Sindicalizado3" id="Sindicalizado3" required>
                                <option value="">--SELECCION UNA OPCIÓN--</option>
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>

                            </select>
                        </div>

                        <div class="col-4 ">
                            <label class="form-label" for="NivelRango3">NIVEL Y RANGO</label>
                            <input required type="text" id="NivelRango3" name="NivelRango3" class="form-control"
                                   value="<?php $_POST["NivelRango3"]; ?>" placeholder=""/>
                        </div>

                    </div>
                    </br>

                    <button id="botonregistroaux2"  class="btn btn-primary" name="botonregistroaux2" >Registrarse</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById("CveEst3").addEventListener("change", function () {
        var idPadre = this.value;
        var hijo = document.getElementById("CveCD3");
        hijo.innerHTML = "<option value=''>Seleccione una opción</option>";
        var opcionesHijo = <?php echo json_encode($listaCD2); ?>;
        var opciones = opcionesHijo.filter(opcion => opcion['cve_estado'] == idPadre);
        if (opciones.length) {
            opciones.forEach(opcion => {
                hijo.innerHTML += "<option value='" + opcion['CDCveCD'] + "'>" + opcion['CDDescripcion'] + "</option>";
            });
            //     hijo.style.display = "inline-block";
        } else {
            //    hijo.style.display = "none";
        }
    });

    //----------------------------------Segundo
    document.getElementById("CveEst32").addEventListener("change", function () {
        var idPadre = this.value;
        var hijo = document.getElementById("CveCT3");
        hijo.innerHTML = "<option value=''>Seleccione una opción</option>";


        var opcionesHijo = <?php echo json_encode($listaCT2); ?>

        var opciones = opcionesHijo.filter(opcion => opcion['cve_estado'] == idPadre);
        if (opciones.length) {
            opciones.forEach(opcion => {
                hijo.innerHTML += "<option value='" + opcion['CTCveCT'] + "'>" + opcion['CTDescripcion'] + "</option>";
            });
            //hijo.style.display = "inline-block";
        } else {
            // hijo.style.display = "none";
        }
    });
</script>



<script type="text/javascript">
    function mostrarPassword2() {
        var cambio = document.getElementById("PASSCON3");
        if (cambio.type == "password") {
            cambio.type = "text";
            $('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
        } else {
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
    function mostrarPassword() {
        var cambio = document.getElementById("PASS3");
        if (cambio.type == "password") {
            cambio.type = "text";
            $('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
        } else {
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
    var input = document.getElementById('TelCT3');
    input.addEventListener('input', function () {
        if (this.value.length > 10)
            this.value = this.value.slice(0, 10);
    })


    var input = document.getElementById('TelCD3');
    input.addEventListener('input', function () {
        if (this.value.length > 10)
            this.value = this.value.slice(0, 10);
    })
</script>
<script>
    var input = document.getElementById('Rfc3');
    input.addEventListener('input', function () {
        if (this.value.length > 13)
            this.value = this.value.slice(0, 13);
    })


</script>
<script>
    $(document).ready(function() {
        $("#botonregistroaux2").click(function(e) {
            e.preventDefault();
            const form = document.getElementById("fomrgem2");

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
            formData.append("NombreUsuario3", $('#NombreUsuario3').val());
            formData.append("ApellidoPaterno3", $('#ApellidoPaterno3').val());
            formData.append("ApellidoMaterno3", $('#ApellidoMaterno3').val());
            formData.append("Rfc3", $('#Rfc3').val());
            formData.append("Correo3", $('#Correo3').val());
            formData.append("PASS3", $('#PASS3').val());
            formData.append("PASSCON3", $('#PASSCON3').val());
            formData.append("CveAds3", $('#CveAds3').val());
            formData.append("FechaIngAds3", $('#FechaIngAds3').val());
            formData.append("CvePF3", $('#CvePF3').val());
            formData.append("CveAJ3", $('#CveAJ3').val());
            formData.append("CveAD3", $('#CveAD3').val());
            formData.append("CveZE3", $('#CveZE3').val());
            formData.append("CveCD3", $('#CveCD3').val());
            formData.append("TelCD3", $('#TelCD3').val());
            formData.append("CveCT3", $('#CveCT3').val());
            formData.append("TelCT3", $('#TelCT3').val());
            formData.append("Issemmym3", $('#Issemmym3').val());
            formData.append("Sindicalizado3", $('#Sindicalizado3').val());
            formData.append("NivelRango3", $('#NivelRango3').val());

            $.ajax({
                url: "ajax_sistema/registro_aux.php",
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
                        title: 'ERROR EN LA QUERY',
                        showConfirmButton: false,
                        timer: 1700
                    });
                } else if (res == "3") {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'CUENTA CREADA',
                        text: 'Ya puedes ingresar al sistema usando tu RFC',
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
                        title: 'ERROR EN EL QUERY DOS',
                        showConfirmButton: false,
                        timer: 1700
                    });
                } else if (res == "5") {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'warning',
                        title: 'Las contraseñas son diferentes',
                        showConfirmButton: true,
                    });
                }
            });
        }
    });
    </script>






</body>

</html>