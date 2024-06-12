<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Productos</title>
    <style>
        body {
            background-color: #222;
            color: white;
            font-family: Arial, sans-serif;
        }
        .producto {
            margin-bottom: 20px;
            background-color: #333;
            padding: 20px;
            border-radius: 10px;
            transition: background-color 0.3s;
        }
        .producto:hover {
            background-color: #555;
        }
        .agregar {
            cursor: pointer;
            color: white;
            background-color: blue;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s;
            display: inline-block;
        }
        .agregar:hover {
            background-color: darkblue;
        }
        .formulario {
            display: none;
            margin-top: 10px;
        }
        label {
            display: block;
            margin-bottom: 10px;
        }
        input[type="date"],
        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            background-color: #444;
            color: white;
            outline: none;
        }
        input[type="submit"] {
            background-color: blue;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: darkblue;
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

<h2>Formulario de Productos</h2>

<?php
// Establecer la conexión a la base de datos
include('../Servicios/Auth/conexion.php');

// Procesamiento del formulario para agregar o actualizar productos
$mensaje = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombreProducto = $_POST["nombreProducto"];
    $cantidadProducida = $_POST["cantidadProducida"];
    $unidadMedida = $_POST["unidadMedida"];
    $fechaProduccion = $_POST["fechaProduccion"];
    $fechaVencimiento = $_POST["fechaVencimiento"];

    // Verificar si el producto ya existe en la tabla
    $sql_exist = "SELECT * FROM tbl_productos WHERE nombreProducto='$nombreProducto'";
    $result_exist = mysqli_query($conex, $sql_exist);

    if (mysqli_num_rows($result_exist) > 0) {
        // Si el producto existe, actualiza los datos
        $sql_update = "UPDATE tbl_productos SET cantidadProducida='$cantidadProducida', unidadMedida='$unidadMedida', fechaProduccion='$fechaProduccion', fechaVencimiento='$fechaVencimiento' WHERE nombreProducto='$nombreProducto'";
        if (mysqli_query($conex, $sql_update)) {
            $mensaje = "Producto actualizado exitosamente.";
        } else {
            $mensaje = "Error al actualizar el producto: " . mysqli_error($conex);
        }
    } else {
        // Si el producto no existe, inserta un nuevo registro
        $sql_insert = "INSERT INTO tbl_productos (nombreProducto, cantidadProducida, unidadMedida, fechaProduccion, fechaVencimiento) VALUES ('$nombreProducto', '$cantidadProducida', '$unidadMedida', '$fechaProduccion', '$fechaVencimiento')";
        if (mysqli_query($conex, $sql_insert)) {
            $mensaje = "Producto registrado exitosamente.";
        } else {
            $mensaje = "Error al registrar el producto: " . mysqli_error($conex);
        }
    }
}
?>

<div class="producto">
    <h3>Mantequilla</h3>
    <button class="agregar" onclick="mostrarFormulario('formMantequilla')">Agregar Producto</button>
    <div id="formMantequilla" class="formulario">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input type="hidden" name="nombreProducto" value="Mantequilla">
            <label for="cantidadProducidaMantequilla">Cantidad Producida:</label>
            <input type="text" id="cantidadProducidaMantequilla" name="cantidadProducida" required>

            <label for="fechaProduccionMantequilla">Fecha de Producción:</label>
            <input type="date" id="fechaProduccionMantequilla" name="fechaProduccion" required>

            <label for="fechaVencimientoMantequilla">Fecha de Vencimiento:</label>
            <input type="date" id="fechaVencimientoMantequilla" name="fechaVencimiento" required>

            <label for="unidadMedidaMantequilla">Unidad de Medida:</label>
            <select id="unidadMedidaMantequilla" name="unidadMedida" required>
                <option value="Kilogramos">Kilogramos</option>
                <option value="Libras">Libras</option>
                <option value="Unidades">Unidades</option>
            </select>

            <input type="submit" value="Agregar/Actualizar">
        </form>
    </div>
</div>

