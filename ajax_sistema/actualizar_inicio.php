<?php
require_once '../configuracion_sistema/configuracion.php';
require_once '../librerias/PDOConsultas.php';



    $ClaveServidorIN = $_POST["ClaveServidorIN"];
    $NombreUsuarioIN = $_POST["NombreUsuarioIN"];
    $ApellidoPaternoIN = $_POST["ApellidoPaternoIN"];
    $ApellidoMaternoIN = $_POST["ApellidoMaternoIN"];
    $RfcIN = $_POST["RfcIN"];
    $CorreoIN = $_POST["CorreoIN"];
    $CveAdsIN = $_POST["CveAdsIN"];
    $CvePFIN = $_POST["CvePFIN"];
    $CveAJIN = $_POST["CveAJIN"];
    $CveADIN = $_POST["CveADIN"];
    $CveZEIN = $_POST["CveZEIN"];
    $CveCDIN = $_POST["CveCDIN"];
    $TelCDIN = $_POST["TelCDIN"];
    $CveCTIN = $_POST["CveCTIN"];
    $TelCTIN = $_POST["TelCTIN"];
    $IssemmymIN = $_POST["IssemmymIN"];
    $CveUAIN = $_POST["CveUAIN"];
    $SindicalizadoIN = $_POST["SindicalizadoIN"];
    $NivelRangoIN = $_POST["NivelRangoIN"];

    $CveEstatus=$_POST["CveEstatus"];
    $cve_usuarioIN=$_POST["cve_usuario"];

    $consulta2 = new PDOConsultas();
    $consulta2->connect($CFG_HOST[0], $CFG_USER[0], $CFG_DBPWD[0], $CFG_DBASE[0]);
    $actualisausuario = " UPDATE sb_usuario SET " .
        " nom_usuario = '" . $NombreUsuarioIN . "'," .
        " ApePat = '" . $ApellidoPaternoIN . "'," .
        " ApeMat = '" . $ApellidoMaternoIN . "'," .
        " Rfc = '" . $RfcIN . "'," .
        " email = '" . $CorreoIN . "'," .
        " CveAds = " . $CveAdsIN . "," .
        " CvePF = " . $CvePFIN . "," .
        " CveAJ = " . $CveAJIN . "," .
        " CveAD = " . $CveADIN . "," .
        " CveZE = " . $CveZEIN . "," .
        " CveCD = " . $CveCDIN . "," .
        " TelCD = '" . $TelCDIN . "'," .
        " CveCT = " . $CveCTIN . "," .
        " TelCT = '" . $TelCTIN . "'," .
        " Issemmym = '" . $IssemmymIN . "'," .
        " CveUA = " . $CveUAIN . "," .
        " Sindicalizado = '" . $SindicalizadoIN . "'," .
        " NivelRango = '" . $NivelRangoIN . "'," .
        " CveE = ".$CveEstatus." " .
        " WHERE cve_usuario = '" . $cve_usuarioIN. "'";



    $consulta2->executeQuery($actualisausuario);
    if ($consulta2->lastInsertId != 'null') {
        echo "1";
    } else {
        echo "2";
    }

?>
