var Ajax = /** @class */ (function () {
    function Ajax() {
        var _this = this;
        this.Get = function (ruta, success, params, error) {
            if (params === void 0) { params = ""; }
            var parametros = params.length > 0 ? params : "";
            ruta = params.length > 0 ? ruta + "?" + parametros : ruta;
            _this._xhr.open('GET', ruta);
            _this._xhr.send();
            _this._xhr.onreadystatechange = function () {
                if (_this._xhr.readyState === Ajax.DONE) {
                    if (_this._xhr.status === Ajax.OK) {
                        success(_this._xhr.responseText);
                    }
                    else {
                        if (error !== undefined) {
                            error(_this._xhr.status);
                        }
                    }
                }
            };
        };
        this.Post = function (ruta, success, params, error) {
            if (params === void 0) { params = ""; }
            var parametros = params.length > 0 ? params : "";
            _this._xhr.open('POST', ruta, true);
            _this._xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
            _this._xhr.send(parametros);
            _this._xhr.onreadystatechange = function () {
                if (_this._xhr.readyState === Ajax.DONE) {
                    if (_this._xhr.status === Ajax.OK) {
                        success(_this._xhr.responseText);
                    }
                    else {
                        if (error !== undefined) {
                            error(_this._xhr.status);
                        }
                    }
                }
            };
        };
        this._xhr = new XMLHttpRequest();
        Ajax.DONE = 4;
        Ajax.OK = 200;
    }
    return Ajax;
}());
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
/// <reference path="ajax.ts" />
function enviar() {
    var txtDni = (document.getElementById('txtDni')).value;
    var txtNombre = (document.getElementById('txtNombre')).value;
    var txtApellido = (document.getElementById('txtApellido')).value;
    var txtLegajo = (document.getElementById('txtLegajo')).value;
    var txtSueldo = (document.getElementById('txtSueldo')).value;
    var cboSexo = (document.getElementById('cboSexo')).value;
    var turno = ObtenerTurnoSeleccionado();
    var foto = document.getElementById('foto');
    if (AdministrarValidaciones()) {
        var xhr_1 = new XMLHttpRequest();
        var foto_1 = document.getElementById("foto");
        var form = new FormData();
        form.append('txtDni', txtDni);
        form.append('txtNombre', txtNombre);
        form.append('txtApellido', txtApellido);
        form.append('txtLegajo', txtLegajo);
        form.append('txtSueldo', txtSueldo);
        form.append('cboSexo', cboSexo);
        form.append('rdoTurno', turno);
        form.append('foto', foto_1.files[0]);
        if ((document.getElementById('hdnModificar'))) {
            form.append('hdnModificar', (document.getElementById('hdnModificar')).value);
        }
        xhr_1.open('POST', "./../backend/administracion.php", true);
        xhr_1.setRequestHeader("enctype", "multipart/form-data");
        xhr_1.send(form);
        xhr_1.onreadystatechange = function () {
            if (xhr_1.readyState === 4 && xhr_1.status === 200) {
                cargarMostrar();
            }
        };
        cargarForm();
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
    var inputDni = document.getElementById('dni');
    inputDni.value = dni.toString();
    var ajax = new Ajax();
    ajax.Post('./alta_modif.php', ImprimirForm, 'dni=' + inputDni.value);
}
function indexOnLoad() {
    cargarMostrar();
    cargarForm();
}
function cargarForm() {
    var ajax = new Ajax();
    ajax.Post("./alta_modif.php", ImprimirForm);
}
function ImprimirForm(response) {
    document.getElementById("forms").innerHTML = response;
}
function cargarMostrar() {
    var ajax = new Ajax();
    ajax.Post("./../backend/mostrar.php", ImprimirMostrar);
}
function ImprimirMostrar(response) {
    document.getElementById("mostrar").innerHTML = response;
}
function eliminarEmpleado(legajo) {
    var ajax = new Ajax();
    ajax.Get("./../backend/eliminar.php", cargarMostrar, 'legajo=' + legajo);
}
