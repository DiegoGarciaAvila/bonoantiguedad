<?php

//print_r($__SESSION->getValueSession('fecregsis'));
//die();
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
        //$array_auxiliar = explode(',', $_GET['pila']);
        //$str_clave = base64_decode($array_auxiliar[0]);
        //$str_llave = base64_decode($array_auxiliar[1]);
        //$str_Include = base64_decode($array_auxiliar[2]);
        //$str_mod = base64_decode($array_auxiliar[3]);
        //$str_nivelpadre = base64_decode($array_auxiliar[4]);

        //CAMBIA EL TEXTO DEL BOTON
        $boton_texto = "NUEVO REGISTRO";
        $campo = array();
        $entidad = 'USUARIOS QUE YA TIENEN BONO';
        $btn_guardar = 'GUARDAR';
        $id_prin = 'cve_usuario';
        $strWhere = '';
        $a_order = 'ORDER BY cve_usuario desc';
        if ($__SESSION->getValueSession('desperfil') == 'ADMINISTRADOR') {

            //die($__SESSION->getValueSession('fecregsis'));
            $strnuevo = TRUE;
            $streditar = TRUE;
            $streliminar = TRUE;

            $strWhere = ' WHERE CveE = 2' ;
        } else {

            //$strnuevo = TRUE;
            $streditar = TRUE;
            $streliminar = FALSE;

            $strWhere = ' WHERE CveE = 2' ;
        }
        /************************SECCION DE LOS BOTONES*****************************************************************************************/
        //$strnuevo = ($__SESSION->getValueSession('alta')) ? TRUE : FALSE;
        //$streditar = ($__SESSION->getValueSession('actualiza')) ? TRUE : FALSE;
        //$streliminar = ($__SESSION->getValueSession('elimina')) ? TRUE : FALSE;



        //$str_impresora = TRUE; 
        //$str_impresora_destino='fichas_reporte_sistema/rep_sb_usuario.php?';
        /************************FIN  DE LA SECCION DE LOS BOTONES*******************************************************************************/

        $tamanio_tabla = "100%";
        $intlimit = 5;

        //SECCION DE LOS CAMPOS DE BUSQUEDA
        /******************DESCOMENTAR ESTA SECCION SI NECESITAN CAMPOS DE BUSQUEDA**************************/



        $a_search_campo = array('a.ClaveServidor', 'nom_usuario', 'cve_perfil', 'ApePat', 'ApeMat', 'email', 'Rfc', 'CveAds', 'Issemmym', 'CveAD', 'CveAJ', 'CvePF', 'NivelRango');
        $a_search_etiqueta = array('CLAVE SERVIDOR PUBLICO', 'NOMBRE SERVIDOR PUBLICO', 'ROL', 'APELLIDO PATERNO', 'APELLIDO MATERNO', 'CORREO', 'RFC', 'ADCRIPCION', 'ISSEMMYM', 'ADMINISTRATIVO/DOCENTE', 'ACTIVO/JUBILADO', 'PUESTO FUNCIONAL', 'NIVEL Y RANGO');
        $a_search_tipo = array('text', 'text', 'text', 'text', 'text', 'text', 'text', 'text', 'text', 'text', 'text', 'text', 'text');

        //SECCION DE LOS NIVELES DE ACCESO
        /******************DESCOMENTAR ESTA SECCION SI NECESITAN LOS ARCHIVOS PHP**************************/
        $niveles_acceso = array('i_peticiones.php');
        $niveles_acceso_etiqueta = array('VER PETICIONES DEL USUARIO');

        $tabla = 'sb_usuario';
        $campos_join  = '';
        $tabla_join = '';
        /******************SECCIOM DE LOS SEPARADORES*****************************************/
        $separadores = array('SEPARADOR 1', 'SEPARADOR 2', 'SEPARADOR 3');
        /**************************************************************************/
        /******************JOINS (EJEMPLO)*****************************************/


        // $str_union_tabla = '';
        $tabla = 'sb_usuario a ';
        $tabla_join = 'LEFT JOIN sb_perfil b ON (a.cve_perfil=b.cve_perfil)
        LEFT JOIN cat_adscripcion c ON (a.CveAds = c.ACveA)
        LEFT JOIN cat_puesto d ON (a.CvePF = d.PCveP)
        LEFT JOIN cat_admindocente e ON (a.CveAD = e.ADCveAD)
        LEFT JOIN cat_zonaescolar f ON (a.CveZE = f.ZECveZE)
        LEFT JOIN cat_ciudaddom h ON (a.CveCD = h.CDCveCD)
        LEFT JOIN cat_ciudadtra i ON (a.CveCT = i.CTCveCT)
        LEFT JOIN cat_modalidad j ON (a.CveM = j.MCveM)
        LEFT JOIN cat_unidadejecutora k ON (a.CveUA= k.UECveUE)
        LEFT JOIN estper l ON (a.CveE=l.EPCveEP)
        LEFT JOIN cat_activojubilado m ON (a.CveAJ=m.AJCveAJ)';
        $campos_join = 'a.*,b.des_perfil,c.ADescripcion ,d.PDescripcion, e.ADDescripcion,
        f.ZEDescripcion, h.CDDescripcion,i.CTDescripcion, j.MDescripcion, k.UEDescripcion,
        l.EPDescripcion,m.AJDescripcion ';
        /***************************************************************************/
        /************************SECCION DE LOS BOTONES************************************************************************************/

        //$str_javascript='<script src="metodos_javascript/js_sb_usuario.js"></script>';
        //EN CASO DE UTILIZAR PRCESOS EM TIEMPO INTERMEDIO
        //$str_javascript_entidad = '<script src="metodos_javascript/js_inicio.js"></script>';
        /************************RUTA EN DONDE SE COLOCARAN LOS ARCHIVOS A SUBIR**********************************************************/

        //$str_ruta_include= "imagenes_sistema/perfiles2/";
        $str_ruta_include = "oficios/" . $__SESSION->getValueSession('claveservidor') . "_" . $__SESSION->getValueSession('nomusuario') . "/";

        /**********************************************************************************************************************************/
        /******************SECCION DE LOS SELECTS(EJEMPLO)***********************************/
        //  $consulta2 = new PDOConsultas();
        //  $consulta2->connect($CFG_HOST[0], $CFG_USER[0], $CFG_DBPWD[0], $CFG_DBASE[0]);
        //  $select= $consulta2->executeQuery("SELECT cve_estatus,des_estatus FROM cat_estatus");
        // foreach ($select as $keyselect => &$valselect) {
        //     $vector[]=array($valselect['cve_estatus'],$valselect['des_estatus']);
        //     }

        //  $desperfil = array (
        //   0 => array('cve_perfil' => "1",'des_perfil' => "ADMINISTRADOR DEL SISTEMA"),
        //   1 => array('cve_perfil' => "2",'des_perfil' => "SERVIDOR PUBLICO")
        //   );
        //print_r($desperfil);
        //die();
        $consulta2 = new PDOConsultas();
        $consulta2->connect($CFG_HOST[0], $CFG_USER[0], $CFG_DBPWD[0], $CFG_DBASE[0]);

        $select = array(
            0 => array('cve_perfil' => "SI", 'des_perfil' => "SI"),
            1 => array('cve_perfil' => "NO", 'des_perfil' => "NO")
        );

        foreach ($select as $keyselect => &$valselect) {
            $sindicalizado[] = array($valselect['cve_perfil'], $valselect['des_perfil']);
        }

        $select = array(
            0 => array('cve_perfil' => "ADMINISTRADOR DEL SISTEMA", 'des_perfil' => "ADMINISTRADOR DEL SISTEMA"),
            1 => array('cve_perfil' => "CAPTURA", 'des_perfil' => "CAPTURA"),
            2 => array('cve_perfil' => "SERVIDOR PUBLICO", 'des_perfil' => "SERVIDOR PUBLICO")
        );

        foreach ($select as $keyselect => &$valselect) {
            $desperfil[] = array($valselect['cve_perfil'], $valselect['des_perfil']);
        }

        $select = $consulta2->executeQuery("SELECT cve_perfil,des_perfil from sb_perfil");
        foreach ($select as $keyselect => &$valselect) {
            $selecDesc[] = array($valselect['cve_perfil'], $valselect['des_perfil']);
        }
        //print_r($select);
        //die();
        $consulta2 = new PDOConsultas();
        $consulta2->connect($CFG_HOST[0], $CFG_USER[0], $CFG_DBPWD[0], $CFG_DBASE[0]);
        $select = $consulta2->executeQuery("SELECT ACveA,ADescripcion FROM cat_adscripcion;");
        foreach ($select as $keyselect => &$valselect) {
            $selecADS[] = array($valselect['ACveA'], $valselect['ADescripcion']);
        }


        $select = $consulta2->executeQuery("SELECT ADCveAD,ADDescripcion FROM cat_admindocente");
        foreach ($select as $keyselect => &$valselect) {
            $selecAD[] = array($valselect['ADCveAD'], $valselect['ADDescripcion']);
        }

        $select = $consulta2->executeQuery("SELECT AJCveAJ,AJDescripcion FROM cat_activojubilado");
        foreach ($select as $keyselect => &$valselect) {
            $selecAJ[] = array($valselect['AJCveAJ'], $valselect['AJDescripcion']);
        }


        $select = $consulta2->executeQuery("SELECT CDCveCD,CDDescripcion FROM cat_ciudaddom");
        foreach ($select as $keyselect => &$valselect) {
            $selecCD[] = array($valselect['CDCveCD'], $valselect['CDDescripcion']);
        }

        $select = $consulta2->executeQuery("SELECT CTCveCT,CTDescripcion FROM cat_ciudadtra");
        foreach ($select as $keyselect => &$valselect) {
            $selecCT[] = array($valselect['CTCveCT'], $valselect['CTDescripcion']);
        }


        $select = $consulta2->executeQuery("SELECT EPCveEP,EPDescripcion FROM estper");
        foreach ($select as $keyselect => &$valselect) {
            $selecEP[] = array($valselect['EPCveEP'], $valselect['EPDescripcion']);
        }

        $select = $consulta2->executeQuery("SELECT MCveM, MDescripcion FROM cat_modalidad");
        foreach ($select as $keyselect => &$valselect) {
            $selecM[] = array($valselect['MCveM'], $valselect['MDescripcion']);
        }

        $select = $consulta2->executeQuery("SELECT PCveP,PDescripcion FROM cat_puesto");
        foreach ($select as $keyselect => &$valselect) {
            $selecPuesto[] = array($valselect['PCveP'], $valselect['PDescripcion']);
        }

        $select = $consulta2->executeQuery("SELECT UECveUE,UEDescripcion FROM cat_unidadejecutora");
        foreach ($select as $keyselect => &$valselect) {
            $selecUE[] = array($valselect['UECveUE'], $valselect['UEDescripcion']);
        }


        $select = $consulta2->executeQuery("SELECT ZECveZE,ZEDescripcion FROM cat_zonaescolar");
        foreach ($select as $keyselect => &$valselect) {
            $selecZE[] = array($valselect['ZECveZE'], $valselect['ZEDescripcion']);
        }
        $select = $consulta2->executeQuery("SELECT OCveO,ODescripcion FROM cat_org");
        foreach ($select as $keyselect => &$valselect) {
            $selecOrg[] = array($valselect['OCveO'], $valselect['ODescripcion']);
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
        //  $str_ruta_include= "oficios/" . $__SESSION->getValueSession('claveservidor')."_".$__SESSION->getValueSession('nomusuario') ."/";
        //$str_ruta_include= "imagenes_sistema/perfiles2/";


        switch ($_POST['opc']) {
            case 0:
                //CASO DE PRIMERA VISTA, OPC 0 DE MANERAINTERNA, PARA EL FORMATO DE LA TABLA
                $field[] = array('cve_usuario', 'cve_usuario', 'HIDDEN', 'number', 'NOOBLIGATORIO', 'int', '', array(0, 12), '30', '', array(), '', '');
                $field[] = array('ClaveServidor', 'CLAVE SERVIDOR PUBLICO', 'VISTA', 'text', 'OBLIGATORIO', 'varchar', '', array(0, 12), '300', '', array(), '', '');
                $field[] = array('nom_usuario', 'NOMBRE USUARIO', 'VISTA', 'text', 'OBLIGATORIO', 'varchar', '', array(0, 12), '30', '', array(), '', '');

                $field[] = array('des_perfil', 'ROL', 'VISTA', 'number', 'OBLIGATORIO', 'int', '', array(0, 12), '30', '', array(), '', '');

                $field[] = array('des_usuario', 'DESCRIPCION DEL USUARIO', 'VISTA', 'text', 'OBLIGATORIO', 'varchar', '', array(0, 12), '300', '', array(), '', '');
                $field[] = array('ApePat', 'APELLIDO PATERNO', 'VISTA', 'text', 'OBLIGATORIO', 'varchar', '', array(0, 12), '30', '', array(), '', '');
                $field[] = array('ApeMat', 'APELLIDO MATERNO', 'VISTA', 'text', 'OBLIGATORIO', 'varchar', '', array(0, 12), '30', '', array(), '', '');
                $field[] = array('email', 'CORREO', 'VISTA', 'text', 'OBLIGATORIO', 'varchar', '', array(0, 12), '30', '', array(), '', '');
                $field[] = array('passwd', 'CONTRASEÑA', 'VISTA', 'text', 'OBLIGATORIO', 'varchar', '', array(0, 12), '30', '', array(), '', '');
                $field[] = array('Rfc', 'RFC', 'VISTA', 'text', 'OBLIGATORIO', 'varchar', '', array(0, 12), '30', '', array(), '', '');
                $field[] = array('Antiguedad', 'ANTIGUEDAD', 'VISTA', 'text', 'NOOBLIGATORIO', 'varchar', '', array(0, 12), '30', '', array(), '', '');


                $field[] = array('ADescripcion', 'ADSCRIPCION', 'VISTA', 'number', 'OBLIGATORIO', 'int', '', array(0, 12), '30', '', array(), '', '');
                $field[] = array('FechaIngAds', 'FECHA INGRESO A ADSCRIPCION', 'VISTA', 'date', 'OBLIGATORIO', 'date', '', array(0, 12), '30', '', array(), '', '');

                $field[] = array('Issemmym', 'ISSEMMYM', 'VISTA', 'text', 'OBLIGATORIO', 'varchar', '', array(0, 12), '30', '', array(), '', '');
                $field[] = array('FechaIngIss', 'FECHA INGRESO A ISSEMMYM', 'VISTA', 'date', 'OBLIGATORIO', 'date', '', array(0, 12), '30', '', array(), '', '');

                $field[] = array('ADDescripcion', 'ADMINISTRATIVO/DOCENTE', 'VISTA', 'number', 'OBLIGATORIO', 'int', '', array(0, 12), '30', '', array(), '', '');

                $field[] = array('AJDescripcion', 'ACTIVO/JUBILADO', 'VISTA', 'number', 'OBLIGATORIO', 'int', '', array(0, 12), '30', '', array(), '', '');
                $field[] = array('Sindicalizado', 'Sindicalizado', 'VISTA', 'text', 'OBLIGATORIO', 'int', '', array(0, 12), '30', '', array(), '', '');

                $field[] = array('CDDescripcion', 'CIUDAD DE DOMICILIO', 'VISTA', 'number', 'OBLIGATORIO', 'int', '', array(0, 12), '30', '', array(), '', '');
                $field[] = array('TelCD', 'TELEFONO DE DOMICILIO', 'VISTA', 'text', 'OBLIGATORIO', 'varchar', '', array(0, 12), '30', '', array(), '', '');

                $field[] = array('CTDescripcion', 'CIUDAD DE TRABAJO', 'VISTA', 'number', 'OBLIGATORIO', 'int', '', array(0, 12), '30', '', array(), '', '');
                $field[] = array('TelCT', 'TELEFONO DE TRABAJO', 'VISTA', 'text', 'OBLIGATORIO', 'varchar', '', array(0, 12), '30', '', array(), '', '');

                $field[] = array('EPDescripcion', 'ESTADO DE USUARIO', 'VISTA', 'number', 'NOOBLIGATORIO', 'int', '', array(0, 12), '30', '', array(), '', '');
                $field[] = array('MDescripcion', 'MODALIDAD', 'VISTA', 'number', 'OBLIGATORIO', 'int', '', array(0, 12), '30', '', array(), '', '');
                $field[] = array('PDescripcion', 'PUESTO FUNCIONAL', 'VISTA', 'number', 'OBLIGATORIO', 'int', '', array(0, 12), '30', '', array(), '', '');
                $field[] = array('NivelRango', 'NivelRango', 'VISTA', 'text', 'NOOBLIGATORIO', 'int', '', array(0, 12), '30', '', array(), '', '');

                $field[] = array('UEDescripcion', 'UNIDAD ADMINISTRATIVA', 'VISTA', 'number', 'OBLIGATORIO', 'int', '', array(0, 12), '30', '', array(), '', '');
                $field[] = array('ZEDescripcion', 'ZONA ESCOLAR', 'VISTA', 'number', 'OBLIGATORIO', 'int', '', array(0, 12), '30', '', array(), '', '');


                $field[] = array('user_image_file', 'FOTO', 'VISTA', 'IMAGEN', 'OBLIGATORIO', 'varchar', '', array(0, 12), '30', '', array(), '', '');

                // $field[]=array('cve_15','cve_15','VISTA','text','OBLIGATORIO','varchar', '', array(0, 12),'30','',array(),'','');
                // $field[]=array('cve_estatus','cve_estatus','VISTA','number','OBLIGATORIO','int', '', array(0, 12),'30',1,array(),'','');
                // $field[]=array('cve_organismo','ORGANISMO','VISTA','number','NOOBLIGATORIO','int', '', array(0, 12),'30','',array(),'','');
                // $field[]=array('cve_secretaria','cve_secretaria','VISTA','number','NOOBLIGATORIO','int', '', array(0, 12),'30','',array(),'','');
                // $field[]=array('cve_usergroup','cve_usergroup','HIDDEN','number','OBLIGATORIO','int', '', array(0, 12),'30',1,array(),'','');


                break;
            case 2:
                /******************SELECTS(EJEMPLO)***********************************************/
                //$field[] = array('cve_estado', 'cve_estado', 'VISTA', 'select', 'OBLIGATORIO', 'int',$vector,array(0, 12),'30','','');
                /*************************************************************************************************/
                $field[] = array('cve_usuario', 'cve_usuario', 'HIDDEN', 'number', 'NOOBLIGATORIO', 'int', '', array(0, 12), '30', '', array(), '', '');
                $field[] = array('ClaveServidor', 'CLAVE SERVIDOR PUBLICO', 'VISTA', 'text', 'OBLIGATORIO', 'varchar', '', array(0, 12), '300', '', array(), '', '');
                $field[] = array('nom_usuario', 'NOMBRE USUARIO', 'VISTA', 'text', 'OBLIGATORIO', 'varchar', '', array(0, 12), '30', '', array(), '', '');

                $field[] = array('cve_perfil', 'ROL', 'VISTA', 'select', 'NOOBLIGATORIO', 'int', $selecDesc, array(0, 12), '30', '', array(), '', '');

                $field[] = array('des_usuario', 'DESCRIPCION DEL USUARIO', 'VISTA', 'select', 'OBLIGATORIO', 'varchar', $desperfil, array(0, 12), '300', '', array(), '', '');
                $field[] = array('ApePat', 'APELLIDO PATERNO', 'VISTA', 'text', 'OBLIGATORIO', 'varchar', '', array(0, 12), '30', '', array(), '', '');
                $field[] = array('ApeMat', 'APELLIDO MATERNO', 'VISTA', 'text', 'OBLIGATORIO', 'varchar', '', array(0, 12), '30', '', array(), '', '');
                $field[] = array('email', 'CORREO', 'VISTA', 'text', 'OBLIGATORIO', 'varchar', '', array(0, 12), '30', '', array(), '', '');
                $field[] = array('passwd', 'CONTRASEÑA', 'VISTA', 'text', 'OBLIGATORIO', 'varchar', '', array(0, 12), '30', '', array(), '', '');
                $field[] = array('Rfc', 'RFC', 'VISTA', 'text', 'OBLIGATORIO', 'varchar', '', array(0, 12), '30', '', array(), '', '');
                $field[] = array('Antiguedad', 'ANTIGUEDAD', 'HIDDEN', 'text', 'NOOBLIGATORIO', 'varchar', '', array(0, 12), '30', 'NA', array(), '', '');

                $field[] = array('CveAds', 'ADSCRIPCION', 'VISTA', 'select', 'NOOBLIGATORIO', 'int',  $selecADS, array(0, 12), '30', '', array(), '', '');
                $field[] = array('FechaIngAds', 'FECHA INGRESO A ADSCRIPCION', 'VISTA', 'date', 'OBLIGATORIO', 'date', '', array(0, 12), '30', '', array(), '', '');

                $field[] = array('Issemmym', 'ISSEMMYM', 'VISTA', 'text', 'OBLIGATORIO', 'varchar', '', array(0, 12), '30', '', array(), '', '');
                $field[] = array('FechaIngIss', 'FECHA INGRESO A ISSEMMYM', 'VISTA', 'date', 'OBLIGATORIO', 'date', '', array(0, 12), '30', '', array(), '', '');

                $field[] = array('CveAD', 'ADMINISTRATIVO/DOCENTE', 'VISTA', 'select', 'OBLIGATORIO', 'int', $selecAD, array(0, 12), '30', '', array(), '', '');
                $field[] = array('CveAJ', 'ACTIVO/JUBILADO', 'VISTA', 'select', 'OBLIGATORIO', 'int', $selecAJ, array(0, 12), '30', '', array(), '', '');
                $field[] = array('Sindicalizado', 'Sindicalizado', 'VISTA', 'select', 'OBLIGATORIO', 'int', $sindicalizado, array(0, 12), '30', '', array(), '', '');

                $field[] = array('CveCD', 'CIUDAD DE DOMICILIO', 'VISTA', 'select', 'OBLIGATORIO', 'int', $selecCD, array(0, 12), '30', '', array(), '', '');
                $field[] = array('TelCD', 'TELEFONO DE DOMICILIO', 'VISTA', 'text', 'OBLIGATORIO', 'varchar', '', array(0, 12), '30', '', array(), '', '');

                $field[] = array('CveCT', 'CIUDAD DE TRABAJO', 'VISTA', 'select', 'OBLIGATORIO', 'int',  $selecCT, array(0, 12), '30', '', array(), '', '');
                $field[] = array('TelCT', 'TELEFONO DE TRABAJO', 'VISTA', 'text', 'OBLIGATORIO', 'varchar', '', array(0, 12), '30', '', array(), '', '');

                $field[] = array('CveE', 'ESTADO DE USUARIO', 'VISTA', 'select', 'OBLIGATORIO', 'int', $selecEP, array(0, 12), '30', '', array(), '', '');
                $field[] = array('CveM', 'MODALIDAD', 'VISTA', 'select', 'NOOBLIGATORIO', 'int', $selecM, array(0, 12), '30', '', array(), '', '');
                $field[] = array('CvePF', 'PUESTO FUNCIONAL', 'VISTA', 'select', 'OBLIGATORIO', 'int', $selecPuesto, array(0, 12), '30', '', array(), '', '');
                $field[] = array('NivelRango', 'NivelRango', 'VISTA', 'text', 'NOOBLIGATORIO', 'int', '', array(0, 12), '30', '', array(), '', '');

                $field[] = array('CveUA', 'UNIDAD EJECUTORA', 'VISTA', 'select', 'OBLIGATORIO', 'int', $selecUE, array(0, 12), '30', '', array(), '', '');
                $field[] = array('CveZE', 'ZONA ESCOLAR', 'VISTA', 'select', 'OBLIGATORIO', 'int', $selecZE, array(0, 12), '30', '', array(), '', '');
                $field[] = array('cve_organismo', 'ORGANISMO', 'VISTA', 'select', 'NOOBLIGATORIO', 'int', $selecOrg, array(0, 12), '30', '', array(), '', '');

                //  $field[]=array('user_image_file','FOTO','VISTA','file','NOOBLIGATORIO','varchar', '', array(0, 12),'30','',array(),'','');

                // $field[]=array('cve_15','cve_15','HIDDEN','text','NOOBLIGATORIO','varchar', '', array(0, 12),'30','',array(),'','');
                $field[] = array('cve_estatus', 'cve_estatus', 'HIDDEN', 'number', 'NOOBLIGATORIO', 'int', '', array(0, 12), '30', 1, array(), '', '');
                // $field[]=array('cve_secretaria','cve_secretari','HIDDEN','number','NONOOBLIGATORIO','int', '', array(0, 12),'30','',array(),'','');
                $field[] = array('cve_usergroup', 'cve_usergroup', 'HIDDEN', 'number', 'NOOBLIGATORIO', 'int', '', array(0, 12), '30', 1, array(), '', '');


                break;
            case 3:
                /******************SELECTS(EJEMPLO)***********************************************/
                //$field[] = array('cve_estado', 'cve_estado', 'VISTA', 'select', 'OBLIGATORIO', 'int',$vector,array(0, 12),'30','','');
                /*************************************************************************************************/
                $field[] = array('cve_usuario', 'cve_usuario', 'HIDDEN', 'number', 'NOOBLIGATORIO', 'int', '', array(0, 12), '30', '', array(), '', '');
                $field[] = array('ClaveServidor', 'CLAVE SERVIDOR PUBLICO', 'VISTA', 'text', 'OBLIGATORIO', 'varchar', '', array(0, 12), '300', '', array(), '', '');
                $field[] = array('nom_usuario', 'NOMBRE USUARIO', 'VISTA', 'text', 'OBLIGATORIO', 'varchar', '', array(0, 12), '30', '', array(), '', '');

                $field[] = array('cve_perfil', 'ROL', 'VISTA', 'select', 'NOOBLIGATORIO', 'int', $selecDesc, array(0, 12), '30', '', array(), '', '');

                $field[] = array('des_usuario', 'DESCRIPCION DEL USUARIO', 'VISTA', 'select', 'OBLIGATORIO', 'varchar', $desperfil, array(0, 12), '300', '', array(), '', '');
                $field[] = array('ApePat', 'APELLIDO PATERNO', 'VISTA', 'text', 'OBLIGATORIO', 'varchar', '', array(0, 12), '30', '', array(), '', '');
                $field[] = array('ApeMat', 'APELLIDO MATERNO', 'VISTA', 'text', 'OBLIGATORIO', 'varchar', '', array(0, 12), '30', '', array(), '', '');
                $field[] = array('email', 'CORREO', 'VISTA', 'text', 'OBLIGATORIO', 'varchar', '', array(0, 12), '30', '', array(), '', '');
                $field[] = array('passwd', 'CONTRASEÑA', 'VISTA', 'text', 'OBLIGATORIO', 'varchar', '', array(0, 12), '30', '', array(), '', '');
                $field[] = array('Rfc', 'RFC', 'VISTA', 'text', 'OBLIGATORIO', 'varchar', '', array(0, 12), '30', '', array(), '', '');
                $field[] = array('Antiguedad', 'ANTIGUEDAD', 'HIDDEN', 'text', 'NOOBLIGATORIO', 'varchar', '', array(0, 12), '30', 'NA', array(), '', '');
                $field[] = array('CveAds', 'ADSCRIPCION', 'VISTA', 'select', 'OBLIGATORIO', 'int',  $selecADS, array(0, 12), '30', '', array(), '', '');
                $field[] = array('FechaIngAds', 'FECHA INGRESO A ADSCRIPCION', 'VISTA', 'date', 'OBLIGATORIO', 'date', '', array(0, 12), '30', '', array(), '', '');

                $field[] = array('Issemmym', 'ISSEMMYM', 'VISTA', 'text', 'OBLIGATORIO', 'varchar', '', array(0, 12), '30', '', array(), '', '');
                $field[] = array('FechaIngIss', 'FECHA INGRESO A ISSEMMYM', 'VISTA', 'date', 'OBLIGATORIO', 'date', '', array(0, 12), '30', '', array(), '', '');

                $field[] = array('CveAD', 'ADMINISTRATIVO/DOCENTE', 'VISTA', 'select', 'OBLIGATORIO', 'int', $selecAD, array(0, 12), '30', '', array(), '', '');
                $field[] = array('CveAJ', 'ACTIVO/JUBILADO', 'VISTA', 'select', 'OBLIGATORIO', 'int', $selecAJ, array(0, 12), '30', '', array(), '', '');
                $field[] = array('Sindicalizado', 'Sindicalizado', 'VISTA', 'select', 'OBLIGATORIO', 'int', $sindicalizado, array(0, 12), '30', '', array(), '', '');

                $field[] = array('CveCD', 'CIUDAD DE DOMICILIO', 'VISTA', 'select', 'OBLIGATORIO', 'int', $selecCD, array(0, 12), '30', '', array(), '', '');
                $field[] = array('TelCD', 'TELEFONO DE DOMICILIO', 'VISTA', 'text', 'OBLIGATORIO', 'varchar', '', array(0, 12), '30', '', array(), '', '');

                $field[] = array('CveCT', 'CIUDAD DE TRABAJO', 'VISTA', 'select', 'OBLIGATORIO', 'int',  $selecCT, array(0, 12), '30', '', array(), '', '');
                $field[] = array('TelCT', 'TELEFONO DE TRABAJO', 'VISTA', 'text', 'OBLIGATORIO', 'varchar', '', array(0, 12), '30', '', array(), '', '');

                $field[] = array('CveE', 'ESTADO DE USUARIO', 'VISTA', 'select', 'OBLIGATORIO', 'int', $selecEP, array(0, 12), '30', '', array(), '', '');
                $field[] = array('CveM', 'MODALIDAD', 'VISTA', 'select', 'NOOBLIGATORIO', 'int', $selecM, array(0, 12), '30', '', array(), '', '');
                $field[] = array('CvePF', 'PUESTO FUNCIONAL', 'VISTA', 'select', 'OBLIGATORIO', 'int', $selecPuesto, array(0, 12), '30', '', array(), '', '');
                $field[] = array('NivelRango', 'NivelRango', 'VISTA', 'text', 'NOOBLIGATORIO', 'int', '', array(0, 12), '30', '', array(), '', '');

                $field[] = array('CveUA', 'UNIDAD EJECUTORA', 'VISTA', 'select', 'OBLIGATORIO', 'int', $selecUE, array(0, 12), '30', '', array(), '', '');
                $field[] = array('CveZE', 'ZONA ESCOLAR', 'VISTA', 'select', 'OBLIGATORIO', 'int', $selecZE, array(0, 12), '30', '', array(), '', '');
                $field[] = array('cve_organismo', 'ORGANISMO', 'VISTA', 'select', 'NOOBLIGATORIO', 'int', $selecOrg, array(0, 12), '30', '', array(), '', '');

                //  $field[]=array('user_image_file','FOTO','VISTA','file','NOOBLIGATORIO','varchar', '', array(0, 12),'30','',array(),'','');

                // $field[]=array('cve_15','cve_15','HIDDEN','text','NOOBLIGATORIO','varchar', '', array(0, 12),'30','',array(),'','');
                // $field[]=array('cve_estatus','cve_estatus','HIDDEN','number','NOOBLIGATORIO','int', '', array(0, 12),'30','',array(),'','');
                // $field[]=array('cve_secretaria','cve_secretari','HIDDEN','number','NONOOBLIGATORIO','int', '', array(0, 12),'30','',array(),'','');
                // $field[]=array('cve_usergroup','cve_usergroup','HIDDEN','number','NOOBLIGATORIO','int', '', array(0, 12),'30','',array(),'','');

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
