<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seguimiento de Productos Lácteos</title>
    <style>
      h1 {
    color: #333;
    text-align: center; /* Centrar el texto del encabezado */
    margin-top: 20px; /* Agregar un poco de margen superior */
}

        form {
            margin-bottom: 20px;
            text-align: center;
        }
        
        table {
            width: 100%; /* Modificar el ancho de la tabla al 100% */
            margin: 0 auto;
            border-collapse: collapse;
        }
        
        table, th, td {
            border: 1px solid #ccc;
            padding: 10px;
        }
        
        th {
            background-color: #f2f2f2;
            
        }

    
    </style>
</head>
<body>
    <h1>Seguimiento de Productos Lácteos</h1>
    <form method="post">
        <label for="producto">Producto:</label>
        <select name="producto" id="producto">
            <option value="yogurt">Yogurt</option>
            <option value="mantequilla">Mantequilla</option>
            <option value="crema_de_leche">Crema de leche</option>
        </select>
        <label for="cantidad">Cantidad producida:</label>
        <input type="number" name="cantidad" id="cantidad" min="1" required>
        <input type="submit" value="Registrar producción">
    </form>
    
    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            <!-- Aquí puedes mostrar las filas de seguimiento de productos -->
            <tr>
                <td>Yogurt</td>
                <td>100 unidades</td>
                <td>2024-04-16</td>
            </tr>
            <tr>
                <td>Mantequilla</td>
                <td>50 unidades</td>
                <td>2024-04-15</td>
            </tr>
            <tr>
                <td>Crema de leche</td>
                <td>80 unidades</td>
                <td>2024-04-15</td>
            </tr>
        </tbody>
    </table>
</body>
</html>
