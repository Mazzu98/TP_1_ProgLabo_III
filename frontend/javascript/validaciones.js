"use strict";
function ValidarCamposVacios(valor) {
    var retValue = true;
    if (valor === '') {
        retValue = false;
    }
    return retValue;
}
function ValidarRangoNumerico(valor, max, min) {
    var retValue = true;
    if (valor < min || valor > max || isNaN(valor)) {
        retValue = false;
    }
    return retValue;
}
function ValidarCombo(valor, noValor) {
    var retValue = true;
    if (valor === noValor) {
        retValue = false;
    }
    return retValue;
}
function ObtenerTurnoSeleccionado() {
    var radioButtons = (document.getElementsByName('rdoTurno'));
    var retValue = '';
    radioButtons.forEach(function (element) {
        if (element.checked) {
            retValue = element.value;
        }
    });
    return retValue;
}
function ObtenerSueldoMaximo(valor) {
    var maxValue = 0;
    switch (valor) {
        case 'M':
            maxValue = 20000;
            break;
        case 'T':
            maxValue = 18500;
            break;
        case 'N':
            maxValue = 25000;
            break;
    }
    return maxValue;
}
function imprimirError(valor, mensaje) {
    if (!valor) {
        console.log(mensaje);
    }
}
function ValidarArchivoVacio(valor) {
    var retValue = false;
    if (valor != "") {
        retValue = true;
    }
    return retValue;
}
