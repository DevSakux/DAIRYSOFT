<?php
include "../Servicios/Auth/seguridad.php";



?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Registro de Datos del Proveedor</title>
<style>

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
        display: block;
        margin-bottom: 5px;
    }

    input[type="text"], input[type="number"], input[type="date"], select, button {
        width: calc(100% - 20px);
        padding: 10px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 5px;
        margin-top: 5px;
        margin-bottom: 10px;
    }

    button {
        background-color: #4caf50;
        color: #fff;
        cursor: pointer;
    }

    button:hover {
        background-color: #45a049;
    }
</style>
</head>
<body>
<div class="container">
    <h1>Registro de Datos del Proveedor</h1>
    <form>
        <label for="producto">Producto:</label>
        <select name="producto" id="producto">
            <option value="leche">Leche</option>
            <option value="leche_en_polvo">Leche en Polvo</option>
            <!-- Agrega más opciones según los productos que necesites -->
        </select>

        <label for="cantidad">Cantidad (litros):</label>
        <input type="number" id="cantidad" name="cantidad" min="1" required>

        <label for="fecha">Fecha de entrega:</label>
        <input type="date" id="fecha" name="fecha" required>

        <button type="submit">Registrar</button>
    </form>
</div>
</body>
</html>