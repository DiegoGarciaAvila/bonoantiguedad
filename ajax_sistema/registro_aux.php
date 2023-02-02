<?php

require_once '../configuracion_sistema/configuracion.php';
require_once '../librerias/PDOConsultas.php';

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

    $claveservidor = "$Rfc3";


    if ($PASS3 == $PASSCON3) {

        $PASSCON3 = base64_encode($PASSCON3);

        $consulta = new PDOConsultas();
        $consulta->connect($CFG_HOST[0], $CFG_USER[0], $CFG_DBPWD[0], $CFG_DBASE[0], $CFG_TIPO[0]);
        $select2 = $consulta->executeQuery("INSERT INTO sb_usuario (ClaveServidor,nom_usuario,ApePat,ApeMat,email,passwd,Rfc,des_usuario,cve_estatus,cve_perfil,cve_usergroup,CveAds,CvePF,CveAJ,CveAD,FechaIngAds,CveZE,CveCD,TelCD,CveCT,TelCT,Issemmym,CveM,CveE,Sindicalizado,NivelRango,FecRegSis)
                values ('$claveservidor',
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

                    echo "1";

                } else {
                    $error = $consulta->error;
                    echo "2" ;

                }
            } else {

                echo "3";

            }
        } else {
            echo "4";
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
        echo "5";

    }

?>
