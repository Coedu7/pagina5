<?php
include_once('conexion.php');
$cedula = $_POST['cedula'];

    $query = "SELECT COUNT(dni) as r FROM `clientes` WHERE dni=$cedula;";

    $rs = mysqli_query($conec, $query) or die('Error: ' . mysqli_error($conec)); //recordset ($rs)

    if(mysqli_fetch_array($rs)['r']==1){
        $query = "DELETE FROM clientes WHERE `clientes`.`dni` = $cedula";
        $rs = mysqli_query($conec, $query) or die('Error: ' . mysqli_error($conec));
        echo 'Borrado completado';
    } else{
        echo 'Error catastrofico';
    }
mysqli_close($conec);
?>
