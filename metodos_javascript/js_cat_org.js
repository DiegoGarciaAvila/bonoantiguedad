
//////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////@ISC CHRISTOPHER DELGADILLO RAMIREZ ALV PRRS
////ARCHIVO DE CONFIGURACION DE JAVASCREIPT JQUERY
//////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////SECCION DE LAS VALIDACIONES DE LOS CAMPOS VIA JAVASCRIPT////////////////////////////////////////////////

    var OClave = document.getElementById("OClave");    
OClave.addEventListener ("input", function (event) { 
    (this.value = this.value.toUpperCase());
    });
    
    
    var OCveO = document.getElementById("OCveO");    
OCveO.addEventListener ("input", function (event) { 
    (this.value = this.value.toUpperCase());
    });
    
    
    var ODescripcion = document.getElementById("ODescripcion");    
ODescripcion.addEventListener ("input", function (event) { 
    (this.value = this.value.toUpperCase());
    });
    
    
/////////////////////////////////////////////////FIN DE LAS VALIDACIONES////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////SECCCION DEL EVENTO ONCLICK////////////////////////////////////////////////////////////////
$(document).ready(function() {    
        $("#OClave").hide();    
        $("#OCveO").hide();    
        $("#ODescripcion").hide();    
        $("#OClave").show();    
        $("#OCveO").show();    
        $("#ODescripcion").show();    
    $("#OClave").click(function(){

    });    
    $("#OCveO").click(function(){

    });    
    $("#ODescripcion").click(function(){

    });
/////////////////////////////////////////////////FIN DE LOS EVENTOS////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////FUNCIONES KEYUP/////////////////////////////////////////////////////////////////////////////////////////
    
    $("#OClave").keyup(function () {

    });    
    $("#OCveO").keyup(function () {

    });    
    $("#ODescripcion").keyup(function () {

    });
/////////////////////////////////////////////////FIN DE LOS EVENTOS KEY UP////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////FIN DE LOS keypress////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////FUNCIONES keypress/////////////////////////////////////////////////////////////////////////////////////////
    
    $("#OClave").keypress(function(){

    });    
    $("#OCveO").keypress(function(){

    });    
    $("#ODescripcion").keypress(function(){

    });
/////////////////////////////////////////////////FIN DE LOS EVENTOS keypress////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////FUNCIONES ON PROP///////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////FUNCIONES PROP/////////////////////////////////////////////////////////////////////////////////////////
    
    if ($("#OClave").prop('checked')) {
    } else {
    }    
    if ($("#OCveO").prop('checked')) {
    } else {
    }    
    if ($("#ODescripcion").prop('checked')) {
    } else {
    }
/////////////////////////////////////////////////FIN DE LOS EVENTOS PROP////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

});
//////////////////////////////////////////////////////CIERRE DOCUMENT READY////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function validar_numeros(elem) {
    var text = document.getElementById(elem);
    text.addEventListener("keypress", _check);
    function _check(e) {
        var textV = "which" in e ? e.which : e.keyCode,
                char = String.fromCharCode(textV),
                regex = /[0-9]/ig;
        if (!regex.test(char))
            e.preventDefault();
        return false;
    }
}
function validar_letras(elem) {
    var text = document.getElementById(elem);
    text.addEventListener("keypress", _check);
    function _check(e) {
        var textV = "which" in e ? e.which : e.keyCode,
                char = String.fromCharCode(textV),
                regex = /^[a-zA-ZáéíóúñÁÉÍÓÚÑ0-9\s]+$/g;
        if (!regex.test(char))
            e.preventDefault();
        return false;
    }
}