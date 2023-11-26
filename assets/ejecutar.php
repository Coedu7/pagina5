<?php
include_once('conexion.php');
$cedula = $_POST['cedula'];
$cantidad = $_POST['cantidad'];

    $query = "call pedido('$cedula','$cantidad')";

    $rs = mysqli_query($conec, $query) or die('Error: ' . mysqli_error($conec)); //recordset ($rs)

    if($rs){
        echo mysqli_fetch_array($rs)['r'];
    }
mysqli_close($conec);
?>