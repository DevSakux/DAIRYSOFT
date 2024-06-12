<?php 
include "../Servicios/Auth/seguridad.php";
include "../Servicios/Auth/conexion.php";


?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuario</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Agregamos Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <style>
        /* Estilos personalizados */
        body {
            background-color: #282828; /* Cambiamos el color de fondo de la página */
            color: #fff;
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

        /* Nuevo estilo para el contenedor del formulario */
        .form-container {
            border: 2px solid #8bc34a;
            border-radius: 10px;
            padding: 20px;
            margin-top: 20px;
        }

        form {
            margin-top: 20px;
        }

        form label {
            color: #8bc34a;
        }

        form input[type="text"],
        form input[type="email"],
        form select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: none;
            border-radius: 5px;
            background-color: #444; /* Cambié el color de fondo */
            color: #fff;
        }

        form select {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-color: #444; /* Fondo negro */
            color: #fff; /* Letra blanca */
        }

        form select option {
            background-color: #444; /* Fondo negro */
            color: #fff; /* Letra blanca */
        }

        form input[type="submit"] {
            padding: 10px 20px;
            background-color: #8bc34a; /* Cambié el color de fondo */
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            display: block;
            margin: 0 auto; /* Centramos el botón */
        }

        form input[type="submit"]:hover {
            background-color: #689f38; /* Cambié el color de fondo */
        }

        /* Estilo para el ID del usuario */
        #userIdDisplay {
            font-size: 18px;
            margin-bottom: 10px;
            color: #8bc34a;
            user-select: none;
            cursor: default; /* Cambiar el cursor a predeterminado */
            display: inline-block; /* Hacer que el contenedor ocupe solo el espacio necesario */
        }

        #userIdDisplay input[type="text"] {
            background-color: transparent;
            border: none;
            color: #8bc34a;
            font-size: 18px;
            font-weight: bold;
            width: auto; /* Hacer que el ancho se ajuste automáticamente al contenido */
            margin-bottom: 0;
            user-select: none;
            cursor: default; /* Cambiar el cursor a predeterminado */
            outline: none; /* Eliminar el contorno al enfocar el campo */
        }
    </style>
</head>
<body>

<a href="Usuarios.php" class="btn btn-success mt-3 ml-3"><i class="fas fa-arrow-left"></i> Regresar</a>

<div class="container">
    <div class="message-container">
        <h1>Editar Usuario</h1>
        <p>Modifique los siguientes campos para editar el usuario.</p>
    </div>

    <!-- Contenedor del formulario con borde verde -->
    <div class="form-container">
        <?php
        // Incluir el archivo de conexión a la base de datos
        include('../Servicios/Auth/conexion.php');

        // Verificar si se ha enviado un ID de usuario a través de la URL
        if(isset($_GET['id'])) {
            // Obtener el ID de usuario de la URL
            $userId = $_GET['id'];

            // Consulta SQL para obtener los datos del usuario con el ID proporcionado
            $sql = "SELECT * FROM tbl_usuarios WHERE id = $userId";

            // Ejecutar la consulta
            $result = mysqli_query($conex, $sql);

            // Verificar si se encontraron resultados
            if(mysqli_num_rows($result) > 0) {
                // Obtener los datos del usuario como un array asociativo
                $userData = mysqli_fetch_assoc($result);

                // Mostrar el formulario con los datos del usuario
                echo '<form id="editUserForm" action="../Controladores/EditarUsuarioController.php" method="POST">';
                // Mostrar el ID del usuario (no editable)
                echo '<div id="userIdDisplay">';
                echo '<label for="userId">ID</label>';
                echo '<input type="text" id="userId" name="userId" value="'.$userData['id'].'" readonly>';
                echo '</div>';
                echo '<div class="form-group">';
                echo '<label for="nombre">Nombre</label>';
                echo '<input type="text" id="nombre" name="nombre" class="form-control" value="'.$userData['nombre'].'" required>';
                echo '</div>';
                echo '<div class="form-group">';
                echo '<label for="apellido">Apellido</label>';
                echo '<input type="text" id="apellido" name="apellido" class="form-control" value="'.$userData['apellido'].'" required>';
                echo '</div>';
                echo '<div class="form-group">';
                echo '<label for="correo">Correo</label>';
                echo '<input type="email" id="correo" name="correo" class="form-control" value="'.$userData['correo'].'" required>';
                echo '</div>';
                echo '<div class="form-group">';
                echo '<label for="rol" style="color: #8bc34a;">Rol</label>';
                echo '<select id="rol" name="rol" class="form-control" style="background-color: #444; color: #fff;">';
                echo '<option value="1"'.($userData['rol_id'] == 1 ? ' selected' : '').'>Administrador</option>';
                echo '<option value="2"'.($userData['rol_id'] == 2 ? ' selected' : '').'>Empleado</option>';
                echo '<option value="3"'.($userData['rol_id'] == 3 ? ' selected' : '').'>Revisión</option>';
                echo '</select>';
                echo '</div>';
                // Botón para guardar cambios
                echo '<button type="submit" class="btn btn-primary" style="display: block; margin: 0 auto;">Guardar Cambios</button>';
                echo '</form>';
            } else {
                // Mostrar un mensaje de error si no se encontraron datos para el usuario
                echo '<div class="alert alert-danger" role="alert">No se encontraron datos para el usuario especificado.</div>';
            }
        } else {
            // Mostrar un mensaje de error si no se proporcionó un ID de usuario
            echo '<div class="alert alert-danger" role="alert">No se proporcionó un ID de usuario válido.</div>';
        }
        ?>
    </div>
</div>
<!-- Agregamos Bootstrap JS y jQuery (para los componentes de Bootstrap) -->

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
