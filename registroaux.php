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
    <?php
    $consulta2 = new PDOConsultas();
    $consulta2->connect($CFG_HOST[0], $CFG_USER[0], $CFG_DBPWD[0], $CFG_DBASE[0]);

    $listaAds2 = $consulta2->executeQuery("SELECT * FROM cat_adscripcion");
    $listaPF2 = $consulta2->executeQuery("SELECT * FROM cat_puesto");
    $listaAJ2 = $consulta2->executeQuery("SELECT * FROM cat_activojubilado");
    $listaAD2 = $consulta2->executeQuery("SELECT * FROM cat_admindocente");
    $listaZE2 = $consulta2->executeQuery("SELECT * FROM cat_zonaescolar");
    $listaCD2 = $consulta2->executeQuery("SELECT * FROM cat_ciudaddom");
    $listaCT2 = $consulta2->executeQuery("SELECT * FROM cat_ciudadtra");

    $listaE2 = $consulta2->executeQuery("SELECT * FROM estper");
    $listaUA2 = $consulta2->executeQuery("SELECT * FROM cat_unidadejecutora");


    ?>
<body class="vertical-layout vertical-menu-modern blank-page navbar-floating footer-static " data-open="click" data-menu="vertical-menu-modern" data-col="blank-page">
    <div class="app-content content ">
        <div class="content-wrapper">
            <div class="content-body ">
                <div id="divform2" class="divform">
                    <h1 class="card-title fw-bold mb-1" style="text-align:center;"><b><a href="login.php"><?= $NOMBRE_CABECERA ?></a></b></h1>
                    <div class="content-header row">&nbsp;</div>
                    <div class="content-header row">&nbsp;</div>
                    <div class="content-header row"><img src="./imagenes_sistema/linea.png" width="15%"></div>
                    <div class="content-header row">&nbsp;</div>
                    <div class="content-header row">&nbsp;</div>
                    <div class="content-header row">&nbsp;</div>
                    <h5 class="card-title fw-bold mb-1" style="text-align:center;"><b><?= $NOMBRE_SUBCABECERA ?></b></h5>

                    <form method="POST" id="fomrgem2" class="align-items-center">

                        <div class="col-12 ">
                            <label class="form-label" for="NombreUsuario3">NOMBRE</label>
                            <input required type="text" id="NombreUsuario3" name="NombreUsuario3" class="form-control" placeholder="NOMBRE" />
                        </div>

                        <div class="col-12 ">
                            <label class="form-label" for="ApellidoPaterno3">APELLIDO PATERNO</label>
                            <input required type="text" id="ApellidoPaterno3" name="ApellidoPaterno3" class="form-control" placeholder="APELLIDO PATERNO" />
                        </div>

                        <div class="col-12 ">
                            <label class="form-label" for="ApellidoMaterno3">APELLIDO MATERNO</label>
                            <input required type="text" id="ApellidoMaterno3" name="ApellidoMaterno3" class="form-control"  placeholder="APELLIDO MATERNO" />
                        </div>
                        <div class="col-12 ">
                            <label class="form-label" for="Rfc3">RFC</label>
                            <input required type="text" id="Rfc3" name="Rfc3" class="form-control" placeholder="RFC" />
                        </div>
                        <div class="col-12 ">
                            <label class="form-label" for="Correo3">CORREO</label>
                            <input required type="email" id="Correo3" name="Correo3" class="form-control" placeholder="CORREO" pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}" />
                        </div>
                        <div class="col-12 ">
                            <label class="form-label" for="PASS3">CONTRASEÑA</label>
                            <div class="input-group">
                                <input required type="password" id="PASS3" name="PASS3" class="form-control" placeholder="CONTRASEÑA" />
                                <div class="input-group-append">
                                    <button id="show_password" class="btn btn-primary" type="button" onclick="mostrarPassword()"> <span class="fa fa-eye-slash icon"></span> </button>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 ">
                            <label class="form-label" for="PASSCON3">CONFIRMAR CONTRASEÑA</label>
                           <div class="input-group">
                               <input required type="password" id="PASSCON3" name="PASSCON3" class="form-control" placeholder="CONFIRMAR CONTRASEÑA" />
                               <div class="input-group-append">
                                   <button id="show_password2" class="btn btn-primary" type="button" onclick="mostrarPassword2()"> <span class="fa fa-eye-slash icon"></span> </button>
                               </div>
                           </div>
                        </div>

                        <div class="col-12 form-group">
                            <label class="form-label" for="CveAds3">ADSCRIPCION</label>
                            <select class="form-control" name="CveAds3" id="CveAds3" required>

                                <option value="">--SELECCION UNA OPCION--</option>
                                <?php
                                $la=0;

                                foreach ($listaAds2 as $keyla) {
                                    $la++;
                                    echo ("<option  value= \"" .  $la . "\" > " . $keyla['ADescripcion'] . "</option> ");

                                }
                                ?>
                            </select>
                        </div>

                        <div class="col-12 ">
                            <label class="form-label" for="FechaIngAds3">FECHA DE INGRESO A DEPENDENCIA</label>
                            <input required type="date" id="FechaIngAds3" name="FechaIngAds3" class="form-control" placeholder= "FECHA DE INGRESO A ADCRIPCION" />
                        </div>

                        <div class="col-12 form-group">
                            <label class="form-label" for="CvePF3">PUESTO FUNCIONAL</label>
                            <select class="form-control" name="CvePF3" id="CvePF3" required>
                                <option value="">--SELECCION UNA OPCION--</option>
                                <?php
                                $pf=0;
                                foreach ($listaPF2 as $keypf) {
                                    $pf++;
                                    echo ("<option  value= \"" . $pf . "\" > " . $keypf['PDescripcion'] . "</option> ");


                                }
                                ?>
                            </select>
                        </div>

                        <div class="col-12 form-group">
                            <label class="form-label" for="CveAJ3">ACTIVO/JUBILADO</label>
                            <select class="form-control" name="CveAJ3" id="CveAJ3" required>
                                <option value="">--SELECCION UNA OPCION--</option>
                                <?php
                                $aj=0;
                                foreach ( $listaAJ2 as $keyAJ) {
                                    $aj++;
                                    echo ("<option  value= \"" . $aj . "\" > " . $keyAJ['AJDescripcion'] . "</option> ");

                                }
                                ?>
                            </select>
                        </div>

                        <div class="col-12 form-group">
                            <label class="form-label" for="CveAD3">ADMINISTRATIVO/DOCENTE</label>
                            <select class="form-control" name="CveAD3" id="CveAD3" required>
                                <option value="">--SELECCION UNA OPCION--</option>
                                <?php
                                $ad=0;
                                foreach ( $listaAD2 as $keyAD) {
                                    $ad++;
                                    echo ("<option  value= \"" . $ad . "\" > " . $keyAD['ADDescripcion'] . "</option> ");

                                }
                                ?>
                            </select>
                        </div>

                        <div class="col-12 form-group">
                            <label class="form-label" for="CveZE3">ZONA ESCOLAR</label>
                            <select class="form-control" name="CveZE3" id="CveZE3">
                                <option value="">--SELECCION UNA OPCION--</option>
                                <?php
                                $ze=0;
                                foreach ( $listaZE2 as $keyZE) {
                                    $ze++;
                                    echo ("<option  value= \"" . $ze . "\" > " . $keyZE['ZEDescripcion'] . "</option> ");

                                }
                                ?>
                            </select>
                        </div>

                        <div class="col-12 form-group">
                            <label class="form-label" for="CveCD3">CIUDAD DOMICILIO</label>
                            <select class="form-control" name="CveCD3" id="CveCD3" required>

                                <option value="">--SELECCION UNA OPCION--</option>
                                <?php
                                $j=0;
                                foreach ($listaCD2 as $keys) {
                                    $j++;
                                    echo ("<option  value= \"" . $j . "\" > " . $keys['CDDescripcion'] . "</option> ");

                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-12 ">
                            <label class="form-label" for="TelCD3">TELEFONO PERSONAL</label>
                            <input required type="number" id="TelCD3" name="TelCD3" class="form-control" placeholder="TELEFONO DE DOMICILIO" />
                        </div>
                        <div class="col-12 form-group">
                            <label class="form-label" for="CveCT3">CIUDAD TRABAJO</label>
                            <select class="form-control" name="CveCT3" id="CveCT3" required>

                                <option value="">--SELECCION UNA OPCION--</option>
                                <?php
                                $i=0;
                                foreach ($listaCT2 as $key) {
                                    $i++;
                                    echo ("<option  value= \"" . $i . "\" > " . $key['CTDescripcion'] . "</option> ");

                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-12 ">
                            <label class="form-label" for="TelCT3">TELEFONO TRABAJO</label>
                            <input required type="number" id="TelCT3" name="TelCT3" class="form-control" placeholder="TELEFONO DE TRABAJP" />
                        </div>
                        <div class="col-12 ">
                            <label class="form-label" for="Issemmym3">ISSEMMYM</label>
                            <input required type="number" id="Issemmym3" name="Issemmym3" class="form-control"  placeholder="ISSEMMYM" />
                        </div>


                        <div class="col-12 form-group">
                            <label class="form-label" for="Sindicalizado3">SINDICALIZADO</label>
                            <select class="form-control" name="Sindicalizado3" id="Sindicalizado3" required>
                                <option value="">--SELECCION UNA OPCION--</option>
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>

                            </select>
                        </div>

                        <div class="col-12 ">
                            <label class="form-label" for="NivelRango3">NIVEL Y RANGO</label>
                            <input required type="text" id="NivelRango3" name="NivelRango3" class="form-control" placeholder="" />
                        </div>

                        <button type="submit" class="btn btn-primary" name="botonregistroaux2">Registrarse</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        function mostrarPassword2(){
            var cambio = document.getElementById("PASSCON3");
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
            var cambio = document.getElementById("PASS3");
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
    var input=  document.getElementById('TelCT3');
    input.addEventListener('input',function(){
        if (this.value.length > 10)
            this.value = this.value.slice(0,10);
    })


    var input=  document.getElementById('TelCD3');
    input.addEventListener('input',function(){
        if (this.value.length > 10)
            this.value = this.value.slice(0,10);
    })
</script>
    <script>
        var input=  document.getElementById('Rfc3');
        input.addEventListener('input',function(){
            if (this.value.length > 13)
                this.value = this.value.slice(0,13);
        })


    </script>

    <?php
    if ($_POST != null) {

        $NombreUsuario3 = $_POST["NombreUsuario3"];
        $ApellidoPaterno3 = $_POST["ApellidoPaterno3"];
        $ApellidoMaterno3 = $_POST["ApellidoMaterno3"];
        $Rfc3 = $_POST["Rfc3"];
        $Correo3 = $_POST["Correo3"];
        $PASS3 = $_POST["PASS3"];
        $PASSCON3 = $_POST["PASSCON3"];
        $CveAds3 = $_POST["CveAds3"];
        $FechaIngAds3 = $_POST["FechaIngAds3"];
        $CvePF3 = $_POST["CvePF3"];
        $CveAJ3 = $_POST["CveAJ3"];
        $CveAD3 = $_POST["CveAD3"];
        $CveZE3 = $_POST["CveZE3"];
        $CveCD3 = $_POST["CveCD3"];
        $TelCD3 = $_POST["TelCD3"];
        $CveCT3 = $_POST["CveCT3"];
        $TelCT3 = $_POST["TelCT3"];
        $Issemmym3 = $_POST["Issemmym3"];

        $Sindicalizado3 = $_POST["Sindicalizado3"];
        $NivelRango3 = $_POST["NivelRango3"];

        $hoy = getdate();
        $fecha = $hoy['year'] . '-' . $hoy['mon'] . '-' . $hoy['mday'];

        $claveservidor= $Rfc3+substr($NombreUsuario3,1,3);

        if ($PASS3 == $PASSCON3) {


            $PASSCON3 = base64_encode($PASSCON3);

            $consulta = new PDOConsultas();
            $consulta->connect($CFG_HOST[0], $CFG_USER[0], $CFG_DBPWD[0], $CFG_DBASE[0], $CFG_TIPO[0]);
            $select2 = $consulta->executeQuery("INSERT INTO sb_usuario (ClaveServidor,nom_usuario,ApePat,ApeMat,email,passwd,Rfc,des_usuario,cve_estatus,cve_perfil,cve_usergroup,CveAds,CvePF,CveAJ,CveAD,FechaIngAds,CveZE,CveCD,TelCD,CveCT,TelCT,Issemmym,CveM,CveE,Sindicalizado,NivelRango,FecRegSis)
            values ($claveservidor,
                    '$NombreUsuario3',
                    '$ApellidoPaterno3',
                    '$ApellidoMaterno3',
                    '$Correo3',
                    '$PASSCON3',
                    '$Rfc3',
                    'SERVIDOR PUBLICO',
                    1,
                    4,
                    1,
                    $CveAds3,
                    $CvePF3,
                    $CveAJ3,
                    $CveAD3,
                    '$FechaIngAds3',
                    $CveZE3,
                    $CveCD3,
                    '$TelCD3',
                    $CveCT3,
                    '$TelCT3',
                    '$Issemmym3',
                    1,
                    5,
                    '$Sindicalizado3',
                    '$NivelRango3',
                    '$fecha');");


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


</body>

</html>