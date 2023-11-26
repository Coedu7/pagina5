<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Concesionario</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="styles.css">
        <style>
            .card{
                background-color: bisque;
                margin-top: 25vh;
                margin-left: 20vh;
                padding-top: 10vh;
            }
            #c2{
                margin-left: 35vh;
            }
        </style>
    </head>
    
    <body style="background-color: antiquewhite;">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        
        <div style="width: 75vh; background-color: burlywood; padding: 1vh; position: absolute; top:25%; left: 25%; ">
        <h1>Registre la reparacion</h1>
        <form id="area-form">
            <div class="mb-3">
                <label for="idcli" class="form-label">Cedula del cliente:</label>
                <input type="number" class="form-control" id="idcli" name="cedula">
            </div>
            <div class="mb-3">
                <label for="idmec" class="form-label">ID del mecanico:</label>
                <input type="number" class="form-control" id="idmec" name="cantidad">
            </div>
            <div class="mb-3">
                <label for="rep" class="form-label">Repuesto necesario:</label>
                <input type="number" class="form-control" id="rep" name="cantidad">
            </div>
            <div class="mb-3">
                <label for="placa" class="form-label">Placa del vehiculo:</label>
                <input type="text" class="form-control" id="placa" name="cantidad">
            </div>
            <div class="mb-3">
                <label for="tipo" class="form-label">Estado de la reparacion:</label>
                <select id="tipo" class="form-select" aria-label="Default select example">
                    <option selected value="1">Activo</option>
                    <option value="2">Terminado</option>
                </select>  
            </div>


            <!-- Botón para calcular -->
            <button type="button" class="btn btn-primary" id="registrar-btn">Calcular</button>
            <a href="reparacion.php">Gestión de reparaciones</a>
            <a href="clientes.php">Gestión de clientes</a>
            <a href="mecanicos.php">Gestión de mecanicos</a>
            <a href="carros.php">Gestión de carros</a>
            <a href="repuestos.php">Gestión de repuestos</a>
        </form>
        <div class="container" id="resultado">
           
        </div>
        <br>
    </div>            
      
    <!-- Script para realizar la solicitud AJAX -->
    <script>
        document.getElementById('registrar-btn').addEventListener('click', function() {
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
                url: "assets/registrarrep.php",
                type: "post",
                data: parametros,
            beforeSend: function() {
                $("#resultado").html("Procesando, espere por favor...");
            },
            success: function(response) {
                if (response!="Registro completado" && response!="Ya está este vehiculo en reparación") {
                $("#resultado").html('Alguno de los datos no existe');
            } else {
                $("#resultado").html(response);
            }
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
</html>