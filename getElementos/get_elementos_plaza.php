<?php

include_once("../configuracion_sistema/configuracion.php");
include_once '../librerias/PDOConsultas.php';

$consulta = new PDOConsultas();
$consulta->connect($CFG_HOST[0], $CFG_USER[0], $CFG_DBPWD[0], $CFG_DBASE[0], $CFG_TIPO[0]);

//////SECCION PARA LA CONSUILTA DE LOS DATOS DE LOS CATALOGOS DE LOS PUESTOS
///Array ( [caso] => puesto [tipoplaza] => 2 [cveorganismo] => 1 ) 
switch ($_GET['caso']) {
        //ESTE METODO OBTENDRA TODAS LAS FUNCIONALIDADES DE LA CASCADA
    case 'puesto':
        switch ($_GET['tipoplaza']) {
            case 1:
                $query_ejecuta = "SELECT cve_puesto,puesto_funcional FROM cat_puesto WHERE rama!='' AND puesto!='' AND nivel!='' AND cve_organismo=" . $_GET['cveorganismo'] . " ORDER BY puesto_funcional ASC";
                $resultado = $consulta->executeQuery($query_ejecuta);
                if ($consulta->totalRows < 1) {
                    echo '<option value="">NO EXISTEN CAMPOS</option>';
                } else {
                    echo '<option value="">-SELECCIONE-</option>';
                    foreach ($resultado as $key => &$val) {
                        echo '<option selected=true value="' . $val['cve_puesto'] . '">' . $val['puesto_funcional'] . '</option>';
                    }
                }
                break;
            case 2:
                $query_ejecuta = "SELECT cve_contrato,categoria,rango FROM cat_contratos WHERE cve_organismo=" . $_GET['cveorganismo'] . " AND cve_tipo_contrato=2 ORDER BY categoria ASC";
                $resultado = $consulta->executeQuery($query_ejecuta);
                if ($consulta->totalRows < 1) {
                    echo '<option value="">NO EXISTEN CAMPOS</option>';
                } else {
                    echo '<option value="">-SELECCIONE-</option>';
                    foreach ($resultado as $key => &$val) {
                        if ($val['rango'] != 'NO APLICA') {
                            echo '<option value="' . $val['cve_contrato'] . '">' . $val['categoria']  . " " . $val['rango']  . '</option>';
                        } else {
                            echo '<option value="' . $val['cve_contrato'] . '">' . $val['categoria'] . '</option>';
                        }
                    }
                }
                break;
            case 3:
                $query_ejecuta = "SELECT cve_contrato,categoria FROM cat_contratos WHERE cve_organismo=" . $_GET['cveorganismo'] . " AND cve_tipo_contrato=3  ORDER BY categoria ASC";
                $resultado = $consulta->executeQuery($query_ejecuta);
                if ($consulta->totalRows < 1) {
                    echo '<option value="">NO EXISTEN CAMPOS</option>';
                } else {
                    echo '<option value="">-SELECCIONE-</option>';
                    foreach ($resultado as $key => &$val) {
                        echo '<option value="' . $val['cve_contrato'] . '">' . $val['categoria'] . '</option>';
                    }
                }
                break;
            default:
                echo "NO SE ENCONTRO NINGUN CATALOGO DISPONIBLE";
                break;
        }
        break;
    case 'nivel':
        switch ($_GET['tipoplaza']) {
            case 1:
                $query_ejecuta = "SELECT nivel FROM cat_puesto WHERE rama!='' AND puesto!='' AND nivel!='' AND cve_organismo=" . $_GET['cveorganismo'] . " AND 
                cve_puesto=" . $_GET['tipopuesto'] . "  ORDER BY puesto_funcional ASC";
                $resultado = $consulta->executeQuery($query_ejecuta);
                if ($consulta->totalRows < 1) {
                    echo '<option value="">NO EXISTEN CAMPOS</option>';
                } else {
                    // echo '<option value="">-SELECCIONE-</option>';
                    foreach ($resultado as $key => &$val) {
                        echo '<option value="' . $val['nivel'] . '">' . $val['nivel'] . '</option>';
                    }
                }
                break;
            case 2:
                $query_ejecuta = "SELECT nivel FROM cat_contratos WHERE cve_organismo=" . $_GET['cveorganismo'] . " AND cve_tipo_contrato=2 AND cve_contrato=" . $_GET['tipopuesto'] . " ORDER BY categoria ASC";
                $resultado = $consulta->executeQuery($query_ejecuta);
                if ($consulta->totalRows < 1) {
                    echo '<option value="">NO EXISTEN CAMPOS</option>';
                } else {
                    // echo '<option value="">-SELECCIONE-</option>';
                    foreach ($resultado as $key => &$val) {
                        echo '<option value="' . $val['nivel'] . '">' . $val['nivel'] . '</option>';
                    }
                }
                break;
            case 3:
                $query_ejecuta = "SELECT nivel FROM cat_contratos WHERE cve_organismo=" . $_GET['cveorganismo'] . " AND cve_tipo_contrato=3  AND cve_contrato=" . $_GET['tipopuesto'] . "  ORDER BY categoria ASC";
                $resultado = $consulta->executeQuery($query_ejecuta);
                if ($consulta->totalRows < 1) {
                    echo '<option value="">NO EXISTEN CAMPOS</option>';
                } else {
                    // echo '<option value="">-SELECCIONE-</option>';
                    foreach ($resultado as $key => &$val) {
                        echo '<option value="' . $val['cve_contrato'] . '">' . $val['categoria'] . '</option>';
                    }
                }
                break;
            default:
                echo "NO SE ENCONTRO NINGUN CATALOGO DISPONIBLE";
                break;
        }
        break;
    case 'rango':
        switch ($_GET['tipoplaza']) {
            case 1:
                $query_ejecuta = "SELECT grupo FROM cat_puesto WHERE rama!='' AND puesto!='' AND nivel!='' AND cve_organismo=" . $_GET['cveorganismo'] . " AND 
                    cve_puesto=" . $_GET['tipopuesto'] . "  ORDER BY puesto_funcional ASC";
                $resultado = $consulta->executeQuery($query_ejecuta);
                $letra = trim($resultado[0]['grupo']);
                echo '<option value="">-SELECCIONE-</option>';
                if ($letra == 'B') {
                    echo '<option value="E">E</option>';
                    echo '<option value="F">F</option>';
                    echo '<option value="G">G</option>';
                    echo '<option value="H">H</option>';
                }
                if ($letra == 'D') {
                    echo '<option value="A">A</option>';
                    echo '<option value="B">B</option>';
                    echo '<option value="C">C</option>';
                    echo '<option value="D">D</option>';
                    echo '<option value="E">E</option>';
                    echo '<option value="F">F</option>';
                    // echo '<option value="G">G</option>';
                    // echo '<option value="H">H</option>';
                }
                if ($letra == 'E') {
                    echo '<option value="A">A</option>';
                    echo '<option value="B">B</option>';
                    echo '<option value="C">C</option>';
                    echo '<option value="D">D</option>';
                }
                if ($letra == 'J' || $letra == 'K' || $letra == 'M' || $letra == 'N' || $letra == 'P' || $letra == 'V' || $letra == 'W' || $letra == 'X') {
                    echo '<option value="1">1</option>';
                    echo '<option value="2">2</option>';
                    echo '<option value="3">3</option>';
                    echo '<option value="4">4</option>';
                }
                break;
            case 2:
                $query_ejecuta = "SELECT rango FROM cat_contratos WHERE cve_organismo=" . $_GET['cveorganismo'] . " AND cve_tipo_contrato=2 AND cve_contrato=" . $_GET['tipopuesto'] . " ORDER BY categoria ASC";
                $resultado = $consulta->executeQuery($query_ejecuta);
                if ($consulta->totalRows < 1) {
                    echo '<option value="">NO EXISTEN CAMPOS</option>';
                } else {
                    // echo '<option value="">-SELECCIONE-</option>';
                    foreach ($resultado as $key => &$val) {
                        echo '<option value="' . $val['rango'] . '">' . $val['rango'] . '</option>';
                    }
                }
                break;
            case 3:
                $query_ejecuta = "SELECT rango FROM cat_contratos WHERE cve_organismo=" . $_GET['cveorganismo'] . " AND cve_tipo_contrato=3  AND cve_contrato=" . $_GET['tipopuesto'] . "  ORDER BY categoria ASC";
                $resultado = $consulta->executeQuery($query_ejecuta);
                if ($consulta->totalRows < 1) {
                    echo '<option value="">NO EXISTEN CAMPOS</option>';
                } else {
                    // echo '<option value="">-SELECCIONE-</option>';
                    foreach ($resultado as $key => &$val) {
                        echo '<option value="' . $val['rango'] . '">' . $val['rango'] . '</option>';
                    }
                }
                break;
            default:
                echo "NO SE ENCONTRO NINGUN CATALOGO DISPONIBLE";
                break;
        }
        break;

    case 'codigo':
        switch ($_GET['tipoplaza']) {
            case 1:
                $query_ejecuta = "SELECT CONCAT(grupo,rama,puesto,nivel,'" . $_GET['rango'] . "') AS codigo FROM cat_puesto WHERE rama!='' AND puesto!='' AND nivel!='' AND cve_organismo=" . $_GET['cveorganismo'] . " AND 
                cve_puesto=" . $_GET['tipopuesto'] . "  ORDER BY puesto_funcional ASC";
                $resultado = $consulta->executeQuery($query_ejecuta);
                foreach ($resultado as $key => &$val) {
                    echo '<option value="' . $val['codigo'] . '">' . $val['codigo'] . '</option>';
                }
                break;
            case 2:
                $query_ejecuta = "SELECT codigo FROM cat_contratos WHERE cve_organismo=" . $_GET['cveorganismo'] . " AND cve_tipo_contrato=2 AND cve_contrato=" . $_GET['tipopuesto'] . " ORDER BY codigo ASC";
                $resultado = $consulta->executeQuery($query_ejecuta);
                if ($consulta->totalRows < 1) {
                    echo '<option value="">NO EXISTEN CAMPOS</option>';
                } else {
                    foreach ($resultado as $key => &$val) {
                        echo '<option value="' . $val['codigo'] . '">' . $val['codigo'] . '</option>';
                    }
                }
                break;
            case 3:
                $query_ejecuta = "SELECT codigo FROM cat_contratos WHERE cve_organismo=" . $_GET['cveorganismo'] . " AND cve_tipo_contrato=3 AND cve_contrato=" . $_GET['tipopuesto'] . " ORDER BY codigo ASC";
                $resultado = $consulta->executeQuery($query_ejecuta);
                if ($consulta->totalRows < 1) {
                    echo '<option value="">NO EXISTEN CAMPOS</option>';
                } else {
                    foreach ($resultado as $key => &$val) {
                        echo '<option value="' . $val['codigo'] . '">' . $val['codigo'] . '</option>';
                    }
                }
                break;
            default:
                echo "NO SE ENCONTRO NINGUN CATALOGO DISPONIBLE";
                break;
        }
        break;

    case 'mando':
        switch ($_GET['tipoplaza']) {
            case 1:
                $query_ejecuta = "SELECT grupo FROM cat_puesto WHERE rama!='' AND puesto!='' AND nivel!='' AND cve_organismo=" . $_GET['cveorganismo'] . " AND 
                    cve_puesto=" . $_GET['tipopuesto'] . "  ORDER BY puesto_funcional ASC";

                $resultado = $consulta->executeQuery($query_ejecuta);
                $letra = trim($resultado[0]['grupo']);
                if ($letra == 'B') {
                    echo '<option value="4">ENLACE</option>';
                }
                if ($letra == 'D') {
                    echo '<option value="1">SUPERIOR</option>';
                }
                
                if ($letra == 'E') {
                    echo '<option value="2">MANDO MEDIO</option>';
                }
                if ($letra == 'J' || $letra == 'K' || $letra == 'M' || $letra == 'N' || $letra == 'P' || $letra == 'V' || $letra == 'W' || $letra == 'X') {
                    echo '<option value="5">OPERATIVO</option>';
                }
                break;
            case 2:
                $query_ejecuta = "SELECT 
                                    a.cve_tipo_mando,b.des_tipo_mando 
                                FROM 
                                    cat_contratos a
                                    LEFT JOIN cat_tipo_mando b 
                                                        ON a.cve_tipo_mando=b.cve_tipo_mando
                                WHERE 
                                    a.cve_organismo=" . $_GET['cveorganismo'] . " 
                                    AND a.cve_tipo_contrato=2 
                                    AND a.cve_contrato=" . $_GET['tipopuesto'] . "
                                ORDER BY 
                                    a.categoria ASC";
                $resultado = $consulta->executeQuery($query_ejecuta);
                if ($consulta->totalRows < 1) {
                    echo '<option value="">NO EXISTEN CAMPOS</option>';
                } else {
                    // echo '<option value="">-SELECCIONE-</option>';
                    foreach ($resultado as $key => &$val) {
                        echo '<option value="' . $val['cve_tipo_mando'] . '">' . $val['des_tipo_mando'] . '</option>';
                    }
                }
                break;
            case 3:
                $query_ejecuta = "SELECT 
                                    a.cve_tipo_mando,b.des_tipo_mando 
                                FROM 
                                    cat_contratos a
                                    LEFT JOIN cat_tipo_mando b 
                                                        ON a.cve_tipo_mando=b.cve_tipo_mando
                                WHERE 
                                    a.cve_organismo=" . $_GET['cveorganismo'] . " 
                                    AND a.cve_tipo_contrato=3 
                                    AND a.cve_contrato=" . $_GET['tipopuesto'] . "
                                ORDER BY 
                                    a.categoria ASC";
                $resultado = $consulta->executeQuery($query_ejecuta);
                if ($consulta->totalRows < 1) {
                    echo '<option value="">NO EXISTEN CAMPOS</option>';
                } else {
                    // echo '<option value="">-SELECCIONE-</option>';
                    foreach ($resultado as $key => &$val) {
                        echo '<option value="' . $val['cve_tipo_mando'] . '">' . $val['des_tipo_mando'] . '</option>';
                    }
                }
                break;
            default:
                echo "NO SE ENCONTRO NINGUN CATALOGO DISPONIBLE";
                break;
        }
        break;

    case 'limpia':
        echo '<option value="">-SELECCIONE-</option>';
        break;

    case 'codificacion':
        $query_ejecuta = "SELECT cve_ads,unidad_administrativa,cve_15 
        FROM cat_adscripciones 
        WHERE  cve_ads=" . $_GET['cveadscripcion'] . " ORDER BY unidad_administrativa ASC";
        $resultado = $consulta->executeQuery($query_ejecuta);
        if ($consulta->totalRows < 1) {
            echo '<option value="">NO EXISTEN CAMPOS</option>';
        } else {
            // echo '<option value="">-SELECCIONE-</option>';
            foreach ($resultado as $key => &$val) {
                echo '<option value="' . $val['cve_15'] . '">' . $val['cve_15'] . '</option>';
            }
        }
        break;

    default:
        echo "NO SE ENCONTRO UN CASO EN ESPECIFICO CONSULTE LOS GET ELEMENTOS";
        break;
}
