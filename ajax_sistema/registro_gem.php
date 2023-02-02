<?php

require_once '../configuracion_sistema/configuracion.php';
require_once '../librerias/PDOConsultas.php';


//-------------------------DATOS LOCAL----------------------------
$claveservidorpublico = $_POST["claveservidorpublico"];
$nombreservidor = $_POST["nombreservidor"];
$telcd = $_POST["telcd"];
$correo = $_POST["correo"];
$password = $_POST["password"];
$passwordconfirmar = $_POST["passwordconfirmar"];
$hoy = getdate();
$fecha = $hoy['year'] . '-' . $hoy['mon'] . '-' . $hoy['mday'];


if ($password == $passwordconfirmar) {

    //----------------------------DATOS SERVER------------------------------
    $consulta = new PDOConsultas();
    $consulta->connect($CFG_HOST[1], $CFG_USER[1], $CFG_DBPWD[1], $CFG_DBASE[1],$CFG_TIPO[1]);

    $selectserver = $consulta->executeQuery("
                    SELECT A.STD_ID_PERSON AS CVE_SP, A.STD_N_FAM_NAME_1 AS A_PATERNO, A.STD_N_MAIDEN_NAME A_MATERNO, A.STD_N_FIRST_NAME A_NOMBRE, G.STD_N_GENDERESP AS GENERO, K.SCO_GB_ADDRESS AS DIRECCION,A.SME_RFC, A.SME_CURP, A.SME_NUM_SS AS ISSEMYM,
                    IIF(E.CME_ID_PLAZA_ANT IS NULL,'',E.CME_ID_PLAZA_ANT) AS PZA_9,E.CME_ID_PLAZA_FUMP AS PZA_15,
                    E.SCO_ID_WORK_UNIT AS ADSC, J.STD_N_WORK_UNITENG AS SECRETARIA,E.SCO_ID_WORK_LOC AS CCT,REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(UPPER(LTRIM(RTRIM(I.STD_WORK_LOCESP))),'.',' '),'-',' '),'/',''),'\"',''),'Ñ','N'),'Á','A'),'É','E'),'Í','I'),'Ó','O'),'Ú','U'),',',' '),'\"','') AS NOM_CCT,
                    E.SCO_ID_JOB_CODE AS PUESTO, RIGHT(E.SCO_ID_JOB_CODE,3) AS NIVELR,
                    REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(UPPER(LTRIM(RTRIM(F.STD_N_JOB_CODEESP))),'.',' '),'-',' '),'/',''),'\"',''),'Ñ','N'),'Á','A'),'É','E'),'Í','I'),'Ó','O'),'Ú','U'),',',' '),'\"','') AS LEYENDAPUESTO,
                    CAST(B.SSP_FEC_ANTIGUEDAD AS DATE) AS F_ANTIGUEDAD,
                    (((12* year(getdate()))-(12*(year(B.SSP_FEC_ANTIGUEDAD))))+ (month(getdate())-month(B.SSP_FEC_ANTIGUEDAD)))/12 as anio,
                    DATEDIFF(MONTH,B.SSP_FEC_ANTIGUEDAD,getdate())%12 'mes',
                    DATEPART(DAY, getdate()) - DATEPART(DAY, B.SSP_FEC_ANTIGUEDAD) 'dia'
                    FROM STD_PERSON A
                    INNER JOIN STD_HR_PERIOD B ON (A.STD_ID_PERSON = B.STD_ID_HR)
                    INNER JOIN M4SCO_HR_ROLE C ON (B.STD_ID_HR = C.SCO_ID_HR AND B.STD_OR_HR_PERIOD = C.SCO_OR_HR_PER AND B.STD_DT_START <= C.SCO_DT_START AND B.STD_DT_END >= C.SCO_DT_START)
                    INNER JOIN M4SCO_H_HR_POS_COM D ON (C.SCO_ID_HR = D.SCO_ID_HR AND C.SCO_OR_HR_ROLE = D.SCO_OR_HR_ROLE AND C.SCO_DT_START = D.SCO_DT_START AND C.SCO_DT_END = D.SCO_DT_END)
                    INNER JOIN M4SCO_POSITION E ON (D.SCO_ID_POSITION = E.SCO_ID_POSITION)
                    INNER JOIN STD_JOB F ON (E.SCO_ID_JOB_CODE=F.STD_ID_JOB_CODE)
                    INNER JOIN STD_LU_GENDER G ON (A.STD_ID_GENDER=G.STD_ID_GENDER)
                    INNER JOIN M4SAR_H_CONTRATO H ON (A.STD_ID_PERSON=H.STD_ID_HR)
                    INNER JOIN STD_WORK_LOCATION I ON (E.SCO_ID_WORK_LOC = I.STD_ID_WORK_LOCAT)
                    INNER JOIN STD_WORK_UNIT J ON (E.SCO_ID_WORK_UNIT=J.STD_ID_WORK_UNIT)
                    INNER JOIN STD_ADDRESS K ON (A.STD_ID_PERSON=K.STD_ID_PERSON AND B.STD_ID_HR=K.STD_ID_PERSON)
                    WHERE 1 = 1
                    AND B.STD_KEY_EMPLOYEE='1'
                    AND B.STD_DT_START <= GETDATE()
                    AND B.STD_DT_END >= GETDATE()
                    AND C.SCO_DT_START <= GETDATE()
                    AND C.SCO_DT_END >= GETDATE()
                    AND D.SCO_DT_START <=GETDATE()
                    AND D.SCO_DT_END >= GETDATE()
                    and A.STD_ID_PERSON = '". $_POST["claveservidorpublico"] ."' 
                    GROUP BY A.STD_ID_PERSON,A.STD_N_FAM_NAME_1,A.STD_N_MAIDEN_NAME,A.STD_N_FIRST_NAME,A.SME_RFC, A.SME_CURP,E.CME_ID_PLAZA_ANT, K.SCO_GB_ADDRESS,
                    E.CME_ID_PLAZA_FUMP,E.SCO_ID_WORK_UNIT,E.SCO_ID_WORK_LOC,E.SCO_ID_JOB_CODE,G.STD_N_GENDERESP,B.SSP_FEC_ANTIGUEDAD,A.SME_NUM_SS, F.STD_N_JOB_CODEESP,I.STD_WORK_LOCESP,J.STD_N_WORK_UNITENG");

    $CVE_SPserver=$selectserver[0]['CVE_SP'];
    $A_PATERNOserver=$selectserver[0]['A_PATERNO'];
    $A_MATERNOserver=$selectserver[0]['A_MATERNO'];
    $A_NOMBREserver=$selectserver[0]['A_NOMBRE'];
    $SME_RFCserver=$selectserver[0]['SME_RFC'];
    $ADSCserver=$selectserver[0]['ADSC'];//------------------Buscar en local
    $F_ANTIGUEDADserver=$selectserver[0]['F_ANTIGUEDAD'];
    $PUESTOserver=$selectserver[0]['PUESTO'];//-------------------Bucan en local
    $ISSEMYMserver=$selectserver[0]['ISSEMYM'];
    $NIVELRserver=$selectserver[0]['NIVELR'];

    $CveADServer=0;
    //1.- Docente
    //2.- Administrativo
    if (strtoupper($ADSCserver[0]) == 'A') {
        $CveADServer=1;
    } else {
        $CveADServer=2;
    }

    $anioserver=$selectserver[0]['anio'];
    $messerver=$selectserver[0]['mes'];
    $diaserver=$selectserver[0]['dia'];
    $CveZEServer=$selectserver[0]['CCT'];

    //--Busqueda local--//

    $consulta = new PDOConsultas();
    $consulta->connect($CFG_HOST[0], $CFG_USER[0], $CFG_DBPWD[0], $CFG_DBASE[0], $CFG_TIPO[0]);

    $select = $consulta->executeQuery("SELECT * FROM cat_zonaescolar WHERE ZEClave = '$CveZEServer'");
    $cvezed= $select[0]['ZECveZE'];

    $select = $consulta->executeQuery("SELECT * FROM cat_adscripcion WHERE AClave = '$ADSCserver'");
    $cveads= $select[0]['ACveA'];

    $select = $consulta->executeQuery("SELECT *  FROM cat_puesto WHERE PClave = '$PUESTOserver'  ");
    $cvep= $select[0]['PCveP'];

    $passwordcod = base64_encode($password);


    $consulta = new PDOConsultas();
    $consulta->connect($CFG_HOST[0], $CFG_USER[0], $CFG_DBPWD[0], $CFG_DBASE[0], $CFG_TIPO[0]);



    //--Insertar datos--//
    $select = $consulta->executeQuery("INSERT INTO sb_usuario (ClaveServidor, nom_usuario,ApePat,ApeMat, telcd ,email,passwd,Rfc,des_usuario,cve_estatus,cve_perfil,cve_usergroup,CveAds,FechaIngAds,CvePF,CveAD,CveZE,Issemmym,CveM,CveE,antia,antim,antid,NivelRango,FecRegSis)
            VALUES ( 
                '$claveservidorpublico',
                '$A_NOMBREserver' , 
                '$A_PATERNOserver' , 
                '$A_MATERNOserver' , 
                '$telcd' ,
                '$correo' ,
                '$passwordcod' ,
                '$SME_RFCserver' ,
                'SERVIDOR PUBLICO' ,
                1 ,
                4,
                2 , 
                $cveads ,
                '$F_ANTIGUEDADserver',    
                $cvep , 
                $CveADServer , 
                $cvezed , 
                '$ISSEMYMserver',
                1,
                $anioserver,
                $messerver,
                $diaserver,
                5 ,
                '$NIVELRserver',
                '$fecha'
                );");

    if ($consulta->lastInsertId != 'null') {
        if (isset($consulta->error)) {
            $array_error = $consulta->error;
            $error_cadena = substr($array_error[0], 1, 14);
            if ($error_cadena == "QLSTATE[23000]") {
                echo "1";

            } else {
                echo "2";

            }
        } else {
            echo "3";
        }
    } else {
            echo "4";

    }
} else {
    echo "2";

}

?>
