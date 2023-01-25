<?php

session_start();
require_once '../configuracion_sistema/configuracion.php';
require_once '../librerias/PDOConsultas.php';
$events = array();
$consulta = new PDOConsultas();
$consulta->connect($CFG_HOST[0], $CFG_USER[0], $CFG_DBPWD[0], $CFG_DBASE[0], $CFG_TIPO[0]);

if (isset($_FILES) && count($_FILES) > 0) {
    $files = $_FILES;
    $str_ruta_include = $_POST['ruta'];
    //////ESTO LO PUSE PARA ASIGNAR LAS VALORES DE LAS VARIABLES DE LOS FILES, SE TENDRAN QUE VALIDAR PREVIAMENTE POR JAVASCRIPT
    $campos_file = "";
    $valores_file = "";
    foreach ($files as $keyfile => &$valfile) {
        $campos_file .= "," . $keyfile;
        $nombre_archivo = explode('.', $files[$keyfile]["name"]);
        $nombre_archivo = $nombre_archivo[0];
        $ubicacionTemporal = $files[$keyfile]["tmp_name"];
        $extension = pathinfo($files[$keyfile]["full_path"], PATHINFO_EXTENSION);
        $valores_file .= ",'" . $_POST['ruta'] . $nombre_archivo . "." . $extension . "'";
        $ruta_previa_destino = $str_ruta_inicial . $str_ruta_include;

        if (!mkdir($ruta_previa_destino, 0777, true)) {
        }
        move_uploaded_file($ubicacionTemporal, $ruta_previa_destino . $nuevoNombre . $nombre_archivo  . "." . $extension);
    }

    $field = $_POST;
    $puntero = 1;
    $query = "INSERT INTO " . $_POST['tabla'] . " (";
    $query_valores = "(";
    foreach ($field as $key => &$val) {
        if (0 == (count($field) - $puntero)) {
            $query .= $key . $campos_file . ") VALUES ";
            $query_valores .= "'" . $val . "' " . $valores_file . ")";
        } else {
            //el tres es para evitar el indice donde apuntan los datos principales de la tabla
            if ($puntero > 3) {
                if (0 == (count($field) - $puntero)) {
                } else {
                    $query .= $key . ", ";
                    $query_valores .= "'" . $val . "', ";
                }
            }
        }
        $puntero++;
    }
} else {
    /////// ESTE APARTADO ES PARA DIVIDIR LOS CAMPOS DE LA UNION DE LAS TABLAS PARA EL REGISTRO DE LA INFORMACION
    $field = $_POST;
    //TABLAS PARA EL INSERTADO DE DATOS  POR SEPARADO CON LAS PREVIAS VALIDACIONES DE CADA UNO
    $tabla_persona = "sb_persona";
    $tabla_plazas = "dt_plaza";
    $campos_persona = " cve_capturista,
                        cve_organismo,
                        rfc,
                        cve_nacionalidad,
                        curp,
                        apellido_paterno,
                        apellido_materno,
                        nombre,
                        cve_sexo,
                        cve_profesion,
                        issemym,
                        cve_hijos,
                        ine,
                        cve_estado_origen,
                        cve_municipio_origen,
                        cve_estado_actual,
                        cve_municipio_actual,
                        domicilio_actulizado";

    $cve_capturista = "'" . $_POST['cve_capturista'] . "'";
    $cve_organismo = "'" . $_POST['cve_organismo'] . "'";
    $rfc = "'" . $_POST['rfc'] . "'";
    $cve_nacionalidad = "'" . $_POST['cve_nacionalidad'] . "'";
    $curp = "'" . $_POST['curp'] . "'";
    $apellido_paterno = "'" . $_POST['apellido_paterno'] . "'";
    $apellido_materno = "'" . $_POST['apellido_materno'] . "'";
    $nombre = "'" . $_POST['nombre'] . "'";
    $cve_sexo = "'" . $_POST['cve_sexo'] . "'";
    $cve_profesion = "'" . $_POST['cve_profesion'] . "'";
    $issemym = "'" . $_POST['issemym'] . "'";
    $cve_hijos = "'" . $_POST['cve_hijos'] . "'";
    $ine = "'" . $_POST['ine'] . "'";
    $cve_estado_origen = "'" . $_POST['cve_estado_origen'] . "'";
    $cve_municipio_origen = "'" . $_POST['cve_municipio_origen'] . "'";
    $cve_estado_actual = "'" . $_POST['cve_estado_actual'] . "'";
    $cve_municipio_actual = "'" . $_POST['cve_municipio_actual'] . "'";
    $domicilio_actulizado = "'" . $_POST['domicilio_actulizado'] . "'";

    $valores_persona = $cve_capturista . "," . $cve_organismo . "," . $rfc . "," . $cve_nacionalidad
        . "," . $curp . "," . $apellido_paterno . "," . $apellido_materno . "," . $nombre
        . "," . $cve_sexo . "," . $cve_profesion . "," . $issemym . "," . $cve_hijos
        . "," . $ine . "," . $cve_estado_origen . "," . $cve_municipio_origen . "," . $cve_estado_actual . "," . $cve_municipio_actual . "," . $domicilio_actulizado;

    $query_personas = "INSERT INTO " . $tabla_persona . "(" . $campos_persona . ") VALUES (" . $valores_persona . ")";


    $campos_plaza = "
                        cve_usuario,
                        cve_tipoplaza,
                        cve_organismo,
                        cve_puesto,
                        cve_nivel,
                        cve_rango,
                        codigo,
                        num_empleado,
                        cve_tipo_mando,
                        cve_sindicato,
                        cve_ads,
                        codificacion,
                        fecha_captura,
                        fecha_inicio,
                        fecha_fin";

    $cve_usuario = "'" . $_POST['cve_usuario'] . "'";
    $cve_tipoplaza = "'" . $_POST['cve_tipoplaza'] . "'";
    $cve_organismo = "'" . $_POST['cve_organismo'] . "'";
    $cve_puesto = "'" . $_POST['cve_puesto'] . "'";
    $cve_nivel = "'" . $_POST['cve_nivel'] . "'";
    $cve_rango = "'" . $_POST['cve_rango'] . "'";
    $codigo = "'" . $_POST['codigo'] . "'";
    $num_empleado = "'" . $_POST['num_empleado'] . "'";
    $cve_tipo_mando = "'" . $_POST['cve_tipo_mando'] . "'";
    $cve_sindicato = "'" . $_POST['cve_sindicato'] . "'";
    $cve_ads = "'" . $_POST['cve_ads'] . "'";
    $codificacion = "'" . $_POST['codificacion'] . "'";
    $fecha_captura = "'" . $_POST['fecha_captura'] . "'";
    $fecha_inicio = "'" . $_POST['fecha_inicio'] . "'";
    $fecha_fin = "'" . $_POST['fecha_fin'] . "'";

    $valores_plaza = $cve_usuario . "," . $cve_tipoplaza . "," . $cve_organismo . "," . $cve_puesto . "," . $cve_nivel .
        "," . $cve_rango . "," . $codigo . "," . $num_empleado . "," . $cve_tipo_mando . "," . $cve_sindicato . "," . $cve_ads . "," . $codificacion . ","
        . $fecha_captura . "," . $fecha_inicio . "," . $fecha_fin;

        
    $query_plaza =  "INSERT INTO " . $tabla_plazas . "(" . $campos_plaza . ") VALUES (" . $valores_plaza . ")";

    $consulta->executeQuery($query_plaza);

    if ($consulta->lastInsertId != 'null') {
        if (isset($consulta->error)) {
            $array_error = $consulta->error;
            $error_cadena = substr($array_error[0], 1, 14);
            if ($error_cadena == "QLSTATE[23000]") {
                echo  "EL REGISTRO YA EXISTE";
            } else {
                echo $consulta->error;
            }
        } else {
            echo  "EXITO";
        }
    } else {
        echo $consulta->error;
    }
}
