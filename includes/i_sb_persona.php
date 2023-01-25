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
        //$array_auxiliar = explode(',', $_GET['pila']);
        //$str_clave = base64_decode($array_auxiliar[0]);
        //$str_llave = base64_decode($array_auxiliar[1]);
        //$str_Include = base64_decode($array_auxiliar[2]);
        //$str_mod = base64_decode($array_auxiliar[3]);
        //$str_nivelpadre = base64_decode($array_auxiliar[4]);

        //CAMBIA EL TEXTO DEL BOTON
        $boton_texto = "REGISTRO DE PERSONAL";
        $campo = array();
        $entidad = 'DE PERSONAL';
        $btn_guardar = 'SIGUIENTE';
        $id_prin = 'cve_persona';
        if ($__SESSION->getValueSession('desperfil') == 'ADMINISTRADOR') {
            $strWhere = '';
        } else {
            $strWhere = ' WHERE a.cve_organismo=' . $__SESSION->getValueSession('cveorganismo');
        }
        $a_order = array();
        /************************SECCION DE LOS BOTONES*****************************************************************************************/
        // $strnuevo = ($__SESSION->getValueSession('alta')) ? TRUE : FALSE;
        // $streditar = ($__SESSION->getValueSession('actualiza')) ? TRUE : FALSE;
        // $streliminar = ($__SESSION->getValueSession('elimina')) ? TRUE : FALSE;

        $strnuevo = TRUE;
        $streditar = TRUE;
        $streliminar = TRUE;

        $str_impresora = TRUE; 
        $str_impresora_destino='fichas_reporte_sistema/rep_sb_persona.php?';
        /************************FIN  DE LA SECCION DE LOS BOTONES*******************************************************************************/

        $tamanio_tabla = "250%";
        $intlimit = 5;

        //SECCION DE LOS CAMPOS DE BUSQUEDA
        /******************DESCOMENTAR ESTA SECCION SI NECESITAN CAMPOS DE BUSQUEDA**************************/
        $a_search_campo = array('b.des_organismo', 'a.apellido_paterno', 'a.apellido_materno', 'a.nombre', 'a.rfc', 'j.des_profesion', 'a.curp');
        $a_search_etiqueta = array('ORGANISMO', 'APELLIDO PATERNO', 'APELLIDO MATERNO', 'NOMBRE', 'RFC', 'PROFESIÓN', 'CURP');
        $a_search_tipo = array('text', 'text', 'text', 'text', 'text', 'text', 'text');

        //SECCION DE LOS NIVELES DE ACCESO
        /******************DESCOMENTAR ESTA SECCION SI NECESITAN LOS ARCHIVOS PHP**************************/
        $niveles_acceso = array('i_sb_fotografia.php', 'i_sb_datos_organismo.php');
        $niveles_acceso_etiqueta = array('ADJUNTAR FOTOGRAFÍA', 'DATOS DEL ORGANISMO');

        /******************SECCIOM DE LOS SEPARADORES*****************************************/
        $separadores = array('', 'NACIONALIDAD Y RFC', 'DATOS PERSONALES', 'DOMICILIO Y ENTIDAD FEDERATIVA', 'SECCION DE LA PLAZA');
        /**************************************************************************/
        /******************JOINS (EJEMPLO)*****************************************/
        $tabla = 'sb_persona a';
        $tabla_join = '
								LEFT JOIN cat_organismo_aux b ON a.cve_organismo=b.cve_organismo
								LEFT JOIN cat_sexo c ON a.cve_sexo=c.cve_sexo
								LEFT JOIN cat_nacionalidad d ON a.cve_nacionalidad=d.cve_nacionalidad
								LEFT JOIN cat_estado e ON a.cve_estado_origen=e.cve_estado
								LEFT JOIN cat_municipio f ON (a.cve_estado_origen=f.cve_estado AND a.cve_municipio_origen=f.cve_municipio)
								LEFT JOIN cat_estado g ON a.cve_estado_actual=g.cve_estado
								LEFT JOIN cat_municipio h ON (a.cve_estado_actual=h.cve_estado AND a.cve_municipio_actual=h.cve_municipio)
								LEFT JOIN cat_sidicato i ON (a.cve_sindicato=i.cve_sindicato)
								LEFT JOIN cat_profesion j ON (a.cve_profesion=j.cve_profesion)';

        $campos_join = 'a.cve_persona, 
						a.cve_capturista, 
						a.cve_organismo, 
						a.apellido_paterno, 
						a.apellido_materno,
						a.nombre, 
						a.rfc, 
						a.issemym, 
						a.file_fotografia,  
						c.des_sexo, 
						b.des_organismo,
						d.des_nacionalidad, 
						e.des_estado AS des_estado_origen,
						f.des_municipio AS des_municipio_origen, 
						g.des_estado AS des_estado_actual,
						h.des_municipio AS des_municipio_actual, 
						a.ine, 
						j.des_profesion, 
						a.domicilio_actulizado, 
						IF(a.cve_hijos=1,"PADRE/MADRE DE FAMILIA","NO APLICA") AS des_hijos,
						a.curp, 
						a.telefono';
        /***************************************************************************/
        /************************SECCION DE LOS BOTONES************************************************************************************/
        //$streditar = TRUE;
        //$streliminar = TRUE;
        //$strnuevo = TRUE;
        $str_javascript = '<script src="metodos_javascript/js_sb_persona.js"></script>';
        // $str_javascript_entidad = '<script src="metodos_javascript/js_inicio.js"></script>';
        /********************************************************* *************************************************************************/
        /******************SECCION DE LOS SELECTS(EJEMPLO)***********************************/
        $consulta2 = new PDOConsultas();
        $consulta2->connect($CFG_HOST[0], $CFG_USER[0], $CFG_DBPWD[0], $CFG_DBASE[0]);
        $select = $consulta2->executeQuery("SELECT cve_profesion,des_profesion FROM cat_profesion WHERE cve_estatus=1 ORDER BY cve_profesion ASC");
        foreach ($select as $keyselect => &$valselect) {
            $vector_profesion[] = array($valselect['cve_profesion'], $valselect['des_profesion']);
        }
        $select = $consulta2->executeQuery("SELECT cve_nacionalidad,des_nacionalidad FROM cat_nacionalidad");
        foreach ($select as $keyselect => &$valselect) {
            $vector_nacionalidad[] = array($valselect['cve_nacionalidad'], $valselect['des_nacionalidad']);
        }

        $select = $consulta2->executeQuery("SELECT cve_sexo,des_sexo FROM cat_sexo");
        foreach ($select as $keyselect => &$valselect) {
            $vector_sexo[] = array($valselect['cve_sexo'], $valselect['des_sexo']);
        }
        $select = $consulta2->executeQuery("SELECT cve_sindicato,des_sindicato FROM cat_sidicato");
        foreach ($select as $keyselect => &$valselect) {
            $vector_sindicatos[] = array($valselect['cve_sindicato'], $valselect['des_sindicato']);
        }
        if ($_POST['opc'] == 3) {
            $select = $consulta2->executeQuery("SELECT cve_estado,des_estado FROM cat_estado");
            foreach ($select as $keyselect => &$valselect) {
                $vector_estado[] = array($valselect['cve_estado'], $valselect['des_estado']);
            }
        } else {
            $select = $consulta2->executeQuery("SELECT cve_estado,des_estado FROM cat_estado WHERE cve_estatus=1 ");
            foreach ($select as $keyselect => &$valselect) {
                $vector_estado[] = array($valselect['cve_estado'], $valselect['des_estado']);
            }
        }

        $select = $consulta2->executeQuery("SELECT cve_municipio,des_municipio FROM cat_municipio");
        foreach ($select as $keyselect => &$valselect) {
            $vector_municipio[] = array($valselect['cve_municipio'], $valselect['des_municipio']);
        }
        $select = $consulta2->executeQuery("SELECT cve_hijo,des_hijos FROM cat_hijos ORDER BY cve_hijo DESC");
        foreach ($select as $keyselect => &$valselect) {
            $vector_hijos[] = array($valselect['cve_hijo'], $valselect['des_hijos']);
        }
        $select = $consulta2->executeQuery("SELECT cve_tipoplaza,des_tipoplaza FROM cat_tipoplaza");
        $vector_tipoplaza[] = array("", "-SELECCIONE-");
        foreach ($select as $keyselect => &$valselect) {
            $vector_tipoplaza[] = array($valselect['cve_tipoplaza'], $valselect['des_tipoplaza']);
        }
        $select = $consulta2->executeQuery("SELECT cve_sindicato,des_sindicato FROM cat_sidicato");
        foreach ($select as $keyselect => &$valselect) {
            $vector_sindicato[] = array($valselect['cve_sindicato'], $valselect['des_sindicato']);
        }
        $select = $consulta2->executeQuery("SELECT cve_ads,unidad_administrativa,cve_15 FROM cat_adscripciones WHERE cve_organismo=" . $__SESSION->getValueSession('cveorganismo') . " ORDER BY unidad_administrativa ASC");
        foreach ($select as $keyselect => &$valselect) {
            $vector_adscripcion[] = array($valselect['cve_ads'], $valselect['unidad_administrativa'] . "-" . $valselect['cve_15']);
        }
        /************************************************************************** */
        /******************SELECTS(EJEMPLO)***********************************************/
        //$field[] = array('cve_estado', 'cve_estado', 'VISTA', 'select', 'OBLIGATORIO', 'int',$vector);
        /*************************************************************************************************/
        $select_cascada[] = array(
            "llave1" => ('cve_estado'), "llave2" => ('cve_estado'), "origen" => ('cve_estado_origen'), "destino" => ('cve_municipio_origen'), "valores" => ('cve_municipio'), "datos" => ('des_municipio'), "tablas" => array('cat_estado', 'cat_municipio'), "condicion" => (''), "update" => ('WHERE cve_municipio_origen'), "archivo" => ('../' . $NOMBRE_CARPETA_PRINCIPAL . '/getElementos/get_elementos.php')
        );
        $select_cascada[] = array(
            "llave1" => ('cve_estado'), "llave2" => ('cve_estado'), "origen" => ('cve_estado_actual'), "destino" => ('cve_municipio_actual'), "valores" => ('cve_municipio'), "datos" => ('des_municipio'), "tablas" => array('cat_estado', 'cat_municipio'), "condicion" => (''), "archivo" => ('../' . $NOMBRE_CARPETA_PRINCIPAL . '/getElementos/get_elementos.php')
        );
        /***************************************SECCION DE LOS SELECTS EN CASCADA (EJEMPLO)****************************************************
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
        // $_POST['opc']=2;

        // if ($_GET['cambio'] == 2) {
        //     $_POST['opc'] = 2;
        // } else {
        // }
        switch ($_POST['opc']) {
            case 0:
                $field[] = array('cve_persona', 'cve_persona', 'VISTA', 'text', 'OBLIGATORIO', 'bigint', '', array(0, 12), '0', '', array(), '');
                $field[] = array('des_organismo', 'ORGANISMO', 'VISTA', 'number', 'OBLIGATORIO', 'int', '', array(0, 12), '180', '', array(), '');
                $field[] = array('apellido_paterno', 'APELLIDO PATERNO', 'VISTA', 'text', 'OBLIGATORIO', 'varchar', '', array(0, 12), '10', '', array(), '');
                $field[] = array('apellido_materno', 'APELLIDO MATERNO', 'VISTA', 'text', 'OBLIGATORIO', 'varchar', '', array(0, 12), '10', '', array(), '');
                $field[] = array('nombre', 'NOMBRE', 'VISTA', 'text', 'OBLIGATORIO', 'varchar', '', array(0, 12), '10', '', array(), '');
                $field[] = array('file_fotografia', 'FOTOGRAFIA', 'VISTA', 'IMAGEN', 'OBLIGATORIO', 'varchar', '', array(0, 12), '5', '', array(), '');
                $field[] = array('rfc', 'RFC', 'VISTA', 'text', 'OBLIGATORIO', 'varchar', '', array(0, 12), '5', '', array(), '');
                //$field[] = array('numero_empleado', '# EMPLEADO', 'VISTA', 'text', 'OBLIGATORIO', 'varchar', '', array(0, 12), '5', '', array(), '');
                $field[] = array('des_sexo', 'SEXO', 'VISTA', 'number', 'OBLIGATORIO', 'int', '', array(0, 12), '2', '', array(), '');
                $field[] = array('des_profesion', 'PROFESION', 'VISTA', 'number', 'OBLIGATORIO', 'int', '', array(0, 12), '10', '', array(), '');
                $field[] = array('issemym', 'ISSEMYM', 'VISTA', 'text', 'OBLIGATORIO', 'varchar', '', array(0, 12), '5', '', array(), '');
                $field[] = array('des_nacionalidad', 'NACIONALIDAD', 'VISTA', 'number', 'OBLIGATORIO', 'int', '', array(0, 12), '10', '', array(), '');
                $field[] = array('des_estado_origen', 'ESTADO ORIGEN', 'VISTA', 'select', 'OBLIGATORIO', 'int', '', array(0, 12), '5', '', array(), '');
                $field[] = array('des_municipio_origen', 'MUNICIPIO ORIGEN', 'VISTA', 'number', 'OBLIGATORIO', 'int', '', array(0, 12), '10', '', array(), '');
                $field[] = array('des_estado_actual', 'ESTADO ACTUAL', 'VISTA', 'number', 'OBLIGATORIO', 'int', '', array(0, 12), '10', '', array(), '');
                $field[] = array('des_municipio_actual', 'MUNICIPIO ACTUAL', 'VISTA', 'number', 'OBLIGATORIO', 'int', '', array(0, 12), '10', '', array(), '');
                //$field[] = array('des_sindicato', 'SINDICATO', 'VISTA', 'text', 'OBLIGATORIO', 'varchar', '', array(0, 12), '5', '', array(), '');
                //$field[] = array('telefono', 'TELÉFONO', 'VISTA', 'text', 'OBLIGATORIO', 'varchar', '', array(0, 12), '10', '', array(), '');
                $field[] = array('curp', 'CURP', 'VISTA', 'text', 'OBLIGATORIO', 'varchar', '', array(0, 12), '10', '', array(), '');
                $field[] = array('domicilio_actulizado', 'DOMICILIO ACTUAL', 'VISTA', 'text', 'OBLIGATORIO', 'varchar', '', array(0, 12), '150', '', array(), '');
                $field[] = array('des_hijos', 'HIJOS', 'VISTA', 'number', 'OBLIGATORIO', 'int', '', array(0, 12), '2', '', array(), '');
                //$field[] = array('cve_hijas', 'HIJAS', 'VISTA', 'number', 'OBLIGATORIO', 'int', '', array(0, 12), '2', '', array(), '');
                $field[] = array('ine', 'INE', 'VISTA', 'text', 'OBLIGATORIO', 'varchar', '', array(0, 12), '10', '', array(), '');
                //$field[] = array('numero_plaza', 'NUMERO DE PLAZA', 'VISTA', 'text', 'OBLIGATORIO', 'varchar', '', array(0, 12), '25', '', array(), '');
                //$field[] = array('fecha_ingreso', 'FECHA DE INGRESO', 'VISTA', 'text', 'OBLIGATORIO', 'varchar', '', array(0, 12), '15', '', array(), '');
                //$field[] = array('fecha_baja', 'FECHA DE BAJA', 'VISTA', 'text', 'OBLIGATORIO', 'varchar', '', array(0, 12), '15', '', array(), '');
                break;
            case 2:
                $field[] = array('cve_persona', 'cve_persona', 'HIDDEN', 'text', 'NOOBLIGATORIO', 'bigint', '', array(0, 12), '30', '', array(), '');
                $field[] = array('cve_capturista', 'cve_capturista', 'HIDDEN', 'text', 'OBLIGATORIO', 'bigint', '', array(0, 12), '30', $__SESSION->getValueSession('cveusuario'), array(), '');
                $field[] = array('cve_organismo', 'cve_organismo', 'HIDDEN', 'number', 'OBLIGATORIO', 'int', '', array(0, 12), '30', $__SESSION->getValueSession('cveorganismo'), array(), '');
                $field[] = array('rfc', 'RFC', 'VISTA', 'text', 'OBLIGATORIO', 'varchar', '', array(1, 4), '30', '', array(array("pattern", ".{13,}"), array("title", "Debe contener 13 caracteres exactamente"), 
                array("minlength", 13), array("maxlength", 13)), '');
                $field[] = array('cve_nacionalidad', 'NACIONALIDAD', 'VISTA', 'select', 'OBLIGATORIO', 'int', $vector_nacionalidad, array(0, 6), '5', '', array(), '');
                $field[] = array('curp', 'CURP', 'VISTA', 'text', 'OBLIGATORIO', 'varchar', '', array(0, 6), '30', '', array(array("pattern", ".{18,}"), array("title", "Debe contener 18 caracteres exactamente"), array("minlength", 18), array("maxlength", 18)), '');
                $field[] = array('apellido_paterno', 'APELLIDO PATERNO', 'VISTA', 'text', 'OBLIGATORIO', 'varchar', '', array(1, 4), '30', '', array(array("onkeypress", "return soloLetras(event)")), '');
                $field[] = array('apellido_materno', 'APELLIDO MATERNO', 'VISTA', 'text', 'NOOBLIGATORIO', 'varchar', '', array(1, 4), '30', '', array(array("onkeypress", "return soloLetras(event)")), '');
                $field[] = array('nombre', 'NOMBRE(S)', 'VISTA', 'text', 'OBLIGATORIO', 'varchar', '', array(1, 4), '30', '', array(array("onkeypress", "return soloLetras(event)")), '');
                $field[] = array('cve_sexo', 'SEXO', 'VISTA', 'select', 'OBLIGATORIO', 'int', $vector_sexo, array(0, 2), '30', '', array(), '');
                $field[] = array('cve_profesion', 'ÚLTIMO GRADO DE ESTUDIOS', 'VISTA', 'select', 'OBLIGATORIO', 'int', $vector_profesion, array(0, 6), '30', '', array(), '');
                $field[] = array('issemym', 'ISSEMYM', 'VISTA', 'text', 'OBLIGATORIO', 'varchar', '', array(0, 2), '30', '', array(array("pattern", ".{6-10}"), array("onkeypress", "return validar_numeros(event)"), array("title", "Debe contener entre 6 y 10 caracteres "), array("minlength", 6), array("maxlength", 10)), '');
                $field[] = array('cve_hijos', 'HIJ@S', 'VISTA', 'select', 'OBLIGATORIO', 'int', $vector_hijos, array(0, 4), '30', '', array(), '');
                $field[] = array('ine', 'CLAVE DE ELECTOR INE', 'VISTA', 'text', 'OBLIGATORIO', 'varchar', '', array(0, 4), '30', '', array(array("pattern", ".{18,}"), array("title", "Debe contener 18 caracteres exactamente"), array("minlength", 18), array("maxlength", 18)), '');
                $field[] = array('cve_estado_origen', 'ESTADO DE ORIGEN', 'VISTA', 'select', 'OBLIGATORIO', 'int', $vector_estado, array(3, 6), '30', '', array(), '');
                $field[] = array('cve_municipio_origen', 'MUNICIPIO DE ORIGEN', 'VISTA', 'select', 'OBLIGATORIO', 'int', '', array(3, 6), '30', '', array(), '');
                $field[] = array('cve_estado_actual', 'ESTADO ACTUAL', 'VISTA', 'select', 'OBLIGATORIO', 'int', $vector_estado, array(0, 6), '30', '', array(), '');
                $field[] = array('cve_municipio_actual', 'MUNICIPIO ACTUAL', 'VISTA', 'select', 'OBLIGATORIO', 'int', '', array(0, 6), '30', '', array(), '');
                $field[] = array('domicilio_actulizado', 'DOMICILIO ACTUAL', 'VISTA', 'text', 'OBLIGATORIO', 'varchar', '', array(0, 12), '30', '', array(), ' CALLE, NÚMERO, COLONIA, C.P.');
                break;
            case 3:

                $field[] = array('cve_persona', 'cve_persona', 'HIDDEN', 'text', 'NOOBLIGATORIO', 'bigint', '', array(0, 12), '30', '', array(), '');
                $field[] = array('cve_capturista', 'cve_capturista', 'HIDDEN', 'text', 'OBLIGATORIO', 'bigint', '', array(0, 12), '30', $__SESSION->getValueSession('cveusuario'), array(), '');
                $field[] = array('cve_organismo', 'cve_organismo', 'HIDDEN', 'number', 'OBLIGATORIO', 'int', '', array(0, 12), '30', $__SESSION->getValueSession('cveorganismo'), array(), '');
                $field[] = array('rfc', 'RFC', 'VISTA', 'text', 'OBLIGATORIO', 'varchar', '', array(1, 4), '30', '', array(array("pattern", ".{13,}"), array("title", "Debe contener 13 caracteres exactamente"), array("minlength", 13), array("maxlength", 13)), '');
                $field[] = array('cve_nacionalidad', 'NACIONALIDAD', 'VISTA', 'select', 'OBLIGATORIO', 'int', $vector_nacionalidad, array(0, 6), '5', '', array(), '');
                $field[] = array('curp', 'CURP', 'VISTA', 'text', 'OBLIGATORIO', 'varchar', '', array(0, 6), '30', '', array(array("pattern", ".{18,}"), array("title", "Debe contener 18 caracteres exactamente"), array("minlength", 18), array("maxlength", 18)), '');
                $field[] = array('apellido_paterno', 'APELLIDO PATERNO', 'VISTA', 'text', 'OBLIGATORIO', 'varchar', '', array(1, 4), '30', '', array(array("onkeypress", "return soloLetras(event)")), '');
                $field[] = array('apellido_materno', 'APELLIDO MATERNO', 'VISTA', 'text', 'NOOBLIGATORIO', 'varchar', '', array(1, 4), '30', '', array(array("onkeypress", "return soloLetras(event)")), '');
                $field[] = array('nombre', 'NOMBRE(S)', 'VISTA', 'text', 'OBLIGATORIO', 'varchar', '', array(1, 4), '30', '', array(array("onkeypress", "return soloLetras(event)")), '');
                $field[] = array('cve_sexo', 'SEXO', 'VISTA', 'select', 'OBLIGATORIO', 'int', $vector_sexo, array(0, 2), '30', '', array(), '');
                $field[] = array('cve_profesion', 'ÚLTIMO GRADO DE ESTUDIOS', 'VISTA', 'select', 'OBLIGATORIO', 'int', $vector_profesion, array(0, 6), '30', '', array(), '');
                $field[] = array('issemym', 'ISSEMYM', 'VISTA', 'text', 'OBLIGATORIO', 'varchar', '', array(0, 2), '30', '', array(array("pattern", ".{6-10}"), array("onkeypress", "return validar_numeros(event)"), array("title", "Debe contener entre 6 y 10 caracteres "), array("minlength", 6), array("maxlength", 10)), '');
                $field[] = array('cve_hijos', 'HIJ@S', 'VISTA', 'select', 'OBLIGATORIO', 'int', $vector_hijos, array(0, 4), '30', '', array(), '');
                $field[] = array('ine', 'CLAVE DE ELECTOR INE', 'VISTA', 'text', 'OBLIGATORIO', 'varchar', '', array(0, 4), '30', '', array(array("pattern", ".{18,}"), array("title", "Debe contener 18 caracteres exactamente"), array("minlength", 18), array("maxlength", 18)), '');
                $field[] = array('cve_estado_origen', 'ESTADO DE ORIGEN', 'VISTA', 'select', 'OBLIGATORIO', 'int', $vector_estado, array(3, 6), '30', '', array(), '');
                $field[] = array('cve_municipio_origen', 'MUNICIPIO DE ORIGEN', 'VISTA', 'select', 'OBLIGATORIO', 'int', $vector_municipio, array(3, 6), '30', '', array(), '');
                $field[] = array('cve_estado_actual', 'ESTADO ACTUAL', 'VISTA', 'select', 'OBLIGATORIO', 'int', $vector_estado, array(0, 6), '30', '', array(), '');
                $field[] = array('cve_municipio_actual', 'MUNICIPIO ACTUAL', 'VISTA', 'select', 'OBLIGATORIO', 'int', $vector_municipio, array(0, 6), '30', '', array(), '');
                $field[] = array('domicilio_actulizado', 'DOMICILIO ACTUAL', 'VISTA', 'text', 'OBLIGATORIO', 'varchar', '', array(0, 12), '30', '', array(array("onkeypress", "return soloLetras(event)")), ' CALLE, NÚMERO, COLONIA, C.P.');
                //$field[] = array('telefono', 'TELÉFONO', 'VISTA', 'text', 'OBLIGATORIO', 'varchar', '', array(4, 6), '30', '', array(), '');
                //$field[] = array('extension', 'EXTENSIÓN', 'VISTA', 'text', 'OBLIGATORIO', 'varchar', '', array(4, 6), '30', '', array(), '');

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
