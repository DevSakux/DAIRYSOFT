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
            margin-bottom: 20px; /* Aumentado el espacio debajo del mensaje */
        }

        .message-container p {
            font-size: 18px;
            margin: 10px 0;
        }

        .message-container .welcome {
            color: #8bc34a;
            font-size: 28px; /* Aumentado el tamaño del saludo */
            margin-bottom: 20px; /* Aumentado el espacio entre el saludo y el siguiente mensaje */
        }

        .message-container .instruction {
            color: #8bc34a;
        }

        .message-container .warning {
            color: red;
        }

        .invisible-space {
            height: 40px; /* Altura del espacio invisible */
            visibility: hidden; /* Hacer el espacio invisible */
        }

        .space {
            margin-bottom: 40px; /* Aumentado el espacio entre el mensaje y la lista */
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
            color: #fff;
        }

        th {
            background-color: #555;
        }

        tr:nth-child(even) {
            background-color: #383838;
        }

        .action-buttons {
            display: flex;
            justify-content: space-between;
        }

        .action-buttons button {
            padding: 6px 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .admit-button {
            background-color: #8bc34a;
            color: #fff;
        }

        .deny-button {
            background-color: #ff5722;
            color: #fff;
        }

        th.actions-header {
            text-align: center;
        }

        /* Estilos adicionales para el botón REGRESAR */
        .return-button {
            position: absolute;
            top: 20px;
            left: 10px;
            background-color: #8bc34a;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .return-button:hover {
            background-color: #689f38;
        }
    </style>
</head>
<body>
    <!-- Botón REGRESAR -->
    <button class="return-button" onclick="window.location.href = 'usuarios.php';">
        <i class="fas fa-arrow-left"></i> Regresar
    </button>

<div class="container">
    <div class="message-container">
        <p class="welcome">¡Hola Administrador!</p>
    </div>

    <!-- Espacio invisible debajo de ¡Hola Administrador! -->
    <div class="invisible-space"></div>

    <div class="message-container message-with-border">
        <p class="instruction">Aquí podrás permitir que los usuarios en estado de revisión pasen a ser Empleados.</p>
        <p class="instruction">Como administrador, tienes el poder de aceptar o eliminar el usuario registrado.</p>
        <p class="warning">Recuerda admitir a personas que conozcas, ya que tendrán acceso directo al inventario y a la manipulación de la base de datos.</p>
    </div>

    <!-- Espacio entre los mensajes y la lista -->
    <div class="space"></div>

    <div id="listSection">
        <?php
        include('../Servicios/Auth/conexion.php');

        // Consulta SQL para seleccionar solo los usuarios con rol "Revisión"
        $sql = "SELECT u.id, u.nombre, u.apellido, u.correo, r.nombre AS rol, u.fecha_nacimiento, u.fecha_registro
                FROM tbl_usuarios u
                INNER JOIN tbl_roles r ON u.rol_id = r.id
                WHERE u.rol_id = 3"; // Rol "Revisión"
        $resultado = mysqli_query($conex, $sql);

        // Verificar si se encontraron resultados
        if (mysqli_num_rows($resultado) > 0) {
            echo "<table>";
            echo "<tr><th>ID</th><th>Nombre</th><th>Apellido</th><th>Correo</th><th>Rol</th><th>Fecha de Nacimiento</th><th>Fecha de Registro</th><th class='actions-header'>Acciones</th></tr>";

            // Itera sobre los resultados y muestra los botones de acción en una tabla
            while ($fila = mysqli_fetch_assoc($resultado)) {
                echo "<tr>";
                echo "<td>" . $fila['id'] . "</td>";
                echo "<td>" . $fila['nombre'] . "</td>";
                echo "<td>" . $fila['apellido'] . "</td>";
                echo "<td>" . $fila['correo'] . "</td>";
                echo "<td>" . $fila['rol'] . "</td>";
                echo "<td>" . $fila['fecha_nacimiento'] . "</td>";
                echo "<td>" . $fila['fecha_registro'] . "</td>";
                echo "<td class='action-buttons'>
                    <form action='../Vistas/Admitirusuarionuevo.php' method='post'>
                        <input type='hidden' name='usuario_id' value='" . $fila['id'] . "'>
                        <button type='submit' class='admit-button' name='admitir'>Admitir</button>
                    </form>
                    <form action='../Vistas/Denegarusuarionuevo.php' method='post'>
                        <input type='hidden' name='usuario_id' value='" . $fila['id'] . "'>
                        <button type='submit' class='deny-button' name='denegar'>Denegar</button>
                    </form>
                </td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "No se encontraron usuarios con rol de Revisión.";
        }

        // Cerrar la conexión
        mysqli_close($conex);
        ?>
    </div>
</div>

</body>
</html>
