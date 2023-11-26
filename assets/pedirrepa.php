<?php
include_once('conexion.php');
$cli = $_POST['cli'];
$mec = $_POST['mec'];
$rep = $_POST['rep'];
$pla = $_POST['placa'];


    $query = "SELECT * FROM `reparacion` WHERE id_cli=$cli AND id_mec=$mec AND id_rep=$rep AND placa='$pla'";

    $rs = mysqli_query($conec, $query) or die('Error: ' . mysqli_error($conec)); //recordset ($rs)

    $row = mysqli_fetch_array($rs);
    

    echo json_encode($row);
mysqli_close($conec);
?>