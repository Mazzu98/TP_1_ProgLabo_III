<?php
    session_start();
    $dni = $_SESSION['DNIEmpleado'];
    
    include_once "./vendor/autoload.php";

    header('content-type:application/pdf');

    $mdf = new \Mpdf\Mpdf(['pagenumPrefix' => 'Pág nro.',
                            'pagenumSuffix' => ' - ',
                            'nbpgPrefix' => ' de ',
                            'nbpgSuffix' => ' Páginas'
                            ]);

    $mdf->SetHeader('Mazzucchelli Juan    {PAGENO} {nbpg}');
    $mdf->SetFooter('https://testmazzu.000webhostapp.com/frontend/index_PDO.html');

    $mdf->SetProtection([],$dni);

    $mdf->WriteHTML('
    
    <table align="center">
        <tr>
            <td>
                <h4>Lista de empleados</h4>
            </td>
        </tr>
        <tr>
            <td colspan="5"><hr></td>
        </tr>
        ');
        include_once './fabrica.php';

        $fabrica = new Fabrica('RI',7);
        $fabrica->TraerDeBD();
        $empleados = $fabrica->GetEmpleados();
        
        foreach($empleados as $empleado){
            $legajo = $empleado->GetLegajo();
            $path ="./../backend_PDO/" . $empleado->GetPathFoto();
            $dni = $empleado->GetDni();
            $mdf->WriteHTML("
            <tr>
            <td>
            {$empleado->toString()}
            </td>
            <td>
            <img src='$path' width='90px' height='90px'>
            </td>
            <td>
            ");
        }
        $mdf->WriteHTML("
            <tr>
                <td colspan='5'><hr></td>
            </tr>
            <input type='hidden' id='dni' name='dni'>
        </table>
        ");
    $mdf->Output('Empleados.pdf','I');
