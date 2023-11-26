<?php
include_once('conexion.php');
$cli = $_POST['idcli'];
$mec = $_POST['idmec'];
$rep = $_POST['idrep'];
$placa = $_POST['placa'];
$tipo = $_POST['tipo'];

    $query = "SELECT COUNT(placa) as r FROM `reparacion` WHERE placa='$placa' AND tipo='Activo';";

    $rs = mysqli_query($conec, $query) or die('Error: ' . mysqli_error($conec)); //recordset ($rs)

    if(!mysqli_fetch_array($rs)['r']>=1){
        $query = "INSERT INTO `reparacion` (`id_cli`, `id_mec`, `id_rep`, `placa`, `tipo`) VALUES ('$cli', '$mec', '$rep', '$placa', '$tipo')";
        $rs = mysqli_query($conec, $query) or die('Error: ' . mysqli_errno($conec));
        echo 'Registro completado';
    } else{
        echo 'Ya está este vehiculo en reparación';
    }
mysqli_close($conec);
?>