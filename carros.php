<?php
     include_once('assets/conexion.php');


    $query = "SELECT * FROM carro";
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

    .ad{
        margin-bottom: 10px;
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
                <label for="placa" class="form-label">Placa:</label>
                <input readonly type="text" class="form-control" id="placa" name="placa">
            </div>
            <div class="mb-3">
                <label for="modelo" class="form-label">Modelo:</label>
                <input type="text" class="form-control" id="modelo" name="modelo">
            </div>
            <div class="dropdown mb-3">
                <label for="tipo" class="form-label">Apariencia:</label>
                <br>
                <select id="tipo" class="form-select" aria-label="Default select example">
                <option selected value="1">Sedan</option>
                <option value="2">Hatchback</option>
                <option value="3">PickUp</option>
                <option value="4">Coupe</option>
                <option value="5">SUV</option>
            </select> 
            </div>
            <div class="mb-3">
                <label for="marca" class="form-label">Marca:</label>
                <input type="text" class="form-control" id="marca" name="marca">
            </div>
            <div class="mb-3">
                <label for="año" class="form-label">Año:</label>
                <input type="number" class="form-control" id="año" name="año">
            </div>
            <!-- Botón para calcular -->
            <button type="button" class="btn btn-primary" onclick="guardar()" id="guardar-btn">Guardar</button>
        </form>

        
        <a href="index.php">Registro de reparacion</a>
        <a href="registrocar.php">Registro de carros</a>
        <table border="1" >
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Modelo</th>
                        <th>Marca</th>
                        <th>Año</th>
                        <th>Clasificacion</th>
                        <th>Apariencia</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($fila = mysqli_fetch_array($rs)){  ?>
                    <tr>
                        <td><?php echo $fila['placa']; ?></td>
                        <td><?php echo $fila['modelo']; ?></td>
                        <td><?php echo $fila['marca']; ?></td>
                        <td><?php echo $fila['año']; ?></td>
                        <td><?php echo $fila['clasificacion']; ?></td>
                        <td><img src=<?php echo $fila['imagen']; ?>></td>
                        <td><button type="button" class="btn ad btn-primary" data-name="<?php echo $fila['placa']; ?>" onclick="modificar(dataset.name)">Modificar</button>
                        <button type="button" class="btn btn-primary" data-name="<?php echo $fila['placa']; ?>" onclick="borrar(dataset.name)">Borrar</button></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>


        <div class="container" id="resultado">
           
        </div>
    </div>

<!-- Script para realizar la solicitud AJAX -->
<script>
    function modificar(a){
        document.querySelector("#area-form").hidden=false;
        var parametros = {"placa": a};
        
        $.ajax({
            url: "assets/pedircar.php",
            type: "post",
            data: parametros,
        beforeSend: function() {
            $("#resultado").html("Procesando, espere por favor...");
        },
        success: function(response) {
            $("#resultado").html("Datos recuperados");
            $data = JSON.parse(response);
            document.querySelector("#placa").value=$data['placa'];
            document.querySelector("#modelo").value=$data['modelo'];
            switch ($data['clasificacion']) {
                case "sedan":
                    document.querySelector("#tipo").value=1;
                    break;
                case "hatchback":
                    document.querySelector("#tipo").value=2;
                    break;
                case "pickup":
                    document.querySelector("#tipo").value=3;
                    break;
                case "coupe":
                    document.querySelector("#tipo").value=4;
                    break;
                case "suv":
                    document.querySelector("#tipo").value=5;
                    break;
            }
            document.querySelector("#año").value=$data['año'];
            document.querySelector("#marca").value=$data['marca'];
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
            $("#resultado").html("Error al realizar el cálculo");
        }        
        });     
    }
    function borrar(a){
        var parametros = {"placa": a};        
        $.ajax({
            url: "assets/borrarcar.php",
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
        var placa = document.getElementById('placa').value;
        var modelo = document.getElementById('modelo').value;
        var marca = document.getElementById('marca').value;
        var año = document.getElementById('año').value;
        var tipo = parseInt(document.getElementById('tipo').value);
        var img = "base";
        switch (tipo) {
            case 1:
                img="assets/img/sedan.png";
                tipo="sedan";
                break;
            case 2:
                img="assets/img/hatch.png";
                tipo="hatchback";
                break;        
            case 3:
                img="assets/img/pickup.png";
                tipo="pickup";
                break;
            case 4:
                img="assets/img/coupe.png";
                tipo="coupe";
                break;
            case 5:
                img="assets/img/suv.png";
                tipo="suv";
                break;
        }

        if (placa!=null && modelo!=null && marca!=null && año!=null) {
            var parametros = {"placa": placa, "modelo": modelo, "marca": marca, "año": año, "cla": tipo, "img": img};
            $.ajax({
                url: "assets/modificarcar.php",
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
