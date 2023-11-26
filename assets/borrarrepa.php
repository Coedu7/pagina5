<?php
include_once('conexion.php');
$cli = $_POST['cli'];
$mec = $_POST['mec'];
$rep = $_POST['rep'];
$pla = $_POST['placa'];

    $query = "SELECT COUNT(placa) as r FROM `reparacion` WHERE id_cli=$cli AND id_mec=$mec AND id_rep=$rep AND placa='$pla'";

    $rs = mysqli_query($conec, $query) or die('Error: ' . mysqli_error($conec)); //recordset ($rs)

    if(mysqli_fetch_array($rs)['r']==1){
        $query = "DELETE FROM reparacion WHERE `reparacion`.`id_cli` = $cli AND `reparacion`.`id_mec` = $mec AND `reparacion`.`id_rep` = $rep AND `reparacion`.`placa` = '$pla'";
        $rs = mysqli_query($conec, $query) or die('Error: ' . mysqli_error($conec));
        echo 'Borrado completado';
    } else{
        echo 'Error catastrofico';
    }
mysqli_close($conec);
?>
