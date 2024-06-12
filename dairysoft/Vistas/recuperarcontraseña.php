<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Recuperar Contraseña</title>
    <link rel="stylesheet" href="../public/css/style.css?v=<?php echo time(); ?>">

    <style>
 body {
    background-image: url('../public/imagenes/fondo4.jpg');
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
                <h2>¡Recuperar Contraseña!</h2>
                <div class="form">
                    <div class="inputBox">
                        <input type="text" required> <i>Correo electrónico</i>
                    </div>
                    <div class="inputBox">
                        <input type="submit" value="Enviar">
                    </div>
                </div>
                <a href="index.php" class="back-link">Volver al inicio</a>
            </div>
        </div>
    </section>
    <script>
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
