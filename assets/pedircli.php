<?php
include_once('conexion.php');
$cedula = $_POST['cedula'];


    $query = "SELECT * FROM `clientes` WHERE dni=$cedula;";

    $rs = mysqli_query($conec, $query) or die('Error: ' . mysqli_error($conec)); //recordset ($rs)

    $row = mysqli_fetch_array($rs);

    echo json_encode($row);
mysqli_close($conec);
?>