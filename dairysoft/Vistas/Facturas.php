<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facturas</title>
    <style>
        .factura {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 10px;
        }
        body {
    font-family: 'Arial', sans-serif;
    background: linear-gradient(135deg, #0f9d58 0%, #0a0a0a 50%, #0f4c81 100%);
    color: #fff;
    margin: 0;
    padding: 0;
}

button {
    background: #065f3e;
    background: -webkit-linear-gradient(to right, #0a0a0a, #065f3e);
    background: linear-gradient(to right, #0a0a0a, #065f3e);
    border: none;
    color: white;
    padding: 10px 20px;
    font-size: 16px;
    cursor: pointer;
    border-radius: 5px;
    margin: 10px;
    transition: transform 0.3s ease;
}

button:hover {
    transform: scale(1.1);
}

.form-container {
    background: rgba(0, 0, 0, 0.6);
    padding: 20px;
    border-radius: 10px;
    margin: 20px 0;
}

h2 {
    color: #0f9d58;
    text-align: center;
    font-size: 24px;
    margin-bottom: 20px;
}

input[type="number"] {
    padding: 10px;
    border-radius: 5px;
    border: none;
    margin: 5px 0;
}

.factura {
    background: rgba(255, 255, 255, 0.1);
    border: 2px solid #0f9d58;
    border-radius: 10px;
    padding: 20px;
    margin: 20px 0;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.factura:hover {
    transform: translateY(-10px);
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.5);
}

.factura h2 {
    color: #fff;
    font-size: 22px;
    margin-bottom: 10px;
}

.factura p {
    color: #ddd;
    font-size: 16px;
    line-height: 1.5;
    margin: 5px 0;
}

.factura .total {
    color: #0f9d58;
    font-size: 18px;
    font-weight: bold;
    margin-top: 10px;
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
    <script>
        function toggleForm(tipo) {
            document.getElementById('formInsumos').style.display = tipo === 'insumos' ? 'block' : 'none';
            document.getElementById('formProductos').style.display = tipo === 'productos' ? 'block' : 'none';
            document.getElementById('resultados').innerHTML = '';
        }
    </script>
</head>
<body>
    <button onclick="toggleForm('insumos')">Ver Facturas de Insumos</button>
    <button onclick="toggleForm('productos')">Ver Facturas de Productos</button>

    <div id="formInsumos" class="form-container" style="display:none;">
        <h2>Filtrar Facturas de Insumos</h2>
        <form method="post">
            <label for="mesInsumos">Mes:</label>
            <input type="number" id="mesInsumos" name="mesInsumos" min="1" max="12">
            <label for="añoInsumos">Año:</label>
            <input type="number" id="añoInsumos" name="añoInsumos" min="2000" max="2100">
            <button type="submit" name="filtrarInsumos">Filtrar</button>
            <button type="submit" name="verTodosInsumos">Ver Todas las Facturas</button>
        </form>
    </div>

    <div id="formProductos" class="form-container" style="display:none;">
        <h2>Filtrar Facturas de Productos</h2>
        <form method="post">
            <label for="mesProductos">Mes:</label>
            <input type="number" id="mesProductos" name="mesProductos" min="1" max="12">
            <label for="añoProductos">Año:</label>
            <input type="number" id="añoProductos" name="añoProductos" min="2000" max="2100">
            <button type="submit" name="filtrarProductos">Filtrar</button>
            <button type="submit" name="verTodosProductos">Ver Todas las Facturas</button>

        </form>
    </div>
    

    
    <?php
    // Establecer conexión a la base de datos
    include "../Servicios/Auth/conexion.php";

    $total_general = 0;

    // Función para imprimir las facturas de insumos
    function imprimirFacturaInsumos($result) {
        global $total_general;
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="factura">';
                echo '<h2>Factura de Insumos</h2>';
                echo '<p><strong>Proveedor:</strong> ' . $row["nombreProveedor"] . '</p>';
                echo '<p><strong>Insumo:</strong> ' . $row["nombreInsumo"] . '</p>';
                echo '<p><strong>Número de Factura:</strong> ' . $row["numero_factura"] . '</p>';
                echo '<p><strong>Fecha de Factura:</strong> ' . $row["fecha_factura"] . '</p>';
                echo '<p><strong>Dirección de la Empresa:</strong> ' . $row["direccion_empresa"] . '</p>';
                echo '<p><strong>Número de Teléfono:</strong> ' . $row["numero_telefono"] . '</p>';
                echo '<p class="total">Total: ' . $row["monto_total"] . '</p>';
                echo '</div>';
                $total_general += $row["monto_total"];
            }
        } else {
            echo '<p>No se encontraron facturas de insumos.</p>';
        }
    }

    // Función para imprimir las facturas de productos
    function imprimirFacturaProductos($result) {
        global $total_general;
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $productos = json_decode($row["nombre_Producto"], true);
                $productos_formateados = '';
                
                if (is_array($productos)) {
                    foreach ($productos as $producto) {
                        $productos_formateados .= $producto['nombre'] . ' ' . $producto['cantidad'] . ' ' . strtolower($producto['unidad']) . '<br>';
                    }
                } else {
                    $productos_formateados = 'Datos de productos inválidos';
                }
                
                echo '<div class="factura">';
                echo '<h2>Factura de Productos</h2>';
                echo '<p><strong>Cliente:</strong> ' . $row["cliente"] . '</p>';
                echo '<p><strong>Producto:</strong><br>' . $productos_formateados . '</p>';
                echo '<p><strong>Número de Factura:</strong> ' . $row["numero_factura"] . '</p>';
                echo '<p><strong>Fecha de Factura:</strong> ' . $row["fecha_factura"] . '</p>';
                echo '<p><strong>Dirección de la Empresa:</strong> ' . $row["direccion_empresa"] . '</p>';
                echo '<p><strong>Número de Teléfono:</strong> ' . $row["numero"] . '</p>';
                echo '<p><strong>Total:</strong> ' . $row["total"] . '</p>';
                echo '</div>';
                $total_general += $row["total"];
            }
        } else {
            echo '<p>No se encontraron facturas de productos.</p>';
        }
    }

    // Verificar y mostrar facturas según la búsqueda
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $mes = isset($_POST["mesInsumos"]) ? $_POST["mesInsumos"] : null;
        $ano = isset($_POST["añoInsumos"]) ? $_POST["añoInsumos"] : null;

        if (isset($_POST["filtrarInsumos"])) {
            $sql_insumos = "SELECT * FROM factura_insumos WHERE MONTH(fecha_factura) = $mes AND YEAR(fecha_factura) = $ano";
            $result_insumos = $conex->query($sql_insumos);
            imprimirFacturaInsumos($result_insumos);
        } elseif (isset($_POST["verTodosInsumos"])) {
            $sql_insumos = "SELECT * FROM factura_insumos";
            $result_insumos = $conex->query($sql_insumos);
            imprimirFacturaInsumos($result_insumos);
        }

        $mes = isset($_POST["mesProductos"]) ? $_POST["mesProductos"] : null;
        $ano = isset($_POST["añoProductos"]) ? $_POST["añoProductos"] : null;

        if (isset($_POST["filtrarProductos"])) {
            $sql_productos = "SELECT * FROM factura_productos WHERE MONTH(fecha_factura) = $mes AND YEAR(fecha_factura) = $ano";
            $result_productos = $conex->query($sql_productos);
            imprimirFacturaProductos($result_productos);
        } elseif (isset($_POST["verTodosProductos"])) {
            $sql_productos = "SELECT * FROM factura_productos";
            $result_productos = $conex->query($sql_productos);
            imprimirFacturaProductos($result_productos);
        }

        // Mostrar el total general al final de todas las facturas
        echo '<div class="factura">';
        echo '<h2>Total General</h2>';
        echo '<p><strong>Total:</strong> ' . $total_general . '</p>';
        echo '</div>';
    }

    // Cerrar conexión a la base de datos
    $conex->close();
    ?>
    <button id="btnAyuda" onclick="mostrarAyuda()">Ayuda</button>
<div id="textoAyuda">
   Aqui podras ver la fecha de los prodcutos, podras eliminar un prodcuto en caso de que est vencido o proximo a vencer en caso de que este no salga de el control de existencias. o en caso se eliminara automaticamnete cuando el producto este venido.
</div>
    </div>
   

    <script>
        function mostrarAyuda() {
        alert("Facturas de los productos e insumos, podras filtrar los prodcutos segun el mes y el año");
    }
    </script>
</body>
</html>
