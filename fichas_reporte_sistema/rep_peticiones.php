<?php
header('Content-Type: text/html; charset=UTF-8');
require_once('../librerias/PHPfpdf/fpdf.php');
include_once('../configuracion_sistema/configuracion.php');
require_once('../librerias/PDOConsultas.php');



class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    
    /*
    1.-ancho x
    2.-altura y
    3.-texto
    4.-contorno
    5.-sato de linea
    6.-centrado
    */ 
    // Logo
    $this->Image('../imagenes_sistema/desiciones.jpg',10,8,33);
    $this->Image('../imagenes_sistema/imagen_fpdf/desiciones.jpg',161,5,45);

    // Arial bold 15
    $this->SetFont('helvetica','B',10);
    // Movernos a la derecha
    $this->Cell(52);
    // Título
    $this->Cell(92,12,utf8_decode('PROPUESTA DE CANDIDATO PARA RECOMPENSA 2022'),0,0,'C');
   
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-16);
    $this->SetFont('helvetica','',5);

    $this->Cell(0,0,'_________________________________________________________________________________________________________________________________________________________________________________________________________',0,1);

    // Arial italic 8
    $this->SetFont('helvetica','B',5);
    $this->Cell(67);
    $this->Cell(23,5,utf8_decode('SECRETARÍA DE FINANZAS'));

    $this->SetFont('helvetica','',5);

    $this->Cell(3);
    $this->Cell(55,5,utf8_decode('PORTAL MADERO NO.216 EDIF.MONROY 2° PISO.COL. CENTRO'));

    $this->Ln(2);
    $this->Cell(57);
    $this->Cell(33,5,utf8_decode('SUBSECRETARÍA DE ADMINISTRACIÓN'));

    $this->Cell(3);
    $this->Cell(25,5,utf8_decode('TOLUCA, ESTADO DE MEXICO'));

     // Número de página
    $this->Cell(60);

    $this->Cell(0,10,'Página '.$this->PageNo().'/{nb}');

    $this->Ln(2);
    $this->Cell(59);
    $this->Cell(31,5,utf8_decode('DIRECCIÓN GENERAL DE PERSONAL'));

    $this->Cell(3);
    $this->Cell(25,5,utf8_decode('CODIGO POSTAL 50000'));

    $this->Ln(2);

    
   
}
}
////init1 es el valor obtenido de la tabla
/////init2 es el campo principal
/////init 3 es la tabla
$valor=base64_decode($_GET['init1']);
$campo=base64_decode($_GET['init2']);
$tabla=base64_decode($_GET['init3']);


