<?php
include "../Servicios/Auth/seguridad.php";
include "../Servicios/Auth/conexion.php";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos e Insumos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #222, #005000);
            color: #fff;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #333;
            border-radius: 10px;
        }

        .section {
            cursor: pointer;
            margin-bottom: 20px;
            padding: 10px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .section:hover {
            background-color: #444;
        }

        .tabla {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .tabla th, .tabla td {
            padding: 8px;
            border-bottom: 1px solid #666;
        }

        .tabla th {
            background-color: #007bff;
            color: #fff;
        }

        .tabla tr:nth-child(even) {
            background-color: #555;
        }

        .tabla tr:hover {
            background-color: #666;
        }

        .tabla td {
            text-align: center;
        }

        #productos, #insumos {
            display: none;
            padding-top: 10px;
            padding-bottom: 10px;
        }

        #btnAyuda {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: blue;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
        }

        #textoAyuda {
            position: fixed;
            bottom: 50px;
            right: 20px;
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 10px;
            border-radius: 5px;
            display: none;
        }
    </style>
</head>
<body>
    <h1 style="text-align: center;">Productos e Insumos</h1>

    <div class="container">
        <div class="section productos" onclick="toggleProductos()">
            <h2>Productos</h2>
            <div id="productos" style="display: none;">
                <!-- Contenido de productos aquí -->
                <?php
                // Consulta SQL para obtener los datos de la tabla de productos
                $sql_productos = "SELECT nombreProducto, cantidadProducida, unidadMedida, fechaProduccion, fechaVencimiento FROM tbl_productos ORDER BY nombreProducto DESC";
                $result_productos = $conex->query($sql_productos);

                // Verificar si hay resultados
                if ($result_productos->num_rows > 0) {
                    // Mostrar los datos en una tabla
                    echo "<table class='tabla'>
                            <tr>
                                <th>Nombre del Producto</th>
                                <th>Cantidad Producida</th>
                                <th>Unidad de Medida</th>
                                <th>Fecha de Producción</th>
                                <th>Fecha de Vencimiento</th>
                            </tr>";
                    while ($row = $result_productos->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row["nombreProducto"] . "</td>
                                <td>" . $row["cantidadProducida"] . "</td>
                                <td>" . $row["unidadMedida"] . "</td>
                                <td>" . $row["fechaProduccion"] . "</td>
                                <td>" . $row["fechaVencimiento"] . "</td>
                            </tr>";
                    }
                    echo "</table>";
                } else {
                    echo "No hay datos de productos disponibles";
                }
                ?>
            </div>
        </div>

        <div class="section insumos" onclick="toggleInsumos()">
            <h2>Insumos</h2>
            <div id="insumos" style="display: none;">
                <!-- Contenido de insumos aquí -->
                <?php
                // Consulta SQL para obtener los datos de la tabla de insumos
                $sql_insumos = "SELECT nombreProducto, cantidad, unidadMedida, fechaIngreso, fechaVencimiento FROM tbl_insumos";
                $result_insumos = $conex->query($sql_insumos);

                // Verificar si hay resultados
                if ($result_insumos->num_rows > 0) {
                    // Mostrar los datos en una tabla
                    echo "<table class='tabla'>
                            <tr>
                                <th>Nombre del Producto</th>
                                <th>Cantidad</th>
                                <th>Unidad de Medida</th>
                                <th>Fecha de Ingreso</th>
                                <th>Fecha de Vencimiento</th>
                            </tr>";
                    while ($row = $result_insumos->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row["nombreProducto"] . "</td>
                                <td>" . $row["cantidad"] . "</td>
                                <td>" . $row["unidadMedida"] . "</td>
                                <td>" . $row["fechaIngreso"] . "</td>
                                <td>" . $row["fechaVencimiento"] . "</td>
                            </tr>";
                    }
                    echo "</table>";
                } else {
                    echo "No hay datos de insumos disponibles";
                }
                ?>
            </div>
        </div>
    </div>

    <button id="btnAyuda" onclick="mostrarAyuda()">Ayuda</button>

    <div id="textoAyuda">
        Esta página es un formulario para registrar productos. Cada sección corresponde a un tipo de producto, como mantequilla, queso, crema de leche y yogurt. Puedes hacer clic en 'Agregar Producto' en cada sección para desplegar un formulario y registrar la cantidad producida, las fechas de producción y vencimiento, así como la unidad de medida del producto.
    </div>

    <script>
        function toggleProductos() {
            var productos = document.getElementById("productos");
            productos.style.display = productos.style.display === "block" ? "none" : "block";
        }

        function toggleInsumos() {
            var insumos = document.getElementById("insumos");
            insumos.style.display = insumos.style.display === "block" ? "none" : "block";
        }

        function mostrarAyuda() {
            alert("Control de calidad donde puedes tener un registro de los productos e insumo que hay o pueden pasar por el control de existencias durante este período.");
}
</script>

</body>
</html>
