<?php
$str_check = FALSE;
include_once("sb_ii_check.php");
if ($str_check) {
    $IdPrin =$__SESSION->getValueSession('cveperfil');
    $mod=$__SESSION->getValueSession('mod');
    $consulta = new PDOConsultas();
    $consulta->connect($CFG_HOST[0], $CFG_USER[0], $CFG_DBPWD[0], $CFG_DBASE[0],$CFG_TIPO[0]);
    $modulo_acceso = $consulta->executeQuery("SELECT *
                                                        FROM
                                                        sb_perfil_modulo, sb_modulo
                                                        Where sb_perfil_modulo.cve_perfil =".$IdPrin."
                                                        and sb_perfil_modulo.cve_modulo =".$mod."
                                                        and sb_perfil_modulo.cve_modulo = sb_modulo.cve_modulo
                                                        and sb_modulo.status_modulo <>0");


    $str_valmodulo = "MOD_NOVALIDO";
    if ($consulta->totalRows > 0) {

        /////DESCOMENTAR EN CASO DE USAR EL PRIMER SUBNIVEL
        //$array_auxiliar = explode(',', $_GET['pila']);
        //$str_clave = base64_decode($array_auxiliar[0]);
        //$str_llave = base64_decode($array_auxiliar[1]);
        //$str_Include = base64_decode($array_auxiliar[2]);
        //$str_mod = base64_decode($array_auxiliar[3]);
        //$str_nivelpadre = base64_decode($array_auxiliar[4]);

        //CAMBIA EL TEXTO DEL BOTON
        $boton_texto="NUEVO REGISTRO";
        $campo = array();
        $entidad = 'ORGANISMOS';
        $btn_guardar='GUARDAR';
        $id_prin = 'OCveO';
        $strWhere = '';   
        $a_order = '';
        /************************SECCION DE LOS BOTONES*****************************************************************************************/
        $strnuevo = ($__SESSION->getValueSession('alta')) ? TRUE : FALSE;
        $streditar = ($__SESSION->getValueSession('actualiza')) ? TRUE : FALSE;
        $streliminar = ($__SESSION->getValueSession('elimina')) ? TRUE : FALSE;
        
        //$strnuevo = TRUE;
        //$streditar = TRUE;
        //$streliminar =TRUE;
        
        //$str_impresora = TRUE; 
        //$str_impresora_destino='fichas_reporte_sistema/rep_cat_org.php?';
        /************************FIN  DE LA SECCION DE LOS BOTONES*******************************************************************************/

        $tamanio_tabla="100%";
        $intlimit=5;

        //SECCION DE LOS CAMPOS DE BUSQUEDA
        /******************DESCOMENTAR ESTA SECCION SI NECESITAN CAMPOS DE BUSQUEDA**************************/
        $a_search_campo = array('OClave','ODescripcion');
        $a_search_etiqueta = array('CLAVE','DESCRIPCION');
        $a_search_tipo = array('text','text');

        //SECCION DE LOS NIVELES DE ACCESO
        /******************DESCOMENTAR ESTA SECCION SI NECESITAN LOS ARCHIVOS PHP**************************/
        //$niveles_acceso=array('i_sb_perfil.php');
        //$niveles_acceso_etiqueta=array('PERFILES');

        $tabla='cat_org';
        $campos_join  = '';
        $tabla_join = '';
        /******************SECCIOM DE LOS SEPARADORES*****************************************/
        $separadores=array('SEPARADOR 1','SEPARADOR 2','SEPARADOR 3');
        /**************************************************************************/
        /******************JOINS (EJEMPLO)*****************************************/
        //$str_union_tabla = ' ';
        //$tabla = 'cat_sexo a';
        //$tabla_join = ' LEFT JOIN cat_estatus b on a.cve_estatus=b.cve_estatus';
        //$campos_join = 'a.cve_sexo,a.des_sexo,b.des_estatus,a.cve_estatus';
        /***************************************************************************/
        /************************SECCION DE LOS BOTONES************************************************************************************/
        //$streditar = TRUE;
        //$streliminar = TRUE;
        //$strnuevo = TRUE;
        //$str_javascript='<script src="metodos_javascript/js_cat_org.js"></script>';
        //EN CASO DE UTILIZAR PRCESOS EM TIEMPO INTERMEDIO
        //$str_javascript_entidad = '<script src="metodos_javascript/js_inicio.js"></script>';
        /************************RUTA EN DONDE SE COLOCARAN LOS ARCHIVOS A SUBIR**********************************************************/
  
        //$str_ruta_include= "imagenes_sistema/perfiles2/";
        /**********************************************************************************************************************************/
        /******************SECCION DE LOS SELECTS(EJEMPLO)***********************************/
        //$consulta2 = new PDOConsultas();
        //$consulta2->connect($CFG_HOST[0], $CFG_USER[0], $CFG_DBPWD[0], $CFG_DBASE[0]);
        //$select= $consulta2->executeQuery("SELECT cve_estatus,des_estatus FROM cat_estatus");
        //foreach ($select as $keyselect => &$valselect) {
        //    $vector[]=array($valselect['cve_estatus'],$valselect['des_estatus']);
        //    }
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
        //10.- AREA DE ATRIBUTOS DEL INPUT
        //11.-ETIQUETA PEQUEÑA PARA ESPECIFICACIONES
        //12.-MODALS


        /******************************************************SECCION DE MODALS*****************************************************/
        //$str_modal = 'modal_sistema/formulario_sb_modulo.php?';
        /******************************************************FIN DE LOS MODALS*****************************************************/


        switch ($_POST['opc']) {
            case 0:
                //CASO DE PRIMERA VISTA, OPC 0 DE MANERAINTERNA, PARA EL FORMATO DE LA TABLA
                
                $field[]=array('OCveO','OCveO','HIDDEN','number','NOOBLIGATORIO','int', '', array(0, 12),'30','',array(),'','');
                $field[]=array('OClave','CLAVE','VISTA','text','OBLIGATORIO','varchar', '', array(0, 12),'30','',array(),'','');
                $field[]=array('ODescripcion','DESCRIPCION','VISTA','text','OBLIGATORIO','varchar', '', array(0, 12),'30','',array(),'','');
                break;
            case 2:
                /******************SELECTS(EJEMPLO)***********************************************/
                //$field[] = array('cve_estado', 'cve_estado', 'VISTA', 'select', 'OBLIGATORIO', 'int',$vector,array(0, 12),'30','','');
                /*************************************************************************************************/
                
                $field[]=array('OCveO','OCveO','HIDDEN','number','NOOBLIGATORIO','int', '', array(0, 12),'30','',array(),'','');
                $field[]=array('OClave','CLAVE','VISTA','text','OBLIGATORIO','varchar', '', array(0, 12),'30','',array(),'','');
                $field[]=array('ODescripcion','DESCRIPCION','VISTA','text','OBLIGATORIO','varchar', '', array(0, 12),'30','',array(),'','');
                break;
            case 3:
                /******************SELECTS(EJEMPLO)***********************************************/
                //$field[] = array('cve_estado', 'cve_estado', 'VISTA', 'select', 'OBLIGATORIO', 'int',$vector,array(0, 12),'30','','');
                /*************************************************************************************************/
                
                $field[]=array('OCveO','OCveO','HIDDEN','number','NOOBLIGATORIO','int', '', array(0, 12),'30','',array(),'','');
                $field[]=array('OClave','CLAVE','VISTA','text','OBLIGATORIO','varchar', '', array(0, 12),'30','',array(),'','');
                $field[]=array('ODescripcion','DESCRIPCION','VISTA','text','OBLIGATORIO','varchar', '', array(0, 12),'30','',array(),'','');
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