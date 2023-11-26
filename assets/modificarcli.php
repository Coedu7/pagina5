<?php
include_once('conexion.php');
$cedula = $_POST['dni'];
$nombre = $_POST['nombre'];

    $query = "SELECT COUNT(dni) as r FROM `clientes` WHERE dni=$cedula;";

    $rs = mysqli_query($conec, $query) or die('Error: ' . mysqli_error($conec)); //recordset ($rs)

    if(mysqli_fetch_array($rs)['r']==1){
        $query = "UPDATE `clientes` SET `dni` = '$cedula', `nombre` = '$nombre' WHERE `clientes`.`dni` = $cedula";
        $rs = mysqli_query($conec, $query) or die('Error: ' . mysqli_error($conec));
        echo 'Modificación completada';
    } else{
        echo 'Error catastrofico';
    }
mysqli_close($conec);
?>