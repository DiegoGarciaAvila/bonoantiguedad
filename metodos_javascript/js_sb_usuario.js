
//////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////@ISC CHRISTOPHER DELGADILLO RAMIREZ ALV PRRS
////ARCHIVO DE CONFIGURACION DE JAVASCREIPT JQUERY
//////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////SECCION DE LAS VALIDACIONES DE LOS CAMPOS VIA JAVASCRIPT////////////////////////////////////////////////

    var cve_usuario = document.getElementById("cve_usuario");    
cve_usuario.addEventListener ("input", function (event) { 
    (this.value = this.value.toUpperCase());
    });
    
    
    var ClaveServidor = document.getElementById("ClaveServidor");    
ClaveServidor.addEventListener ("input", function (event) { 
    (this.value = this.value.toUpperCase());
    });
    
    
    var nom_usuario = document.getElementById("nom_usuario");    
nom_usuario.addEventListener ("input", function (event) { 
    (this.value = this.value.toUpperCase());
    });
    
    
    var ApePat = document.getElementById("ApePat");    
ApePat.addEventListener ("input", function (event) { 
    (this.value = this.value.toUpperCase());
    });
    
    
    var ApeMat = document.getElementById("ApeMat");    
ApeMat.addEventListener ("input", function (event) { 
    (this.value = this.value.toUpperCase());
    });
    
    
    var email = document.getElementById("email");    
email.addEventListener ("input", function (event) { 
    (this.value = this.value.toUpperCase());
    });
    
    
    var passwd = document.getElementById("passwd");    
passwd.addEventListener ("input", function (event) { 
    (this.value = this.value.toUpperCase());
    });
    
    
    var Rfc = document.getElementById("Rfc");    
Rfc.addEventListener ("input", function (event) { 
    (this.value = this.value.toUpperCase());
    });
    
    
    var des_usuario = document.getElementById("des_usuario");    
des_usuario.addEventListener ("input", function (event) { 
    (this.value = this.value.toUpperCase());
    });
    
    
    var cve_organismo = document.getElementById("cve_organismo");    
cve_organismo.addEventListener ("input", function (event) { 
    (this.value = this.value.toUpperCase());
    });
    
    
    var cve_estatus = document.getElementById("cve_estatus");    
cve_estatus.addEventListener ("input", function (event) { 
    (this.value = this.value.toUpperCase());
    });
    
    
    var cve_15 = document.getElementById("cve_15");    
cve_15.addEventListener ("input", function (event) { 
    (this.value = this.value.toUpperCase());
    });
    
    
    var cve_perfil = document.getElementById("cve_perfil");    
cve_perfil.addEventListener ("input", function (event) { 
    (this.value = this.value.toUpperCase());
    });
    
    
    var cve_secretaria = document.getElementById("cve_secretaria");    
cve_secretaria.addEventListener ("input", function (event) { 
    (this.value = this.value.toUpperCase());
    });
    
    
    var cve_usergroup = document.getElementById("cve_usergroup");    
cve_usergroup.addEventListener ("input", function (event) { 
    (this.value = this.value.toUpperCase());
    });
    
    
    var user_image_file = document.getElementById("user_image_file");    
user_image_file.addEventListener ("input", function (event) { 
    (this.value = this.value.toUpperCase());
    });
    
    
    var CveAds = document.getElementById("CveAds");    
CveAds.addEventListener ("input", function (event) { 
    (this.value = this.value.toUpperCase());
    });
    
    
    var CvePF = document.getElementById("CvePF");    
CvePF.addEventListener ("input", function (event) { 
    (this.value = this.value.toUpperCase());
    });
    
    
    var CveAJ = document.getElementById("CveAJ");    
CveAJ.addEventListener ("input", function (event) { 
    (this.value = this.value.toUpperCase());
    });
    
    
    var CveAD = document.getElementById("CveAD");    
CveAD.addEventListener ("input", function (event) { 
    (this.value = this.value.toUpperCase());
    });
    
    
    var FechaIngAds = document.getElementById("FechaIngAds");    
FechaIngAds.addEventListener ("input", function (event) { 
    (this.value = this.value.toUpperCase());
    });
    
    
    var CveZE = document.getElementById("CveZE");    
CveZE.addEventListener ("input", function (event) { 
    (this.value = this.value.toUpperCase());
    });
    
    
    var CveCD = document.getElementById("CveCD");    
