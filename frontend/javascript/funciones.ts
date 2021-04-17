function enviar(event : Event): void {
   if(!AdministrarValidaciones()){
      event.preventDefault();
   }
}

  function AdministrarValidaciones() : boolean{
    let valida : boolean = true;

    let txtDni = (<HTMLInputElement>(document.getElementById('txtDni'))).value;
    let txtNombre = (<HTMLInputElement>(document.getElementById('txtNombre'))).value;
    let txtApellido = (<HTMLInputElement>(document.getElementById('txtApellido'))).value;
    let txtLegajo = (<HTMLInputElement>(document.getElementById('txtLegajo'))).value;
    let txtSueldo = (<HTMLInputElement>(document.getElementById('txtSueldo'))).value;
    let cboSexo = (<HTMLInputElement>(document.getElementById('cboSexo'))).value;
    let file = (<HTMLInputElement> document.getElementById('foto')).value;

    AdministrarSpanError('errorDni',ValidarCamposVacios(txtDni) && ValidarRangoNumerico(parseInt(txtDni),55000000,1000000));
    AdministrarSpanError('errorApellido',ValidarCamposVacios(txtApellido));
    AdministrarSpanError('errorNombre',ValidarCamposVacios(txtNombre));
    AdministrarSpanError('errorSexo',ValidarCombo(cboSexo,'Seleccione'));
    AdministrarSpanError('errorLegajo', ValidarCamposVacios(txtLegajo));
    AdministrarSpanError('errorSueldo',!(ObtenerSueldoMaximo(ObtenerTurnoSeleccionado()) < +txtSueldo) && ValidarCamposVacios(txtSueldo));
    AdministrarSpanError('errorFoto',ValidarArchivoVacio(file));

    return VerificarValidacionesLogin();
    
}

    function enviarLogin(event : Event): void {
        if(!AdministrarValidacionesLogin()){
            event.preventDefault();
        }
    }

    function AdministrarValidacionesLogin(){
        let txtDni = (<HTMLInputElement>(document.getElementById('txtDni'))).value;
        let txtApellido = (<HTMLInputElement>(document.getElementById('txtApellido'))).value;

        AdministrarSpanError('errorDni',ValidarCamposVacios(txtDni));
        AdministrarSpanError('errorDni',ValidarRangoNumerico(parseInt(txtDni),55000000,1000000));
        AdministrarSpanError('errorApellido',ValidarCamposVacios(txtApellido));

        

        return VerificarValidacionesLogin();
    }

    function AdministrarSpanError(id : string, valida: boolean ){

        if(valida){
            (<HTMLInputElement>(document.getElementById(id))).style.display = 'none';
        }
        else{
            (<HTMLInputElement>(document.getElementById(id))).style.display = 'block';
        }
    }

    function VerificarValidacionesLogin() : boolean{
        let valida = true;
        let error : HTMLCollectionOf<HTMLSpanElement> = document.getElementsByTagName('span');

        for(let i = 0; i<error.length;i++){
            if((<HTMLSpanElement>error[i]).style.display === 'block'){
                valida = false;
                break;
            }
        }

        return valida;
    }

    function AdministrarModificar(dni : number){
        let form = <HTMLFormElement>document.getElementById('form');
        let inputDni = <HTMLInputElement>document.getElementById('dni');
        inputDni.value = dni.toString();
        form.submit();
    }
