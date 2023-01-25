<?php
$str_check = FALSE;
include_once("sb_ii_check.php");
if ($str_check) {
    $IdPrin = $__SESSION->getValueSession('cveperfil');
    $mod = $__SESSION->getValueSession('mod');
    $consulta = new PDOConsultas();
    $consulta->connect($CFG_HOST[0], $CFG_USER[0], $CFG_DBPWD[0], $CFG_DBASE[0], $CFG_TIPO[0]);
    $modulo_acceso = $consulta->executeQuery("SELECT *
                                                        FROM
                                                        sb_perfil_modulo, sb_modulo
                                                        Where sb_perfil_modulo.cve_perfil =" . $IdPrin . "
                                                        and sb_perfil_modulo.cve_modulo =" . $mod . "
                                                        and sb_perfil_modulo.cve_modulo = sb_modulo.cve_modulo
                                                        and sb_modulo.status_modulo <>0");


    $str_valmodulo = "MOD_NOVALIDO";
    if ($consulta->totalRows > 0) {

        ///DESCOMENTAR EN CASO DE USAR EL PRIMER SUBNIVEL
        $array_auxiliar = explode(',', $_GET['pila']);
        $str_clave = base64_decode($array_auxiliar[0]);
        $str_llave = base64_decode($array_auxiliar[1]);
        $str_Include = base64_decode($array_auxiliar[2]);
        $str_mod = base64_decode($array_auxiliar[3]);
        $str_nivelpadre = base64_decode($array_auxiliar[4]);

        //CAMBIA EL TEXTO DEL BOTON
        $boton_texto = "AGREGAR PERFIL";
        $campo = array();
        $entidad = 'MÓDULO DE AGREGACIÓN DE PERFILES';
        $id_prin = 'cve_perfil_modulo';
        $strWhere = 'WHERE a.' . $str_llave . '=' . $str_clave;
        $a_order = array();
        /************************SECCION DE LOS BOTONES*****************************************************************************************/
        $strnuevo = ($__SESSION->getValueSession('alta')) ? TRUE : FALSE;
        $streditar = ($__SESSION->getValueSession('actualiza')) ? TRUE : FALSE;
        $streliminar = ($__SESSION->getValueSession('elimina')) ? TRUE : FALSE;

        //$strnuevo = TRUE;
        //$streditar = TRUE;
        //$streliminar =TRUE;

        //$str_impresora = TRUE; 
        //$str_impresora_destino='fichas_reporte_sistema/rep_sb_perfil_modulo.php?';
        /************************FIN  DE LA SECCION DE LOS BOTONES*******************************************************************************/

        $tamanio_tabla = "100%";
        $intlimit = 5;

        //SECCION DE LOS CAMPOS DE BUSQUEDA
        /******************DESCOMENTAR ESTA SECCION SI NECESITAN CAMPOS DE BUSQUEDA**************************/
        ////$a_search_campo = array('des_sexo');
        ////$a_search_etiqueta = array('DESCRIPCION');
        ////$a_search_tipo = array('text');

        //SECCION DE LOS NIVELES DE ACCESO
        /******************DESCOMENTAR ESTA SECCION SI NECESITAN LOS ARCHIVOS PHP**************************/
        //$niveles_acceso=array('i_sb_perfil.php');
        //$niveles_acceso_etiqueta=array('PERFILES');
        /******************SECCIOM DE LOS SEPARADORES*****************************************/
        $separadores = array('', 'SEPARADOR 2', 'SEPARADOR 3');
        /**************************************************************************/
        /******************JOINS (EJEMPLO)*****************************************/
        $tabla = 'sb_perfil_modulo a';
        $tabla_join = ' LEFT OUTER JOIN 
		                        sb_perfil b ON a.cve_perfil=b.cve_perfil ';
        $campos_join = 'a.cve_perfil_modulo, a.cve_modulo, a.cve_perfil, b.des_perfil';
        /***************************************************************************/
        /************************SECCION DE LOS BOTONES************************************************************************************/
        //$streditar = TRUE;
        //$streliminar = TRUE;
        //$strnuevo = TRUE;
        //$str_javascript='<script src="metodos_javascript/js_sb_perfil_modulo.js"></script>';
        /**********************************************************************************************************************************/
        /******************SECCION DE LOS SELECTS(EJEMPLO)***********************************/
        $consulta2 = new PDOConsultas();
        $consulta2->connect($CFG_HOST[0], $CFG_USER[0], $CFG_DBPWD[0], $CFG_DBASE[0]);
        $select= $consulta2->executeQuery("SELECT cve_perfil,des_perfil FROM sb_perfil");
        foreach ($select as $keyselect => &$valselect) {
           $vector_perfiles[]=array($valselect['cve_perfil'],$valselect['des_perfil']);
           }
        /************************************************************************** */
        /******************SELECTS(EJEMPLO)***********************************************/
        //$field[] = array('cve_estado', 'cve_estado', 'VISTA', 'select', 'OBLIGATORIO', 'int',$vector);
        /*************************************************************************************************/

        /***************************************SECCION DE LOS SELECTS EN CASCADA (EJEMPLO)****************************************************
         $select_cascada[] = array(
            "llave1" => ('cve_estado'), "llave2" => ('cve_estado'),"origen" => ('cve_estado_origen'),"destino" => ('cve_municipio_origen'),"datos" => ('des_municipio'), "tablas" => array('cat_estado', 'cat_municipio'),"condicion" => (''), "archivo" => ('../' . $NOMBRE_CARPETA_PRINCIPAL . '/getElementos/get_elementos.php')
        );


         **************************************************************************************************************************************/
        //@CHRISTOPHER DELGADILLO
        /*CAMPOS SOPORTADOS HASTA AHORA*/
        //text
        //number
        //select
        //IMAGEN
        //file
        //checkbox
        //radio 


        /*********************POSICION DE LOS DATOS EN EL ARRAY FIELD****************************/
        //0.- CLAVE PRINCIPAL DE LA BASE DE DATOS
        //1.- NOMBRE DE LA ETIQUETA DE LAS CABECERAS DEL CAMPO AMOSTRAR 
        //2.- VISIBILIDAD DEL CAMPO
        //3.- TIPO DE DATO PARA EL FORMULARIO
        //4.- CAMPO OBLIGATORIO O NO OBLIGATORIO (TENER EN CUENTA EL TIPO DE LLAVE DEL CAMPO PRINCIPAL YA QUE EN SU MAYORIA ES AUTOINCREMENTABLE EN ESE CASE SE DEBE DE ESCONDER)
        //5.- TIPO DE DATO EN BASE DE DATOS
        //6.- VECTOR DE DATOS QUE CONTIENE UN PAR DE ARRAYS PARA LA CONSTRUCCION DINAMICA DE LOS SELECTS
        //7.- VECTOR DE LOS PESOS PARA LA CONSTRUCCION DE LOS SEPARADORES Y LA DISTRIBUCION DE LOS CAMPOS, (ARRAY DEFINIDO EN 12 POSICIONES)
        //8.- TAMAÑO DEL CAMPO EN LA PANTALLA 0
        //9.- LLENADO DE CAMPO PREDEFINIDO PANTALLA 2 y 3, AGREGA EL VALOR VALUE    
        //11.- AREA DE ATRIBUTOS DEL INPUT
        //12.-ETIQUETA PEQUEÑA PARA ESPECIFICACIONES
        switch ($_POST['opc']) {
            case 0:
                $field[] = array('cve_perfil_modulo', 'cve_perfil_modulo', 'HIDDEN', 'number', 'NOOBLIGATORIO', 'int', '', array(0, 12), '30', '', array(), '');
                $field[] = array('cve_modulo', 'CLAVE DE MÓDULO', 'VISTA', 'number', 'OBLIGATORIO', 'int', '', array(0, 12), '30', '', array(), '');
                $field[] = array('des_perfil', 'PERFIL ASIGNADO', 'VISTA', 'number', 'OBLIGATORIO', 'int', '', array(0, 12), '30', '', array(), '');
                break;
            case 2:
                $field[] = array('cve_perfil_modulo', 'cve_perfil_modulo', 'HIDDEN', 'number', 'NOOBLIGATORIO', 'int', '', array(0, 12), '30', '', array(), '');
                $field[] = array('cve_modulo', 'cve_modulo', 'HIDDEN', 'number', 'OBLIGATORIO', 'int', '', array(0, 12), '30', $str_clave, array(array("readonly","readonly")), '');
                $field[] = array('cve_perfil', 'PERFIL A AGREGAR', 'VISTA', 'select', 'OBLIGATORIO', 'int', $vector_perfiles, array(0, 12), '30', '', array(), '');
                break;
            case 3:
                $field[] = array('cve_perfil_modulo', 'cve_perfil_modulo', 'HIDDEN', 'number', 'NOOBLIGATORIO', 'int', '', array(0, 12), '30', '', array(), '');
                $field[] = array('cve_modulo', 'cve_modulo', 'HIDDEN', 'number', 'OBLIGATORIO', 'int', '', array(0, 12), '30', $str_clave, array(array("readonly","readonly")), '');
                $field[] = array('cve_perfil', 'PERFIL A AGREGA', 'VISTA', 'select', 'OBLIGATORIO', 'int', $vector_perfiles, array(0, 12), '30', '', array(), '');
                break;

            default:
                echo "ERROR EN LOS CASE  VERIFIQUE LOS POST";
                break;
        }

        $str_entidad = "entidad.php";
        $str_addentidad = "addentidad.php";
        $str_updentidad = "updentidad.php";
    }
} else {
    include_once("../configuracion_sistema/configuracion.php");
    include_once("sb_ii_refresh.php");
}