CveCD.addEventListener ("input", function (event) { 
    (this.value = this.value.toUpperCase());
    });
    
    
    var TelCD = document.getElementById("TelCD");    
TelCD.addEventListener ("input", function (event) { 
    (this.value = this.value.toUpperCase());
    });
    
    
    var CveCT = document.getElementById("CveCT");    
CveCT.addEventListener ("input", function (event) { 
    (this.value = this.value.toUpperCase());
    });
    
    
    var TelCT = document.getElementById("TelCT");    
TelCT.addEventListener ("input", function (event) { 
    (this.value = this.value.toUpperCase());
    });
    
    
    var Issemmym = document.getElementById("Issemmym");    
Issemmym.addEventListener ("input", function (event) { 
    (this.value = this.value.toUpperCase());
    });
    
    
    var FechaIngIss = document.getElementById("FechaIngIss");    
FechaIngIss.addEventListener ("input", function (event) { 
    (this.value = this.value.toUpperCase());
    });
    
    
    var CveM = document.getElementById("CveM");    
CveM.addEventListener ("input", function (event) { 
    (this.value = this.value.toUpperCase());
    });
    
    
    var Antiguedad = document.getElementById("Antiguedad");    
Antiguedad.addEventListener ("input", function (event) { 
    (this.value = this.value.toUpperCase());
    });
    
    
    var CveUA = document.getElementById("CveUA");    
CveUA.addEventListener ("input", function (event) { 
    (this.value = this.value.toUpperCase());
    });
    
    
    var CveE = document.getElementById("CveE");    
CveE.addEventListener ("input", function (event) { 
    (this.value = this.value.toUpperCase());
    });
    
    
    var Sindicalizado = document.getElementById("Sindicalizado");    
Sindicalizado.addEventListener ("input", function (event) { 
    (this.value = this.value.toUpperCase());
    });
    
    
    var NivelRango = document.getElementById("NivelRango");    
NivelRango.addEventListener ("input", function (event) { 
    (this.value = this.value.toUpperCase());
    });
    
    
