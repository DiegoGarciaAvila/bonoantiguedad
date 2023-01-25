<?php
session_start();
include_once("../configuracion_sistema/configuracion.php");
if ($__SESSION->getValueSession('nomusuario') == "") {
    include_once("../includes/sb_refresh.php");
} else {
    include_once '../librerias/PDOConsultas.php';
    $consulta = new PDOConsultas();
    $consulta->connect($CFG_HOST[0], $CFG_USER[0], $CFG_DBPWD[0], $CFG_DBASE[0]);
?>


    <?php
    $personaseleccionada = $_GET["campo"];

    $consulta2 = new PDOConsultas();
    $consulta2->connect($CFG_HOST[0], $CFG_USER[0], $CFG_DBPWD[0], $CFG_DBASE[0]);

    $listaRol2 = $consulta2->executeQuery("SELECT * FROM sb_perfil");
    $listaAds2 = $consulta2->executeQuery("SELECT * FROM cat_adscripcion");
    $listaPF2 = $consulta2->executeQuery("SELECT * FROM cat_puesto");
    $listaAJ2 = $consulta2->executeQuery("SELECT * FROM cat_activojubilado");
    $listaAD2 = $consulta2->executeQuery("SELECT * FROM cat_admindocente");
    $listaZE2 = $consulta2->executeQuery("SELECT * FROM cat_zonaescolar");
    $listaM2 = $consulta2->executeQuery("SELECT * FROM cat_modalidad");
    $listaUA2 = $consulta2->executeQuery("SELECT * FROM cat_unidadejecutora");
    $listaE2 = $consulta2->executeQuery("SELECT * FROM estper");


    $listaCD2 = $consulta2->executeQuery("SELECT * FROM cat_ciudaddom");

    $listaCT2 = $consulta2->executeQuery("SELECT * FROM cat_ciudadtra");


    $datosPersona = $consulta->executeQuery("SELECT CveE FROM sb_usuario WHERE cve_usuario = " . $__SESSION->getValueSession('cveusuario'));
    //print_r("SELECT CveE FROM sb_usuario WHERE cve_usuario = " . $__SESSION->getValueSession('cveusuario'));
    //print_r($select[0]['CveE']);
    $listaCDACT = $consulta2->executeQuery("SELECT * FROM cat_ciudaddom");

    $consulta2 = new PDOConsultas();
    $consulta2->connect($CFG_HOST[0], $CFG_USER[0], $CFG_DBPWD[0], $CFG_DBASE[0]);
    $select = $consulta2->executeQuery(
        "SELECT n.PCveP,a.cve_usuario,a.ClaveServidor,a.nom_usuario,a.ApePat,a.ApeMat, a.email,a.passwd,a.Rfc, a.des_usuario,b.des_perfil, a.user_image_file,c.ADescripcion, d.PDescripcion,m.AJDescripcion, e.ADDescripcion, a.FechaIngAds, f.ZEDescripcion, h.CDDescripcion, a.TelCD, i.CTDescripcion, a.TelCT, a.Issemmym,a.FechaIngIss, j.MDescripcion,a.antia,a.antim,a.antid, k.UEDescripcion, l.EPDescripcion, a.Sindicalizado, a.NivelRango 
        FROM peticiones n
        LEFT JOIN sb_usuario a ON (n.PCveUsufk= a.cve_usuario) 
        LEFT JOIN sb_perfil b ON (a.cve_perfil=b.cve_perfil) 
        LEFT JOIN cat_adscripcion c ON (a.CveAds = c.ACveA) 
        LEFT JOIN cat_puesto d ON (a.CvePF = d.PCveP) 
        LEFT JOIN cat_admindocente e ON (a.CveAD = e.ADCveAD) 
        LEFT JOIN cat_zonaescolar f ON (a.CveZE = f.ZECveZE) 
        LEFT JOIN cat_ciudaddom h ON (a.CveCD = h.CDCveCD) 
        LEFT JOIN cat_ciudadtra i ON (a.CveCT = i.CTCveCT) 
        LEFT JOIN cat_modalidad j ON (a.CveM = j.MCveM)
        LEFT JOIN cat_unidadejecutora k ON (a.CveUA= k.UECveUE) 
        LEFT JOIN estper l ON (a.CveE=l.EPCveEP) 
        LEFT JOIN cat_activojubilado m ON (a.CveAJ=m.AJCveAJ) 
        WHERE n.PCveP= " . $_GET["campo"] . ""
    );



    $cveusuario2 = $select[0]['cve_usuario'];
    $ClaveServidor2 = $select[0]['ClaveServidor'];
    $nomusuario2 = $select[0]['nom_usuario'];
    $ApePat2 = $select[0]['ApePat'];
    $ApeMat2 = $select[0]['ApeMat'];
    $email2 = $select[0]['email'];
    $passwd2 = $select[0]['passwd'];
    $Rfc2 = $select[0]['Rfc'];
    $desusuario2 = $select[0]['des_usuario'];
    $desperfil2 = $select[0]['des_perfil'];
    $userimagefile2 = $select[0]['user_image_file'];
    $ADescripcion2 = $select[0]['ADescripcion'];
    $PDescripcion2 = $select[0]['PDescripcion'];
    $AJDescripcion2 = $select[0]['AJDescripcion'];
    $ADDescripcion2 = $select[0]['ADDescripcion'];
    $FechaIngAds2 = $select[0]['FechaIngAds'];
    $ZEDescripcion2 = $select[0]['ZEDescripcion'];
    $CDDescripcion2 = $select[0]['CDDescripcion'];
    $TelCD2 = $select[0]['TelCD'];
    $CTDescripcion2 = $select[0]['CTDescripcion'];
    $TelCT2 = $select[0]['TelCT'];
    $Issemmym2 = $select[0]['Issemmym'];
    $FechaIngIss2 = $select[0]['FechaIngIss'];
    $MDescripcion2 = $select[0]['MDescripcion'];
    $Antia2 = $select[0]['antia'];
    $Antim2 = $select[0]['antim'];
    $Antid2 = $select[0]['antid'];
    $UEDescripcion2 = $select[0]['UEDescripcion'];
    $EPDescripcion2 = $select[0]['EPDescripcion'];
    $Sindicalizado2 = $select[0]['Sindicalizado'];
    $NivelRango2 = $select[0]['NivelRango'];


    $listaDescripcionUsuario = array(
        0 => array('cve_perfil' => "CAPTURA", 'des_perfil' => "CAPTURA"),
        1 => array('cve_perfil' => "SERVIDOR PUBLICO", 'des_perfil' => "SERVIDOR PUBLICO")
    );
    foreach ($listaDescripcionUsuario as $keyselect => &$valselectdescusu) {
        $listaDescripcionUsuarioarray[] = array($valselectdescusu['cve_perfil'], $valselectdescusu['des_perfil']);
    }
    print_r($desusuario2);

     //print_r( $desusuario2);
    ?>
    <div class="col-md-12">
        <div class="card mb-12">
            <div class="card-body">

                <form id="editUserForm2" class="row gy-1 pt-75" method="POST">
                <div class="col-12 col-md-">
                        <input type="text" id="id3" name="id3" class="form-control" hidden value="<?= $cveusuario2 ?>" />
                    </div>
                    <div class="col-12 col-md-">
                        <label class="form-label" for="ClaveServidor3">CLAVE SERVIDOR PUBLICO </label>
                        <input type="text" id="ClaveServidor3" name="ClaveServidor3" readonly class="form-control" value="<?= $ClaveServidor2 ?>" data-msg="Please enter your first name" />
                    </div>
                    <div class="col-12 col-md-3">
                        <label class="form-label" for="NombreUsuario3">NOMBRE</label>
                        <input type="text" id="NombreUsuario3" name="NombreUsuario3" class="form-control" value="<?= $nomusuario2 ?>" data-msg="Please enter your last name" />
                    </div>
                    <div class="col-12 col-md-3">
                        <label class="form-label" for="ApellidoPaterno3">APELLIDO PATERNO</label>
                        <input type="text" id="ApellidoPaterno3" name="ApellidoPaterno3" class="form-control" value="<?= $ApePat2 ?>" data-msg="Please enter your last name" />
                    </div>
                    <div class="col-12 col-md-3">
                        <label class="form-label" for="ApellidoMaterno3">APELLIDO MATERNO</label>
                        <input type="text" id="ApellidoMaterno3" name="ApellidoMaterno3" class="form-control" value="<?= $ApeMat2 ?>" data-msg="Please enter your last name" />
                    </div>
                    <div class="col-12 col-md-3">
                        <label class="form-label" for="Rfc3">RFC</label>
                        <input type="text" id="Rfc3" name="Rfc3" class="form-control" value="<?= $Rfc2 ?>" data-msg="Please enter your last name" />
                    </div>
                    <div class="col-6 ">
                        <label class="form-label" for="Correo3">CORREO</label>
                        <input type="email" id="Correo3" name="Correo3" class="form-control" value="<?= $email2 ?>" data-msg="Please enter your last name" />
                    </div>
                    <div class="col-6 ">
                        <label class="form-label" for="PASS3">PASSWORD</label>
                        <input type="password" id="PASS3" name="PASS3" class="form-control" value="<?= $passwd2 ?>" readonly data-msg="Please enter your last name" />
                    </div>
                    <div class="col-6 form-group">
                        <label class="form-label" for="desusuario3">DESCRIPCION USUARIO</label>
                        <select class="form-control" name="desusuario3" id="desusuario3" required>

                            <option value="">--SELECCION UNA OPCION--</option>

                            <?php
                            $ldu=0;
                            foreach ($listaDescripcionUsuario as $keylrdescusu) {
                                $ldu++;
                                switch ($keylrdescusu['des_perfil']) {
                                    case $desusuario2:
                                        echo ("<option selected value= \"" .  $keylrdescusu['des_perfil'] . "\" > " . $keylrdescusu['des_perfil']  . "</option> ");
                                        break;
                                    default:
                                        echo ("<option  value= \"" .  $keylrdescusu['des_perfil']. "\" > " . $keylrdescusu['des_perfil'] . "</option> ");
                                        break;
                                }
                            }
                            ?>

                        </select>
                    </div>

                    <div class="col-6 form-group">
                        <label class="form-label" for="desperfil3">ROL</label>
                        <select class="form-control" name="desperfil3" id="desperfil3" required>

                            <option value="">--SELECCION UNA OPCION--</option>
                            <?php
                            $lr=0;
                            foreach ($listaRol2 as $keylr) {
                                $lr++;
                                switch ($keylr['des_perfil']) {
                                    case $desperfil2:
                                        echo ("<option selected value= \"" . $lr . "\" > " . $keylr['des_perfil']  . "</option> ");
                                        break;
                                    default:
                                        echo ("<option  value= \"" . $lr . "\" > " . $keylr['des_perfil'] . "</option> ");
                                        break;
                                }
                            }
                            ?>
                        </select>
                    </div>


                    <div class="col-6 form-group">
                        <label class="form-label" for="CveAds3">ADSCRIPCION</label>
                        <select class="form-control" name="CveAds3" id="CveAds3" required>

                            <option value="">--SELECCION UNA OPCION--</option>
                            <?php
                            $la=0;
                            foreach ($listaAds2 as $keyla) {
                                $la++;
                                switch ($keyla['ADescripcion']) {
                                    case  $ADescripcion2:
                                        echo ("<option selected value= \"" .  $la . "\" > " . $keyla['ADescripcion']  . "</option> ");
                                        break;
                                    default:
                                        echo ("<option  value= \"" .  $la . "\" > " . $keyla['ADescripcion'] . "</option> ");
                                        break;
                                }
                            }
                            ?>
                        </select>
                    </div>


                    <div class="col-6 ">
                        <label class="form-label" for="FechaIngAds3">FECHA INGRESO A ADSCRIPCION</label>
                        <input type="date" id="FechaIngAds3" name="FechaIngAds3" class="form-control" value="<?= $FechaIngAds2 ?>" data-msg="Please enter your last name" />
                    </div>

                    <div class="col-6 form-group">
                        <label class="form-label" for="CvePF3">PUESTO FUNCIONAL</label>
                        <select class="form-control" name="CvePF3" id="CvePF3" required>
                            <option value="">--SELECCION UNA OPCION--</option>
                            <?php
                            $pf=0;
                            foreach ($listaPF2 as $keypf) {
                                $pf++;
                                switch ($keypf['PDescripcion']) {
                                    case  $PDescripcion2:
                                        echo ("<option selected value= \"" .  $pf . "\" > " . $keypf['PDescripcion']  . "</option> ");
                                        break;
                                    default:
                                        echo ("<option  value= \"" . $pf . "\" > " . $keypf['PDescripcion'] . "</option> ");
                                        break;
                                }
                            }
                            ?>
                        </select>
                    </div>


                    <div class="col-6 form-group">
                        <label class="form-label" for="CveAJ3">ACTIVO/JUBILADO</label>
                        <select class="form-control" name="CveAJ3" id="CveAJ3" required>
                            <option value="">--SELECCION UNA OPCION--</option>
                            <?php
                            $aj=0;
                            foreach ( $listaAJ2 as $keyAJ) {
                                $aj++;
                                switch ($keyAJ['AJDescripcion']) {
                                    case  $AJDescripcion2:
                                        echo ("<option selected value= \"" .  $aj . "\" > " . $keyAJ['AJDescripcion']  . "</option> ");
                                        break;
                                    default:
                                        echo ("<option  value= \"" . $aj . "\" > " . $keyAJ['AJDescripcion'] . "</option> ");
                                        break;
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <div class="col-6 form-group">
                        <label class="form-label" for="CveAD3">ADMINISTRATIVO/DOCENTE</label>
                        <select class="form-control" name="CveAD3" id="CveAD3" required>
                            <option value="">--SELECCION UNA OPCION--</option>
                            <?php
                            $ad=0;
                            foreach ( $listaAD2 as $keyAD) {
                                $ad++;
                                switch ($keyAD['ADDescripcion']) {
                                    case  $ADDescripcion2:
                                        echo ("<option selected value= \"" .  $ad . "\" > " . $keyAD['ADDescripcion']  . "</option> ");
                                        break;
                                    default:
                                        echo ("<option  value= \"" . $ad . "\" > " . $keyAD['ADDescripcion'] . "</option> ");
                                        break;
                                }
                            }
                            ?>
                        </select>
                    </div>



                    <div class="col-6 form-group">
                        <label class="form-label" for="CveZE3">ZONA ESCOLAR</label>
                        <select class="form-control" name="CveZE3" id="CveZE3" required>
                            <option value="">--SELECCION UNA OPCION--</option>
                            <?php
                            $ze=0;
                            foreach ( $listaZE2 as $keyZE) {
                                $ze++;
                                switch ($keyZE['ZEDescripcion']) {
                                    case   $ZEDescripcion2:
                                        echo ("<option selected value= \"" .  $ze . "\" > " . $keyZE['ZEDescripcion']  . "</option> ");
                                        break;
                                    default:
                                        echo ("<option  value= \"" . $ze . "\" > " . $keyZE['ZEDescripcion'] . "</option> ");
                                        break;
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <div class="col-6 form-group">
                        <label class="form-label" for="CveCD3">CIUDAD DOMICILIO</label>
                        <select class="form-control" name="CveCD3" id="CveCD3" required>

                            <option value="">--SELECCION UNA OPCION--</option>
                            <?php
                            $j=0;
                            foreach ($listaCD2 as $keys) {
                                $j++;
                                switch ($keys['CDDescripcion']) {
                                    case $CDDescripcion2:
                                        echo ("<option selected value= \"" . $j . "\" > " . $keys['CDDescripcion']  . "</option> ");

                                        break;

                                    default:
                                        echo ("<option  value= \"" . $j . "\" > " . $keys['CDDescripcion'] . "</option> ");

                                        break;
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-6 ">
                        <label class="form-label" for="TelCD3">TELEFONO DOMICILIO</label>
                        <input type="number" id="TelCD3" name="TelCD3" class="form-control" value="<?= $TelCD2 ?>" data-msg="Please enter your last name" />
                    </div>
                    <div class="col-6 form-group">
                        <label class="form-label" for="CveCT3">CIUDAD TRABAJO</label>
                        <select class="form-control" name="CveCT3" id="CveCT3" required>

                            <option value="">--SELECCION UNA OPCION--</option>
                            <?php
                            $i=0;
                            foreach ($listaCT2 as $key) {
                                $i++;
                                switch ($key['CTDescripcion']) {
                                    case $CTDescripcion2:
                                        echo ("<option selected value= \"" . $i . "\" > " . $key['CTDescripcion']  . "</option> ");
                                        break;
                                    default:
                                        echo ("<option  value= \"" . $i . "\" > " . $key['CTDescripcion'] . "</option> ");
                                        break;
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-6 ">
                        <label class="form-label" for="TelCT3">TELEFONO TRABAJO</label>
                        <input type="number" id="TelCT3" name="TelCT3" class="form-control" value="<?= $TelCT2 ?>" data-msg="Please enter your last name" />
                    </div>
                    <div class="col-6 ">
                        <label class="form-label" for="Issemmym3">ISSEMMYM</label>
                        <input type="number" id="Issemmym3" name="Issemmym3" class="form-control" value="<?= $Issemmym2 ?>" data-msg="Please enter your last name" />
                    </div>
                    <div class="col-6 ">
                        <label class="form-label" for="FechaIngIss3">FECHA INGRESO A ISSEMMYM</label>
                        <input type="date" id="FechaIngIss3" name="FechaIngIss3" class="form-control" value="<?= $FechaIngIss2 ?>" data-msg="Please enter your last name" />
                    </div>

                    <div class="col-6 form-group">
                        <label class="form-label" for="CveM3">MODALIDAD</label>
                        <select class="form-control" name="CveM3" id="CveM3" required>
                            <option value="">--SELECCION UNA OPCION--</option>
                            <?php
                            $m=0;
                            foreach (  $listaM2 as $keyM) {
                                $m++;
                                switch ($keyM['MDescripcion']) {
                                    case   $MDescripcion2:
                                        echo ("<option selected value= \"" .  $m . "\" > " . $keyM['MDescripcion']  . "</option> ");
                                        break;
                                    default:
                                        echo ("<option  value= \"" . $m . "\" > " . $keyM['MDescripcion'] . "</option> ");
                                        break;
                                }
                            }
                            ?>
                        </select>
                    </div>
                    
                   <div class="row form-group ">
                       <label class="form-label" ></label>

                       <label class="form-label " >ANTIGUEDAD</label>
                       <div class="col-4 ">
                           <label class="form-label" for="Antia3">AÑOS</label>
                           <input type="text" id="Antia3" name="Antia3" class="form-control" value="<?= $Antia2 ?>" data-msg="Please enter your last name" />
                       </div>

                       <div class="col-4 ">
                           <label class="form-label" for="Antim3">MESES</label>
                           <input type="text" id="Antim3" name="Antim3" class="form-control" value="<?= $Antim2 ?>" data-msg="Please enter your last name" />
                       </div>

                       <div class="col-4 ">
                           <label class="form-label" for="Antid3">DIAS</label>
                           <input type="text" id="Antid3" name="Antid3" class="form-control" value="<?= $Antid2 ?>" data-msg="Please enter your last name" />
                       </div>
                   </div>
  
                    <div class="col-6 form-group">
                        <label class="form-label" for="CveUA3">UNIDAD EJECUTORA</label>
                        <select class="form-control" name="CveUA3" id="CveUA3" required>
                            <option value="">--SELECCION UNA OPCION--</option>
                            <?php
                            $ua=0;
                            foreach (  $listaUA2 as $keyUA) {
                                $ua++;
                                switch ($keyUA['UEDescripcion']) {
                                    case   $UEDescripcion2:
                                        echo ("<option selected value= \"" .  $ua . "\" > " . $keyUA['UEDescripcion']  . "</option> ");
                                        break;
                                    default:
                                        echo ("<option  value= \"" . $ua . "\" > " . $keyUA['UEDescripcion'] . "</option> ");
                                        break;
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <div class="col-6 form-group">
                        <label class="form-label" for="CveE3">ESTADO USUARIO</label>
                        <select class="form-control" name="CveE3" id="CveE3" required>
                            <option value="">--SELECCION UNA OPCION--</option>
                            <?php
                            $e=0;
                            foreach (  $listaE2  as $keyE) {
                                $e++;
                                switch ($keyE['EPDescripcion']) {
                                    case  $EPDescripcion2:
                                        echo ("<option selected value= \"" .  $e . "\" > " . $keyE['EPDescripcion']  . "</option> ");
                                        break;
                                    default:
                                        echo ("<option  value= \"" . $e . "\" > " . $keyE['EPDescripcion'] . "</option> ");
                                        break;
                                }
                            }
                            ?>
                        </select>
                    </div>
   
                    <div class="col-12 ">
                        <label class="form-label" for="Sindicalizado3">SINDICALIZADO</label>
                        <input type="text" id="Sindicalizado3" name="Sindicalizado3" class="form-control" value="<?= $Sindicalizado2 ?>" data-msg="Please enter your last name" />
                    </div>
                    <div class="col-12 ">
                        <label class="form-label" for="NivelRango3">NIVEL Y RANGO</label>
                        <input type="text" id="NivelRango3" name="NivelRango3" class="form-control" value="<?= $NivelRango2 ?>" data-msg="Please enter your last name" />
                    </div>

                    <div class="col-12 text-center mt-2 pt-50">
                        <button type="submit" class="btn btn-primary me-1" name="submit_btn2">ENVIAR</button>
                        <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close">
                            CANCELAR
                        </button>
                    </div>

                </form>


            </div>
        </div>
    </div>

<?php
}
?>