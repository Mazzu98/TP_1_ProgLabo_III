/// <reference path="ajax.ts" />

function enviar(): void {
    let txtDni = (<HTMLInputElement>(document.getElementById('txtDni'))).value;
    let txtNombre = (<HTMLInputElement>(document.getElementById('txtNombre'))).value;
    let txtApellido = (<HTMLInputElement>(document.getElementById('txtApellido'))).value;
    let txtLegajo = (<HTMLInputElement>(document.getElementById('txtLegajo'))).value;
    let txtSueldo = (<HTMLInputElement>(document.getElementById('txtSueldo'))).value;
    let cboSexo = (<HTMLInputElement>(document.getElementById('cboSexo'))).value;
    let turno = ObtenerTurnoSeleccionado();
    let foto : any = (<HTMLInputElement> document.getElementById('foto'));
    
    if(AdministrarValidaciones()){

        
        let xhr : XMLHttpRequest = new XMLHttpRequest();
        let foto : any = (<HTMLInputElement> document.getElementById("foto"));
        let form : FormData = new FormData();
        form.append('txtDni', txtDni);
        form.append('txtNombre', txtNombre);
        form.append('txtApellido', txtApellido);
        form.append('txtLegajo', txtLegajo);
        form.append('txtSueldo', txtSueldo);
        form.append('cboSexo', cboSexo);
        form.append('rdoTurno', turno);
        form.append('foto', foto.files[0]);
        if(<HTMLInputElement>(document.getElementById('hdnModificar'))){
            form.append('hdnModificar', (<HTMLInputElement>(document.getElementById('hdnModificar'))).value);
        }
        xhr.open('POST', "./../backend/administracion.php", true);
        xhr.setRequestHeader("enctype", "multipart/form-data");
        xhr.send(form);

        xhr.onreadystatechange = ()=>{
            if(xhr.readyState === 4 && xhr.status === 200){
                cargarMostrar();
            }
        }
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
        let inputDni = <HTMLInputElement>document.getElementById('dni');
        inputDni.value = dni.toString();
        let ajax = new Ajax();
        ajax.Post('./alta_modif.php',ImprimirForm,'dni='+inputDni.value);
    }


    function indexOnLoad(){
        cargarMostrar();
        cargarForm();
      }
      
      function cargarForm(){
          let ajax = new Ajax();
          ajax.Post("./alta_modif.php", ImprimirForm);
      }
      
      function ImprimirForm(response : string) {
        (<HTMLDivElement>document.getElementById("forms")).innerHTML = response;
      }
      
      function cargarMostrar(){
          let ajax = new Ajax();
          ajax.Post("./../backend/mostrar.php", ImprimirMostrar);
      }
      
      function ImprimirMostrar(response : string) {
        (<HTMLDivElement>document.getElementById("mostrar")).innerHTML = response;
      }
      
      function eliminarEmpleado(legajo:string){
            let ajax = new Ajax();
            ajax.Get("./../backend/eliminar.php",cargarMostrar,'legajo='+legajo);
      }
      