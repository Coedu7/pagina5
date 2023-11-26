<?php
include_once('conexion.php');
$placa = $_POST['placa'];
$modelo = $_POST['modelo'];
$cla = $_POST['tipo'];
$img = $_POST['img'];
$marca = $_POST['marca'];
$ano = $_POST['año'];

    $query = "SELECT COUNT(placa) as r FROM `carro` WHERE placa='$placa';";

    $rs = mysqli_query($conec, $query) or die('Error: ' . mysqli_error($conec)); //recordset ($rs)

    if(!mysqli_fetch_array($rs)['r']==1){
        $query = "INSERT INTO `carro` (`placa`, `modelo`, `imagen`, `marca`, `año`, `clasificacion`) VALUES ('$placa', '$modelo', '$img', '$marca', '$ano', '$cla')";
        $rs = mysqli_query($conec, $query) or die('Error: ' . mysqli_error($conec));
        echo 'Registro completado';
    } else{
        echo 'Ya existe la cedula';
    }
mysqli_close($conec);
?>