/////////////////////////////////////////////////FIN DE LAS VALIDACIONES////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////SECCCION DEL EVENTO ONCLICK////////////////////////////////////////////////////////////////
$(document).ready(function() {    
        $("#cve_usuario").hide();    
        $("#ClaveServidor").hide();    
        $("#nom_usuario").hide();    
        $("#ApePat").hide();    
        $("#ApeMat").hide();    
        $("#email").hide();    
        $("#passwd").hide();    
        $("#Rfc").hide();    
        $("#des_usuario").hide();    
        $("#cve_organismo").hide();    
        $("#cve_estatus").hide();    
        $("#cve_15").hide();    
        $("#cve_perfil").hide();    
        $("#cve_secretaria").hide();    
        $("#cve_usergroup").hide();    
        $("#user_image_file").hide();    
        $("#CveAds").hide();    
        $("#CvePF").hide();    
        $("#CveAJ").hide();    
        $("#CveAD").hide();    
        $("#FechaIngAds").hide();    
        $("#CveZE").hide();    
        $("#CveCD").hide();    
        $("#TelCD").hide();    
        $("#CveCT").hide();    
        $("#TelCT").hide();    
        $("#Issemmym").hide();    
        $("#FechaIngIss").hide();    
        $("#CveM").hide();    
        $("#Antiguedad").hide();    
        $("#CveUA").hide();    
        $("#CveE").hide();    
        $("#Sindicalizado").hide();    
        $("#NivelRango").hide();    
        $("#cve_usuario").show();    
        $("#ClaveServidor").show();    
        $("#nom_usuario").show();    
        $("#ApePat").show();    
        $("#ApeMat").show();    
        $("#email").show();    
        $("#passwd").show();    
        $("#Rfc").show();    
        $("#des_usuario").show();    
        $("#cve_organismo").show();    
        $("#cve_estatus").show();    
        $("#cve_15").show();    
        $("#cve_perfil").show();    
        $("#cve_secretaria").show();    
        $("#cve_usergroup").show();    
        $("#user_image_file").show();    
        $("#CveAds").show();    
        $("#CvePF").show();    
        $("#CveAJ").show();    
        $("#CveAD").show();    
        $("#FechaIngAds").show();    
        $("#CveZE").show();    
        $("#CveCD").show();    
        $("#TelCD").show();    
        $("#CveCT").show();    
        $("#TelCT").show();    
        $("#Issemmym").show();    
        $("#FechaIngIss").show();    
        $("#CveM").show();    
        $("#Antiguedad").show();    
        $("#CveUA").show();    
        $("#CveE").show();    
        $("#Sindicalizado").show();    
        $("#NivelRango").show();    
    $("#cve_usuario").click(function(){

    });    
    $("#ClaveServidor").click(function(){

    });    
    $("#nom_usuario").click(function(){

    });    
    $("#ApePat").click(function(){

    });    
    $("#ApeMat").click(function(){

    });    
    $("#email").click(function(){

    });    
    $("#passwd").click(function(){

    });    
    $("#Rfc").click(function(){

    });    
    $("#des_usuario").click(function(){

    });    
    $("#cve_organismo").click(function(){

    });    
    $("#cve_estatus").click(function(){

    });    
    $("#cve_15").click(function(){

    });    
    $("#cve_perfil").click(function(){

    });    
    $("#cve_secretaria").click(function(){

    });    
    $("#cve_usergroup").click(function(){

    });    
    $("#user_image_file").click(function(){

    });    
    $("#CveAds").click(function(){

    });    
    $("#CvePF").click(function(){

    });    
    $("#CveAJ").click(function(){

    });    
    $("#CveAD").click(function(){

    });    
    $("#FechaIngAds").click(function(){

    });    
    $("#CveZE").click(function(){

    });    
    $("#CveCD").click(function(){

    });    
    $("#TelCD").click(function(){

    });    
    $("#CveCT").click(function(){

    });    
    $("#TelCT").click(function(){

    });    
    $("#Issemmym").click(function(){

    });    
    $("#FechaIngIss").click(function(){

    });    
    $("#CveM").click(function(){

    });    
    $("#Antiguedad").click(function(){

    });    
    $("#CveUA").click(function(){

    });    
    $("#CveE").click(function(){

    });    
    $("#Sindicalizado").click(function(){

    });    
    $("#NivelRango").click(function(){

    });
/////////////////////////////////////////////////FIN DE LOS EVENTOS////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////FUNCIONES KEYUP/////////////////////////////////////////////////////////////////////////////////////////
    
    $("#cve_usuario").keyup(function () {

    });    
    $("#ClaveServidor").keyup(function () {

    });    
    $("#nom_usuario").keyup(function () {

    });    
    $("#ApePat").keyup(function () {

    });    
    $("#ApeMat").keyup(function () {

    });    
    $("#email").keyup(function () {

    });    
    $("#passwd").keyup(function () {

    });    
    $("#Rfc").keyup(function () {

    });    
    $("#des_usuario").keyup(function () {

    });    
    $("#cve_organismo").keyup(function () {

    });    
    $("#cve_estatus").keyup(function () {

    });    
    $("#cve_15").keyup(function () {

    });    
    $("#cve_perfil").keyup(function () {

    });    
    $("#cve_secretaria").keyup(function () {

    });    
    $("#cve_usergroup").keyup(function () {

    });    
    $("#user_image_file").keyup(function () {

    });    
    $("#CveAds").keyup(function () {

    });    
    $("#CvePF").keyup(function () {

    });    
    $("#CveAJ").keyup(function () {

    });    
    $("#CveAD").keyup(function () {

    });    
    $("#FechaIngAds").keyup(function () {

    });    
    $("#CveZE").keyup(function () {

    });    
    $("#CveCD").keyup(function () {

    });    
    $("#TelCD").keyup(function () {

    });    
    $("#CveCT").keyup(function () {

    });    
    $("#TelCT").keyup(function () {

    });    
    $("#Issemmym").keyup(function () {

    });    
    $("#FechaIngIss").keyup(function () {

    });    
    $("#CveM").keyup(function () {

    });    
    $("#Antiguedad").keyup(function () {

    });    
    $("#CveUA").keyup(function () {

    });    
    $("#CveE").keyup(function () {

    });    
    $("#Sindicalizado").keyup(function () {

    });    
    $("#NivelRango").keyup(function () {

    });
/////////////////////////////////////////////////FIN DE LOS EVENTOS KEY UP////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////FIN DE LOS keypress////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////FUNCIONES keypress/////////////////////////////////////////////////////////////////////////////////////////
    
    $("#cve_usuario").keypress(function(){

    });    
    $("#ClaveServidor").keypress(function(){

    });    
    $("#nom_usuario").keypress(function(){

    });    
    $("#ApePat").keypress(function(){

    });    
    $("#ApeMat").keypress(function(){

    });    
    $("#email").keypress(function(){

    });    
    $("#passwd").keypress(function(){

    });    
    $("#Rfc").keypress(function(){

    });    
    $("#des_usuario").keypress(function(){

    });    
    $("#cve_organismo").keypress(function(){

    });    
    $("#cve_estatus").keypress(function(){

    });    
    $("#cve_15").keypress(function(){

    });    
    $("#cve_perfil").keypress(function(){

    });    
    $("#cve_secretaria").keypress(function(){

    });    
    $("#cve_usergroup").keypress(function(){

    });    
    $("#user_image_file").keypress(function(){

    });    
    $("#CveAds").keypress(function(){

    });    
    $("#CvePF").keypress(function(){

    });    
    $("#CveAJ").keypress(function(){

    });    
    $("#CveAD").keypress(function(){

    });    
    $("#FechaIngAds").keypress(function(){

    });    
    $("#CveZE").keypress(function(){

    });    
    $("#CveCD").keypress(function(){

    });    
    $("#TelCD").keypress(function(){

    });    
    $("#CveCT").keypress(function(){

    });    
    $("#TelCT").keypress(function(){

    });    
    $("#Issemmym").keypress(function(){

    });    
    $("#FechaIngIss").keypress(function(){

    });    
    $("#CveM").keypress(function(){

    });    
    $("#Antiguedad").keypress(function(){

    });    
    $("#CveUA").keypress(function(){

    });    
    $("#CveE").keypress(function(){

    });    
    $("#Sindicalizado").keypress(function(){

    });    
    $("#NivelRango").keypress(function(){

    });
/////////////////////////////////////////////////FIN DE LOS EVENTOS keypress////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////FUNCIONES ON PROP///////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////FUNCIONES PROP/////////////////////////////////////////////////////////////////////////////////////////
    
    if ($("#cve_usuario").prop('checked')) {
    } else {
    }    
    if ($("#ClaveServidor").prop('checked')) {
    } else {
    }    
    if ($("#nom_usuario").prop('checked')) {
    } else {
    }    
    if ($("#ApePat").prop('checked')) {
    } else {
    }    
    if ($("#ApeMat").prop('checked')) {
    } else {
    }    
    if ($("#email").prop('checked')) {
    } else {
    }    
    if ($("#passwd").prop('checked')) {
    } else {
    }    
    if ($("#Rfc").prop('checked')) {
    } else {
    }    
    if ($("#des_usuario").prop('checked')) {
    } else {
    }    
    if ($("#cve_organismo").prop('checked')) {
    } else {
    }    
    if ($("#cve_estatus").prop('checked')) {
    } else {
    }    
    if ($("#cve_15").prop('checked')) {
    } else {
    }    
    if ($("#cve_perfil").prop('checked')) {
    } else {
    }    
    if ($("#cve_secretaria").prop('checked')) {
    } else {
    }    
    if ($("#cve_usergroup").prop('checked')) {
    } else {
    }    
    if ($("#user_image_file").prop('checked')) {
    } else {
    }    
    if ($("#CveAds").prop('checked')) {
    } else {
    }    
    if ($("#CvePF").prop('checked')) {
    } else {
    }    
    if ($("#CveAJ").prop('checked')) {
    } else {
    }    
    if ($("#CveAD").prop('checked')) {
    } else {
    }    
    if ($("#FechaIngAds").prop('checked')) {
    } else {
    }    
    if ($("#CveZE").prop('checked')) {
    } else {
    }    
    if ($("#CveCD").prop('checked')) {
    } else {
    }    
    if ($("#TelCD").prop('checked')) {
    } else {
    }    
    if ($("#CveCT").prop('checked')) {
    } else {
    }    
    if ($("#TelCT").prop('checked')) {
    } else {
    }    
    if ($("#Issemmym").prop('checked')) {
    } else {
    }    
    if ($("#FechaIngIss").prop('checked')) {
    } else {
    }    
    if ($("#CveM").prop('checked')) {
    } else {
    }    
    if ($("#Antiguedad").prop('checked')) {
    } else {
    }    
    if ($("#CveUA").prop('checked')) {
    } else {
    }    
    if ($("#CveE").prop('checked')) {
    } else {
    }    
    if ($("#Sindicalizado").prop('checked')) {
    } else {
    }    
    if ($("#NivelRango").prop('checked')) {
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