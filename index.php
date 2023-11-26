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
    
    <body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <div id="pagina">
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
            <div class="dropdown mb-3">
                <label for="tipo" class="form-label">Estado de la reparacion:</label>
                <br>
                <button class="btn btn-secondary dropdown-toggle" id="tipo" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Estado de la reparacion
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Activo</a></li>
                    <li><a class="dropdown-item" href="#">Terminado</a></li>
                </ul>
            </div>


            <!-- Botón para calcular -->
            <button type="button" class="btn btn-primary" id="calcular-btn">Calcular</button>
            <a href="clientes.php">Gestión de clientes</a>
            <a href="mecanicos.php">Gestión de mecanicos</a>
            <a href="carros.php">Gestión de carros</a>
            <a href="repuestos.php">Gestión de repuestos</a>
        </form>
        <br>
    </div>            
        </div>        

        


        
    </body>
</html>