<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock de Productos</title>
    <style>
        /* Estilos CSS */
        body {
            font-family: Arial, sans-serif;
            background-color: black;
            color: white;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 20px auto;
        }
        .producto {
            margin-bottom: 20px;
            background-color: #333;
            padding: 20px;
            border-radius: 10px;
            cursor: pointer;
        }
        .producto:hover {
            background-color: #555;
        }
        .tabla-productos {
            display: none;
            margin-top: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        input[type="text"] {
            padding: 8px;
            margin-bottom: 10px;
            width: 100%;
            box-sizing: border-box;
        }
        .no-products {
            text-align: center;
            color: red;
        }
        /* Estilo para el botón de ayuda */
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

        /* Estilo para el texto de ayuda */
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

<div class="container">
    <h2>Stock de Productos</h2>

    <!-- Sección para Mantequilla -->
    <div class="producto" onclick="mostrarTabla('tablaProductos')">
        <h3>Productos</h3>
        <div id="tablaProductos" class="tabla-productos">
            <table>
                <tr>
                    <th>ID Producto</th>
                    <th>Nombre del Producto</th>
                    <th>Cantidad Producida</th>
                    <th>Unidad de Medida</th>
                    <th>Fecha de Producción</th>
                    <th>Fecha de Vencimiento</th>
                </tr>
                <?php
                // Establecer la conexión a la base de datos
                include('../Servicios/Auth/conexion.php');

                // Consultar los productos
                $sqlProductos = "SELECT * FROM tbl_productos";
                $resultProductos = mysqli_query($conex, $sqlProductos);

                // Si hay resultados, mostrar en la tabla
                if (mysqli_num_rows($resultProductos) > 0) {
                    while ($row = mysqli_fetch_assoc($resultProductos)) {
                        echo "<tr>
                                <td>" . $row["id_producto"] . "</td>
                                <td>" . $row["nombreProducto"] . "</td>
                                <td>" . $row["cantidadProducida"] . "</td>
                                <td>" . $row["unidadMedida"] . "</td>
                                <td>" . $row["fechaProduccion"] . "</td>
                                <td>" . $row["fechaVencimiento"] . "</td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' class='no-products'>No hay productos en stock</td></tr>";
                }
                ?>
            </table>
        </div>
    </div>
</div>

<button id="btnAyuda" onclick="mostrarAyuda()">Ayuda</button>
<div id="textoAyuda">
    Aquí podrás ver el stock disponible de los productos que se encuentran actualmente en el control de existencias. Se muestra una tabla con la información de cada producto: ID Producto, Nombre del Producto, Cantidad Producida, Unidad de Medida, Fecha de Producción y Fecha de Vencimiento.
</div>

<script>
    // Función para mostrar/ocultar la tabla de productos
    function mostrarTabla(idTabla) {
        var tabla = document.getElementById(idTabla);
        if (tabla.style.display === "none") {
            tabla.style.display = "block";
        } else {
            tabla.style.display = "none";
        }
    }

    function mostrarAyuda() {
        alert("Aquí podrás ver el stock disponible de los productos que se encuentran actualmente en el control de existencias. Se muestra una tabla con la información de cada producto: ID Producto, Nombre del Producto, Cantidad Producida, Unidad de Medida, Fecha de Producción y Fecha de Vencimiento.");
    }
</script>

</body>
</html>
