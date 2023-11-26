<?php
     include_once('assets/conexion.php');


    $query = "SELECT * FROM reparacion";
    $rs    = mysqli_query($conec, $query) or die('Error: ' . mysqli_error($conec));

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Concesionario</title>
<!-- Enlaces a estilos y bibliotecas externas -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

<style>
    table {
        background-color: burlywood;
        border-collapse: collapse;
        width: 100%;
    }



    th, td {
        padding: 8px;
        text-align: center;
        border-bottom: 2px solid #ddd;
    }
</style>


</head>
<body style="background-color: antiquewhite;">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- Formulario para ingresar altura y base -->
    <div style="width: 80vh; background-color: burlywood; padding: 1vh; position: absolute; top:25%; left: 25%; ">
        <h1>Gestion de mecanicos</h1>
        <form hidden id="area-form">
            <div class="mb-3">
                <label for="idcli" class="form-label">Cedula del cliente:</label>
                <input readonly type="number" class="form-control" id="idcli" name="cedula">
            </div>
            <div class="mb-3">
                <label for="idmec" class="form-label">ID del mecanico:</label>
                <input readonly type="number" class="form-control" id="idmec" name="cantidad">
            </div>
            <div class="mb-3">
                <label for="rep" class="form-label">Repuesto asignado:</label>
                <input readonly type="number" class="form-control" id="rep" name="cantidad">
            </div>
            <div class="mb-3">
                <label for="placa" class="form-label">Placa del vehiculo:</label>
                <input readonly type="text" class="form-control" id="placa" name="cantidad">
            </div>
            <div class="mb-3">
                <label for="tipo" class="form-label">Estado de la reparacion:</label>
                <select id="tipo" class="form-select" aria-label="Default select example">
                    <option selected value="1">Activo</option>
                    <option value="2">Terminado</option>
                </select>  
            </div>


            <!-- Botón para calcular -->
            <button type="button" class="btn btn-primary" onclick="guardar()" id="registrar-btn">Calcular</button>
        </form>
        <a href="index.php">Registro de reparacion</a>
            <a href="clientes.php">Gestión de clientes</a>
            <a href="mecanicos.php">Gestión de mecanicos</a>
            <a href="carros.php">Gestión de carros</a>
            <a href="repuestos.php">Gestión de repuestos</a>
        <div class="container" id="resultado">
           
        </div>
        <table border="1" >
                <thead>
                    <tr>
                        <th>Cliente</th>
                        <th>Mecanico</th>
                        <th>Repuesto</th>
                        <th>Placa</th>
                        <th>Estado</th>                        
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($fila = mysqli_fetch_array($rs)){  ?>
                    <tr>
                        <td><?php echo $fila['id_cli']; ?></td>
                        <td><?php echo $fila['id_mec']; ?></td>
                        <td><?php echo $fila['id_rep']; ?></td>                        
                        <td><?php echo $fila['placa']; ?></td>
                        <td><?php echo $fila['tipo']; ?></td>
                        <td><button type="button" class="btn ad btn-primary" data-cli="<?php echo $fila['id_cli']; ?>" data-mec="<?php echo $fila['id_mec']; ?>" data-rep="<?php echo $fila['id_rep']; ?>" data-placa="<?php echo $fila['placa']; ?>" onclick="modificar(dataset.cli, dataset.mec, dataset.rep, dataset.placa)">Modificar</button>
                        <button type="button" class="btn btn-primary" data-cli="<?php echo $fila['id_cli']; ?>" data-mec="<?php echo $fila['id_mec']; ?>" data-rep="<?php echo $fila['id_rep']; ?>" data-placa="<?php echo $fila['placa']; ?>" onclick="borrar(dataset.cli, dataset.mec, dataset.rep, dataset.placa)">Borrar</button></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>


        <div class="container" id="resultado">
           
        </div>
    </div>

<!-- Script para realizar la solicitud AJAX -->
<script>
    function modificar(a,b,c,d){
        document.querySelector("#area-form").hidden=false;
        var parametros = {"cli": a, "mec": b, "rep": c, "placa": d};
        
        $.ajax({
            url: "assets/pedirrepa.php",
            type: "post",
            data: parametros,
        beforeSend: function() {
            $("#resultado").html("Procesando, espere por favor...");
        },
        success: function(response) {
            $("#resultado").html("Datos recuperados");
            $data = JSON.parse(response);
            document.querySelector("#idcli").value=$data['id_cli'];
            document.querySelector("#idmec").value=$data['id_mec'];
            document.querySelector("#rep").value=$data['id_rep'];
            document.querySelector("#placa").value=$data['placa'];
            switch ($data['tipo']) {
                case "Activo":
                    document.querySelector("#tipo").value=1;
                    break;
                case "Terminado":
                    document.querySelector("#tipo").value=2;
                    break;
            }                       
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
            $("#resultado").html("Error al realizar el cálculo");
        }        
        });     
    }
    function borrar(a,b,c,d){
        var parametros = {"cli": a, "mec": b, "rep": c, "placa": d};        
        $.ajax({
            url: "assets/borrarrepa.php",
            type: "post",
            data: parametros,
        beforeSend: function() {
            $("#resultado").html("Procesando, espere por favor...");
        },
        success: function(response) {
            $("#resultado").html(response);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
            $("#resultado").html("Error al realizar el cálculo");
        }        
        });     
    }

    function guardar(){
        var cli = parseInt(document.getElementById('idcli').value);
        var mec = parseInt(document.getElementById('idmec').value);
        var rep = parseInt(document.getElementById('rep').value);
        var placa = document.getElementById('placa').value;
        var tipo = document.getElementById('tipo').value;
        switch (tipo) {
            case 1:
                tipo="Activo";
                break;
            case 2:
                tipo="Terminado";
                break;        
        }

        if (cli!=null && mec!=null && rep!=null && placa!=null && tipo!=null) {
            var parametros = {"idcli": cli, "idmec": mec, "idrep": rep, "placa": placa, "tipo": tipo};
            $.ajax({
                url: "assets/modificarrepa.php",
                type: "post",
                data: parametros,
            beforeSend: function() {
                $("#resultado").html("Procesando, espere por favor...");
            },
            success: function(response) {
                $("#resultado").html(response);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
                $("#resultado").html("Error al realizar el cálculo");
            }        
            });
        } else {            
            $("#resultado").html("Por favor, ingrese valores numéricos válidos.");
    }
    };
</script>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html
