<?php
include_once('conexion.php');
$nombre = $_POST['descripcion'];
$cantidad = $_POST['cantidad'];


    

        $query = "INSERT INTO `repuesto` (`descripcion`, `cantidad`) VALUES ('$nombre', '$cantidad')";
        $rs = mysqli_query($conec, $query) or die('Error: ' . mysqli_error($conec));
        echo 'Registro completado';

mysqli_close($conec);
?>