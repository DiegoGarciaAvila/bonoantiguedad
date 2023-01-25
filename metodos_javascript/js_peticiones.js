
//////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////@ISC CHRISTOPHER DELGADILLO RAMIREZ ALV PRRS
////ARCHIVO DE CONFIGURACION DE JAVASCREIPT JQUERY
//////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////SECCION DE LAS VALIDACIONES DE LOS CAMPOS VIA JAVASCRIPT////////////////////////////////////////////////

    var PCveEfk = document.getElementById("PCveEfk");    
PCveEfk.addEventListener ("input", function (event) { 
    (this.value = this.value.toUpperCase());
    });
    
    
    var PCveP = document.getElementById("PCveP");    
PCveP.addEventListener ("input", function (event) { 
    (this.value = this.value.toUpperCase());
    });
    
    
    var PCveURfk = document.getElementById("PCveURfk");    
PCveURfk.addEventListener ("input", function (event) { 
    (this.value = this.value.toUpperCase());
    });
    
    
    var PCveUsufk = document.getElementById("PCveUsufk");    
PCveUsufk.addEventListener ("input", function (event) { 
    (this.value = this.value.toUpperCase());
    });
    
    
    var PDocGen = document.getElementById("PDocGen");    
PDocGen.addEventListener ("input", function (event) { 
    (this.value = this.value.toUpperCase());
    });
    
    
    var PFecha = document.getElementById("PFecha");    
PFecha.addEventListener ("input", function (event) { 
    (this.value = this.value.toUpperCase());
    });
    
    
    var PFolio = document.getElementById("PFolio");    
PFolio.addEventListener ("input", function (event) { 
    (this.value = this.value.toUpperCase());
    });
    
    
    var PObs = document.getElementById("PObs");    
PObs.addEventListener ("input", function (event) { 
    (this.value = this.value.toUpperCase());
    });
    
    
/////////////////////////////////////////////////FIN DE LAS VALIDACIONES////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////SECCCION DEL EVENTO ONCLICK////////////////////////////////////////////////////////////////
$(document).ready(function() {    
        $("#PCveEfk").hide();    
        $("#PCveP").hide();    
        $("#PCveURfk").hide();    
        $("#PCveUsufk").hide();    
        $("#PDocGen").hide();    
        $("#PFecha").hide();    
        $("#PFolio").hide();    
        $("#PObs").hide();    
        $("#PCveEfk").show();    
        $("#PCveP").show();    
        $("#PCveURfk").show();    
        $("#PCveUsufk").show();    
        $("#PDocGen").show();    
        $("#PFecha").show();    
        $("#PFolio").show();    
        $("#PObs").show();    
    $("#PCveEfk").click(function(){

    });    
    $("#PCveP").click(function(){

    });    
    $("#PCveURfk").click(function(){

    });    
    $("#PCveUsufk").click(function(){

    });    
    $("#PDocGen").click(function(){

    });    
    $("#PFecha").click(function(){

    });    
    $("#PFolio").click(function(){

    });    
    $("#PObs").click(function(){

    });
/////////////////////////////////////////////////FIN DE LOS EVENTOS////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////FUNCIONES KEYUP/////////////////////////////////////////////////////////////////////////////////////////
    
    $("#PCveEfk").keyup(function () {

    });    
    $("#PCveP").keyup(function () {

    });    
    $("#PCveURfk").keyup(function () {

    });    
    $("#PCveUsufk").keyup(function () {

    });    
    $("#PDocGen").keyup(function () {

    });    
    $("#PFecha").keyup(function () {

    });    
    $("#PFolio").keyup(function () {

    });    
    $("#PObs").keyup(function () {

    });
/////////////////////////////////////////////////FIN DE LOS EVENTOS KEY UP////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////FIN DE LOS keypress////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////FUNCIONES keypress/////////////////////////////////////////////////////////////////////////////////////////
    
    $("#PCveEfk").keypress(function(){

    });    
    $("#PCveP").keypress(function(){

    });    
    $("#PCveURfk").keypress(function(){

    });    
    $("#PCveUsufk").keypress(function(){

    });    
    $("#PDocGen").keypress(function(){

    });    
    $("#PFecha").keypress(function(){

    });    
    $("#PFolio").keypress(function(){

    });    
    $("#PObs").keypress(function(){

    });
/////////////////////////////////////////////////FIN DE LOS EVENTOS keypress////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////FUNCIONES ON PROP///////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////FUNCIONES PROP/////////////////////////////////////////////////////////////////////////////////////////
    
    if ($("#PCveEfk").prop('checked')) {
    } else {
    }    
    if ($("#PCveP").prop('checked')) {
    } else {
    }    
    if ($("#PCveURfk").prop('checked')) {
    } else {
    }    
    if ($("#PCveUsufk").prop('checked')) {
    } else {
    }    
    if ($("#PDocGen").prop('checked')) {
    } else {
    }    
    if ($("#PFecha").prop('checked')) {
    } else {
    }    
    if ($("#PFolio").prop('checked')) {
    } else {
    }    
    if ($("#PObs").prop('checked')) {
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