<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
    <link rel="stylesheet" href="../public/css/style.css?v=<?php echo time(); ?>">

    <style>
        body {
            background-image: url('../public/imagenes/fondo4.jpg');
            background-size: 100% 100%;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        /* Estilo para el mensaje */
        .mensaje-box {
            display: none;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: rgba(255, 255, 255, 0.8);
            padding: 10px 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            z-index: 9999;
        }
        /* Estilo para el mensaje de error dentro del formulario */
        .mensaje-error {
            color: #ff0000; /* Color rojo */
            margin-bottom: 10px;
            font-weight: bold; /* Negrita */
        }

    </style>
</head>
<body>
<section>
    <div class="signin green-border"> <!-- Agregamos la clase "green-border" para el borde verde -->
        <div class="content">
            <h2>¡Regístrate!</h2>
            <div class="form">
                <form id="registroForm" action="../Controladores/registroController.php" method="post">

                    <div class="inputBox3">
                        <input type="text" name="nombre" required pattern="[a-zA-Z]{3,9}" title="Ingrese un Nombre valido. Debe contener entre 3 y 9 letras, sin incluir números ni caracteres especiales.">
                        <i>Nombre</i>
                    </div>
                    <div class="inputBox3">
                        <input type="text" name="apellido" required pattern="[a-zA-Z]{3,9}" title="Ingrese un Apellido válido. Debe contener entre 3 y 9 letras, sin incluir números ni caracteres especiales.">
                        <i>Apellido</i>
                    </div>
                    <div class="inputBox3">
                        <input type="email" name="correo" required pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,30}$" title="Por favor, ingrese una dirección de correo electrónico válida.">
                        <i>Correo electrónico</i>
                    </div>
                    <div class="inputBox">
                        <div class="password-wrapper">
                            <input id="passwordInput" type="password" name="contrasena" required pattern=".{5,}" title="La contraseña debe tener al menos 5 caracteres">
                            <i>Contraseña</i>
                            <div class="password-toggle" onclick="togglePasswordVisibility()">
                                <img src="../public/imagenes/cerrado.png" alt="Toggle Password Visibility">
                            </div>
                        </div>
                    </div>
                    <div class="inputBox">
                        <div class="date-input">
                            <label class="date-label">Fecha de Nacimiento:</label>
                            <div class="select-container">
                                <select name="dia" required>
                                    <option value="" disabled selected>Día</option>
                                    <script>
                                        for (let i = 1; i <= 31; i++) {
                                            document.write(`<option value="${i}">${i}</option>`);
                                        }
                                    </script>
                                </select>
                                <select name="mes" required>
                                    <option value="" disabled selected>Mes</option>
                                    <option value="01">Enero</option>
                                    <option value="02">Febrero</option>
                                    <option value="03">Marzo</option>
                                    <option value="04">Abril</option>
                                    <option value="05">Mayo</option>
                                    <option value="06">Junio</option>
                                    <option value="07">Julio</option>
                                    <option value="08">Agosto</option>
                                    <option value="09">Septiembre</option>
                                    <option value="10">Octubre</option>
                                    <option value="11">Noviembre</option>
                                    <option value="12">Diciembre</option>
                                </select>
                                <select name="año" required>
                                    <option value="" disabled selected>Año</option>
                                    <script>
                                        for (let i = 2024; i >= 1900; i--) {
                                            document.write(`<option value="${i}">${i}</option>`);
                                        }
                                    </script>
                                </select>
                            </div>
                        </div>
                    </div>

                    <?php
                    if (isset($_SESSION['mensaje'])) {
                        echo '<p class="mensaje-error">' . $_SESSION['mensaje'] . '</p>';
                        unset($_SESSION['mensaje']); // Limpiar el mensaje de la sesión
                    }
                    ?>
                    <div class="inputBox">
                        <input type="submit" value="Registrarse">
                    </div>

                </form>
            </div>    
            
            <div class="links">
            <a href="index.php" class="back-link">Volver al inicio</a>
        </div>
    </div>
</section>

<div class="mensaje-box" id="mensajeBox"></div>
<script>
    function togglePasswordVisibility() {
        var passwordInput = document.getElementById('passwordInput');
        var passwordToggle = document.querySelector('.password-toggle img');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            passwordToggle.src = '../public/imagenes/abierto.png'; // Ruta de la imagen de ojo abierto
        } else {
            passwordInput.type = 'password';
            passwordToggle.src = '../public/imagenes/cerrado.png'; // Ruta de la imagen de ojo cerrado
        }
    }

    // Función para ocultar el mensaje de error después de 5 segundos
    setTimeout(function() {
        var errorMsg = document.querySelector('.mensaje-error');
        if (errorMsg) {
            errorMsg.style.display = 'none';
        }
    }, 5000); // Ocultar el mensaje después de 5 segundos

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
