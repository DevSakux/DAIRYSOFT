<?php
session_start();

include 'conexion.php';

// Inicializar la variable de mensaje de error
$mensaje_error = "";

if (isset($_POST['correo']) && isset($_POST['contrasena'])) {
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];

    // Verificar la conexión
    if (!$conex) {
        die("Conexión fallida: " . mysqli_connect_error());
    }

    $sql = "SELECT * FROM usuarios WHERE correo = '$correo' AND contrasena = '$contrasena'";
    $result = mysqli_query($conex, $sql);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            // Inicio de sesión exitoso
            $_SESSION['correo'] = $correo; // Guardar el correo en la sesión
            header("Location: pagina.php"); // Redireccionar a bogota.html después del inicio de sesión exitoso
            exit(); // Importante: detener el script para evitar que se muestre el formulario nuevamente
        } else {
            // Contraseña o correo electrónico incorrectos
            $mensaje_error = "¡Correo electrónico o contraseña incorrectos!";
            $_SESSION['mensaje_error'] = $mensaje_error;
            header("Location: index.php"); // Redireccionar de nuevo a la página de inicio de sesión
            exit();
        }
    } else {
        // Error en la consulta SQL
        $mensaje_error = "¡Error: " . mysqli_error($conex) . "!";
        $_SESSION['mensaje_error'] = $mensaje_error;
        header("Location: index.php"); // Redireccionar de nuevo a la página de inicio de sesión
        exit();
    }

    mysqli_close($conex);
}

// Limpiar la variable de sesión del mensaje de error después de mostrarlo una vez
if (isset($_SESSION['mensaje_error']) && $_SERVER["REQUEST_METHOD"] == "POST") {
    unset($_SESSION['mensaje_error']);
}
?>

<!DOCTYPE html>
<html lang="es">
<!-- Documentación: http://localhost/Dairysoft/ -->

<head>
    <meta charset="UTF-8">
    <title>ProyectoDairySoft</title>
    <link rel="stylesheet" href="./style.css?v=<?php echo time(); ?>">

    <style>
        body {
            background-image: url('buenas3.jpg');
            background-size: cover;
            background-repeat: no-repeat;
        }

        /* Estilo adicional para separar los campos */
        .form {
            margin-top: 20px; /* Espacio entre el encabezado y el formulario */
        }

        .inputBox {
            margin-bottom: 20px; /* Aumentar el espacio entre los campos */
        }

        /* Añadir espacio entre contraseña e iniciar sesión */
        input[type="submit"] {
            margin-top: 20px;
        }

        /* Estilo para el mensaje de error */
        .error-message {
            color: #ff0000; /* Color rojo */
            font-size: 16px;
            margin-top: 5px; /* Espacio superior */
            font-weight: bold; /* Negrita */
        }
    </style>
</head>

<body>
    <section>
        <div class="signin">
            <div class="content">
                <h2>¡Bienvenido!</h2>
                <div class="form">
                    <form action="index.php" method="post"> <!-- Usar el mismo archivo para el formulario -->
                        <div class="inputBox">
                            <input type="text" name="correo" required> <i>Correo electrónico</i>
                        </div>
                        <div class="inputBox">
                            <input type="password" name="contrasena" required> <i>Contraseña</i>
                        </div>
                        <!-- Mostrar mensaje de error debajo del campo de contraseña solo si se ha enviado el formulario y hay un mensaje de error -->
                        <?php if (isset($_SESSION['mensaje_error'])): ?>
                            <div class="error-message" id="error-message"><?php echo $_SESSION['mensaje_error']; ?></div>
                            <?php unset($_SESSION['mensaje_error']); ?> <!-- Limpiar la variable de sesión después de mostrar el mensaje -->
                        <?php endif; ?>
                        <div class="inputBox">
                            <input type="submit" value="Iniciar sesión">
                        </div>
                    </form> <!-- Cerrar formulario -->
                    <div class="links">
                        <table style="margin: 0 auto;">
                            <!-- Tabla para centrar el enlace -->
                            <tr>
                                <td style="text-align: center;">
                                    <a href="recuperarcontraseña.php" class="recupery">¿Has olvidado la contraseña?</a>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="links">
                        <table style="margin: 0 auto;">
                            <!-- Tabla para centrar el enlace -->
                            <tr>
                                <td style="text-align: center;">
                                    <a href="registro.php" class="signup">Registrarse</a>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        // Desaparecer el mensaje de error después de 5 segundos
        setTimeout(function() {
            var errorMessage = document.getElementById('error-message');
            if (errorMessage) {
                errorMessage.style.display = 'none';
            }
        }, 5000);
    </script>
</body>

</html>
