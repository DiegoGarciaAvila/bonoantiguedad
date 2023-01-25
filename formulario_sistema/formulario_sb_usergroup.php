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
<div class="col-md-12">
    <div class="card mb-12">
        <div class="card-body">
            <div class="card-title mb-3">sb_usergroup</div>
            <form>
                    <div class="row">
                        <div class="col-md-12 form-group mb-3">
                        <label for="cve_usergroup">cve_usergroup</label>
                        <input class="form-control form-control-rounded" id="cve_usergroup" type="number" placeholder="cve_usergroup"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group mb-3">
                        <label for="des_usergroup">des_usergroup</label>
                        <input class="form-control form-control-rounded" id="des_usergroup" type="text" placeholder="des_usergroup"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group mb-3">
                        <label for="cve_estatus">cve_estatus</label>
                        <input class="form-control form-control-rounded" id="cve_estatus" type="number" placeholder="cve_estatus"/>
                        </div>
                    </div>
                <div class="col-md-12">
                    <button class="btn btn-primary">ENVIAR</button>
                </div>
      </form>
        </div>
    </div>
</div>
<?php
}
?>