<div class="producto">
    <h3>Queso</h3>
    <button class="agregar" onclick="mostrarFormulario('formQueso')">Agregar Producto</button>
    <div id="formQueso" class="formulario">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input type="hidden" name="nombreProducto" value="Queso">
            <label for="cantidadProducidaQueso">Cantidad Producida:</label>
            <input type="text" id="cantidadProducidaQueso" name="cantidadProducida" required>

            <label for="fechaProduccionQueso">Fecha de Producción:</label>
            <input type="date" id="fechaProduccionQueso" name="fechaProduccion" required>

            <label for="fechaVencimientoQueso">Fecha de Vencimiento:</label>
            <input type="date" id="fechaVencimientoQueso" name="fechaVencimiento" required>

            <label for="unidadMedidaQueso">Unidad de Medida:</label>
            <select id="unidadMedidaQueso" name="unidadMedida" required>
                <option value="Kilogramos">Kilogramos</option>
                <option value="Gramos">Gramos</option>
                <option value="Unidades">Unidades</option>
            </select>

            <input type="submit" value="Agregar/Actualizar">
        </form>
    </div>
</div>

<div class="producto">
    <h3>Crema de leche</h3>
    <button class="agregar" onclick="mostrarFormulario('formCremaLeche')">Agregar Producto</button>
    <div id="formCremaLeche" class="formulario">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input type="hidden" name="nombreProducto" value="Crema de leche">
            <label for="cantidadProducidaCremaLeche">Cantidad Producida:</label>
            <input type="text" id="cantidadProducidaCremaLeche" name="cantidadProducida" required>

            <label for="fechaProduccionCremaLeche">Fecha de Producción:</label>
            <input type="date" id="fechaProduccionCremaLeche" name="fechaProduccion" required>

            <label for="fechaVencimientoCremaLeche">Fecha de Vencimiento:</label>
            <input type="date" id="fechaVencimientoCremaLeche" name="fechaVencimiento" required>

            <label for="unidadMedidaCremaLeche">Unidad de Medida:</label>
            <select id="unidadMedidaCremaLeche" name="unidadMedida" required>
                <option value="Litros">Litros</option>
                <option value="Mililitros">Mililitros</option>
                <option value="Unidades">Unidades</option>
            </select>

            <input type="submit" value="Agregar/Actualizar">
        </form>
    </div>
</div>

<div class="producto">
    <h3>Yogurt</h3>
    <button class="agregar" onclick="mostrarFormulario('formYogurt')">Agregar Producto</button>
    <div id="formYogurt" class="formulario">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input type="hidden" name="nombreProducto" value="Yogurt">
            <label for="cantidadProducidaYogurt">Cantidad Producida:</label>
            <input type="text" id="cantidadProducidaYogurt" name="cantidadProducida" required>

            <label for="fechaProduccionYogurt">Fecha de Producción:</label>
            <input type="date" id="fechaProduccionYogurt" name="fechaProduccion" required>

            <label for="fechaVencimientoYogurt">Fecha de Vencimiento:</label>
            <input type="date" id="fechaVencimientoYogurt" name="fechaVencimiento" required>

            <label for="unidadMedidaYogurt">Unidad de Medida:</label>
            <select id="unidadMedidaYogurt" name="unidadMedida" required>
                <option value="Kilogramos">Kilogramos</option>
                <option value="Litros">Litros</option>
                <option value="Unidades">Unidades</option>
            </select>

            <input type="submit" value="Agregar/Actualizar">
        </form>
    </div>
</div>

<button id="btnAyuda" onclick="mostrarAyuda()">Ayuda</button>
<div id="textoAyuda">
    Esta página es un formulario para registrar productos. Cada sección corresponde a un tipo de producto, como mantequilla, queso, crema de leche y yogurt. Puedes hacer clic en 'Agregar Producto' en cada sección para desplegar un formulario y registrar la cantidad producida, las fechas de producción y vencimiento, así como la unidad de medida del producto.
</div>

<script>
    function mostrarFormulario(formId) {
        var formulario = document.getElementById(formId);
        if (formulario.style.display === "none") {
            formulario.style.display = "block";
        } else {
            formulario.style.display = "none";
        }
    }

    function mostrarAyuda() {
        alert("Esta página es un formulario para registrar productos. Cada sección corresponde a un tipo de producto, como mantequilla, queso, crema de leche y yogurt. Puedes hacer clic en 'Agregar Producto' en cada sección para desplegar un formulario y registrar la cantidad producida, las fechas de producción y vencimiento, así como la unidad de medida del producto.");
    }
</script>

<?php if (!empty($mensaje)) { ?>
    <div><?php echo $mensaje; ?></div>
<?php } ?>

</body>
</html>
