<?php
error_reporting(0);
//error_reporting(E_ERROR | E_WARNING | E_PARSE);
include_once("session.php");
/*
 * @CHRISTOPHER
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/*
  -----------------------------------------------------------------
  ACTIVAR DESACTIVAR DEBUG
 * @CHRISTOPHER ACTIVAMOS ESTO PARTA DETERMINAR SI HAY ALERT O FATAL ERROR
 * ACTUALMENTE EL PROCESO ES FLUIDO SI ERRORES 310821
  -----------------------------------------------------------------
 */
/*
  -----------------------------------------------------------------
  DATOS PARA LA CONEXION A LA BASE DE DATOS
 * ESTO SE DEJO PARA PROCESOS EXTERNOS, YA QUE LA CLASE GENERA ABSOLUTAMENTE TODO
 * YPOR MEDIO DE ENCRIPTACION Y MANEJO DE TOKEN PARA LA SEGURIDAD
 * DE LA PLANTILLA
  -----------------------------------------------------------------
 */
global $CFG_HOST;
global $CFG_USER;
global $CFG_DBPWD;
global $CFG_DBASE;
global $CFG_TIPO;


//PARA EL ACCESO A LA BASE DE DATOS SE DA MEDIANTELA UBICACION DEL ARRAY

/*CONEXION PARA LA BASE DE DATOS LOCAL*/
// $CFG_HOST = array("127.0.0.1", "10.10.48.33");
// $CFG_USER = array("postgres", "dgp_AbrilFlo");
// $CFG_DBPWD = array("admin123", 'C4$t#21');
// $CFG_DBASE = array("postgresplantilla", "pnomina");


$CFG_HOST = array("127.0.0.1");
$CFG_USER = array("root");
$CFG_DBPWD = array("");
$CFG_DBASE = array("db30anios");
$CFG_TIPO = array("mysql");
/*
  -----------------------------------------------------------------
  DEFINICION DE LAS VARIABLES
  -----------------------------------------------------------------
 */
define("_CFGSBASE", "SISTEMA_BONOANTIGUEDAD");
$NOMBRE_SISTEMA = "bonoantiguedad";
$NOMBRE_CARPETA_PRINCIPAL = "bonoantiguedad";
$NOMBRE_CABECERA = "SISTEMA DE RECOMPENSA POR PERMANENCIA EN EL SERVICIO 30 AÑOS";
$NOMBRE_SUBCABECERA = "SISTEMA DE RECOMPENSA POR PERMANENCIA EN EL SERVICIO 30 AÑOS";
$NOMBRE_TITLE = "SISTEMA DE CONTROL DE PERSONAL";
$__SESSION = new Session(_CFGSBASE);

$menu_sistema = "menu_horizontal.php";
$menu_sistema = "menu_vertical.php";


///SECCCION DE LA RUTA PRA LA SUBIDA DE LOS ARCHIVOS, EL PROGRAMADOR TENDRA QUE APLICAR UNA RUTA INTERNA EXTRA
$str_ruta_inicial = "C:/laragon/www/bonoantiguedad/";
