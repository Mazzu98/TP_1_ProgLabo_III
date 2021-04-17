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
function enviar(event) {
    if (!AdministrarValidaciones()) {
        event.preventDefault();
    }
}
function AdministrarValidaciones() {
    var valida = true;
    var txtDni = (document.getElementById('txtDni')).value;
    var txtNombre = (document.getElementById('txtNombre')).value;
    var txtApellido = (document.getElementById('txtApellido')).value;
    var txtLegajo = (document.getElementById('txtLegajo')).value;
    var txtSueldo = (document.getElementById('txtSueldo')).value;
    var cboSexo = (document.getElementById('cboSexo')).value;
    var file = document.getElementById('foto').value;
    AdministrarSpanError('errorDni', ValidarCamposVacios(txtDni) && ValidarRangoNumerico(parseInt(txtDni), 55000000, 1000000));
    AdministrarSpanError('errorApellido', ValidarCamposVacios(txtApellido));
    AdministrarSpanError('errorNombre', ValidarCamposVacios(txtNombre));
    AdministrarSpanError('errorSexo', ValidarCombo(cboSexo, 'Seleccione'));
    AdministrarSpanError('errorLegajo', ValidarCamposVacios(txtLegajo));
    AdministrarSpanError('errorSueldo', !(ObtenerSueldoMaximo(ObtenerTurnoSeleccionado()) < +txtSueldo) && ValidarCamposVacios(txtSueldo));
    AdministrarSpanError('errorFoto', ValidarArchivoVacio(file));
    return VerificarValidacionesLogin();
}
function enviarLogin(event) {
    if (!AdministrarValidacionesLogin()) {
        event.preventDefault();
    }
}
function AdministrarValidacionesLogin() {
    var txtDni = (document.getElementById('txtDni')).value;
    var txtApellido = (document.getElementById('txtApellido')).value;
    AdministrarSpanError('errorDni', ValidarCamposVacios(txtDni));
    AdministrarSpanError('errorDni', ValidarRangoNumerico(parseInt(txtDni), 55000000, 1000000));
    AdministrarSpanError('errorApellido', ValidarCamposVacios(txtApellido));
    return VerificarValidacionesLogin();
}
function AdministrarSpanError(id, valida) {
    if (valida) {
        (document.getElementById(id)).style.display = 'none';
    }
    else {
        (document.getElementById(id)).style.display = 'block';
    }
}
function VerificarValidacionesLogin() {
    var valida = true;
    var error = document.getElementsByTagName('span');
    for (var i = 0; i < error.length; i++) {
        if (error[i].style.display === 'block') {
            valida = false;
            break;
        }
    }
    return valida;
}
function AdministrarModificar(dni) {
    var form = document.getElementById('form');
    var inputDni = document.getElementById('dni');
    inputDni.value = dni.toString();
    form.submit();
}
