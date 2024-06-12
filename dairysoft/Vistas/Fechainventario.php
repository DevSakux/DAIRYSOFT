<?php
// Establecer la conexión a la base de datos
include('../Servicios/Auth/conexion.php');

// Manejo de la eliminación del producto
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = $_GET['id'];

    // Consulta SQL para eliminar el producto con el ID proporcionado
    $sql = "DELETE FROM productos WHERE id = $id";
    if ($conex && mysqli_query($conex, $sql)) {
        // Devolver un mensaje de éxito a través de la respuesta HTTP
        echo "Producto eliminado exitosamente";
    } else {
        // Devolver un mensaje de error a través de la respuesta HTTP
        http_response_code(500);
        echo "Error al eliminar el producto: " . mysqli_error($conex);
    }
    // Detener la ejecución del resto del código PHP después de eliminar el producto
    exit();
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <style>
        /* Estilos CSS */
        body {
            font-family: Arial, sans-serif;
            background-color: #222;
            color: white;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 20px auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #666;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #333;
        }
        tr:nth-child(even) {
            background-color: #444;
        }
        tr:hover {
            background-color: #555;
        }
        .search-container {
            margin-bottom: 20px;
        }
        .search-container input[type=text] {
            padding: 10px;
            margin-right: 10px;
            border: none;
            border-radius: 5px;
        }
        .search-container button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            background-color: #007bff;
            color: white;
        }
        .filter-container {
            margin-bottom: 20px;
        }
        .filter-container label {
            margin-right: 10px;
        }
        .alert {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        .alert-danger {
            background-color: #dc3545;
        }
        .alert-success {
            background-color: #28a745;
        }
        /* Animación para el cambio de color del estado */
.estado {
    transition: background-color 0.5s ease;
}

/* Estilos para los diferentes estados */
.en-stock {
    background-color: green;
    color: white;
}

.proximo-a-vencer {
    background-color: orange;
    color: white;
}

.vencido {
    background-color: red;
    color: white;
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
.delete-button {
    background-color: red;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    padding: 5px 10px;
}
#deleteButtonContainer {
    text-align: right;
}
     
    </style>
</head>
<body>
<div class="container">
    <h1>Productos</h1>

    <div id="deleteButtonContainer">
        <button id="deleteButton" class="delete-button" onclick="deleteSelectedProducts()">Eliminar Productos</button>
    </div>

    <table id="productTable">
        <thead>
            <tr>
                <th>Nombre del Producto</th>
                <th>Cantidad Producida</th>
                <th>Unidad de Medida</th>
                <th>Fecha de Producción</th>
                <th>Fecha de Vencimiento</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Conexión a la base de datos
            include('../Servicios/Auth/conexion.php');

            // Verificar conexión
            if (mysqli_connect_errno()) {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
                exit();
            }

            // Consulta SQL para obtener los productos
            $sql = "SELECT * FROM tbl_productos";
            $result = mysqli_query($conex, $sql);

            // Mostrar los datos de los productos
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr id='id_producto" . $row['id_producto'] . "'>";
                echo "<td>" . $row['nombreProducto'] . "</td>";
                echo "<td>" . $row['cantidadProducida'] . "</td>";
                echo "<td>" . $row['unidadMedida'] . "</td>";
                echo "<td>" . $row['fechaProduccion'] . "</td>";
                echo "<td>" . $row['fechaVencimiento'] . "</td>";

                // Calcular el estado del producto
                $expiryDate = strtotime($row['fechaVencimiento']);
                $daysLeft = floor(($expiryDate - time()) / (60 * 60 * 24));

                if ($daysLeft > 7) {
                    echo "<td class='estado en-stock'>En stock</td>";
                } elseif ($daysLeft > 0) {
                    echo "<td class='estado proximo-a-vencer'>Próximo a vencer ($daysLeft días)</td>";
                } elseif ($daysLeft == 0) {
                    echo "<td class='estado proximo-a-vencer'>Hoy es el último día</td>";
                } else {
                    echo "<td class='estado vencido'>Vencido</td>";
                }

                echo "<td><input type='checkbox' name='selectedProducts[]' value='" . $row['id_producto'] . "'></td>";

                echo "</tr>";
            }
            ?>
       </tbody>
    </table>

    <div id="alert" class="alert" style="display: none;"></div>
    <button id="btnAyuda" onclick="mostrarAyuda()">Ayuda</button>
<div id="textoAyuda">
   Aqui podras ver la fecha de los prodcutos, podras eliminar un prodcuto en caso de que est vencido o proximo a vencer en caso de que este no salga de el control de existencias. o en caso se eliminara automaticamnete cuando el producto este venido.
</div>
    
</div>
<script>
    // Manejar la respuesta del servidor al intentar eliminar un producto
    function handleDeleteResponse(response) {
        var alertElement = document.getElementById('alert');
        var message = response.replace(/<\/?[^>]+(>|$)/g, ""); // Eliminar contenido HTML de la respuesta
        if (message === 'Producto(s) eliminado(s) exitosamente') {
            alertElement.innerText = message;
            alertElement.className = 'alert alert-success';
            alertElement.style.display = 'block';
        } else {
            alert(message); // Mostrar mensaje de error en la consola del navegador
        }
    }

    function deleteSelectedProducts() {
        var selectedProducts = document.getElementsByName('selectedProducts[]');
        var productsToDelete = [];
        for (var i = 0; i < selectedProducts.length; i++) {
            if (selectedProducts[i].checked) {
                productsToDelete.push(selectedProducts[i].value);
            }
        }
        if (productsToDelete.length === 0) {
            alert('Por favor, selecciona al menos un producto para eliminar.');
        } else {
            if (confirm("¿Estás seguro de que deseas eliminar los productos seleccionados?")) {
                // Realizar una solicitud AJAX para eliminar los productos de la base de datos
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        handleDeleteResponse(this.responseText);
                        // Eliminar las filas de la tabla en la interfaz de usuario
                        productsToDelete.forEach(function(id) {
                            var row = document.getElementById("productTable").rows.namedItem("product_" + id);
                            row.parentNode.removeChild(row);
                        });
                    }
                };
                xhttp.open("GET", "<?php echo $_SERVER['PHP_SELF']; ?>?action=delete&id=" + productsToDelete.join(','), true);
                xhttp.send();
            }
        }
    }

    function mostrarAyuda() {
        alert(" Aqui podras ver la fecha de los prodcutos, podras eliminar un prodcuto en caso de que est vencido o proximo a vencer en caso de que este no salga de el control de existencias. o en caso se eliminara automaticamnete cuando el producto este venido.");
    }
</script>

</body>
</html>
