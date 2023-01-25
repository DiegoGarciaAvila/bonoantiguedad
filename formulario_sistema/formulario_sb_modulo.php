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
            <div class="card-title mb-3">sb_modulo</div>
            <form>
                    <div class="row">
                        <div class="col-md-12 form-group mb-3">
                        <label for="cve_modulo">cve_modulo</label>
                        <input class="form-control form-control-rounded" id="cve_modulo" type="number" placeholder="cve_modulo"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group mb-3">
                        <label for="descripcion_modulo">descripcion_modulo</label>
                        <input class="form-control form-control-rounded" id="descripcion_modulo" type="text" placeholder="descripcion_modulo"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group mb-3">
                        <label for="status_modulo">status_modulo</label>
                        <input class="form-control form-control-rounded" id="status_modulo" type="text" placeholder="status_modulo"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group mb-3">
                        <label for="url_modulo">url_modulo</label>
                        <input class="form-control form-control-rounded" id="url_modulo" type="text" placeholder="url_modulo"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group mb-3">
                        <label for="grupo_modulo">grupo_modulo</label>
                        <input class="form-control form-control-rounded" id="grupo_modulo" type="text" placeholder="grupo_modulo"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group mb-3">
                        <label for="posicion_modulo">posicion_modulo</label>
                        <input class="form-control form-control-rounded" id="posicion_modulo" type="text" placeholder="posicion_modulo"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group mb-3">
                        <label for="nivel_modulo">nivel_modulo</label>
                        <input class="form-control form-control-rounded" id="nivel_modulo" type="text" placeholder="nivel_modulo"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group mb-3">
                        <label for="url_include">url_include</label>
                        <input class="form-control form-control-rounded" id="url_include" type="text" placeholder="url_include"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group mb-3">
                        <label for="tipo_nivel">tipo_nivel</label>
                        <input class="form-control form-control-rounded" id="tipo_nivel" type="text" placeholder="tipo_nivel"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group mb-3">
                        <label for="nivel_padre">nivel_padre</label>
                        <input class="form-control form-control-rounded" id="nivel_padre" type="text" placeholder="nivel_padre"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group mb-3">
                        <label for="nivel_hijo">nivel_hijo</label>
                        <input class="form-control form-control-rounded" id="nivel_hijo" type="text" placeholder="nivel_hijo"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group mb-3">
                        <label for="icono">icono</label>
                        <input class="form-control form-control-rounded" id="icono" type="text" placeholder="icono"/>
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
