<?php
include_once('conexion.php');
$placa = $_POST['placa'];
$modelo = $_POST['modelo'];
$año = $_POST['año'];
$cla = $_POST['cla'];
$img = $_POST['img'];
$marca = $_POST['marca'];

    $query = "SELECT COUNT(placa) as r FROM `carro` WHERE placa='$placa';";

    $rs = mysqli_query($conec, $query) or die('Error: ' . mysqli_error($conec)); //recordset ($rs)

    if(mysqli_fetch_array($rs)['r']==1){
        $query = "UPDATE `carro` SET `placa` = '$placa', `modelo` = '$modelo',  `imagen` = '$img',  `marca` = '$marca',  `año` = '$año', `clasificacion` = '$cla' WHERE `carro`.`placa` = '$placa'";
        $rs = mysqli_query($conec, $query) or die('Error: ' . mysqli_error($conec));
        echo 'Modificación completada';
    } else{
        echo 'Error catastrofico';
    }
mysqli_close($conec);
?>