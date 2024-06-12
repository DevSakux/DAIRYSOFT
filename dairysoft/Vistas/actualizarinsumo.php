<?php
// Incluir el archivo de conexión
require_once('../Servicios/Auth/conexion.php');

// Verificar si se proporcionó un ID de insumo en la URL
if(isset($_GET['id']) && !empty($_GET['id'])) {
    // Obtener y escapar el ID del insumo desde la URL
    $id_insumo = mysqli_real_escape_string($conex, $_GET['id']);

    // Query para obtener los datos del insumo con el ID proporcionado
    $query = "SELECT * FROM tbl_insumos WHERE codigo = '$id_insumo'";

    // Ejecutar la consulta
    $result = mysqli_query($conex, $query);

    // Verificar si la consulta se ejecutó correctamente
    if($result) {
        // Verificar si se encontró el insumo
        if(mysqli_num_rows($result) == 1) {
            // Obtener los datos del insumo
            $row = mysqli_fetch_assoc($result);
            $nombre = $row['nombre'];
            $cantidad = $row['cantidad'];
            $unidad = $row['unidad'];
            $ubicacion = $row['ubicacion'];
            $descripcion = $row['descripcion'];
            $proveedor = $row['proveedor_nombre'];
            $contacto_proveedor = $row['proveedor_contacto'];

            // Liberar el resultado
            mysqli_free_result($result);
        } else {
            // Si no se encontró el insumo, redireccionar a la página de insumos con un mensaje de error
            header("Location: insumos.php?error=no_insumo_found");
            exit();
        }
    } else {
        // Si la consulta no se ejecutó correctamente, mostrar un mensaje de error
        echo "Error al ejecutar la consulta: " . mysqli_error($conex);
    }
} else {
    // Si no se proporcionó un ID de insumo en la URL, redireccionar a la página de insumos con un mensaje de error
    header("Location: insumos.php?error=no_id_provided");
    exit();
}

// Cerrar la conexión
mysqli_close($conex);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Insumo</title>
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
            background-color: #c82333;
            border-color: #bd2130;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1 class="text-center mb-4">Actualizar Insumo</h1>
        <form action="../Controladores/ActualizarInsumosController.php?id=<?php echo htmlspecialchars($id_insumo); ?>" method="post">
            <div class="form-group">
                <label for="nombre">Nombre del Insumo:</label>
                <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($nombre); ?>" pattern="[A-Za-z\s]+" title="Ingrese solo letras y espacios">
            </div>
            <div class="form-group">
                <label for="cantidad">Cantidad:</label>
                <input type="text" id="cantidad" name="cantidad" value="<?php echo htmlspecialchars($cantidad); ?>" pattern="[0-9]+" title="Ingrese solo números">
            </div>
            <div class="form-group">
                <label for="unidad">Unidad:</label>
                <select class="form-control" id="unidad" name="unidad" required>
                    <option value="" disabled>Seleccionar</option>
                    <option value="unidades" <?php if($unidad == 'unidades') echo 'selected'; ?>>Unidades</option>
                    <option value="litros" <?php if($unidad == 'litros') echo 'selected'; ?>>Litros</option>
                    <option value="kilogramos" <?php if($unidad == 'kilogramos') echo 'selected'; ?>>Kilogramos</option>
                    <option value="gramos" <?php if($unidad == 'gramos') echo 'selected'; ?>>Gramos</option>
                    <option value="mililitros" <?php if($unidad == 'mililitros') echo 'selected'; ?>>Mililitros</option>
                </select>
            </div>
            <div class="form-group">
                <label for="ubicacion">Ubicación:</label>
                <input type="text" id="ubicacion" name="ubicacion" value="<?php echo htmlspecialchars($ubicacion); ?>">
            </div>
            <div class="form-group">
                <label for="descripcion">Descripción:</label>
                <input type="text" id="descripcion" name="descripcion" value="<?php echo htmlspecialchars($descripcion); ?>">
            </div>
            <div class="form-group">
                <label for="proveedor">Proveedor:</label>
                <input type="text" id="proveedor" name="proveedor" value="<?php echo htmlspecialchars($proveedor); ?>">
            </div>
            <div class="form-group">
                <label for="contacto_proveedor">Contacto del Proveedor:</label>
                <input type="text" id="contacto_proveedor" name="contacto_proveedor" value="<?php echo htmlspecialchars($contacto_proveedor); ?>" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" title="Ingrese un correo válido o un número de teléfono">
            </div>
            <!-- Agrega más campos aquí para los otros atributos del insumo -->
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Actualizar</button>
                <a href="insumos.php" class="btn btn-danger">Cancelar</a>
            </div>
        </form>
    </div>
</body>
</html>

