

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,
initial-scale=1.0">
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

<!-- Formulario para ingresar altura y base -->
    <div style="width: 75vh; background-color: burlywood; padding: 1vh; position: absolute; top:25%; left: 25%; ">
        <h1>Registro de carro</h1>
        <form id="area-form">
            <div class="mb-3">
                <label for="placa" class="form-label">Placa:</label>
                <input type="text" class="form-control" id="placa" name="placa">
            </div>
            <div class="mb-3">
                <label for="modelo" class="form-label">Modelo:</label>
                <input type="text" class="form-control" id="modelo" name="modelo">
            </div>
            <div class="mb-3">
            <label for="tipo" class="form-label">Clasificación:</label>
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
            <button type="button" class="btn btn-primary" id="registrar-btn">Calcular</button>
            <a href="index.php">Registro de reparacion</a>
            <a href="carros.php">Gestionar carros</a>
        </form>
        
        <!-- Contenedor para mostrar los registros -->
        <div class="container" id="resultado">
           
        </div>
    </div>
    <!-- Contenedor para mostrar el resultado -->





<!-- Script para realizar la solicitud AJAX -->
<script>
    document.getElementById('registrar-btn').addEventListener('click', function() {
    var placa = document.getElementById('placa').value;
    var modelo = document.getElementById('modelo').value;
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
    var marca = document.getElementById('marca').value;
    var año = parseFloat(document.getElementById('año').value);
    if (placa!=null && modelo!=null && tipo!=null && marca!=null && año!=null) {
        var parametros = {"placa": placa, "modelo": modelo, "tipo": tipo, "img": img, "marca": marca, "año":año};
        $.ajax({
            url: "assets/registrarcar.php",
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
});
</script>



</body>
</html