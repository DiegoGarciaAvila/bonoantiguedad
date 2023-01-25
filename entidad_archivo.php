<?php

if (isset($_GET['pila'])) {
    $array_auxiliar = explode(',', $_GET['pila']);
    $CONSULTA_NIVELES = new PDOConsultas();
    $CONSULTA_NIVELES->connect($CFG_HOST[0], $CFG_USER[0], $CFG_DBPWD[0], $CFG_DBASE[0], $CFG_TIPO[0]);
    $REDIRECCIONA_ARCHIVO = $CONSULTA_NIVELES->executeQuery("SELECT 
                    cve_modulo, descripcion_modulo, status_modulo, 
                    url_modulo, grupo_modulo, posicion_modulo, nivel_modulo, 
                    url_include, tipo_nivel, nivel_padre, nivel_hijo, icono
                    FROM sb_modulo
                    WHERE
                    cve_modulo=" . $modulo);

    if ($CONSULTA_NIVELES->totalRows > 0) {
        $strInclude = base64_decode($array_auxiliar[2]);
        $modulo = $REDIRECCIONA_ARCHIVO[0]['cve_modulo'];
        $array_niveles = array(
            "clave" => (base64_decode($array_auxiliar[0])),
            "llave" => (base64_decode($array_auxiliar[1])),
            "modulo" => ($REDIRECCIONA_ARCHIVO[0]['descripcion_modulo']),
            "anterior" => $_SERVER['HTTP_REFERER'],
            "mod" => (base64_decode($array_auxiliar[3])),
            "nivelpadre" => (base64_decode($array_auxiliar[4])),
            "tabla" => (base64_decode($_GET['tabs']))
        );
        $__SESSION->setValueSession('niveles', $array_niveles);

        $consultacurp = new PDOConsultas();
        $consultacurp->connect($CFG_HOST[0], $CFG_USER[0], $CFG_DBPWD[0], $CFG_DBASE[0], $CFG_TIPO[0]);
        $curp = $consultacurp->executeQuery("SELECT * FROM " . $array_niveles['tabla'] ." WHERE ". $array_niveles['llave'] . "='" . $array_niveles['clave'] . "'");
        // print_r("SELECT * FROM " . $array_niveles['tabla'] . $array_niveles['llave'] . "='" . $array_niveles['clave'] . "'");die();
        //yo puse curp por que es el campo que necesito
        $curp = $curp[0]['curp'];
?>

        <body>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h1>SUBIR FOTOGRAFIA</h1>
                        <div class="form-group">
                            <input type="text" id="tabla" name="tabla" value="<?= $array_niveles['tabla'] ?>" hidden="TRUE">
                            <input type="text" id="clave" name="clave" value="<?= $array_niveles['clave'] ?>" hidden="TRUE">
                            <input type="text" id="llave" name="llave" value="<?= $array_niveles['llave'] ?>" hidden="TRUE">
                            <input type="text" id="curp" name="curp" value="<?= $curp ?>" hidden="TRUE">
                            <input type="text" id="campo" name="campo" value="<?= $field[0][0] ?>" hidden="TRUE">
                            <input multiple type="file" class="form-control" id="inputArchivos">
                            <br>
                            <button id="btnEnviar" class="btn btn-success">Enviar</button>
                        </div>
                        <div class="alert alert-info" id="estado"></div>
                    </div>
                </div>
            </div>
        </body>
        <script>
            /*
    https://parzibyte.me/blog
*/
            // Elementos del DOM
            const $inputArchivos = document.querySelector("#inputArchivos"),
                $btnEnviar = document.querySelector("#btnEnviar"),
                $estado = document.querySelector("#estado");
            $btnEnviar.addEventListener("click", async () => {
                const archivosParaSubir = $inputArchivos.files;
                if (archivosParaSubir.length <= 0) {
                    // Si no hay archivos, no continuamos
                    return;
                }
                // Preparamos el formdata
                const formData = new FormData();
                // Agregamos cada archivo a "archivos[]". Los corchetes son importantes
                for (const archivo of archivosParaSubir) {
                    formData.append("archivos[]", archivo);
                }
                formData.append("tabla", $('#tabla').val());
                formData.append("clave", $('#clave').val());
                formData.append("llave", $('#llave').val());
                formData.append("campo", $('#campo').val());
                formData.append("curp", $('#curp').val());
                
                // Los enviamos
                $estado.textContent = "Enviando archivos...";
                const respuestaRaw = await fetch("ajax_sistema/guardar.php", {
                    method: "POST",
                    body: formData,
                });
                const respuesta = respuestaRaw.json();
                // Puedes manejar la respuesta como tú quieras
                console.log({
                    respuesta
                });
                // Finalmente limpiamos el campo
                $inputArchivos.value = null;
                $estado.textContent = "Archivos enviados";
            });
        </script>

<?php
    } else {
        echo "ERRROR AL OBTENER EL CODIGO DE INCLUDE";
    }
}
