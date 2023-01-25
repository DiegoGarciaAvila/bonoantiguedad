<?php
include_once('./configuracion_sistema/configuracion.php');
include_once './librerias/PDOConsultas.php';
$str_session = 'SIN_SESSION';
$field = array();

/* $field[]=array('0 - nombre','1 - tabla','2 - posicion en el registro','3 - valor inicial' */
$field[] = array('cve_usuario', 'usuario', '1', 0);
$field[] = array('nom_usuario', 'usuario', '0', "");
$field[] = array('des_usuario', 'usuario', '1', "");
$field[] = array('cve_estatus', 'usuario', '1', "");
$field[] = array('cve_perfil', 'perfil', '0', 0);
$field[] = array('des_perfil', 'perfil', '1', "");
$field[] = array('sta_perfil', 'perfil', '1', "");
$field[] = array('user_image_file', 'perfil', '1', "");


$allf = array();
$allv = array();

foreach ($field as $afield) {
    $allf[] = $afield[0];
    $allv[] = $afield[3];
}
$IdPrin = '';
foreach ($field as $afield) {
    if ($afield[2] == '0') {
        $IdPrin = $afield[0];
        break;
    }
}

if ($__SESSION->getValueSession('nomusuario') <> "" && $__SESSION->getValueSession('passwd') <> "" && $__SESSION->getValueSession('cveperfil') <> "") {
    $IdPrin = $__SESSION->getValueSession('claveservidor');
    $pwd = $__SESSION->getValueSession('passwd');
    $consulta = new PDOConsultas();
    $consulta->connect($CFG_HOST[0], $CFG_USER[0], $CFG_DBPWD[0], $CFG_DBASE[0], $CFG_TIPO[0]);
   
   $datos_acceso = $consulta->executeQuery("SELECT 
                                                    u.cve_usuario, 
                                                    u.des_usuario, 
                                                    u.nom_usuario, 
                                                    u.cve_estatus, 
                                                    u.passwd, 
                                                    u.cve_perfil, 
                                                    p.des_perfil, 
                                                    p.alta, 
                                                    p.actualiza, 
                                                    p.elimina, 
                                                    u.cve_organismo, 
                                                    u.user_image_file, 
                                                    u.cve_usergroup, 
                                                    g.des_usergroup,
                                                    u.ClaveServidor
                                                    from sb_usuario u 
                                                    JOIN sb_perfil p ON u.cve_perfil = p.cve_perfil 
                                                    JOIN sb_usergroup g ON u.cve_usergroup=g.cve_usergroup 
                                                    Where u.ClaveServidor='$IdPrin' and u.cve_estatus <> 0 and u.passwd = '$pwd' and p.sta_perfil <> 0 ");
//print_r($datos_acceso);
//die();
    if ($consulta->totalRows > 0) {
        $str_session = 'SESSION_OK';
    }
} else {

    $str_session = 'SIN_DATOS';
}
