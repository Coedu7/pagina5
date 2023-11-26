<?php
     include_once('assets/conexion.php');


    $query = "SELECT * FROM clientes";
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
        padding: 10px;
        text-align: left;
        border-bottom: 2px solid #ddd;
    }
</style>


</head>
<body style="background-color: antiquewhite;">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- Formulario para ingresar altura y base -->
    <div style="width: 75vh; background-color: burlywood; padding: 1vh; position: absolute; top:25%; left: 25%; ">
        <h1>Gestion de cliente</h1>
        <form hidden id="area-form">
            <div class="mb-3">
                <label for="cedula" class="form-label">DNI:</label>
                <input readonly type="number" class="form-control" id="cedula" name="cedula">
            </div>
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre:</label>
                <input type="text" class="form-control" id="nombre" name="nombre">
            </div>
            <!-- Botón para calcular -->
            <button type="button" class="btn btn-primary" onclick="guardar()" id="guardar-btn">Guardar</button>
        </form>

        
        <a href="index.php">Registro de reparacion</a>
        <a href="registrocli.php">Registro de clientes</a>
        <a href="repCli.php">Reportes de clientes</a>
        <table border="1" >
                <thead>
                    <tr>
                        <th>DNI</th>
                        <th>Nombre</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($fila = mysqli_fetch_array($rs)){  ?>
                    <tr>
                        <td><?php echo $fila['dni']; ?></td>
                        <td><?php echo $fila['nombre']; ?></td>
                        <td><button type="button" class="btn btn-primary" data-name="<?php echo $fila['dni']; ?>" onclick="modificar(dataset.name)">Modificar</button>
                        <button type="button" class="btn btn-primary" data-name="<?php echo $fila['dni']; ?>" onclick="borrar(dataset.name)">Borrar</button></td>
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
        var parametros = {"cedula": a};
        
        $.ajax({
            url: "assets/pedircli.php",
            type: "post",
            data: parametros,
        beforeSend: function() {
            $("#resultado").html("Procesando, espere por favor...");
        },
        success: function(response) {
            $("#resultado").html("Datos recuperados");
            $data = JSON.parse(response);
            document.querySelector("#cedula").value=$data['dni'];
            document.querySelector("#nombre").value=$data['nombre'];
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
            $("#resultado").html("Error al realizar el cálculo");
        }        
        });     
    }
    function borrar(a){
        var parametros = {"cedula": a};        
        $.ajax({
            url: "assets/borrarcli.php",
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
        var cedula = parseFloat(document.getElementById('cedula').value);
        var nombre = document.getElementById('nombre').value;
        if (!isNaN(cedula)) {
            var parametros = {"dni": cedula, "nombre": nombre};
            $.ajax({
                url: "assets/modificarcli.php",
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
