<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informe de Seguimiento de Productos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1, h2 {
            text-align: center;
        }

        form {
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
        }

        select, button {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-top: 5px;
        }

        button {
            background-color: #4caf50;
            color: #fff;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        .informe {
            margin-top: 20px;
            background-color: #f9f9f9;
            padding: 10px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Informe de Seguimiento de Productos</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="producto">Selecciona un producto:</label>
            <select name="producto" id="producto">
                <option value="leche">Leche</option>
                <option value="yogurt">Yogurt</option>
                <option value="mantequilla">Mantequilla</option>
                <!-- Agrega más opciones según los productos que necesites -->
            </select>
            <button type="submit">Generar Informe</button>
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Datos simulados del proveedor (pueden provenir de una base de datos)
            $datos_proveedor = array(
                'leche' => array('total' => 500, 'utilizado' => 250),
                'yogurt' => array('total' => 200, 'utilizado' => 100),
                'mantequilla' => array('total' => 300, 'utilizado' => 150)
                // Agrega más datos según los productos que necesites
            );

            // Obtener el producto seleccionado por el usuario
            $producto = $_POST['producto'];

            // Generar el informe
            echo "<div class='informe'>";
            echo "<h2>Informe para $producto</h2>";
            echo "<p>Total recibido del proveedor: {$datos_proveedor[$producto]['total']} litros</p>";
            echo "<p>Litros utilizados: {$datos_proveedor[$producto]['utilizado']}</p>";
            echo "<p>Litros restantes: " . ($datos_proveedor[$producto]['total'] - $datos_proveedor[$producto]['utilizado']) . "</p>";
            echo "</div>";
        }
        ?>
    </div>
</body>
</html>