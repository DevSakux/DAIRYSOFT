<?php 
include "../Servicios/Auth/seguridad.php";
include "../Servicios/Auth/conexion.php";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Denegar Usuario</title>
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
            color: #fff; /* Cambiamos el color del texto a blanco */
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
        }

        form input[type="submit"] {
            padding: 10px 20px;
            background-color: #d32f2f; /* Cambié el color de fondo */
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            display: block;
            margin: 0 auto; /* Centramos el botón */
        }

        form input[type="submit"]:hover {
            background-color: #b71c1c; /* Cambié el color de fondo */
        }

        .alert-danger {
            margin-top: 20px;
        }
    </style>
</head>
<body>

<a href="admitir.php" class="btn btn-success mt-3 ml-3"><i class="fas fa-arrow-left"></i> Regresar</a>

<div class="container">
    <div class="message-container">
        <h1>Denegar Usuario</h1>
        <p>Confirme la denegación del usuario.</p>
    </div>

    <!-- Contenedor del formulario con borde verde -->
    <div class="form-container">
        <?php
        // Verificar si se ha enviado un ID de usuario a través del formulario POST
        if(isset($_POST['usuario_id'])) {
            // Obtener el ID de usuario del formulario
            $userId = $_POST['usuario_id'];

            // Consulta SQL para obtener los datos del usuario con el ID proporcionado
            $sql = "SELECT * FROM tbl_usuarios WHERE id = $userId";

            // Ejecutar la consulta
            $result = mysqli_query($conex, $sql);

            // Verificar si se encontraron resultados
            if(mysqli_num_rows($result) > 0) {
                // Obtener los datos del usuario como un array asociativo
                $userData = mysqli_fetch_assoc($result);

                // Mostrar el ID del usuario
                echo '<div class="form-group">';
                echo '<label for="userId">ID:</label>';
                echo '<input type="text" id="userId" name="userId" class="form-control" value="'.$userData['id'].'" readonly>';
                echo '</div>';

                // Mostrar los datos del usuario
                echo '<div class="form-group">';
                echo '<label for="nombre">Nombre:</label>';
                echo '<input type="text" id="nombre" name="nombre" class="form-control" value="'.$userData['nombre'].'" readonly>';
                echo '</div>';
                echo '<div class="form-group">';
                echo '<label for="apellido">Apellido:</label>';
                echo '<input type="text" id="apellido" name="apellido" class="form-control" value="'.$userData['apellido'].'" readonly>';
                echo '</div>';
                echo '<div class="form-group">';
                echo '<label for="correo">Correo:</label>';
                echo '<input type="email" id="correo" name="correo" class="form-control" value="'.$userData['correo'].'" readonly>';
                echo '</div>';
                echo '<div class="form-group">';
               
                echo '<label for="rol">Rol:</label>';
                echo '<input type="text" id="rol" name="rol" class="form-control" value="'.$userData['rol_id'].'" readonly>';
                echo '</div>';

                // Botón para confirmar la denegación del usuario
                echo '<form id="denyUserForm" action="../Controladores/DenegarUserAdminController.php" method="POST">';
                echo '<input type="hidden" id="userId" name="userId" value="'.$userData['id'].'">';
                echo '<div style="text-align: center;">'; // Nuevo contenedor para centrar el botón
                echo '<button type="submit" class="btn btn-danger">Denegar Usuario</button>';
                echo '</div>';
                echo '</form>';
            } else {
                // Mostrar un mensaje de error si no se encontraron datos para el usuario
                echo '<div class="alert alert-danger" role="alert">No se encontraron datos para el usuario especificado.</div>';
            }
        } else {
            // Mostrar un mensaje de error si no se proporcionó un ID de usuario válido
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
