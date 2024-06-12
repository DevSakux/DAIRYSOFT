<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Verificación de Existencias</title>
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

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th, td {
        padding: 10px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #f2f2f2;
    }
</style>
</head>
<body>
<div class="container">
    <h1>Verificación de Existencias</h1>
    <h2>Insumos</h2>
    <table>
        <tr>
            <th>Insumo</th>
            <th>Cantidad</th>
        </tr>
        <?php
        // Datos simulados de existencias de insumos (pueden provenir de una base de datos)
        $insumos = array(
            'Leche' => '500 litros',
            'Leche en Polvo' => '20 kilos'
            // Agrega más insumos según los que tengas en tu inventario de insumos
        );

        foreach ($insumos as $insumo => $cantidad) {
            echo "<tr>";
            echo "<td>$insumo</td>";
            echo "<td>$cantidad</td>";
            echo "</tr>";
        }
        ?>
    </table>

    <h2>Productos</h2>
    <table>
        <tr>
            <th>Producto</th>
            <th>Cantidad</th>
        </tr>
        <?php
        // Datos simulados de existencias de productos (pueden provenir de una base de datos)
        $productos = array(
            'Mantequilla' => '1 libra',
            'Yogurt' => '7 litros'
            // Agrega más productos según los que tengas en tu inventario de productos
        );

        foreach ($productos as $producto => $cantidad) {
            echo "<tr>";
            echo "<td>$producto</td>";
            echo "<td>$cantidad</td>";
            echo "</tr>";
        }
        ?>
    </table>
</div>
</body>
</html>
