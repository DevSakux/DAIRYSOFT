<?php
// Conexión a la base de datos
include('../Servicios/Auth/conexion.php');

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // Recoger los datos del formulario de la factura
  $cliente = isset($_POST["cliente"]) ? $_POST["cliente"] : "";
  $fechaFactura = isset($_POST["fecha_factura"]) ? $_POST["fecha_factura"] : "";
  $numeroFactura = isset($_POST["numero_factura"]) ? $_POST["numero_factura"] : "";
  $direccionEmpresa = isset($_POST["direccion_empresa"]) ? $_POST["direccion_empresa"] : "";
  $numero = isset($_POST["numero"]) ? $_POST["numero"] : "";
  $total = isset($_POST["total"]) ? $_POST["total"] : "";

  // Recoger los productos seleccionados y sus cantidades vendidas
  $productosSeleccionados = isset($_POST["producto"]) ? $_POST["producto"] : [];
  $cantidadesVendidas = isset($_POST["cantidades"]) ? $_POST["cantidades"] : [];
  $unidadesMedida = isset($_POST["unidad_medida"]) ? $_POST["unidad_medida"] : [];

  // Preparar el array para el campo productos
  $productos = [];

  if (is_array($productosSeleccionados) && is_array($cantidadesVendidas) && is_array($unidadesMedida)) {
    foreach ($productosSeleccionados as $index => $productoSeleccionado) {
      $cantidadSalida = isset($cantidadesVendidas[$index]) ? $cantidadesVendidas[$index] : 0;
      $unidadMedida = isset($unidadesMedida[$index]) ? $unidadesMedida[$index] : "";
      $productos[] = [
        "nombre" => $productoSeleccionado,
        "cantidad" => $cantidadSalida,
        "unidad" => $unidadMedida
      ];
    }
  }

  // Convertir el array de productos a JSON
  $productosJson = json_encode($productos);

  // Insertar datos en la tabla tbl_facturas
  $sqlFacturaProductos = "INSERT INTO tbl_facturas (cliente, fecha_factura, numero_factura, direccion_empresa, numero_telefono, total, tipo) VALUES ('$cliente', '$fechaFactura', '$numeroFactura', '$direccionEmpresa', '$numero', '$total', 'productos')";
  $resultFacturaProductos = mysqli_query($conex, $sqlFacturaProductos);

  if (!$resultFacturaProductos) {
    die("Error al registrar factura para el cliente ".$cliente.": " . mysqli_error($conex));
  }

  // Cerrar la conexión
  mysqli_close($conex);

  echo "Registro exitoso.";
}
?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Salida</title>
    <style>
/* Estilos generales */
body {
    font-family: 'Arial', sans-serif;
    background-color: #121212;
    color: #ffffff;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    overflow: hidden;
}

.container {
    background-color: #1f1f1f;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 20px rgba(0, 255, 128, 0.5);
    animation: fadeIn 1s ease-in-out;
    width: 100%;
    max-width: 900px;
    max-height: 100vh;
    overflow-y: auto;
    overflow-x: hidden;
    margin: 20px;
}

h2 {
    color: #00ff80;
    font-size: 28px;
    text-align: center;
    margin-bottom: 20px;
}

form {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

/* Estilos de la tabla */
table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
    color: #ffffff;
}

th, td {
    padding: 12px;
    border: 1px solid #00ff80;
    text-align: center;
}

th {
    background-color: #333333;
    color: #00ff80;
    position: sticky;
    top: 0;
}

td select, td input {
    width: 100%;
    padding: 8px;
    border: 1px solid #00ff80;
    border-radius: 4px;
    box-sizing: border-box;
    background-color: #2b2b2b;
    color: #ffffff;
}



td input[type="number"]::-webkit-outer-spin-button,
td input[type="number"]::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
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

/* Estilo para el botón de ayuda */
#btnAyuda {
    position: fixed;
    bottom: 20px;
    right: 20px;
    background-color: blue; /* Cambia el color a azul */
    color: white;
    padding: 10px 20px;
    border-radius: 5px;
    border: none;
    cursor: pointer;
    z-index: 9999; /* Asegura que esté por encima de otros elementos */
}

/* Estilo para el botón de eliminar */
.delete-button {
    background-color: red;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    padding: 5px 10px;
}

/* Estilo para el contenedor del botón de eliminar */
#deleteButtonContainer {
    text-align: right;
}
/*Botones de agregar o eliminar prodcuto  */
button { 
    display: relative;
    justify-content: space-between;
    gap: 10px;
}

button {
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.3s ease;
    background-color: #00ff80;
    color: #1f1f1f;
}

button[type="submit"] {
    background-color: #00ff80;
    color: #1f1f1f;
}

button[type="button"] {
    background-color: #007bff;
    color: #ffffff;
}

button:hover {
    background-color: #00cc66;
}


/* Estilos para las entradas de texto */
input[type="text"], input[type="date"], input[type="number"], input[type="submit"] {
    padding: 10px;
    border: 1px solid #00ff80;
    border-radius: 4px;
    box-sizing: border-box;
    width: 100%;
    background-color: #2b2b2b;
    color: #ffffff;
}

input[type="text"]:focus, input[type="date"]:focus, input[type="number"]:focus, select:focus {
    outline: none;
    border-color: #00ff80;
    box-shadow: 0 0 5px rgba(0, 255, 128, 0.5);
}

