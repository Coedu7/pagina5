<?php
include_once('conexion.php');
$dni = $_POST['id'];
$nombre = $_POST['nombre'];

    $query = "SELECT COUNT(id) as r FROM `mecanicos` WHERE id=$dni;";

    $rs = mysqli_query($conec, $query) or die('Error: ' . mysqli_error($conec)); //recordset ($rs)

    if(!mysqli_fetch_array($rs)['r']==1){
        $query = "INSERT INTO `mecanicos` (`id`, `nombre`) VALUES ('$dni', '$nombre')";
        $rs = mysqli_query($conec, $query) or die('Error: ' . mysqli_error($conec));
        echo 'Registro completado';
    } else{
        echo 'Ya existe la cedula';
    }
mysqli_close($conec);
?>