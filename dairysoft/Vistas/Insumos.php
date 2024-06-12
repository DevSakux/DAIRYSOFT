<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control de Inventario - Insumos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            background-color: #282828;
            font-family: Arial, sans-serif;
            color: #fff;
        }
        .container-fluid {
            padding-top: 50px;
        }
        .table {
            border: 2px solid #fff; /* Agregando bordes a la tabla */
            border-collapse: collapse;
            width: 100%;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 10px; /* Reducir el padding */
            text-align: left;
            border-bottom: 1px solid #dee2e6;
            color: #fff; /* Color del texto en blanco */
            font-size: 14px; /* Tamaño de fuente más pequeño */
        }
        th {
            background-color: #007bff;
            font-weight: bold;
            text-transform: uppercase;
        }
        tr:hover {
            background-color: #8bc34a; /* Cambiado el color de fondo al pasar el mouse */
        }

        .btn {
            padding: 5px 10px; /* Reducir el tamaño de los botones */
            font-size: 12px; /* Reducir el tamaño de fuente de los botones */
            transition: all 0.3s ease;
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
        .btn-danger, .btn-success {
            padding: 5px 10px; /* Ajustar el tamaño de los botones Eliminar y Actualizar */
            background-color: #dc3545; /* Color del botón Eliminar */
            border-color: #dc3545;
            color: #fff;
            margin-right: 5px; /* Espacio entre los botones */
            width: 80px; /* Ancho fijo */
        }
        .btn-success {
            background-color: #28a745; /* Color del botón Actualizar */
            border-color: #28a745;
        }
        .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }
        .btn-success:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }
        .mb-4 {
            margin-bottom: 0; /* Ajuste para eliminar el margen inferior */
        }
        .btn-success {
            background-color: #28a745; /* Color del botón Actualizar */
            border-color: #28a745;
            margin-bottom: 5px; /* Agregar espacio entre los botones */
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <h1 class="text-center mb-4">Lista de Insumos</h1>
    <div class="mb-4">
        <div class="row">
            <div class="col-md-6">
                <h3 style="display: inline-block;">Agregar Insumo:</h3>
                <a class="btn btn-success ml-2" href="registrarinsumo.php">Agregar</a>
            </div>
            <div class="col-md-10">
                <h3 style="display: inline-block;">Consultar por nombre:</h3>
                <form action="" method="post" style="display: inline-block;">
                    <div class="input-group">
                        <input type="text" name="nombre" class="form-control" placeholder="Nombre del insumo">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary">Filtrar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class='table'>
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Cantidad</th>
                    <th>Unidad</th>
                    <th>Precio</th>
                    <th>Fecha de Compra</th>
                    <th>Fecha de Lote</th>
                    <th>Fecha de Vencimiento</th>
                    <th>Ubicación</th>
                    <th>Categoría</th>
                    <th>Descripción</th>
                    <th>Proveedor</th>
                    <th>Contacto del Proveedor</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Incluir el archivo de conexión
                require_once('../Servicios/Auth/conexion.php');

                // Query para obtener los datos de los insumos
                $query = "SELECT * FROM tbl_insumos";
                
                // Si se envió un nombre para filtrar
                if(isset($_POST['nombre']) && !empty($_POST['nombre'])){
                    $nombre = $_POST['nombre'];
                    $query .= " WHERE nombre LIKE '%$nombre%'";
                }

                $result = mysqli_query($conex, $query);

                // Verificar si hay datos
                if (mysqli_num_rows($result) > 0) {
                    // Iterar sobre los resultados y mostrarlos en la tabla
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['codigo'] . "</td>"; // Nueva columna para el código
                        echo "<td>" . $row['nombre'] . "</td>";
                        echo "<td>" . $row['cantidad'] . "</td>";
                        echo "<td>" . $row['unidad'] . "</td>";
                        echo "<td>$" . $row['precio'] . "</td>";
                        echo "<td>" . $row['fecha_compra'] . "</td>";
                        echo "<td>" . $row['fecha_lote'] . "</td>";
                        echo "<td>" . $row['fecha_vencimiento'] . "</td>";
                        echo "<td>" . $row['ubicacion'] . "</td>";
                        echo "<td>" . $row['categoria'] . "</td>";
                        echo "<td>" . $row['descripcion'] . "</td>";
                        echo "<td>" . $row['proveedor_nombre'] . "</td>";
                        echo "<td>" . $row['proveedor_contacto'] . "</td>";
                        echo "<td class='text-center'>
                        <a class='btn btn-success mr-1' href='actualizarinsumo.php?id=" . $row['codigo'] . "'>Actualizar</a>
                        
                        <a class='btn btn-danger' href='Eliminarinsumo.php?id=" . $row['codigo'] . "' onclick='return confirmDelete()'>Eliminar</a>
                        </td>"; 
                        echo "</tr>";
                    }
                } else {
                    // Si no hay datos, mostrar un mensaje
                    echo "<tr><td colspan='14'>No hay insumos disponibles.</td></tr>";
                }
                // Liberar el resultado
                mysqli_free_result($result);
                
                // Cerrar la conexión
                mysqli_close($conex);
                ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>

