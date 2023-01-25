<?php

include_once ("../configuracion_sistema/configuracion.php");
include_once ("../librerias/PDOConsultas.php");

$strParamGet = "";
$boolPDF = "";
foreach ($_GET as $item => $value) {
    if (strlen($strParamGet) > 0)
        $strParamGet .= "&";
    $strParamGet .= $item . "=" . $value;
}

//Botones de Excel y PDF
$a_head = array();
$barra = "<div style=\"text-align: right;\"><a href=\"./reportes/clases.php?" . $strParamGet . "\"><img src=\"./reportes/icono/excel.png\"  title=\"DESCARGAR ARCHIVO\"   height=\"40\" width=\"60\" border =\"0\" /></a></div>"
    . (($boolPDF) ? ("<a href=\"javascript:abrir2('./reportes/repspdfccs.php?" . $strParamGet . "')\"><img src=\"./img/pdf.png\" height=\"42\" width=\"42\" border =\"0\" /></a>") : '');


$vector_campos = array();
$consulta = new PDOConsultas();
$consulta->connect($CFG_HOST[0], $CFG_USER[0], $CFG_DBPWD[0], $CFG_DBASE[0], $CFG_TIPO[0]);

// print_r($consulta);
// die();
$predatos = $consulta->executeQuery("SELECT 
cve_rango, 
des_rango, 
cve_estatus
FROM 
cat_rango");
if ($consulta->totalRows > 0) {
    $vector_campos = array("cve_rango", "des_rango", "cve_estatus");
?>
    <style type="text/css">
        .tftable {
            font-size: 12px;
            color: #333333;
            width: 100%;
            border-width: 1px;
            border-color: #c4c4c4;
            border-collapse: collapse;
        }

        .tftable th {
            color: #ffffff;
            font-size: 14px;
            background-color: #7367f0;
            border-width: 1px;
            padding: 8px;
            border-style: solid;
            border-color: #7367f0;
            text-align: left;
        }

        .tftable tr {
            background-color: #f9f9f9;
        }

        .tftable td {
            font-size: 12px;
            border-width: 1px;
            padding: 8px;
            border-style: solid;
            border-color: #c4c4c4;
        }

        .tftable tr:hover {
            background-color: #ffffff;
        }
    </style>
    </head>

    <body>
        TOTAL DE DATOS:
        <table class="tftable" border="1">
            <tr>
                <?php
                for ($i = 0; $i < count($vector_campos); $i++) {
                    echo '<th>' . strtoupper($vector_campos[$i]) . '</th>';
                }
                ?>
            </tr>
            <?php
            foreach ($predatos as $key => &$val) {
                echo '<tr>';
                for ($i = 0; $i < count($vector_campos); $i++) {
                    echo ' <td>' . $val[$vector_campos[$i]] . '</td>';
                }
                echo '</tr>';
            }
            ?>
        </table>
    </body>
<?php
} else {
    echo $uno = "No hay registros para mostrar";
}
?>

</html>