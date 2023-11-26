<?php
include_once('conexion.php');
$cli = $_POST['idcli'];
$mec = $_POST['idmec'];
$rep = $_POST['idrep'];
$pla = $_POST['placa'];
$tipo = $_POST['tipo'];

    $query = "SELECT COUNT(placa) as r FROM `reparacion` WHERE id_cli=$cli AND id_mec=$mec AND id_rep=$rep AND placa='$pla'";

    $rs = mysqli_query($conec, $query) or die('Error: ' . mysqli_error($conec)); //recordset ($rs)

    if(mysqli_fetch_array($rs)['r']==1){
        $query = "UPDATE `reparacion` SET `id_cli` = '$cli', `id_mec` = '$mec',  `id_rep` = '$rep',  `placa` = '$pla',  `tipo` = '$tipo' WHERE `reparacion`.`id_cli` = $cli AND `reparacion`.`id_mec` = $mec AND `reparacion`.`id_rep` = $rep AND `reparacion`.`placa` = '$pla'";
        $rs = mysqli_query($conec, $query) or die('Error: ' . mysqli_error($conec));
        echo 'Modificación completada';
    } else{
        echo 'Error catastrofico';
    }
mysqli_close($conec);
?>