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
            <div class="card-title mb-3">sb_usuario</div>
            <form>
                    <div class="row">
                        <div class="col-md-12 form-group mb-3">
                        <label for="cve_usuario">cve_usuario</label>
                        <input class="form-control form-control-rounded" id="cve_usuario" type="number" placeholder="cve_usuario"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group mb-3">
                        <label for="nom_usuario">nom_usuario</label>
                        <input class="form-control form-control-rounded" id="nom_usuario" type="text" placeholder="nom_usuario"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group mb-3">
                        <label for="des_usuario">des_usuario</label>
                        <input class="form-control form-control-rounded" id="des_usuario" type="text" placeholder="des_usuario"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group mb-3">
                        <label for="cve_organismo">cve_organismo</label>
                        <input class="form-control form-control-rounded" id="cve_organismo" type="number" placeholder="cve_organismo"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group mb-3">
                        <label for="cve_estatus">cve_estatus</label>
                        <input class="form-control form-control-rounded" id="cve_estatus" type="number" placeholder="cve_estatus"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group mb-3">
                        <label for="passwd">passwd</label>
                        <input class="form-control form-control-rounded" id="passwd" type="text" placeholder="passwd"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group mb-3">
                        <label for="cve_15">cve_15</label>
                        <input class="form-control form-control-rounded" id="cve_15" type="text" placeholder="cve_15"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group mb-3">
                        <label for="cve_perfil">cve_perfil</label>
                        <input class="form-control form-control-rounded" id="cve_perfil" type="number" placeholder="cve_perfil"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group mb-3">
                        <label for="cve_secretaria">cve_secretaria</label>
                        <input class="form-control form-control-rounded" id="cve_secretaria" type="number" placeholder="cve_secretaria"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group mb-3">
                        <label for="cve_usergroup">cve_usergroup</label>
                        <input class="form-control form-control-rounded" id="cve_usergroup" type="number" placeholder="cve_usergroup"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group mb-3">
                        <label for="email">email</label>
                        <input class="form-control form-control-rounded" id="email" type="text" placeholder="email"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group mb-3">
                        <label for="user_image_file">user_image_file</label>
                        <input class="form-control form-control-rounded" id="user_image_file" type="text" placeholder="user_image_file"/>
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
