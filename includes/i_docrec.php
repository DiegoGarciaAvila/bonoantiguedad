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

        /////DESCOMENTAR EN CASO DE USAR EL PRIMER SUBNIVEL
        $array_auxiliar = explode(',', $_GET['pila']);
        $str_clave = base64_decode($array_auxiliar[0]);
        $str_llave = base64_decode($array_auxiliar[1]);
        $str_Include = base64_decode($array_auxiliar[2]);
        $str_mod = base64_decode($array_auxiliar[3]);
        $str_nivelpadre = base64_decode($array_auxiliar[4]);



        //CAMBIA EL TEXTO DEL BOTON
        $boton_texto = "NUEVO REGISTRO";
        $campo = array();
        $entidad = 'DOCUMENTOS ENVIADOS';
        $btn_guardar = 'GUARDAR';
        $id_prin = 'DRCveDR';
        //$strWhere = 'ORDER BY DRCveDR DESC';   

        if ($__SESSION->getValueSession('desperfil') == 'ADMINISTRADOR') {
            $strWhere = ' WHERE ' .  ' a.DRCvePfk = ' . $str_clave;
        } else {
            $strWhere = ' WHERE ' .  ' a.DRCvePfk = ' . $str_clave;
        }


        $a_order = ' ORDER BY DRCveDR DESC';
        /************************SECCION DE LOS BOTONES*****************************************************************************************/
        $strnuevo = ($__SESSION->getValueSession('alta')) ? TRUE : FALSE;
        $streditar = ($__SESSION->getValueSession('actualiza')) ? TRUE : FALSE;
        $streliminar = ($__SESSION->getValueSession('elimina')) ? TRUE : FALSE;


        //SELECCIONA DONDE LA PETICION SEA $str_clave
        //$strnuevo = TRUE;
        //$streditar = TRUE;
        //$streliminar =TRUE;

        //$str_impresora = TRUE; 
        //$str_impresora_destino='fichas_reporte_sistema/rep_docrec.php?';
        /************************FIN  DE LA SECCION DE LOS BOTONES*******************************************************************************/

        $tamanio_tabla = "100%";
        $intlimit = 5;

        //SECCION DE LOS CAMPOS DE BUSQUEDA
        /******************DESCOMENTAR ESTA SECCION SI NECESITAN CAMPOS DE BUSQUEDA**************************/
        ////$a_search_campo = array('des_sexo');
        ////$a_search_etiqueta = array('DESCRIPCION');
        ////$a_search_tipo = array('text');
        // $a_search_campo = array('DRFolio','TDDescripcion','DRFecIni','DRFecFin','ODescripcion','PFolio');
        // $a_search_etiqueta = array('FOLIO DE DOCUMENTO','TIPO DE DOCUMENTO','FECHA MANDADO','FECHA REVISADO','ORGANISMO QUE PROPORCIONO EL DOCUMENTO','FOLIO PETICION');
        // $a_search_tipo = array('text','text','text','text','text','text');
        //SECCION DE LOS NIVELES DE ACCESO
        /******************DESCOMENTAR ESTA SECCION SI NECESITAN LOS ARCHIVOS PHP**************************/
        //$niveles_acceso=array('i_sb_perfil.php');
        //$niveles_acceso_etiqueta=array('PERFILES');

        $tabla = 'docrec';
        $campos_join  = '';
        $tabla_join = '';
        /******************SECCIOM DE LOS SEPARADORES*****************************************/
        $separadores = array('SEPARADOR 1', 'SEPARADOR 2', 'SEPARADOR 3');
        /**************************************************************************/
        /******************JOINS (EJEMPLO)*****************************************/
        //$str_union_tabla = ' ';
        //$tabla = 'cat_sexo a';
        //$tabla_join = ' LEFT JOIN cat_estatus b on a.cve_estatus=b.cve_estatus';
        //$campos_join = 'a.cve_sexo,a.des_sexo,b.des_estatus,a.cve_estatus';

        $tabla = 'docrec a';
        $tabla_join = 'LEFT JOIN cat_tipodoc b ON (a.DRCveTDfk=b.TDCveTD)
       LEFT JOIN cat_org c ON (a.DRCveOfk=c.OCveO)
       LEFT JOIN peticiones d ON (a.DRCvePfk=d.PCveP)
       LEFT JOIN sb_usuario e ON (d.PCveUsufk=e.cve_usuario)';
        $campos_join = 'a.*, b.TDDescripcion,c.ODescripcion, d.PFolio,e.cve_usuario,e.nom_usuario';

        /***************************************************************************/
        /************************SECCION DE LOS BOTONES************************************************************************************/
        //$streditar = TRUE;
        //$streliminar = TRUE;
        //$strnuevo = TRUE;
        //$str_javascript='<script src="metodos_javascript/js_docrec.js"></script>';
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

        $consulta2 = new PDOConsultas();
        $consulta2->connect($CFG_HOST[0], $CFG_USER[0], $CFG_DBPWD[0], $CFG_DBASE[0]);




        $llevaone = $consulta2->executeQuery("SELECT * FROM peticiones WHERE PCveP= " . $str_clave);
        //print_r($llevaone);
        //die();
        if ($llevaone[0]["PPaso"] == 1) {

         //   $select = $consulta2->executeQuery("SELECT TDCveTD,TDDescripcion FROM cat_tipodoc WHERE TDCveTD IN (4,5)");
        
            $select = $consulta2->executeQuery("SELECT TDCveTD,TDDescripcion FROM cat_tipodoc WHERE TDCveTD IN (6)");
            foreach ($select as $keyselect => &$valselect) {
                $tipoDocumento[] = array($valselect['TDCveTD'], $valselect['TDDescripcion']);
            }


            $numdocadj = $consulta2->executeQuery("SELECT COUNT(*) FROM docrec WHERE DRCvePfk = " . $str_clave);



            if ($llevaone[0]["PCveEfk"] != 1 && $llevaone[0]["PCveEfk"] != 5) {
                if ($numdocadj[0]['COUNT(*)'] >= 1) {
                    $actualizarRegistro = $consulta2->executeQuery("UPDATE peticiones
                    SET PCveEfk = 3
                    WHERE PCveP = " . $str_clave);
                }
                if ($numdocadj[0]['COUNT(*)'] < 1) {
                    $actualizarRegistro = $consulta2->executeQuery("UPDATE peticiones
                    SET PCveEfk = 2
                    WHERE PCveP = " . $str_clave);
                }
            }
        }
        if ($llevaone[0]["PPaso"] == 2) {
            // print_r($llevaone);
            // die();
            $select = $consulta2->executeQuery("SELECT TDCveTD,TDDescripcion FROM cat_tipodoc WHERE TDCveTD IN (1,2,3)");
            foreach ($select as $keyselect => &$valselect) {
                $tipoDocumento[] = array($valselect['TDCveTD'], $valselect['TDDescripcion']);
            }
        }
        //print_r( $tipoDocumento);
        //die();

        $select = $consulta2->executeQuery("SELECT OCveO,ODescripcion FROM cat_org");
        foreach ($select as $keyselect => &$valselect) {
            $tipoOrganismo[] = array($valselect['OCveO'], $valselect['ODescripcion']);
        }







        $contador2 = $consulta2->executeQuery("SELECT MAX(DRCveDR) FROM docrec ");

        $contador = $contador2[0]['MAX(DRCveDR)'] + 1;
        $hoy = getdate();
        $fecha = $hoy['year'] . '-' . $hoy['mon'] . '-' . $hoy['mday'];





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
        $str_ruta_include = "oficios/" . $__SESSION->getValueSession('claveservidor') . "_" . $__SESSION->getValueSession('nomusuario') . "/";


        switch ($_POST['opc']) {
            case 0:
                //CASO DE PRIMERA VISTA, OPC 0 DE MANERAINTERNA, PARA EL FORMATO DE LA TABLA

                $field[] = array('DRCveDR', 'DRCveDR', 'HIDDEN', 'number', 'NOOBLIGATORIO', 'int', '', array(0, 12), '30', '', array(), '', '');
                $field[] = array('DRFolio', 'FOLIO DE DOCUMENTO', 'VISTA', 'text', 'OBLIGATORIO', 'varchar', '', array(0, 12), '30', '', array(), '', '');
                $field[] = array('file_oficio', 'RUTA DOCUMENTO', 'VISTA', 'FILE', 'OBLIGATORIO', 'varchar', '', array(0, 12), '30', '', array(), '', '');
                $field[] = array('TDDescripcion', 'TIPO DE DOCUMENTO', 'VISTA', 'number', 'OBLIGATORIO', 'int', '', array(0, 12), '30', '', array(), '', '');

                $field[] = array('DRFecIni', 'INICIO PERIODO', 'VISTA', 'date', 'OBLIGATORIO', 'date', '', array(0, 12), '30', '', array(), '', '');
                $field[] = array('DRFecFin', 'FIN PERIODO', 'VISTA', 'date', 'OBLIGATORIO', 'date', '', array(0, 12), '30', '', array(), '', '');
                $field[] = array('Observaciones', 'ORGANISMO QUE PROPORCIONO EL DOCUMENTO', 'VISTA', 'text', 'NOOBLIGATORIO', 'text','', array(0, 12), '30', '', array(), '', '');

//                $field[] = array('ODescripcion', 'ORGANISMO QUE PROPORCIONO EL DOCUMENTO ', 'VISTA', 'number', 'OBLIGATORIO', 'int', '', array(0, 12), '30', '', array(), '', '');
                //$field[]=array('PFolio','FOLIO PETICION','HIDDEN','text','NOOBLIGATORIO','text', '', array(0, 12),'30','',array(),'','');

                break;
            case 2:
                /******************SELECTS(EJEMPLO)***********************************************/
                //$field[] = array('cve_estado', 'cve_estado', 'VISTA', 'select', 'OBLIGATORIO', 'int',$vector,array(0, 12),'30','','');
                /*************************************************************************************************/

                $field[] = array('DRCveDR', 'DRCveDR', 'HIDDEN', 'number', 'NOOBLIGATORIO', 'int', '', array(0, 12), '30', '', array(), '', '');
                $field[] = array('DRFolio', 'FOLIO DE DOCUMENTO', 'VISTA', 'text', 'OBLIGATORIO', 'varchar', '', array(0, 12), '30', 'DOCREC' . $contador, array(array("readonly", "true")), '', '');
                $field[] = array('file_oficio', 'DOCUMENTO', 'VISTA', 'file', 'OBLIGATORIO', 'varchar', '', array(0, 12), '30', '', array(), '', '');
                $field[] = array('DRCveTDfk', 'TIPO DE DOCUMENTO', 'VISTA', 'select', 'OBLIGATORIO', 'int', $tipoDocumento, array(0, 12), '30', '', array(), '', '');

               // $field[] = array('DRFecIni', 'INICIO PERIODO', 'VISTA', 'text', 'OBLIGATORIO', 'date', '', array(0, 12), '30', '', array(array("readonly", "true")), '', '');
                $field[] = array('DRFecIni', 'INICIO PERIODO', 'VISTA', 'date', 'OBLIGATORIO', 'date', '', array(0, 12), '30', '', array(), '', '');
                $field[] = array('DRFecFin', 'FIN PERIODO', 'VISTA', 'date', 'OBLIGATORIO', 'date', '', array(0, 12), '30', '', array(), '', '');
                //$field[] = array('DRCveOfk', 'ORGANISMO QUE PROPORCIONO EL DOCUMENTO', 'VISTA', 'select', 'NOOBLIGATORIO', 'int', $tipoOrganismo, array(0, 12), '30', '', array(), '', '');
                $field[] = array('Observaciones', 'ORGANISMO QUE PROPORCIONO EL DOCUMENTO', 'VISTA', 'text', 'NOOBLIGATORIO', 'text','', array(0, 12), '30', '', array(), '', '');
               $field[] = array('DRCvePfk', 'FOLIO PETICION', 'HIDDEN', 'number', 'NOOBLIGATORIO', 'int', '', array(0, 12), '30', $str_clave, array(), '', '');
                break;
            case 3:
                /******************SELECTS(EJEMPLO)***********************************************/
                //$field[] = array('cve_estado', 'cve_estado', 'VISTA', 'select', 'OBLIGATORIO', 'int',$vector,array(0, 12),'30','','');
                /*************************************************************************************************/

              
                $field[] = array('DRCveDR', 'DRCveDR', 'HIDDEN', 'number', 'NOOBLIGATORIO', 'int', '', array(0, 12), '30', '', array(), '', '');
                $field[] = array('DRFolio', 'FOLIO DE DOCUMENTO', 'VISTA', 'text', 'OBLIGATORIO', 'varchar', '', array(0, 12), '30', 'DOCREC' . $contador, array(array("readonly", "true")), '', '');
                $field[] = array('file_oficio', 'DOCUMENTO', 'VISTA', 'file', 'OBLIGATORIO', 'varchar', '', array(0, 12), '30', '', array(), '', '');
                $field[] = array('DRCveTDfk', 'TIPO DE DOCUMENTO', 'VISTA', 'select', 'OBLIGATORIO', 'int', $tipoDocumento, array(0, 12), '30', '', array(), '', '');

               // $field[] = array('DRFecIni', 'INICIO PERIODO', 'VISTA', 'text', 'OBLIGATORIO', 'date', '', array(0, 12), '30', '', array(array("readonly", "true")), '', '');
                $field[] = array('DRFecIni', 'INICIO PERIODO', 'VISTA', 'date', 'OBLIGATORIO', 'date', '', array(0, 12), '30', '', array(), '', '');
                $field[] = array('DRFecFin', 'FIN PERIODO', 'VISTA', 'date', 'OBLIGATORIO', 'date', '', array(0, 12), '30', '', array(), '', '');
                //$field[] = array('DRCveOfk', 'ORGANISMO QUE PROPORCIONO EL DOCUMENTO', 'VISTA', 'select', 'NOOBLIGATORIO', 'int', $tipoOrganismo, array(0, 12), '30', '', array(), '', '');
                $field[] = array('Observaciones', 'ORGANISMO QUE PROPORCIONO EL DOCUMENTO', 'VISTA', 'text', 'NOOBLIGATORIO', 'text','', array(0, 12), '30', '', array(), '', '');
                $field[] = array('DRCvePfk', 'FOLIO PETICION', 'HIDDEN', 'number', 'NOOBLIGATORIO', 'int', '', array(0, 12), '30', $str_clave, array(), '', '');
                
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
