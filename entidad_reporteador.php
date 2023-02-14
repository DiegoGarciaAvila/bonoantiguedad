<?php
if ($__SESSION->getValueSession('nomusuario') == "") {
    include_once("configuracion/configuracion.php");
} else {
    include_once("./configuracion/configuracion.php");
    include_once './librerias/PDOConsultas.php';
    $ValsendRep2 = "sendRep2";
    $ValsendRep2PDF = "sendRep2PDF";
    $vars_post = '';
    $vars_obj = " return false;\"";
    $vars_obj2 = " return false;\"";
?>
<?php
}
?>
<!-- BEGIN: Content-->
<div class="content-wrapper container-xxl p-0">
    <div class="content-body">
        <!-- Flatpickr Starts -->
        <section id="flatpickr">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">REPORTEADOR</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                    <label for="reporte" id="etreporte">SELECCIONE UN REPORTE</label>
                        <div class="col-md-8 col-12 mb-1">
                            <div class="input-group">
                            <input type="hidden" name="report" id="report" value="">
                        
                            <select class="selectpicker form-control" data-live-search="true" title="SELECCIONE" id="reporte" name="data[reporte]">
                                <option value="">-SELECCIONE-</option>
                                <option value="1">USUARIOS CON BONO</option>
                                <option value="2">USUARIOS RECHAZADOS</option>
                                <option value="3">USUARIOS </option>
                        
               
                            </select>
                            </div>
                        </div>
                        <div class="col-md-2 col-12 mb-1">
                            <div class="input-group">
                                <?php
                                if (isset($fileExcel) && $fileExcel)
                                    echo "<input type='button' style='margin-right:5px;' class='btn-primary btn' id=\"excel\" border=0' name=\"submit\" value=\"Generar Excel\"" . " $vars_obj></input>";
                                ?>
                            </div>
                        </div>
                        <div class="col-md-2 col-12 mb-1">
                            <div class="input-group">
                                <?php
                                if (isset($filePDF) && $filePDF)
                                    echo "<input type='button' style='margin-right:5px;' class='btn-primary btn' id=\"pdf\"  border='0' name=\"submit\" value=\"Generar PDF\"" . " $vars_obj2></input>";
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <?php
                        echo "<div id=\"miiframe\" name=\"miiframe\" style=\"border: 1px solid #E0E4D1;z-index:10; overflow:scroll; height:630px;  \"></div>";
                        ?>
                    </div>
                </div>
            </div>
        </section>
        <!-- Flatpickr Ends-->
    </div>
</div>
<script>
    $(document).ready(function() {
        $('.selectpicker').selectpicker('refresh');
    });

    $("#reporte").change(function() {
        var repo = $("#reporte").val();
        $("#report").val(repo);

    });
    $("#excel").click(function() {
        var rep = $("#report").val();
        if (rep == '') {
            Swal.fire({
                icon: 'error',
                title: '¡DEBE SELECCIONAR UNA OPCIÓN!',
            })

        } else {
            var rango = '1';
            var horas = '2';
            var tab = '3';
            var quin = '4';
            var total = '5';
            var bur = '6';
            if (rep == rango) {
                rep = './reportes_sistema/repxls_sb_modulo.php?';
            }
            if (rep == horas) {
                rep = './reportes_sistema/horasClase.php?';
            }
            if (rep == tab) {
                rep = './reportes_sistema/tabuladores.php?';
            }
            if (rep == quin) {
                rep = './reportes_sistema/quinquenios.php?';
            }
            if (rep == total) {
                rep = './reportes_sistema/totalPlazas.php?';
            }
            if (rep == bur) {
                rep = './reportes_sistema/burocratas.php?';
            }

            sendRep2(rep);
        }

    });
    $("#pdf").click(function() {
        var rep = $("#report").val();
        if (rep == '') {
            Swal.fire({
                icon: 'error',
                title: '¡DEBE SELECCIONAR UNA OPCIÓN!',
            })
        } else {
            var rango = '1';
            var horas = '2';
            var tab = '3';
            var quin = '4';
            var total = '5';
            var bur = '6';
            if (rep == rango) {
                rep = './reportes_sistema/reppdf_sb_modulo.php?';
            }
            if (rep == horas) {
                rep = './reportes_sistema/PDFhorasClase.php?';
            }
            if (rep == tab) {
                rep = './reportes_sistema/PDFtabuladores.php?';
            }
            if (rep == quin) {
                rep = './reportes_sistema/PDFquinquenios.php?';
            }
            if (rep == total) {
                rep = './reportes_sistema/PDFtotalPlazas.php?';
            }
            if (rep == bur) {
                rep = './reportes_sistema/pdfburocratas.php?';
            }
            sendRep2PDF(rep);
        }

    });
</script>

<SCRIPT LANGUAGE="JavaScript">
    var d = null;

    function sendRep2() {
        Swal.fire({
            title: 'GENERANDO ARCHIVO EXCEL',
            text: 'UN MOMENTO POR FAVOR, EL TIEMPO DEPENDERA DEL VOLUMEN DE INFORMACION',
            imageUrl: 'imagenes_sistema/tuerca.gif',
            imageWidth: 500,
            imageHeight: 400,
            imageAlt: 'GENERANDO REPORTE',
        })
        var cadena1 = '',
            xname = '',
            i, args = sendRep2.arguments;
        var cadena2 = '';
        var cadena = '';
        var chk = true;
        var chkStr = "chk";
        var chkCnt = 0;
        document.obj_retVal = false;
        cadena1 = args[0] + cadena;
        cadena1 += '&tipo=' + $('#reporte').val() + '&reporte=';
        openInIframe5(cadena1);
    }

    function sendRep2PDF() {

        Swal.fire({
            title: 'GENERANDO ARCHIVO PDF',
            text: 'UN MOMENTO POR FAVOR, EL TIEMPO DEPENDERA DEL VOLUMEN DE INFORMACION',
            imageUrl: 'imagenes_sistema/tuerca.gif',
            imageWidth: 500,
            imageHeight: 400,
            imageAlt: 'GENERANDO REPORTE PDF',
        })
        var cadena1 = '',
            xname = '',
            i, args = sendRep2PDF.arguments;
        var cadena2 = '';
        var cadena = '';
        var chk = true;
        var chkStr = "chk";
        var chkCnt = 0;
        document.obj_retVal = false;
        cadena1 = args[0] + cadena;
        cadena1 += '&tipo=' + $('#reporte').val() + '&reporte=';
        openInIframeFPDF(cadena1);

    }

    function openInIframeFPDF(cadena1) {
        $obj = $('<object style="width: 100%; height: 100%;">');
        $obj.attr("data", cadena1);
        $obj.attr("type", "application/pdf");
        $obj.addClass("pdf");
        $("#miiframe").css("overflow", "");
        $("#miiframe").html($obj);
    }

    function openInIframe5(cadena1) {
        $("#miiframe").css("overflow", "scroll");
        load_response('miiframe', cadena1);
    }

    function load_response(target, cadena1) {
        ///NI LE MUEVAN
        var myConnection = new XHConn();
        if (!myConnection)
            alert("XMLHTTP no esta disponible");
        var peticion = function(oXML) {
            $("#" + target).html(oXML.responseText);
        };
        var pars = cadena1.split('?');
        myConnection.connect(pars[0], "GET", pars[1], peticion);
    }
</SCRIPT>