input[type="submit"] {
    background-color: #00ff80;
    color: #1f1f1f;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

input[type="submit"]:hover {
    background-color: #00cc66;
}

label {
    font-weight: bold;
    color: #00ff80;
}


/* Animaciones */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}


    </style>
</head>
<body>

<div class="container">
    <h2>Registro de Salida</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" onsubmit="return validarFormulario()">
        <table class="factura">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody class="producto">
                <tr class="producto">
                    <td>
                        <select name="producto[]" required>
                            <option value=""></option>
                            <option value="Mantequilla">Mantequilla</option>
                            <option value="Queso">Queso</option>
                            <option value="Yogurt">Yogurt</option>
                            <option value="Crema de leche">Crema de leche</option>
                        </select>
                    </td>
                    <td>
                        <div class="campo">
                            <input type="text" name="cantidades[]" placeholder="Cantidad" required>
                            <select name="unidad_medida[]" required>
                                <option value="Libras">Libras</option>
                                <option value="Unidades">Unidades</option>
                            </select>
                        </div>
                    </td>
                    <td><input type="number" name="precios[]" placeholder="Precio" step="0.01" required oninput="calcularTotal()"></td>
                    <td><input type="date" name="fechas_venta[]" required></td>
                </tr>
            </tbody>
        </table>
        <div class="botones">
            <button type="button" onclick="agregarProducto()">Añadir producto</button>
            <button type="button" onclick="eliminarProducto()">Eliminar producto</button>
        </div>
        <label for="fecha_factura">Fecha de Factura:</label>
        <input type="date" id="fecha_factura" name="fecha_factura" required>

        <label for="cliente">Cliente:</label>
        <input type="text" id="cliente" name="cliente" required>

        <label for="numero_factura">Num. Factura (máximo 15 dígitos):</label>
        <input type="text" id="numero_factura" name="numero_factura" maxlength="15" required>

        <label for="direccion_empresa">Dirección Empresa:</label>
        <input type="text" id="direccion_empresa" name="direccion_empresa" required>

        <label for="numero">Número Celular (máximo 10 dígitos):</label>
        <input type="text" id="numero" name="numero" maxlength="10" required>

        <label for="total">Total:</label>
        <input type="text" id="total" name="total" readonly required>

        <input type="submit" value="Registrar Salida">
        
    </form>
    <div id="alert" class="alert" style="display: none;"></div>
    <button id="btnAyuda" onclick="mostrarAyuda()">Ayuda</button>
<div id="textoAyuda">
    
</div>
   
<script>
    let productoCount = 1;

    function agregarProducto() {
        if (productoCount >= 4) {
            alert("Solo se pueden agregar hasta 4 productos.");
            return;
        }
        productoCount++;

        const productosTable = document.querySelector('tbody.producto');
        const nuevoProducto = `
            <tr class="producto">
                <td>
                    <select name="producto[]" required onchange="validarProductoRepetido(this)">
                        <option value=""></option>
                        <option value="Mantequilla">Mantequilla</option>
                        <option value="Queso">Queso</option>
                        <option value="Yogurt">Yogurt</option>
                        <option value="Crema de leche">Crema de leche</option>
                    </select>
                </td>
                <td>
                    <div class="campo">
                        <input type="text" name="cantidades[]" placeholder="Cantidad" required>
                        <select name="unidad_medida[]" required>
                            <option value="Libras">Libras</option>
                            <option value="Unidades">Unidades</option>
                        </select>
                    </div>
                </td>
                <td><input type="number" name="precios[]" placeholder="Precio" step="0.01" required oninput="calcularTotal()"></td>
                <td><input type="date" name="fechas_venta[]" required></td>
            </tr>
        `;
        productosTable.insertAdjacentHTML('beforeend', nuevoProducto);
    }

    function eliminarProducto() {
        const productos = document.querySelectorAll('.producto');
        if (productos.length > 1) {
            productos[productos.length - 1].remove();
            productoCount--;
        }
    }

    function calcularTotal() {
        const precios = document.querySelectorAll('input[name="precios[]"]');
        let total = 0;

        precios.forEach(precio => {
            total += parseFloat(precio.value) || 0;
        });

        const iva = total * 0.19;
        const totalConIva = total + iva;

        document.getElementById('total').value = totalConIva.toFixed(2);
    }

    function mostrarAyuda() {
        alert("Registrar salida prodcutos con su respectiva factura, el producto debe estar en stock para su salida exitosa.");
    
    }

    function validarProductoRepetido(selectElement) {
        const productos = document.querySelectorAll('select[name="producto[]"]');
        const selectedValues = [];
        let mensajeError = '';

        productos.forEach((producto, index) => {
            if (selectedValues.includes(producto.value)) {
                mensajeError = `El producto "${producto.value}" ya ha sido seleccionado.`;
                producto.value = '';
            }
            selectedValues.push(producto.value);
        });

        if (mensajeError) {
            alert(mensajeError);
        }
    }

    function validarFormulario() {
        const productos = document.querySelectorAll('select[name="producto[]"]');
        const selectedValues = [];

        for (let producto of productos) {
            if (selectedValues.includes(producto.value)) {
                alert(`El producto "${producto.value}" ya ha sido seleccionado.`);
                return false;
            }
            selectedValues.push(producto.value);
        }
        return true;
    }
</script>

</div>
</div>
</body>
</html>