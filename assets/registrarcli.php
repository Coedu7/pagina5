<?php
include_once('conexion.php');
$dni = $_POST['DNI'];
$nombre = $_POST['nombre'];

    $query = "SELECT COUNT(dni) as r FROM `clientes` WHERE dni=$dni;";

    $rs = mysqli_query($conec, $query) or die('Error: ' . mysqli_error($conec)); //recordset ($rs)

    if(!mysqli_fetch_array($rs)['r']==1){
        $query = "INSERT INTO `clientes` (`dni`, `nombre`) VALUES ('$dni', '$nombre')";
        $rs = mysqli_query($conec, $query) or die('Error: ' . mysqli_error($conec));
        echo 'Registro completado';
    } else{
        echo 'Ya existe la cedula';
    }
mysqli_close($conec);
?>