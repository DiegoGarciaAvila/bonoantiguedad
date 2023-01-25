<?php
$str_check = FALSE;
include_once("sb_ii_check.php");
if ($str_check) {
    $IdPrin =$__SESSION->getValueSession('cveperfil');
    $mod=$__SESSION->getValueSession('mod');
    $consulta = new PDOConsultas();
    $consulta->connect($CFG_HOST[0], $CFG_USER[0], $CFG_DBPWD[0], $CFG_DBASE[0]);
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
        $id_prin = 'cve_perfil';
        $strWhere = '';   
        $a_order = array();
        $impresora = FALSE; 
        $tamanio_tabla="100%";
        $intlimit=5;

        //SECCION DE LOS CAMPOS DE BUSQUEDA
        /******************DESCOMENTAR ESTA SECCION SI NECESITAN CAMPOS DE BUSQUEDA**************************/
        ////$a_search_campo = array('des_sexo');
        ////$a_search_etiqueta = array('DESCRIPCION');
        ////$a_search_tipo = array('text');

        //SECCION DE LOS NIVELES DE ACCESO
        /******************DESCOMENTAR ESTA SECCION SI NECESITAN LOS ARCHIVOS PHP**************************/
        //$niveles_acceso=array('i_sb_perfil.php');
        //$niveles_acceso_etiqueta=array('PERFILES');

        $tabla='sb_perfil_usuario';
        $campos_join  = '';
        $tabla_join = '';
        /******************SECCIOM DE LOS SEPARADORES*****************************************/
        $separadores=array('SEPARADOR 1','SEPARADOR 2','SEPARADOR 3');
        /**************************************************************************/
        /******************JOINS (EJEMPLO)*****************************************/
        //$tabla = 'cat_sexo a';
        //$tabla_join = ' LEFT JOIN cat_estatus b on a.cve_estatus=b.cve_estatus';
        //$campos_join = 'a.cve_sexo,a.des_sexo,b.des_estatus,a.cve_estatus';
        /***************************************************************************/
        /************************SECCION DE LOS BOTONES************************************************************************************/
        //$streditar = TRUE;
        //$streliminar = TRUE;
        //$strnuevo = TRUE;
        //$str_javascript='<script src="metodos_javascript\js_sb_persona.js"></script>';
        /**********************************************************************************************************************************/
        /******************SECCION DE LOS SELECTS(EJEMPLO)***********************************/
        //$consulta2 = new PDOConsultas();
        //$consulta2->connect($CFG_HOST[0], $CFG_USER[0], $CFG_DBPWD[0], $CFG_DBASE[0]);
        //$select= $consulta2->executeQuery("SELECT cve_estado,des_estado FROM cat_estatus");
        //foreach ($select as $keyselect => &$valselect) {
            //$vector[]=array($valselect['cve_estado'],$valselect['des_estado']);
            //}
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

        switch ($_POST['opc']) {
            case 0:
                //CASO DE PRIMERA VISTA, OPC 0 DE MANERAINTERNA, PARA EL FORMATO DE LA TABLA
                
                $field[]=array('cve_perfil','cve_perfil','VISTA','number','OBLIGATORIO','int', '', array(0, 12),'30','',array());
                $field[]=array('cve_usuario','cve_usuario','VISTA','number','OBLIGATORIO','int', '', array(0, 12),'30','',array());
                break;
            case 2:
                /******************SELECTS(EJEMPLO)***********************************************/
                //$field[] = array('cve_estado', 'cve_estado', 'VISTA', 'select', 'OBLIGATORIO', 'int',$vector,array(0, 12),'30','','');
                /*************************************************************************************************/
                
                $field[]=array('cve_perfil','cve_perfil','VISTA','number','OBLIGATORIO','int', '', array(0, 12),'30','',array());
                $field[]=array('cve_usuario','cve_usuario','VISTA','number','OBLIGATORIO','int', '', array(0, 12),'30','',array());
                break;
            case 3:
                /******************SELECTS(EJEMPLO)***********************************************/
                //$field[] = array('cve_estado', 'cve_estado', 'VISTA', 'select', 'OBLIGATORIO', 'int',$vector,array(0, 12),'30','','');
                /*************************************************************************************************/
                
                $field[]=array('cve_perfil','cve_perfil','VISTA','number','OBLIGATORIO','int', '', array(0, 12),'30','',array());
                $field[]=array('cve_usuario','cve_usuario','VISTA','number','OBLIGATORIO','int', '', array(0, 12),'30','',array());
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