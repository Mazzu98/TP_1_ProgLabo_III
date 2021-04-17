
function ValidarCamposVacios(valor : string) : boolean{
    let retValue : boolean = true;
    if(valor === '' ){
        retValue = false;
    }
    return retValue;
}

function ValidarRangoNumerico(valor : number, max : number, min : number) : boolean{
    let retValue : boolean = true;
    if(valor < min || valor > max || isNaN(valor)){
        retValue = false;
    }
    
    return retValue;
}

function ValidarCombo(valor : string, noValor : string) : boolean{
    let retValue : boolean = true;
    if(valor === noValor){
        retValue = false;
    }
    return retValue;
}

function ObtenerTurnoSeleccionado() : string{
    let radioButtons = (document.getElementsByName('rdoTurno'));
    let retValue : string = '';
    radioButtons.forEach(element => {
        if((<HTMLInputElement> element).checked){
            retValue = (<HTMLInputElement> element).value;
        }
    });
    return retValue;
}

function ObtenerSueldoMaximo(valor : string) : number{
    let maxValue = 0;
    switch(valor){
        case 'M': maxValue = 20000;
        break;
        case 'T': maxValue = 18500;
        break;
        case 'N': maxValue = 25000;
        break;
    }
    return maxValue;
}

function imprimirError(valor : boolean, mensaje : string) : void{
    if(! valor){
        console.log(mensaje);
    }
}

function ValidarArchivoVacio(valor:string){
    let retValue = false;
    if(valor != ""){
        retValue = true;
    } 
    return retValue;
}