$consulta = new PDOConsultas();
$consulta->connect($CFG_HOST[0], $CFG_USER[0], $CFG_DBPWD[0], $CFG_DBASE[0],$CFG_TIPO[0]);
$select= $consulta->executeQuery("SELECT a.PCveP as Cve ,a.PFolio as NumeroRegistro,a.PFecha AS 'FechaRegistro',
b.nom_usuario as NombreUsuario,b.Rfc as Rfc, b.antia as Antia,b.antim as Antim,b.antid as Antid,
c.ADescripcion as Adscripcion,
d.PDescripcion as PuestoFuncional,
e.AJDescripcion as ActivoJubilado,
f.ADDescripcion as AdminDocen,
g.ZEClave as ZonaEscolar,
b.TelCD as TelCD,
h.CDDescripcion as CD,
b.TelCT as TelCT,
i.CTDescripcion as CT,
k.nom_usuario as Supervisor
FROM peticiones a
left JOIN sb_usuario b ON (a.PCveUsufk=b.cve_usuario)
left JOIN cat_adscripcion c ON (b.CveAds=c.ACveA)
left JOIN cat_puesto d ON (b.CvePF=d.PCveP)
LEFT JOIN cat_activojubilado e on (b.CveAJ=e.AJCveAJ)
LEFT JOIN cat_admindocente f ON (b.CveAD=f.ADCveAD)
LEFT JOIN cat_zonaescolar g ON (b.CveZE=g.ZECveZE)
LEFT JOIN cat_ciudaddom h ON (b.CveCD=h.CDCveCD)
LEFT JOIN cat_ciudadtra i ON (b.CveCT=i.CTCveCT)
inner JOIN sb_perfil_usuario j ON (a.PCveURfk= j.cve_perfil_usuario)
inner JOIN sb_usuario k ON (k.cve_usuario= j.cve_usuario)
WHERE a.PCveP= $valor")
;
//print_r($select);
$Cve=$select[0]['Cve'];
$FechaRegistro=$select[0]['FechaRegistro'];
$NumeroRegistro=$select[0]['NumeroRegistro'];
$NombreUsuario=$select[0]['NombreUsuario'];
$Rfc=$select[0]['Rfc'];
$Adscripcion=$select[0]['Adscripcion'];
$PuestoFuncional=$select[0]['PuestoFuncional'];

$ActivoJubilado=$select[0]['ActivoJubilado'];
$ActivoJubiladoMarcaActivo='';
$ActivoJubiladoMarcaJubilado='';
if($ActivoJubilado=='ACTIVO'){
    $ActivoJubiladoMarcaActivo='X';
    $ActivoJubiladoMarcaJubilado='';
}
if($ActivoJubilado=='JUBILADO'){
    $ActivoJubiladoMarcaActivo='';
    $ActivoJubiladoMarcaJubilado='X';
}

$AdminDocen=$select[0]['AdminDocen'];
$AdminDocenMarcaAdmin='';
$AdminDocenMarcaDocen='';
if($AdminDocen=='ADMINISTRATIVO'){
    $AdminDocenMarcaAdmin='X';
    $AdminDocenMarcaDocen='';
}
if($AdminDocen=='DOCENTE'){
    $AdminDocenMarcaAdmin='';
    $AdminDocenMarcaDocen='X';
}


$ZonaEscolar=$select[0]['ZonaEscolar'];
$TelCD=$select[0]['TelCD'];
$CD=$select[0]['CD'];
$TelCT=$select[0]['TelCT'];
$CT=$select[0]['CT'];

$Antia =$select[0]['Antia'];
$Antim =$select[0]['Antim'];
$Antid =$select[0]['Antid'];

$Supervisor=$select[0]['Supervisor'];

$Antiguedad = $Antia . " años " ;
if( $Antim === '1'){
    $Antiguedad =$Antiguedad.  $Antim ." mes " ;
}else{
    $Antiguedad =$Antiguedad.  $Antim ." meses ";

}
if( $Antid === '1'){
    $Antiguedad = $Antiguedad. $Antid . " dia" ;
}else{
    $Antiguedad = $Antiguedad. $Antid . " dias" ;
}


// Creación del objeto de la clase heredada
$pdf = new PDF('P','mm',array(216 ,279));

$pdf->AddPage();
//$pdf->AddFont('HelveticaNeueLTStd','','HelveticaNeueLTStd-Th.php');

$pdf->AliasNbPages();
 // Salto de línea
$pdf->SetFont('helvetica','B',10);
$pdf->Ln(5);
$pdf->Cell(128);
$pdf->Cell(58,30,utf8_decode('Fecha de registro: ' . $FechaRegistro));
$pdf->Ln(5);
$pdf->Cell(125);
$pdf->Cell(58,30,utf8_decode('Número de registro: '.$NumeroRegistro));
$pdf->Ln(5);
$pdf->Cell(190,15,'',0,1);
$pdf->SetFont('helvetica','',10);

$pdf->MultiCell(0,7,utf8_decode('Por este conducto, respetuosamente propongo al Jurado de Premiación para el Otorgamiento de Reconocimientos a Servidores Públicos, considerar como candidato para obtener una recompensa en la modalidad de:') );

$pdf->Cell(70,12,'',0,0);

$pdf->SetFont('helvetica','B',10);
$pdf->Cell(12,12,'PERMANENCIA EN EL SERVICIO',0,1);

$pdf->SetFont('helvetica','',10);
$pdf->Cell(0,7,utf8_decode('Al servidor público cuyos datos a continuación detallo:'),0,1);

$pdf->SetFont('helvetica','B',10);
$pdf->Cell(10,8,'',0,0);
$pdf->Cell(14,7,utf8_decode('Nombre:'),0,0);

$pdf->SetFont('helvetica','',10);
$pdf->Cell(22,8,'',0,0);
$pdf->Cell(0,7,utf8_decode($NombreUsuario),0,1);


$pdf->SetFont('helvetica','B',10);
$pdf->Cell(10,8,'',0,0);
$pdf->Cell(14,7,utf8_decode('RFC:'),0,);

$pdf->SetFont('helvetica','',10);
$pdf->Cell(22,8,'',0,0);
$pdf->Cell(0,7,utf8_decode($Rfc),0,1);


$pdf->SetFont('helvetica','B',10);
$pdf->Cell(10,8,'',0,0);
$pdf->Cell(14,7,utf8_decode('Adscripción:'),0,0);

$pdf->SetFont('helvetica','',10);
$pdf->Cell(22,8,'',0,0);
$pdf->Cell(0,7,utf8_decode($Adscripcion),0,1);


$pdf->SetFont('helvetica','B',10);
$pdf->Cell(10,8,'',0,0);
$pdf->Cell(14,7,utf8_decode('Puesto funcional: '),0,0);

$pdf->SetFont('helvetica','',10);
$pdf->Cell(22,8,'',0,0);
$pdf->Cell(0,7,utf8_decode($PuestoFuncional),0,1);

$pdf->SetFont('helvetica','B',10);
$pdf->Cell(10,8,'',0,0);
$pdf->Cell(0,7,utf8_decode('Activo( '.$ActivoJubiladoMarcaActivo.' )  Jubilado( '.$ActivoJubiladoMarcaJubilado.' )'),0,1);

$pdf->SetFont('helvetica','B',10);
$pdf->Cell(10,8,'',0,0);
$pdf->Cell(0,7,utf8_decode('Administrativo( '.$AdminDocenMarcaAdmin.' )  Docente( '.$AdminDocenMarcaDocen.' )'),0,1);

$pdf->SetFont('helvetica','B',10);
$pdf->Cell(10,8,'',0,0);
$pdf->Cell(14,7,utf8_decode('Zona escolar o Subdirección regional:'),0,0);

$pdf->SetFont('helvetica','',10);
$pdf->Cell(52,8,'',0,0);
$pdf->Cell(0,7,utf8_decode($ZonaEscolar),0,1);

$pdf->SetFont('helvetica','B',10);
$pdf->Cell(10,8,'',0,0);
$pdf->Cell(14,7,utf8_decode('Teléfono domicilio:'),0,0);

$pdf->SetFont('helvetica','',10);
$pdf->Cell(22,8,'',0,0);
$pdf->Cell(0,7,utf8_decode($TelCD),0,1);

$pdf->SetFont('helvetica','B',10);
$pdf->Cell(10,8,'',0,0);
$pdf->Cell(14,7,utf8_decode('Ciudad domicilio:'),0,0);

$pdf->SetFont('helvetica','',10);
$pdf->Cell(22,8,'',0,0);
$pdf->Cell(0,7,utf8_decode($CD),0,1);

$pdf->SetFont('helvetica','B',10);
$pdf->Cell(10,8,'',0,0);
$pdf->Cell(14,7,utf8_decode('Teléfono trabajo:'),0,0);

$pdf->SetFont('helvetica','',10);
$pdf->Cell(22,8,'',0,0);
$pdf->Cell(0,7,utf8_decode($TelCT),0,1);

$pdf->SetFont('helvetica','B',10);
$pdf->Cell(10,8,'',0,0);
$pdf->Cell(14,7,utf8_decode('Ciudad trabajo:'),0,0);

$pdf->SetFont('helvetica','',10);
$pdf->Cell(22,8,'',0,0);
$pdf->Cell(0,7,utf8_decode($CT),0,1);

$pdf->SetFont('helvetica','B',10);
$pdf->Cell(10,8,'',0,0);
$pdf->Cell(14,7,utf8_decode('Antigüedad:'),0,0);

$pdf->SetFont('helvetica','',10);
$pdf->Cell(22,8,'',0,0);
$pdf->Cell(0,7,utf8_decode($Antiguedad),0,1);
$pdf->Cell(0,3,'',0,1);

$pdf->MultiCell(0,7,utf8_decode('Por medio de la presente, manifiesto que los datos asentados en este formato, fueron revisados por el suscrito, por lo que avalo bajo mi responsailidad, que éstos son correctos, los cuales serán utilizados para la elaboración del diploma, medalla y cheque que me serán otorgados.') );


$pdf->Cell(0,3,'',0,1);

$pdf->MultiCell(0,7,utf8_decode('Asimismo manifiesto que cuento como mínimo al 31 de diciembre del presente año, con 29 años, 6 meses y 1 un día de servicio activo como servidor público en el Gobierno del Estado de México, para obtener la recomprensa por Permanencia en el Servicio y que de desmostrárse que no es así, me sujero a las responsabilidades del caso.') );
$pdf->Cell(0,5,'',0,1);
$pdf->SetFont('helvetica','B',10);

$pdf->Cell(0,3,'ATENTAMENTE',0,1,'C');
$pdf->Cell(0,20,'',0,1);
$pdf->Cell(0,3,'NOMBRE Y FIRMA',0,1,'C');
$pdf->Cell(0,15,'',0,1);
$pdf->Cell(0,3,utf8_decode('Atendidio por: '.$Supervisor),0,0);











$pdf->Output();

?>

