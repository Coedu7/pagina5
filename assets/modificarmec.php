<?php
include_once('conexion.php');
$cedula = $_POST['id'];
$nombre = $_POST['nombre'];

    $query = "SELECT COUNT(id) as r FROM `mecanicos` WHERE id=$cedula;";

    $rs = mysqli_query($conec, $query) or die('Error: ' . mysqli_error($conec)); //recordset ($rs)

    if(mysqli_fetch_array($rs)['r']==1){
        $query = "UPDATE `mecanicos` SET `id` = '$cedula', `nombre` = '$nombre' WHERE `mecanicos`.`id` = $cedula";
        $rs = mysqli_query($conec, $query) or die('Error: ' . mysqli_error($conec));
        echo 'Modificación completada';
    } else{
        echo 'Error catastrofico';
    }
mysqli_close($conec);
?>