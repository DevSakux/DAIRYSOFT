<?php
include "../Servicios/Auth/seguridad.php";



?>



<!DOCTYPE html>
<html>
<head>
    <title>Tabla de Usuarios</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            background-color: #282828;
            color: #fff;
            font-family: Arial, sans-serif;
        }

        .message-container {
            text-align: center;
            margin-bottom: 20px;
        }

        .message-container h1,
        .message-container p {
            color: #8bc34a;
        }

        .message-container h1 {
            font-size: 24px;
        }

        .message-container p {
            font-size: 18px;
        }

        .role-filter-container, .add-user-inventory-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
        }

        .role-filter {
            text-align: left;
        }

        .role-filter select {
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #555;
            background-color: #444;
            color: #fff;
            transition: border-color 0.3s;
        }

        .role-filter select:focus {
            border-color: #3498db;
        }

        .role-filter button {
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            background-color: #3498db;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-left: 10px;
        }

        .role-filter button:hover {
            background-color: #2980b9;
        }

        .add-user-container {
            text-align: right;
        }

        .add-user-container p {
            display: inline;
            font-size: 18px;
            color: #8bc34a;
            margin-right: 10px;
        }

        .add-user-container a.addButton {
            padding: 10px 20px;
            background-color: #8bc34a;
            color: #fff;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-size: 16px;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .add-user-container a.addButton:hover {
            background-color: #2ecc71;
        }

        .add-user-inventory-container {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            margin-top: 20px;
            color: #000;
        }

        .add-user-inventory-container p {
            font-size: 18px;
            color: #000;
            margin-right: 10px;
        }

        .add-user-inventory-container a.inventoryButton {
            padding: 10px 20px;
            background-color: #8bc34a;
            color: #fff;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-size: 16px;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .add-user-inventory-container a.inventoryButton:hover {
            background-color: #27ae60;
        }

        .space {
            margin-bottom: 20px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 12px;
            background-color: #444;
        }

        th {
            background-color: #555;
        }

        tr:nth-child(even) {
            background-color: #383838;
        }

        td.actions {
            text-align: center;
        }

        td.actions a {
            display: inline-block;
            margin: 0 5px;
            color: #3498db;
            transition: color 0.3s;
        }

        td.actions a.eliminar {
            color: red;
        }

        td.actions a:hover {
            color: #2980b9;
        }

        td.actions a.eliminar:hover {
            color: darkred;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="message-container">
        <h1>¡Hola Administrador!</h1>
        <p>Aquí podrá consultar, modificar, eliminar y agregar usuarios.</p>
    </div>

    <div class="add-user-inventory-container">
        <p style="color: #fff;">Admitir usuarios al inventario:</p>
        <a href="admitir.php" class="inventoryButton" onclick="mostrarLista()">Admitir</a>
    </div>

    <div class="role-filter-container">
        <div class="role-filter">
            <label for="roleSelect">Consultar Usuarios por Rol:</label>
            <select id="roleSelect">
                <option value="total" selected>Todos</option>
                <option value="1">Administrador</option>
                <option value="2">Empleado</option>
                <option value="3">Revisión</option>
            </select>
            <button onclick="filtrarUsuarios()">Filtrar</button>
        </div>
        <div class="add-user-container">
            <p>Nuevo usuario:</p>
            <a href="agregarusuarioadmin.php" class="addButton">Agregar</a>
        </div>
    </div>
    
    <!-- Espacio entre el texto y la lista -->
    <div class="space"></div>
    <div id="listSection">
        <?php
        include('../Servicios/Auth/conexion.php');

        // Consulta SQL para seleccionar todos los usuarios
        $sql = "SELECT u.id, u.nombre, u.apellido, u.correo, r.nombre AS rol, u.fecha_nacimiento, u.fecha_registro
                FROM tbl_usuarios u
                INNER JOIN tbl_roles r ON u.rol_id = r.id";
        $resultado = mysqli_query($conex, $sql);

        // Verificar si se encontraron resultados
        if (mysqli_num_rows($resultado) > 0) {
            echo "<table>";
            echo "<tr><th>ID</th><th>Nombre</th><th>Apellido</th><th>Correo</th><th>Rol</th><th>Fecha de Nacimiento</th><th>Fecha de Registro</th><th>Acciones</th></tr>";

            // Iterar sobre los resultados y mostrarlos en una tabla
            while ($fila = mysqli_fetch_assoc($resultado)) {
                echo "<tr>";
                echo "<td>" . $fila['id'] . "</td>";
                echo "<td>" . $fila['nombre'] . "</td>";
                echo "<td>" . $fila['apellido'] . "</td>";
                echo "<td>" . $fila['correo'] . "</td>";
                echo "<td>" . $fila['rol'] . "</td>";
                echo "<td>" . $fila['fecha_nacimiento'] . "</td>";
                echo "<td>" . $fila['fecha_registro'] . "</td>";
                echo "<td class='actions'><a class='editar' href='modificar.php?id=" . $fila['id'] . "&rol=" . $fila['rol'] . "'><i class='fas fa-edit'></i></a> <a class='eliminar' href='eliminarusuario.php?id=" . $fila['id'] . "'><i class='fas fa-trash-alt'></i></a></td>";

                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "No se encontraron usuarios.";
        }

        // Cerrar la conexión
        mysqli_close($conex);
        ?>
    </div>
</div>
<script>
    function filtrarUsuarios() {
        var rolSeleccionado = document.getElementById("roleSelect").value;
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("listSection").innerHTML = this.responseText;
            }
        };
        if (rolSeleccionado === "total") {
            xhttp.open("GET", "../Controladores/FiltradoUsersController.php", true);
        } else {
            xhttp.open("GET", "../Controladores/FiltradoUsersController.php?rol=" + rolSeleccionado, true);
        }
        xhttp.send();
    }


</script>

</body>
</script>
