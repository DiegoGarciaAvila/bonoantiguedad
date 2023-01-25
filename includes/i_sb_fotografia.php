<?php
$str_check = FALSE;
include_once("sb_ii_check.php");
if ($str_check) {
    $IdPrin = $__SESSION->getValueSession('cveperfil');
    $mod = $__SESSION->getValueSession('mod');
    $consulta = new PDOConsultas();
    $consulta->connect($CFG_HOST[0], $CFG_USER[0], $CFG_DBPWD[0], $CFG_DBASE[0]);
    $modulo_acceso = $consulta->executeQuery("SELECT *
                                                        FROM
                                                        sb_perfil_modulo, sb_modulo
                                                        Where sb_perfil_modulo.cve_perfil =" . $IdPrin . "
                                                        and sb_perfil_modulo.cve_modulo =" . $mod . "
                                                        and sb_perfil_modulo.cve_modulo = sb_modulo.cve_modulo
                                                        and sb_modulo.status_modulo <>0");


    $str_valmodulo = "MOD_NOVALIDO";
    if ($consulta->totalRows > 0) {
        //CAMBIA EL TEXTO DEL BOTON
        $boton_texto = "NUEVO REGISTRO";
        $campo = array();
        $entidad = 'AQUI VA EL NOMBRE';
        $id_prin = 'cve_persona';
        $strWhere = '';
        $a_order = array();
        $impresora = FALSE;
        $tamanio_tabla = "100%";
        $intlimit = 10;

        $tabla = 'sb_persona';
        $campos_join  = '';
        $tabla_join = '';

        
        $field[] = array('user_image_file', 'cve_15', 'VISTA', 'text', 'OBLIGATORIO', 'varchar', '', array(0, 4), '30', '', array());

        $str_entidad = "entidad.php";
        $str_addentidad = "addentidad.php";
        $str_updentidad = "updentidad.php";
    }
} else {
    include_once("../configuracion_sistema/configuracion.php");
    include_once("sb_ii_refresh.php");
}
