<?php
require_once '../configuracion_sistema/configuracion.php';
require_once '../librerias/PDOConsultas.php';
$events = array();
$consulta = new PDOConsultas();
$consulta->connect($CFG_HOST[0], $CFG_USER[0], $CFG_DBPWD[0], $CFG_DBASE[0],$CFG_TIPO[0]); //connect to 
$consulta->executeQuery("DELETE FROM ");
$elemento = $_POST['elemento'];
$llave = $_POST['llave'];
$tabla = $_POST['tabla'];
$query = "DELETE FROM " . $tabla . " WHERE " . $llave . "=" . $elemento;
$consulta->executeQuery($query);

$e['bandera'] = "EXITO";
$e['errores'] = "NO SE EJECUTO NINGUNA INSTRUCCION";
array_push($events, $e);
echo json_encode($events);
