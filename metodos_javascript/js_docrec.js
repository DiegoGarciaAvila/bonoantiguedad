
//////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////@ISC CHRISTOPHER DELGADILLO RAMIREZ ALV PRRS
////ARCHIVO DE CONFIGURACION DE JAVASCREIPT JQUERY
//////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////SECCION DE LAS VALIDACIONES DE LOS CAMPOS VIA JAVASCRIPT////////////////////////////////////////////////

    var DRCveDR = document.getElementById("DRCveDR");    
DRCveDR.addEventListener ("input", function (event) { 
    (this.value = this.value.toUpperCase());
    });
    
    
    var DRCveOfk = document.getElementById("DRCveOfk");    
DRCveOfk.addEventListener ("input", function (event) { 
    (this.value = this.value.toUpperCase());
    });
    
    
    var DRCvePfk = document.getElementById("DRCvePfk");    
DRCvePfk.addEventListener ("input", function (event) { 
    (this.value = this.value.toUpperCase());
    });
    
    
    var DRCveTDfk = document.getElementById("DRCveTDfk");    
DRCveTDfk.addEventListener ("input", function (event) { 
    (this.value = this.value.toUpperCase());
    });
    
    
    var DRFecFin = document.getElementById("DRFecFin");    
DRFecFin.addEventListener ("input", function (event) { 
    (this.value = this.value.toUpperCase());
    });
    
    
    var DRFecIni = document.getElementById("DRFecIni");    
DRFecIni.addEventListener ("input", function (event) { 
    (this.value = this.value.toUpperCase());
    });
    
    
    var DRFolio = document.getElementById("DRFolio");    
DRFolio.addEventListener ("input", function (event) { 
    (this.value = this.value.toUpperCase());
    });
    
    
    var DRRuta = document.getElementById("DRRuta");    
DRRuta.addEventListener ("input", function (event) { 
    (this.value = this.value.toUpperCase());
    });
    
    
/////////////////////////////////////////////////FIN DE LAS VALIDACIONES////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////SECCCION DEL EVENTO ONCLICK////////////////////////////////////////////////////////////////
$(document).ready(function() {    
        $("#DRCveDR").hide();    
        $("#DRCveOfk").hide();    
        $("#DRCvePfk").hide();    
        $("#DRCveTDfk").hide();    
        $("#DRFecFin").hide();    
        $("#DRFecIni").hide();    
        $("#DRFolio").hide();    
        $("#DRRuta").hide();    
        $("#DRCveDR").show();    
        $("#DRCveOfk").show();    
        $("#DRCvePfk").show();    
        $("#DRCveTDfk").show();    
        $("#DRFecFin").show();    
        $("#DRFecIni").show();    
        $("#DRFolio").show();    
        $("#DRRuta").show();    
    $("#DRCveDR").click(function(){

    });    
    $("#DRCveOfk").click(function(){

    });    
    $("#DRCvePfk").click(function(){

    });    
    $("#DRCveTDfk").click(function(){

    });    
    $("#DRFecFin").click(function(){

    });    
    $("#DRFecIni").click(function(){

    });    
    $("#DRFolio").click(function(){

    });    
    $("#DRRuta").click(function(){

    });
/////////////////////////////////////////////////FIN DE LOS EVENTOS////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////FUNCIONES KEYUP/////////////////////////////////////////////////////////////////////////////////////////
    
    $("#DRCveDR").keyup(function () {

    });    
    $("#DRCveOfk").keyup(function () {

    });    
    $("#DRCvePfk").keyup(function () {

    });    
    $("#DRCveTDfk").keyup(function () {

    });    
    $("#DRFecFin").keyup(function () {

    });    
    $("#DRFecIni").keyup(function () {

    });    
    $("#DRFolio").keyup(function () {

    });    
    $("#DRRuta").keyup(function () {

    });
/////////////////////////////////////////////////FIN DE LOS EVENTOS KEY UP////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////FIN DE LOS keypress////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////FUNCIONES keypress/////////////////////////////////////////////////////////////////////////////////////////
    
    $("#DRCveDR").keypress(function(){

    });    
    $("#DRCveOfk").keypress(function(){

    });    
    $("#DRCvePfk").keypress(function(){

    });    
    $("#DRCveTDfk").keypress(function(){

    });    
    $("#DRFecFin").keypress(function(){

    });    
    $("#DRFecIni").keypress(function(){

    });    
    $("#DRFolio").keypress(function(){

    });    
    $("#DRRuta").keypress(function(){

    });
/////////////////////////////////////////////////FIN DE LOS EVENTOS keypress////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////FUNCIONES ON PROP///////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////FUNCIONES PROP/////////////////////////////////////////////////////////////////////////////////////////
    
    if ($("#DRCveDR").prop('checked')) {
    } else {
    }    
    if ($("#DRCveOfk").prop('checked')) {
    } else {
    }    
    if ($("#DRCvePfk").prop('checked')) {
    } else {
    }    
    if ($("#DRCveTDfk").prop('checked')) {
    } else {
    }    
    if ($("#DRFecFin").prop('checked')) {
    } else {
    }    
    if ($("#DRFecIni").prop('checked')) {
    } else {
    }    
    if ($("#DRFolio").prop('checked')) {
    } else {
    }    
    if ($("#DRRuta").prop('checked')) {
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