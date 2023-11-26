<?php
include_once('conexion.php');
$placa = $_POST['placa'];

    $query = "SELECT COUNT(placa) as r FROM `carro` WHERE placa='$placa';";

    $rs = mysqli_query($conec, $query) or die('Error: ' . mysqli_error($conec)); //recordset ($rs)

    if(mysqli_fetch_array($rs)['r']==1){
        $query = "DELETE FROM carro WHERE `carro`.`placa` = '$placa'";
        $rs = mysqli_query($conec, $query) or die('Error: ' . mysqli_error($conec));
        echo 'Borrado completado';
    } else{
        echo 'Error catastrofico';
    }
mysqli_close($conec);
?>
