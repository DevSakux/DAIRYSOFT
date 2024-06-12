<?php 
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>ProyectoDairySoft</title>
    
    <link rel="stylesheet" href="../public/css/style.css?v=<?php echo time(); ?>">

    <style>
 body {
    background-image: url('../public/imagenes/Fondo4.jpg');
    background-size: 100% 100%;
    background-repeat: no-repeat;
    background-attachment: fixed;
}

    </style>
</head>
<body>
    <section>
        <div class="signin">
            <div class="content">
                <h2>¡Bienvenido!</h2>
                <div class="form">
                    <form action="../Controladores/loginController.php" method="post"> <!-- Usar el mismo archivo para el formulario -->
                        <div class="inputBox">
                            <input type="text" name="correo" required> <i>Correo electrónico</i>
                        </div>
                        <div class="inputBox">
                        <div class="password-wrapper">
                        <input id="passwordInput" type="password" name="contrasena" required>
                        <i>Contraseña</i>
                        <div class="password-toggle" onclick="togglePasswordVisibility()">
                        <img src="../public/imagenes/cerrado.png" alt="Toggle Password Visibility">
        </div>
    </div>
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
    <script>
    function togglePasswordVisibility() {
        var passwordInput = document.getElementById('passwordInput');
        var toggleImage = document.querySelector('.password-toggle img');
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleImage.src = '../public/imagenes/abierto.png'; // Cambia la imagen a "abierto"
        } else {
            passwordInput.type = 'password';
            toggleImage.src = '../public/imagenes/cerrado.png'; // Cambia la imagen a "cerrado"
        }
    }

    window.addEventListener('DOMContentLoaded', function() {
    // Código para cargar la imagen aquí
    var backgroundImg = new Image();
    backgroundImg.onload = function() {
        // Cuando la imagen se haya cargado correctamente, actualiza el fondo del body
        document.body.style.backgroundImage = 'url("../public/imagenes/fondo4.jpg")';
    };
    backgroundImg.src = '../public/imagenes/fondo4.jpg'; // Ruta de la imagen de fondo
});
</script>

</body>
</html>
