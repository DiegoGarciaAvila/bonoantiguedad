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
        //CAMBIA EL TEXTO DEL BOTON
        $boton_texto="NUEVO REGISTRO";
        $campo = array();
        $entidad = 'NOMBRE DEL MÓDULO';
        $id_prin = 'cve_modulo';
        $strWhere = '';   
        $a_order = array();
        /************************SECCION DE LOS BOTONES*****************************************************************************************/
        $strnuevo = ($__SESSION->getValueSession('alta')) ? TRUE : FALSE;
        $streditar = ($__SESSION->getValueSession('actualiza')) ? TRUE : FALSE;
        $streliminar = ($__SESSION->getValueSession('elimina')) ? TRUE : FALSE;
        
        //$strnuevo = TRUE;
        //$streditar = TRUE;
        //$streliminar =TRUE;
        
        $str_impresora = TRUE; 
        $str_impresora_destino='fichas_reporte_sistema/rep_sb_modulo.php?';
        /************************FIN  DE LA SECCION DE LOS BOTONES*******************************************************************************/

        $tamanio_tabla="110%";
        $intlimit=7;

        //SECCION DE LOS CAMPOS DE BUSQUEDA
        /******************DESCOMENTAR ESTA SECCION SI NECESITAN CAMPOS DE BUSQUEDA**************************/
        $a_search_campo = array('des_sexo');
        $a_search_etiqueta = array('DESCRIPCION');
        $a_search_tipo = array('text');

        //SECCION DE LOS NIVELES DE ACCESO
        /******************DESCOMENTAR ESTA SECCION SI NECESITAN LOS ARCHIVOS PHP**************************/
        $niveles_acceso=array('i_sb_perfil_modulo.php');
        $niveles_acceso_etiqueta=array('PERFILES');

        /******************SECCIOM DE LOS SEPARADORES*****************************************/
        $separadores=array('','SEPARADOR 2','SEPARADOR 3');
        /**************************************************************************/
        /******************JOINS (EJEMPLO)*****************************************/
        $tabla = 'sb_modulo a';
        $tabla_join = ' LEFT JOIN cat_estatus b on a.status_modulo=b.cve_estatus';
        $campos_join = 'A.*, b.des_estatus';
        /***************************************************************************/
        /************************SECCION DE LOS BOTONES************************************************************************************/
        //$streditar = TRUE;
        //$streliminar = TRUE;
        //$strnuevo = TRUE;
        //$str_javascript='<script src="metodos_javascript/js_sb_modulo.js"></script>';
        /**********************************************************************************************************************************/
        /******************SECCION DE LOS SELECTS(EJEMPLO)***********************************/
        $consulta2 = new PDOConsultas();
        $consulta2->connect($CFG_HOST[0], $CFG_USER[0], $CFG_DBPWD[0], $CFG_DBASE[0]);
        $select= $consulta2->executeQuery("SELECT cve_estatus,des_estatus FROM cat_estatus");
        foreach ($select as $keyselect => &$valselect) {       
           $array_estatus[]=array($valselect['cve_estatus'],$valselect['des_estatus']);
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
                $field[]=array('cve_modulo','cve_modulo','VISTA','number','OBLIGATORIO','int', '', array(0, 12),'30','',array(),'');
                $field[]=array('descripcion_modulo','MÓDULO','VISTA','text','OBLIGATORIO','varchar', '', array(0, 12),'15','',array(),'');
                $field[]=array('des_estatus','ESTATUS','VISTA','number','OBLIGATORIO','smallint', '', array(0, 12),'5','',array(),'');
                $field[]=array('url_modulo','URL INDEX','VISTA','text','OBLIGATORIO','varchar', '', array(0, 12),'15','',array(),'');
                $field[]=array('grupo_modulo','GRUPO','VISTA','number','OBLIGATORIO','smallint', '', array(0, 12),'5','',array(),'');
                $field[]=array('posicion_modulo','POSICIÓN','VISTA','number','OBLIGATORIO','smallint', '', array(0, 12),'5','',array(),'');
                $field[]=array('nivel_modulo','NIVEL','VISTA','number','OBLIGATORIO','smallint', '', array(0, 12),'8','',array(),'');
                $field[]=array('url_include','URL IMCLUDE','VISTA','text','OBLIGATORIO','varchar', '', array(0, 12),'15','',array(),'');
                $field[]=array('tipo_nivel','NIVEL','VISTA','text','OBLIGATORIO','varchar', '', array(0, 12),'5','',array(),'');
                $field[]=array('nivel_padre','NIVEL PADRE','VISTA','number','OBLIGATORIO','smallint', '', array(0, 12),'2','',array(),'');
                $field[]=array('nivel_hijo','NIVEL HIJO','VISTA','number','OBLIGATORIO','smallint', '', array(0, 12),'2','',array(),'');
                $field[]=array('icono','ICONO','VISTA','text','OBLIGATORIO','varchar', '', array(0, 12),'30','',array(),'');
                break;
            case 2:
                $field[]=array('cve_modulo','cve_modulo','HIDDEN','number','NOOBLIGATORIO','int', '', array(0, 12),'30','',array(),'');
                $field[]=array('descripcion_modulo','DESCRIPCIÓN MODULO','VISTA','text','OBLIGATORIO','varchar', '', array(0, 4),'30','',array(),'(Solo letras)');
                $field[]=array('status_modulo','ESTATUS MODULO','VISTA','select','OBLIGATORIO','smallint', $array_estatus, array(0, 4),'30','',array(),'');
                $field[]=array('url_modulo','URL INDEX','VISTA','text','OBLIGATORIO','varchar', '', array(0, 4),'30','',array(),'');
                $field[]=array('grupo_modulo','GRUPO DEL MÓLDULO','VISTA','number','OBLIGATORIO','smallint', '', array(0, 2),'30','',array(),'');
                $field[]=array('posicion_modulo','POSICION DEL MÓDULO','VISTA','number','OBLIGATORIO','smallint', '', array(0,2),'30','',array(),'');
                $field[]=array('nivel_modulo','NIVEL DEL MÓDULO','VISTA','number','OBLIGATORIO','smallint', '', array(0,2),'30','',array(),'');
                $field[]=array('url_include','URL INCLUDE','VISTA','text','OBLIGATORIO','varchar', '', array(0, 6),'30','',array(),'');
                $field[]=array('tipo_nivel','TIPO DE NIVEL','VISTA','text','OBLIGATORIO','varchar', '', array(0, 3),'30','',array(),'(PADRE-HIJO)');
                $field[]=array('nivel_padre','NIVEL PADRE','VISTA','number','OBLIGATORIO','smallint', '', array(0, 3),'30','',array(),'');
                $field[]=array('nivel_hijo','NIVEL HIJO','VISTA','number','OBLIGATORIO','smallint', '', array(0, 3),'30','',array(),'');
                $field[]=array('icono','ICONO','VISTA','text','OBLIGATORIO','varchar', '', array(0, 3),'30','',array(),'');
                break;
            case 3:
                $field[]=array('cve_modulo','cve_modulo','HIDDEN','number','NOOBLIGATORIO','int', '', array(0, 12),'30','',array(),'');
                $field[]=array('descripcion_modulo','DESCRIPCIÓN MODULO','VISTA','text','OBLIGATORIO','varchar', '', array(0, 4),'30','',array(),'(Solo letras)');
                $field[]=array('status_modulo','ESTATUS MODULO','VISTA','select','OBLIGATORIO','smallint', $array_estatus, array(0, 4),'30','',array(),'');
                $field[]=array('url_modulo','URL INDEX','VISTA','text','OBLIGATORIO','varchar', '', array(0, 4),'30','',array(),'');
                $field[]=array('grupo_modulo','GRUPO DEL MÓLDULO','VISTA','number','OBLIGATORIO','smallint', '', array(0, 2),'30','',array(),'');
                $field[]=array('posicion_modulo','POSICION DEL MÓDULO','VISTA','number','OBLIGATORIO','smallint', '', array(0,2),'30','',array(),'');
                $field[]=array('nivel_modulo','NIVEL DEL MÓDULO','VISTA','number','OBLIGATORIO','smallint', '', array(0,2),'30','',array(),'');
                $field[]=array('url_include','URL INCLUDE','VISTA','text','OBLIGATORIO','varchar', '', array(0, 6),'30','',array(),'');
                $field[]=array('tipo_nivel','TIPO DE NIVEL','VISTA','text','OBLIGATORIO','varchar', '', array(0, 3),'30','',array(),'(PADRE-HIJO)');
                $field[]=array('nivel_padre','NIVEL PADRE','VISTA','number','OBLIGATORIO','smallint', '', array(0, 3),'30','',array(),'');
                $field[]=array('nivel_hijo','NIVEL HIJO','VISTA','number','OBLIGATORIO','smallint', '', array(0, 3),'30','',array(),'');
                $field[]=array('icono','ICONO','VISTA','text','OBLIGATORIO','varchar', '', array(0, 3),'30','',array(),'');
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