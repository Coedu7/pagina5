<?php
include_once('conexion.php');
$cedula = $_POST['id'];
$nombre = $_POST['descripcion'];
$cantidad = $_POST['cantidad'];

    $query = "SELECT COUNT(id) as r FROM `repuesto` WHERE id=$cedula;";

    $rs = mysqli_query($conec, $query) or die('Error: ' . mysqli_error($conec)); //recordset ($rs)

    if(mysqli_fetch_array($rs)['r']==1){
        $query = "UPDATE `repuesto` SET `id` = '$cedula', `descripcion` = '$nombre',  `cantidad` = '$cantidad' WHERE `repuesto`.`id` = $cedula";
        $rs = mysqli_query($conec, $query) or die('Error: ' . mysqli_error($conec));
        echo 'Modificación completada';
    } else{
        echo 'Error catastrofico';
    }
mysqli_close($conec);
?>