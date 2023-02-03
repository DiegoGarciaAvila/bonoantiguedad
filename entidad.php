<?php
include_once("configuracion_sistema/configuracion.php");
if ($__SESSION->getValueSession('nomusuario') == "") {
    include_once("includes/sb_refresh.php");
} else {
    //CREACION DEL OBJETO DE LAS CONSULTAS
    $IdPrin = $__SESSION->getValueSession('cveperfil');
    $consulta = new PDOConsultas();
    $consulta->connect($CFG_HOST[0], $CFG_USER[0], $CFG_DBPWD[0], $CFG_DBASE[0], $CFG_TIPO[0]);
    $modulo_acceso = $consulta->executeQuery("SELECT *
                                                    FROM
                                                    sb_perfil_modulo, sb_modulo
                                                    Where sb_perfil_modulo.cve_perfil =$IdPrin
                                                    and sb_perfil_modulo.cve_modulo =$modulo
                                                    and sb_perfil_modulo.cve_modulo = sb_modulo.cve_modulo
                                                    and sb_modulo.status_modulo <>0");
    $nombre_modulo_padre = $modulo_acceso[0]['descripcion_modulo'];

    /*************************************************************************************************************************************************************/
    /*OBTENCION DE LA PILA PARA EL REDIRECCIONAMIENTO DE LAS PANTALLAS DE LOS SUBNIVELES*/
    /*************************************************************************************************************************************************************/

    /*************************************************************************************************************************************************************/
    /*FIN DE LA SECCION DE LAS PILAS*/
    /*************************************************************************************************************************************************************/
    /*******************************************************************************************************************/
    /*SECCION DE EL PAGINADO*/
    /*******************************************************************************************************************/
    $consulta_paginado = new PDOConsultas();
    $consulta_paginado->connect($CFG_HOST[0], $CFG_USER[0], $CFG_DBPWD[0], $CFG_DBASE[0], $CFG_TIPO[0]); //connect to database
    if (isset($_GET['intpag'])) {
        $intpag = $_GET['intpag'];
    }
    if (strpos($strWhere, ' Where')) {
        $query_pag = " select count(*) AS TOTAL FROM " . $tabla . " " . $tabla_join . " " . $cadena_busqueda;
    } else {
        $query_pag = " select count(*) AS TOTAL FROM " . $tabla . " " . $tabla_join . " " . $strWhere . " " . $cadena_busqueda;
    }
    $total_datos = $consulta_paginado->executeQuery($query_pag);
    $reg_found = $total_datos[0]['TOTAL'];
    $decdiv = intval($reg_found / $intlimit);

    $intmod = ($reg_found / $intlimit) - $decdiv;

    if ($intmod > 0) {
        $decdiv += 1;
    }

    if (!isset($intpag))
        $intpag = 1;

    if ($intpag > $decdiv || $intpag < 0 || !isset($intpag))
        $intpag = 1;

    $intOffset = ($intlimit * $intpag) - $intlimit;
    $strlimit = " LIMIT $intlimit OFFSET $intOffset";

    /* inicia paginacion */
    $paginas = $intlimit;
    $inipag = 1;
    $finpag = $paginas;

    if ($decdiv >= $paginas) {
        if ($intpag - ($paginas / 2) >= 1 && $intpag + ($paginas / 2) <= $decdiv) {
            $inipag = $intpag - ($paginas / 2);
            $finpag = $intpag + ($paginas / 2);
        } else {
            if ($intpag - ($paginas / 2) < 1) {
                $inipag = 1;
                $finpag = $paginas;
            }
            if (($intpag + ($paginas / 2)) > $decdiv) {
                $inipag = $decdiv - $paginas;
                $finpag = $decdiv;
            }
        }
    } else {
        $finpag = $decdiv;
    }
    // echo $decdiv;
    $paginado = '<nav aria-label="Page navigation example" id="btn_numero_paginas">
                    <ul class="pagination justify-content-start">';
    for ($i = round($inipag); $i <= $finpag; $i++) {
        if ($i > $finpag) {
            $titulo1 .= '<li class="page-item disabled"><a class="page-link" href="#" tabindex="-1">FIN</a></li>';
        } else {
            if ($_GET['pila'] == '') {
                $aux_pila = "";
                $titulo1 .= "<li class=\"page-item\"><a class=\"page-link\" href=\"#\" onClick=\"window.location='" . $serveraux . "?" . 'mod=' . $_GET['mod'] . $aux_pila . "&intpag=" . $i . "'\">" . $i . '</a></li>';
            } else {
                $aux_pila = $sub_1;
                $titulo1 .= "<li class=\"page-item\"><a class=\"page-link\" href=\"#\" onClick=\"window.location='" . $serveraux  . $aux_pila . "&intpag=" . $i . "'\">" . $i . '</a></li>';
            }
        }
    }
    $paginado .= $titulo1;
    $paginado .= '   </ul>
                </nav>';

    /*******************************************************************************************************************/
    /*MICROFORMULARIO DE BUSQUEDA*/
    /*******************************************************************************************************************/

    if (isset($a_search_campo)) {
        /*SECCION DE LA CREACION DEL FORMULARRIO DE BUSQUEDA*/
        if (isset($_POST['vector_busqueda']) && strlen($_POST['buscar_campo']) > 0) {
            $cadena_auxiliar = explode("@@", $_POST['vector_busqueda']);
            $nombre_campo = $cadena_auxiliar[0];
            $tipo_dato_campo = $cadena_auxiliar[1];
            //PROGRAMAR CONDICINES DE BUSQUEDA inica contiene termina
            if ($tipo_dato_campo == 'text' || $tipo_dato_campo == 'varchar') {
                switch ($tipo_dato_campo) {
                    case 'text':
                        $filtro = $nombre_campo . " like '%" . $_POST['buscar_campo'] . "%'";
                        break;
                    case 'char':
                        $filtro = $nombre_campo . " like '%" . $_POST['buscar_campo'] . "%'";
                        break;
                    case 'varchar':
                        $filtro = $nombre_campo . " like '%" . $_POST['buscar_campo'] . "%'";
                        break;
                    case 'int':
                        $filtro = $nombre_campo . "=" . $_POST['buscar_campo'];
                        break;
                    default:
                        break;
                }
            }

            if (strlen($strWhere) <= 0) {
                $cadena_busqueda = " Where " . $filtro;
            } else {

                $cadena_busqueda = " AND " . $filtro;
                //
            }
        }
        for ($pbusqueda = 0; $pbusqueda < count($a_search_campo); $pbusqueda++) {
            $opciones_busqueda .= '<option value="' . $a_search_campo[$pbusqueda] . '@@' . $a_search_tipo[$pbusqueda] . '">' . $a_search_etiqueta[$pbusqueda] . '</option>';
        }
        $select_busqueda .= '<div class="row">';
        $select_busqueda .= '
                            <div class="col-md-6 form-group mb-3">                        
                                <select class="form-control" name="vector_busqueda" id="vector_busqueda">
                                ' . $opciones_busqueda . '
                                </select>
                                </div>
                            <div class="col-md-4 form-group mb-3">
                                <input class="form-control" id="buscar_campo" placeholder="BUSCAR" name="buscar_campo" />
                             </div>
                            <div class="col-md-2 form-group mb-3">
                                <button class="btn btn-primary">BUSCAR</button>
                            </div>';
        $select_busqueda .= '</div>';
        $strbusqueda = "";
        $strbusqueda = "<form method=\"post\" action=\"" . $_SERVER['PHP_SELF'] . "?mod=" . $_GET['mod'] . "\">";
        $strbusqueda .= "<input type=\"text\" id=\"op\" name=\"op\" value=\"1\" hidden=\"true\">";
        $strbusqueda .= "<input type=\"text\" id=\"mod\" name=\"mod\" value=\"" . $_GET['mod'] . "\" hidden=\"true\">";
        $strbusqueda .= "<input type=\"text\" id=\"opc\" name=\"opc\" value=\"0\" hidden=\"true\">";
        $strbusqueda .= $select_busqueda;
        $strbusqueda .= "</form>";
    }

    /*******************************************************************************************************************/
    /*FIN DE MICROFORMULARIO DE BUSQUEDA*/
    /*******************************************************************************************************************
    /*******************************************************************************************************************/
    /*INICIO DE LA CREACION DE LOS CAMPOS PRINCIPALES*/
    /*******************************************************************************************************************/
    //SE ESTABLECE LOS ARRAYS DE LOS CAMPOS DE LOS FIELDS
    $array_cabecera = array();
    $nombres_cabecera = array();
    $tamanio_celda = array();
    $query_principal = "SELECT ";
    $campos = "";
    /*****************************************SE ESTABLECE LOS ARRAYS DE LOS CAMPOS DE LOS FIELDS***********************/
    //DESTRIPA LOS FIELD Y LOS AGRUPA A LOS CAMPOS EN SUS RESPECTIVAS POSICIONES
    //$ban=true;
    foreach ($field as $key => &$val) {
        if ($key != count($field) - 1) {

            //      if($ban){
            //          $Pro='ORDER BY '.$val[0]. " DESC";
            //          $ban=false;
            //      }


            $campos .= $val[0] . ',';
            $array_cabecera[] =  $val[0];
            $nombres_cabecera[] =  $val[1];
            $tamanio_celda[] = $val[8];
            $vector_imagen[] = $val[3];
            $vector_modal[] = $val[12];
        } else {
            $campos .= $val[0];
            $array_cabecera[] = $val[0];
            $nombres_cabecera[] =  $val[1];
            $tamanio_celda[] = $val[8];
            $vector_imagen[] = $val[3];
            $vector_modal[] = $val[12];
        }
    }
    //SI DETECTA DATOS EN LAS TABLAS DE LOS CAMPOS DE JOIN  SE REEMPLAZAN LOS CAMPOS
    if ($campos_join != '') {
        $campos = $campos_join;
    }

    //SE SE DETECTA DATOS EN EL LA VARIABLE DE  CONDICION SE REEMPLAZA   
    if (strpos($strWhere, ' Where')) {
        $query_principal .= $campos . " FROM " . $tabla . " " . $tabla_join . " " . $cadena_busqueda . " " . $a_order;
    } else {
        if (isset($str_union_tabla)) {
            $query_principal .= $campos . " FROM " . $str_union_tabla . " " . $tabla_join . " " . $strWhere . " " . $cadena_busqueda . " " . $a_order;
        } else {
            $query_principal .= $campos . " FROM " . $tabla . " " . $tabla_join . " " . $strWhere . " " . $cadena_busqueda . " " . $a_order;
        }
    }
    // die($query_principal);
    //CREACION DE LOS OBJETOS DE LA CONSULTA



    $resultado = $consulta->executeQuery($query_principal . $strlimit);

    // print($query_principal);


?>

    <!------------------------------------------------------------------------------------------------------------------------------------------------->
    <!-------------------------------------------- VISUALIZACION DE LA TABLA -------------------------------------------------------------------->
    <!------------------------------------------------------------------------------------------------------------------------------------------------->

    <div class="row" id="table-small">

        <div class="col-12">
            <div class="card">
                <div class="modal fade text-start" id="str_modal" tabindex="-1" aria-labelledby="myModalLabel17" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel17">Modificar informacion de usuario</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div id="miiframe" name="miiframe"></div>
                            </div>
                            <!-- <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Accept</button>
                            </div> -->
                        </div>
                    </div>
                </div>
                <input type="text" id="formulario" value="<?= "formulario_" . $tabla ?>" hidden="true">
                <div class="card-body">
                    <div class="row ">
                        <?php
                        if (isset($_GET['pila'])) {
                            $sub_1 = "?mod=" . $_GET['mod'] . "&pila=" . $_GET['pila'];
                            echo '<a href="' . $_SERVER['PHP_SELF'] . '?mod=' . $_GET['mod'] . '">ATRÁS</a>';
                        } else {
                            $sub_1 = "";
                        }
                        ?>
                        <div class="col-md-4 col-12 mb-1 ">
                            <div class="input-group">
                                <h6 class="card-title mb-3" id="informacion_modulo"><?= $entidad ?><small>&nbsp;&nbsp;&nbsp;<?= "REGISTROS: " . $reg_found ?></small></h6>
                                <?php
                                if ($strnuevo) {
                                    $strnuevo = "";
                                    $strnuevo = "<form method=\"post\" action=\"" . $_SERVER['PHP_SELF'] . $sub_1 . "\" >";
                                    $strnuevo .= "<input type=\"text\" id=\"op\" name=\"op\" value=\"1\" hidden=\"true\">";
                                    $strnuevo .= "<input type=\"text\" id=\"mod\" name=\"mod\" value=\"" . $_GET['mod'] . "\" hidden=\"true\">";
                                    $strnuevo .= "<input type=\"text\" id=\"opc\" name=\"opc\" value=\"2\" hidden=\"true\">";
                                    $strnuevo .= "<input type=\"text\" id=\"btnAdd\" name=\"btnAdd\" value=\"btnAdd\" hidden=\"true\">";
                                    $strnuevo .= "<button style=\"margin:0 10px \" class=\"btn btn-primary btn4\" id=\"btn_nuevo_registro\" type=\"submit\"><span class=\"ul-btn__icon\"><i class=\"i-Gear-2\"></i></span><span class=\"ul-btn__text\">" . $boton_texto . "</span></button>";
                                    $strnuevo .= "</form>";
                                    echo $strnuevo;
                                } else {
                                    echo "";
                                }
                                ?>
                            </div>
                        </div>
                        <div class="col-md-4 col-12 mb-1">
                            <div class="input-group">
                                <?= $strbusqueda ?>
                            </div>
                        </div>
                        <div class="col-md-4 col-12 justify-content-between">
                            <div class="input-group">
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <?php
                                echo "<a href=\"reportes_sistema/excel/rep_xls.php?chain1=" . base64_encode($campos)
                                    . "&chain2=" . base64_encode($tabla)
                                    . "&chain3=" . base64_encode($tabla_join)
                                    . "&chain4=" . base64_encode($strWhere)
                                    . "&chain5=" . base64_encode($cadena_busqueda) . "\">
                                <img style=\"margin:0 10px \" src=\"imagenes_sistema/excel.png\"  title=\"DESCARGAR \"  width=\"45\" height=\"45\"  border=\"0\" />
                                </a>";

                                echo "<img style=\"margin:0 10px \"src=\"imagenes_sistema/aiuda2.png\"  id=\"tour2\" title=\"ayuda \"   height=\"45\" width=\"45\" border=\"0\" />";
                                ?>
                            </div>
                        </div>
                    </div>
                    <?php
                    if ($_GET['mod'] == 66) {
                        echo (" <div>
                                <h3>Recuerda adjuntar tu constancia anterior </h3>
                                <ol>
                              
                                </ol>
                            </div>
                            <br>");
                    }
                    ?>

                    <div class="table-responsive" id="tabla_contenido">
                        <table class="table table-sm" style="width:<?= $tamanio_tabla ?>;">
                            <thead>
                                <tr>
                                    <th style="width:5px;">PROCESOS</th>
                                    <?php
                                    for ($i = 1; $i < count($array_cabecera); $i++) {
                                        echo "<th><b>" . str_replace('CVE', ' ', str_replace('_', ' ', strtoupper($nombres_cabecera[$i]))) . "</b></th>";
                                    }
                                    ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($tabla_join != '') {
                                    if (isset($str_union_tabla)) {
                                    } else {
                                        $vector_tabla = explode(' ', $tabla);
                                        $tabla = $vector_tabla[0];
                                    }
                                }
                                foreach ($resultado as $key => &$val) {
                                    /****************************SECCION DE LOS NIVELES DE ACCESO*************************************************************/
                                    if (isset($niveles_acceso) && count($niveles_acceso) > 0) {
                                        // (valor, llave, tabla, archivo, carpeta)  

                                        for ($puntero_nivel = 0; $puntero_nivel < count($niveles_acceso); $puntero_nivel++) {
                                            $nivel_enlaces .= "<a class=\"dropdown-item\" href='javascript:;' onclick=\"detalle('" . $val[$id_prin] . "','" . $id_prin . "','" . $tabla . "','" . $niveles_acceso[$puntero_nivel] . "','" . $NOMBRE_CARPETA_PRINCIPAL . "','" . $_GET['mod'] . "','" . $nombre_modulo_padre . "');\">
                                            <i data-feather=\"edit-2\" class=\"me-50\"></i><small>
                                            " . $niveles_acceso_etiqueta[$puntero_nivel] . "</small>
                                        </a>";
                                        }

                                        $niveles = " 
                                        <div class=\"col-lg-2\">
                                                <div class=\"dropdown\">
                                                        <button type=\"button\" class=\"btn btn-sm dropdown-toggle hide-arrow py-0\" title =\"DETEALLE DEL REGISTRO\"  data-bs-toggle=\"dropdown\">
                                                            <i data-feather=\"paperclip\"></i>
                                                        </button>
                                                        <div class=\"dropdown-menu dropdown-menu-end\">
                                                            " . $nivel_enlaces . "
                                                        </div>
                                                </div> 
                                        </div>";
                                        $nivel_enlaces = "";
                                    } else {
                                        $niveles = "";
                                    }

                                    /*************************************************************************************************************************/
                                    /***********************************************AVTIVACION DEL ICONO DE LA IMPRESORA*****************************************/
                                    if ($str_impresora) {
                                        $strimpresora = "
                                        <a type=\"button\" class=\"btn btn-icon btn-flat-warning\" target=\"_blank\" onclick=\"window.open(this.href, 'mywin',
                                        'left=20,top=20,width=1000,height=800,toolbar=1,resizable=0'); return false;\" href=\"../" . $NOMBRE_CARPETA_PRINCIPAL . "/" . $str_impresora_destino . "init1=" . base64_encode($val[$id_prin]) . "&init2=" . base64_encode($id_prin) . "&init3=" . base64_encode($tabla) . "'\">
                                        <i data-feather=\"printer\"></i>
                                        </a>";
                                    } else {
                                        $strimpresora = "";
                                    }
                                    //Asignar id con el nombre de tabla y campo
                                    $stractualiza = "";
                                    echo '<tr class="table-default">';
                                    if ($streditar) {
                                        $stractualiza .= '<div class="col-lg-2">';
                                        $stractualiza .= "<form method=\"post\" id=\"formactualiza\" action=\"" . $_SERVER['PHP_SELF'] . $sub_1 . "\" >";
                                        $stractualiza .= "<input type=\"text\" id=\"id_prin\" name=\"id_prin\" value=\"$val[$id_prin] \" hidden=\"true\">";
                                        $stractualiza .= "<input type=\"text\" id=\"op\" name=\"op\" value=\"3\" hidden=\"true\">";
                                        $stractualiza .= "<input type=\"text\" id=\"mod\" name=\"mod\" value=\"" . $_GET['mod'] . "\" hidden=\"true\">";
                                        $stractualiza .= "<input type=\"text\" id=\"opc\" name=\"opc\" value=\"3\" hidden=\"true\">";
                                        $stractualiza .= "<button class=\"btn btn-icon btn-flat-primary\" id=\"btn_actualiza_registro\" title =\"ACTUALIZAR REGISTRO\" name=\"button\"><i data-feather=\"edit\"></i></button>";
                                        $stractualiza .= "</form>";
                                        $stractualiza .= '</div>';
                                    } else {
                                        $stractualiza = "";
                                    }

                                    if ($streliminar) {
                                        $strelimina = '
                                        <div class="col-lg-2">
                                                <button type="button" id="btn_elimina_registro" class="btn btn-icon btn-flat-success" title ="ELIMINAR REGISTRO" href=\'javascript:;\' onclick="elimina(\'' . $val[$id_prin] . '\',\'' . $id_prin . '\',\'' . $tabla . '\');">
                                                <i data-feather="delete" ></i>
                                                </button>
                                        </div>';
                                    } else {
                                        $streimina = "";
                                    }


                                    echo '<td>
                                                <div class="row">
                                                            ' . $stractualiza . '
                                                            ' . $strelimina . '

                                                            ' . $niveles . '
                                                           
                                                            <div class="col-lg-2">  
                                                            ' . $strimpresora . '
                                                            </div> 
                                                            
                                                            <div class="col-lg-4">                                                                                                        
                                                            </div>
                                                </div>                               
                                    </td>';
                                    for ($i = 1; $i < count($array_cabecera); $i++) {
                                        if ($vector_imagen[$i] == 'IMAGEN' || $vector_imagen[$i] == 'FILE') {
                                            switch ($vector_imagen[$i]) {
                                                case 'IMAGEN':
                                                    echo '<td style="width:' . $tamanio_celda[$i] . 'px;"><img class="d-block rounded me-1" src="' . $val[$array_cabecera[$i]] . '" alt="donuts" width="62"></td>';
                                                    break;
                                                case 'FILE':
                                                    echo '<td style="width:' . $tamanio_celda[$i] . 'px;">
                                                    <a href="' . $val[$array_cabecera[$i]] . '" target="_blank" onclick="window.open(this.href, \'mywin\',
                                                    \'left=20,top=20,width=1000,height=800,toolbar=1,resizable=0\'); return false;">
                                                    <img src="imagenes_sistema/Icono_pdf.png"   title="ayuda "   height="50" width="50" />
                                                    </a>
                                                    </td>';
                                                    break;
                                                default:
                                                    break;
                                            }
                                        } else {
                                            if ($vector_modal[$i] != '') {
                                                echo '<td style="width:' . $tamanio_celda[$i] . 'px;">' . $val[$array_cabecera[$i]] . '   
                                                     <button onclick="ejecuta_modal(\'' . $val[$id_prin] . '\',\'' . $id_prin . '\',\'' . $tabla . '\',\'' . $str_modal . '\');" class="btn btn-icon btn-flat-primary" title ="ABRIR MODAL"  name="button" value="\'' . $val[$id_prin] . '"><i data-feather="airplay" ></i></button>                                        
                                                   </td>';
                                            } else {
                                                echo '<td style="width:' . $tamanio_celda[$i] . 'px;">' . $val[$array_cabecera[$i]] . '</td>';
                                            }
                                        }
                                    }
                                    echo '</tr>';
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th style="width:5px;">PROCESOS</th>
                                    <?php
                                    for ($i = 1; $i < count($array_cabecera); $i++) {
                                        echo "<th>" . str_replace('CVE', ' ', str_replace('_', ' ', strtoupper($nombres_cabecera[$i]))) . "</th>";
                                    }
                                    ?>
                                </tr>
                            </tfoot>
                        </table>
                        <?= $paginado ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    if (isset($str_javascript_entidad)) {
        echo $str_javascript_entidad;
    }



    ?>


    <?php

    if (isset($_REQUEST['submit_btn2'])) {



        $cveusuario2_ = $_POST["id3"];
        $ClaveServidor2_ = $_POST["ClaveServidor3"];
        $nomusuario2_ = $_POST["NombreUsuario3"];
        $ApePat2_ = $_POST["ApellidoPaterno3"];
        $ApeMat2_ = $_POST["ApellidoMaterno3"];
        $Rfc2_ = $_POST["Rfc3"];
        $email2_ = $_POST["Correo3"];
        $passwd2_ = $_POST["PASS3"];
        $desusuario2_ = $_POST["desusuario3"];
        $desperfil2_ = $_POST["desperfil3"];
        $userimagefile2_ = $_POST["userimagefile3"];
        $ADescripcion2_ = $_POST["CveAds3"];
        $FechaIngAds2_ = $_POST["FechaIngAds3"];
        $PDescripcion2_ = $_POST["CvePF3"];
        $AJDescripcion2_ = $_POST["CveAJ3"];
        $ADDescripcion2_ = $_POST["CveAD3"];
        $ZEDescripcion2_ = $_POST["CveZE3"];
        $CDDescripcion2_ = $_POST["CveCD3"];
        $TelCD2_ = $_POST["TelCD3"];
        $CTDescripcion2_ = $_POST["CveCT3"];
        $TelCT2_ = $_POST["TelCT3"];
        $Issemmym2_ = $_POST["Issemmym3"];
        $FechaIngIss2_ = $_POST["FechaIngIss3"];
        $MDescripcion2_ = $_POST["CveM3"];
        $Antia2_ = $_POST["Antia3"];
        $Antim2_ = $_POST["Antim3"];
        $Antid2_ = $_POST["Antid3"];
        $UEDescripcion2_ = $_POST["CveUA3"];
        $EPDescripcion2_ = $_POST["CveE3"];
        $Sindicalizado2_ = $_POST["Sindicalizado3"];
        $NivelRango2_ = $_POST["NivelRango3"];

        
        //print_r($CveCD);
        //print_r($TelCD);
        //print_r($CveCT);
        //print_r($TelCT);
        //die();

        $consulta2 = new PDOConsultas();
        $consulta2->connect($CFG_HOST[0], $CFG_USER[0], $CFG_DBPWD[0], $CFG_DBASE[0]);
        //$usuarioeditarconsulta="select PCveUsufk from peticiones WHERE PCveP = ".$val[$id_prin] ;
       // print_r($cveusuario2_);
       // $usuarioeditar = $consulta2->executeQuery("SELECT PCveUsufk FROM peticiones WHERE PCveP = " . $cveusuario2_ );
       

        $actualisausuario3 = " UPDATE sb_usuario SET " .
            " nom_usuario = '" . $nomusuario2_ . "'," .
            " ApePat = '" . $ApePat2_ .  "'," .
            " ApeMat = '" . $ApeMat2_ . "'," .
            " email = '" . $email2_ . "'," .
            " Rfc ='" . $Rfc2_ . "'," .
            " des_usuario = '" . $desusuario2_ . "'," .
            " cve_perfil = '" . $desperfil2_. "'," .
            " CveAds = " .  $ADescripcion2_ . "," .
            " CvePF = " . $PDescripcion2_ . "," .
            " CveAJ = " . $AJDescripcion2_ . "," .
            " CveAD = " . $ADDescripcion2_ . "," .
            " FechaIngAds = '" .  $FechaIngAds2_ . "'," .
            " CveZE = " . $ZEDescripcion2_ . "," .
            " CveCD = " .  $CDDescripcion2_ . "," .
            " TelCD = '" . $TelCD2_ . "'," .
            " CveCT = " . $CTDescripcion2_ . "," .
            " TelCT = '" . $TelCT2_ . "'," .
            " Issemmym = '" . $Issemmym2_ . "'," .
            " FechaIngIss = '" . $FechaIngIss2_ . "'," .
            " CveM = " . $MDescripcion2_ . "," .
            " antia = " . $Antia2_ . "," .
            " antim = " . $Antim2_ . "," .
            " antid = " . $Antid2_ . "," .
            " CveUA = " . $UEDescripcion2_ . "," .
            " CveE = " . $EPDescripcion2_ . "," .
            " Sindicalizado = '" . $Sindicalizado2_ . "'," .
            " NivelRango = '" . $NivelRango2_ .  "'" .
            " WHERE cve_usuario = " . $cveusuario2_ . ";";
            //sleep(10);
        //print_r($actualisausuario3);
    //die();
        $consulta->executeQuery($actualisausuario3);
        if ($consulta->lastInsertId != 'null') {
            echo ("<meta http-equiv='refresh' content='1'>");
        } else {
            echo  $consulta->error;
        }
    }


    ?>


    <script src="app-assets/js/scripts/extensions/ext-component-tour-entidad.js"></script>
    <!------------------------------------------------------------------------------------------------------------------------------------------------->
    <!-------------------------------------------- CREACION DEL FORMULARIO GENERAL -------------------------------------------------------------------->
    <!------------------------------------------------------------------------------------------------------------------------------------------------->
    <script>
        $('#submit_btn').click(function() {

            Swal.fire({
                position: 'top-center',
                icon: 'success',
                title: 'REGISTRO GUARDADO CON EXITO',
                showCancelButton: false,

            })
        });
    </script>

    <script>
        function detalle(valor, llave, tabla, archivo, carpeta, mod, padre) {
            let sbniv = [Base64.encode(valor), Base64.encode(llave), Base64.encode(archivo), Base64.encode(mod), Base64.encode(padre)];
            let sbniv2 = Base64.encode(tabla);
            window.location.href = "../" + carpeta + "/index.php?mod=" + mod + "&pila=" + sbniv + "&tabs=" + sbniv2;
        }

        function elimina(valor, llave, tabla) {
            Swal.fire({
                title: 'DESEAS ELIMINAR ESTE REGISTRO?',
                text: "Este proceso es irreversible!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, de acuerdo'
            }).then((result) => {
                if (result.isConfirmed) {
                    ejecuta_elimina(valor, llave, tabla);
                }
            })
        }


        function ejecuta_elimina(valor, llave, tabla) {
            $.ajax({
                url: 'ajax_sistema/elimina.php',
                data: 'elemento=' + valor + '&llave=' + llave + '&tabla=' + tabla,
                type: 'POST',
                dataType: 'json',
                success: function(data) {
                    $('#content2').fadeIn(1000).html(data);
                    $.each(data, function(index, element) {
                        if (element.bandera === 'EXITO') {
                            Swal.fire(
                                    'ELIMINADO!',
                                    'EL REGISTRO FUE ELIMINADO DE MANERA CORRECTA.',
                                    'success'
                                ),
                                window.location.reload();
                        } else {
                            return false;
                        }
                    });
                },
                error: function(e) {
                    return false;
                }
            });
        }

        function ejecuta_modal(valor, llave, tabla, archivo) {

            $('#str_modal').modal('show');
            sendRep2(valor, llave, tabla, archivo);


        }

        var Base64 = {
            _keyStr: "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",
            encode: function(input) {
                var output = "";
                var chr1, chr2, chr3, enc1, enc2, enc3, enc4;
                var i = 0;
                input = Base64._utf8_encode(input);
                while (i < input.length) {

                    chr1 = input.charCodeAt(i++);
                    chr2 = input.charCodeAt(i++);
                    chr3 = input.charCodeAt(i++);

                    enc1 = chr1 >> 2;
                    enc2 = ((chr1 & 3) << 4) | (chr2 >> 4);
                    enc3 = ((chr2 & 15) << 2) | (chr3 >> 6);
                    enc4 = chr3 & 63;

                    if (isNaN(chr2)) {
                        enc3 = enc4 = 64;
                    } else if (isNaN(chr3)) {
                        enc4 = 64;
                    }

                    output = output +
                        this._keyStr.charAt(enc1) + this._keyStr.charAt(enc2) +
                        this._keyStr.charAt(enc3) + this._keyStr.charAt(enc4);
                }
                return output;
            },

            decode: function(input) {
                var output = "";
                var chr1, chr2, chr3;
                var enc1, enc2, enc3, enc4;
                var i = 0;

                input = input.replace(/[^A-Za-z0-9\+\/\=]/g, "");

                while (i < input.length) {

                    enc1 = this._keyStr.indexOf(input.charAt(i++));
                    enc2 = this._keyStr.indexOf(input.charAt(i++));
                    enc3 = this._keyStr.indexOf(input.charAt(i++));
                    enc4 = this._keyStr.indexOf(input.charAt(i++));

                    chr1 = (enc1 << 2) | (enc2 >> 4);
                    chr2 = ((enc2 & 15) << 4) | (enc3 >> 2);
                    chr3 = ((enc3 & 3) << 6) | enc4;

                    output = output + String.fromCharCode(chr1);

                    if (enc3 != 64) {
                        output = output + String.fromCharCode(chr2);
                    }
                    if (enc4 != 64) {
                        output = output + String.fromCharCode(chr3);
                    }
                }

                output = Base64._utf8_decode(output);

                return output;
            },

            _utf8_encode: function(string) {
                string = string.replace(/\r\n/g, "\n");
                var utftext = "";

                for (var n = 0; n < string.length; n++) {
                    var c = string.charCodeAt(n);
                    if (c < 128) {
                        utftext += String.fromCharCode(c);
                    } else if ((c > 127) && (c < 2048)) {
                        utftext += String.fromCharCode((c >> 6) | 192);
                        utftext += String.fromCharCode((c & 63) | 128);
                    } else {
                        utftext += String.fromCharCode((c >> 12) | 224);
                        utftext += String.fromCharCode(((c >> 6) & 63) | 128);
                        utftext += String.fromCharCode((c & 63) | 128);
                    }
                }
                return utftext;
            },

            _utf8_decode: function(utftext) {
                var string = "";
                var i = 0;
                var c = c1 = c2 = 0;

                while (i < utftext.length) {

                    c = utftext.charCodeAt(i);

                    if (c < 128) {
                        string += String.fromCharCode(c);
                        i++;
                    } else if ((c > 191) && (c < 224)) {
                        c2 = utftext.charCodeAt(i + 1);
                        string += String.fromCharCode(((c & 31) << 6) | (c2 & 63));
                        i += 2;
                    } else {
                        c2 = utftext.charCodeAt(i + 1);
                        c3 = utftext.charCodeAt(i + 2);
                        string += String.fromCharCode(((c & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));
                        i += 3;
                    }
                }
                return string;
            }
        }
    </script>
    <SCRIPT LANGUAGE="JavaScript">
        var d = null;

        function sendRep2(valor, llave, tabla, archivo) {
            var cadena1 = '',
                xname = '',
                i, args = sendRep2.arguments;
            var cadena2 = '';
            var cadena = '';
            var chk = true;
            var chkStr = "chk";
            var chkCnt = 0;
            document.obj_retVal = false;
            cadena1 = archivo;
            cadena1 += 'campo=' + args[0] + cadena;
            //alert(cadena1);
            openInIframe5(cadena1);
        }

        function openInIframe5(cadena1) {
            // $("#miiframe").css("overflow", "scroll");
            load_response('miiframe', cadena1);
        }

        function load_response(target, cadena1) {
            ///NI LE MUEVAN
            var myConnection = new XHConn();
            if (!myConnection)
                alert("XMLHTTP no esta disponible");
            var peticion = function(oXML) {
                $("#" + target).html(oXML.responseText);
            };
            var pars = cadena1.split('?');
            myConnection.connect(pars[0], "GET", pars[1], peticion);
        }
    </SCRIPT>
<?php
}
?>