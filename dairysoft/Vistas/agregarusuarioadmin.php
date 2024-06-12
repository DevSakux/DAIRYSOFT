<?php 
include "../Servicios/Auth/seguridad.php";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Usuario</title>
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
        form input[type="password"],
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
    </style>
</head>
<body>

<a href="Usuarios.php" class="btn btn-success mt-3 ml-3"><i class="fas fa-arrow-left"></i> Regresar</a>

<div class="container">
    <div class="message-container">
        <h1>Agregar Usuario</h1>
        <p>Complete el siguiente formulario para agregar un nuevo usuario.</p>
    </div>

    <!-- Contenedor del formulario con borde verde -->
    <div class="form-container">
        <form action="../Controladores/AgregarUsuarioController.php" method="POST">
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" class="form-control" pattern="[a-zA-Z]{3,9}" title="Debe contener entre 3 y 9 letras" required>
            </div>
            <div class="form-group">
                <label for="apellido">Apellido</label>
                <input type="text" id="apellido" name="apellido" class="form-control" pattern="[a-zA-Z]{3,9}" title="Debe contener entre 3 y 9 letras" required>
            </div>
            <div class="form-group">
                <label for="correo">Correo</label>
                <input type="email" id="correo" name="correo" class="form-control"  pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,30}$" title="Por favor, ingrese una dirección de correo electrónico válida." required>
            </div>
            <div class="form-group">
                <label for="contrasena">Contraseña</label>
                <input type="password" id="contrasena" name="contrasena" required pattern=".{5,}" class="form-control" title="La contraseña debe tener al menos 5 caracteres" required>
            </div>
            <div class="form-group">
                <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                <div class="form-row">
                    <div class="col">
                        <select name="dia" class="form-control" required style="background-color: #444; color: #fff;">
                            <option value="" disabled selected>Día</option>
                            <?php
                            for ($i = 1; $i <= 31; $i++) {
                                echo "<option value=\"$i\" style=\"color: #fff;\">$i</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="col">
                        <select name="mes" class="form-control" required style="background-color: #444; color: #fff;">
                            <option value="" disabled selected>Mes</option>
                            <option value="01" style="color: #fff;">Enero</option>
                            <option value="02" style="color: #fff;">Febrero</option>
                            <option value="03" style="color: #fff;">Marzo</option>
                            <option value="04" style="color: #fff;">Abril</option>
                            <option value="05" style="color: #fff;">Mayo</option>
                            <option value="06" style="color: #fff;">Junio</option>
                            <option value="07" style="color: #fff;">Julio</option>
                            <option value="08" style="color: #fff;">Agosto</option>
                            <option value="09" style="color: #fff;">Septiembre</option>
                            <option value="10" style="color: #fff;">Octubre</option>
                            <option value="11" style="color: #fff;">Noviembre</option>
                            <option value="12" style="color: #fff;">Diciembre</option>
                        </select>
                    </div>
                    <div class="col">
                        <select name="año" class="form-control" required style="background-color: #444; color: #fff;">
                            <option value="" disabled selected>Año</option>
                            <?php
                            for ($i = date("Y"); $i >= 1900; $i--) {
                                echo "<option value=\"$i\">$i</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
    <label for="rol" style="color: #8bc34a;">Rol</label>
    <select id="rol" name="rol" class="form-control" style="background-color: #444; color: #fff;">
        <option value="1">Administrador</option>
        <option value="2">Empleado</option>
        <option value="3">Revisión</option>
    </select>
    <div class="form-group text-center">
    <button type="submit" class="btn btn-primary">Agregar Usuario</button>
</div>

</div>
<?php
// Definir una función para obtener el nombre del rol según el rol_id
function obtenerNombreRol($rol_id) {
    // Definir un array asociativo con los nombres de los roles
    $roles = array(
        1 => 'Administrador',
        2 => 'Empleado',
        3 => 'Revisión'
    );

    // Verificar si el rol_id existe en el array de roles
    if (array_key_exists($rol_id, $roles)) {
        // Devolver el nombre del rol correspondiente
        return $roles[$rol_id];
    } else {
        // Si el rol_id no está definido en el array, devolver 'Desconocido'
        return 'Desconocido';
    }
}

// Verificar si hay un mensaje de éxito o error en la URL
if (isset($_GET['registro'])) {
    if ($_GET['registro'] === 'exitoso') {
        // Obtener el nombre del rol utilizando la función obtenerNombreRol
        $nombre_rol = obtenerNombreRol($_GET['rol']);
        
        // Mostrar un mensaje de éxito con el nombre del usuario y el nombre del rol
        echo "<div class='alert alert-success' role='alert'>El usuario {$_GET['nombre']} se agregó correctamente con el rol \"$nombre_rol\".</div>";
    } elseif ($_GET['registro'] === 'error') {
        // Mostrar un mensaje de error
        echo "<div class='alert alert-danger' role='alert'>Hubo un error al agregar el usuario, intente de nuevo.</div>";
    }
}
?>
</div>


<!-- Agregamos Bootstrap JS y jQuery (para los componentes de Bootstrap) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
