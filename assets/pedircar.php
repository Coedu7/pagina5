<?php
include_once('conexion.php');
$placa = $_POST['placa'];


    $query = "SELECT * FROM `carro` WHERE placa='$placa';";

    $rs = mysqli_query($conec, $query) or die('Error: ' . mysqli_error($conec)); //recordset ($rs)

    $row = mysqli_fetch_array($rs);

    echo json_encode($row);
mysqli_close($conec);
?>