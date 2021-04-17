<?php
    include_once "empleado.php";
    include_once "fabrica.php";
    include_once "./validarSesion.php";

    $emp1 = new Empleado('Juan','Perez',33224411,'Masculino',6632993,50,'Tarde');
    $emp2 = new Empleado('Pepito','dasds',37389441,'Masculino',6632993,50,'Tarde');
    $emp3 = new Empleado('Leon','dfdsfdf',83248418,'Masculino',6632993,50,'Tarde');

    $fab = new Fabrica('RI',5);

    $fab->AgregarEmpleado($emp1);
    $fab->AgregarEmpleado($emp2);
    $fab->AgregarEmpleado($emp3);
    $fab->AgregarEmpleado($emp3);

    echo $fab->toString();
    
    echo "<br><br>";

    $fab->EliminarEmpleado($emp2);

    echo $fab->toString();

    echo "<a href='./cerrarSesion.php'>Log out</a>";
    
?>
