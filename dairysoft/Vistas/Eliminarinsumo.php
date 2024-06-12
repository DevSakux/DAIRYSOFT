<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Insumo</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            background-color: #282828;
            font-family: Arial, sans-serif;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .form-container {
            border: 2px solid green;
            border-radius: 10px;
            padding: 20px;
            width: 90%;
            max-width: 600px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
        }
        input[type="text"], select {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ced4da;
            background-color: #fff;
            color: #495057;
        }
        .btn {
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            color: #fff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
            color: #fff;
        }
        .btn-danger:hover {
            background-color:  #c82333;
            border-color: #bd2130;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1 class="text-center mb-4">Eliminar Insumo</h1>
        <?php
        // Verificar si se ha enviado un ID para eliminar
        if(isset($_GET['id']) && !empty($_GET['id'])) {
            // Incluir el archivo de conexión
            require_once('../Servicios/Auth/conexion.php');

            // Sanitizar el ID del insumo a eliminar
            $id = mysqli_real_escape_string($conex, $_GET['id']);

            // Consultar la base de datos para obtener el insumo a eliminar
            $query = "SELECT * FROM tbl_insumos WHERE codigo = '$id'";
            $result = mysqli_query($conex, $query);

            if(mysqli_num_rows($result) === 1) {
                // El insumo existe, mostrar los detalles para confirmar la eliminación
                $row = mysqli_fetch_assoc($result);
                ?>
                <form action="../Controladores/EliminarInsumoController.php" method="post">
                    <div class="form-group">
                        <label for="nombre">Codigo del insumo:</label>
                        <input type="text" id="nombre" codigo="codigo" value="<?php echo htmlspecialchars($row['codigo']); ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="nombre">Nombre del Insumo:</label>
                        <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($row['nombre']); ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="cantidad">Cantidad:</label>
                        <input type="text" id="cantidad" name="cantidad" value="<?php echo htmlspecialchars($row['cantidad']); ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="unidad">Unidad:</label>
                        <input type="text" id="unidad" name="unidad" value="<?php echo htmlspecialchars($row['unidad']); ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="unidad">Proveedor:</label>
                        <input type="text" id="unidad" name="unidad" value="<?php echo htmlspecialchars($row['proveedor_nombre']); ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="unidad">Contacto del proveedor:</label>
                        <input type="text" id="unidad" name="unidad" value="<?php echo htmlspecialchars($row['proveedor_contacto']); ?>" readonly>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                        <a href="insumos.php" class="btn btn-primary">Cancelar</a>
                    </div>
                </form>
                <?php
            } else {
                // El insumo no existe
                echo "<p>No se encontró el insumo a eliminar.</p>";
            }

            // Liberar el resultado y cerrar la conexión
            mysqli_free_result($result);
            mysqli_close($conex);
        } else {
            // Si no se proporcionó un ID, mostrar un mensaje de error
            echo "<p>No se proporcionó un ID de insumo válido.</p>";
        }
        ?>
    </div>
</body>
</html>
