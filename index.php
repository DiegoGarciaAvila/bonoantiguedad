<?php

if (strlen(session_id()) == 0) {
    session_start();
    include_once("configuracion_sistema/configuracion.php");
    if (isset($_SESSION["ultimoAcceso"])) {
        $ahora = date("Y-n-j H:i:s");
        $tiempo_transcurrido = (strtotime($ahora) - strtotime($_SESSION["ultimoAcceso"]));
        if ($tiempo_transcurrido >= 3000) {
            unset($_SESSION[_CFGSBASE]);
            header("Location: logout.php");
            session_destroy();
        } else {
            $_SESSION["ultimoAcceso"] = $ahora;
        }
    } else {
        $_SESSION["ultimoAcceso"] = date("Y-n-j H:i:s");
    }
} else {
    session_destroy();
    header("Location: index.php");
    include_once("configuracion_sistema/configuracion.php");
    unset($_SESSION[_CFGSBASE]);
}

if ($__SESSION->getValueSession('nomusuario') == "" || $__SESSION->getValueSession('passwd') == "") {
    unset($_SESSION[_CFGSBASE]);
    $str_login = "";
    $str_gets = "";
    include_once("includes/sb_acceso.php");
?>
    <!DOCTYPE html>
    <html>

    <head>
        <title><?= $NOMBRE_TITLE ?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="Content-Security-Policy" content="img-src 'self' data:; default-src 'self' http://127.0.0.1/<?= $NOMBRE_CARPETA_PRINCIPAL ?>/">
        <meta content="text/html; charset=UTF-8; X-Content-Type-Options=nosniff" http-equiv="Content-Type" />
        <link rel="shortcut icon" type="image/x-icon" href="imagenes_sistema/escudo_estado_mexico.png">
    </head>

    <body>
    <?php

    $str_refresh = "login.php";
    switch ($str_login) {
        case 'SESSION_00':
            $_SESSION[_CFGSBASE] = array();
            $__SESSION->setValueSession('cveusuario', $datos_acceso[0]['cve_usuario']);
            $__SESSION->setValueSession('nomusuario', $datos_acceso[0]['nom_usuario']);
            $__SESSION->setValueSession('desusuario', $datos_acceso[0]['des_usuario']);
            $__SESSION->setValueSession('desperfil', $datos_acceso[0]['des_perfil']);
            $__SESSION->setValueSession('passwd', $datos_acceso[0]['passwd']);
            $__SESSION->setValueSession('cveperfil', $datos_acceso[0]['cve_perfil']);
            $__SESSION->setValueSession('cveorganismo', $datos_acceso[0]['cve_organismo']);
            $__SESSION->setValueSession('alta', $datos_acceso[0]['alta']);
            $__SESSION->setValueSession('actualiza', $datos_acceso[0]['actualiza']);
            $__SESSION->setValueSession('elimina', $datos_acceso[0]['elimina']);
            $__SESSION->setValueSession('user_image_file', $datos_acceso[0]['user_image_file']);
            $__SESSION->setValueSession('cve_usergroup', $datos_acceso[0]['cve_usergroup']);
            $__SESSION->setValueSession('des_usergroup', $datos_acceso[0]['des_usergroup']);
            $__SESSION->setValueSession('cve_15', $datos_acceso[0]['cve_15']);
            $__SESSION->setValueSession('cve_torganismo', $datos_acceso[0]['cve_torganismo']);
            $__SESSION->setValueSession('claveservidor', $datos_acceso[0]['ClaveServidor']);

            // $__SESSION->setValueSession('id_session', controlSessiones($datos_acceso));
            $str_refresh = "index.php";
            break;
    }
    echo "<meta http-equiv='refresh' content='0;URL=" . $str_refresh . "'>";
    echo "</body>";
    echo "</html>";
} else {
    include_once("includes/sb_valusu.php");
    if ($str_session == 'SESSION_OK') {
        include_once("wprincipal.php");
    } else {
        echo "<body topmargin=\"0\" leftmargin=\"0\">";
        echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"estilos/estilo.css\" />";
        include_once("includes/sb_msg_red.php");
        $str_refresh = "login.php";
        echo "<meta http-equiv='refresh' content='0;URL=" . $str_refresh . "'>";
        echo "</body>";
        echo "</html>";
    }
}

function controlSessiones($datos_acceso)
{
    include_once("librerias/PDOConsultas.php");
    $CFG_HOST = array("127.0.0.1");
    $CFG_USER = array("root");
    $CFG_DBPWD = array("");
    $CFG_DBASE = array("dbsectorauxiliar");

    $cve_usuario = $datos_acceso[0]['cve_usuario'];
    $des_usuario = $datos_acceso[0]['des_usuario'];
    $cve_perfil = $datos_acceso[0]['cve_perfil'];
    $fecha_inicio = date('Y-m-d H:i:s');
    $id_session = session_id() . rand(5642, 99999826);

    $consulta = new PDOConsultas();
    $consulta->connect($CFG_HOST[0], $CFG_USER[0], $CFG_DBPWD[0], $CFG_DBASE[0],$CFG_TIPO[0]);
    $consulta->insert(
        "sb_audit_session",
        array(
            "cve_usuario" => $cve_usuario, "cve_perfil" => $cve_perfil,
            "fecha_inicio" => $fecha_inicio, "nom_usuario" => $des_usuario, "id_session" => $id_session
        )
    );
    return $id_session;
}
