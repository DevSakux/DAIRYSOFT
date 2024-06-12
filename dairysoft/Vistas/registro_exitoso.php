<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Exitoso</title>
    <link rel="stylesheet" href="../public/css/style.css?v=<?php echo time(); ?>">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('../public/imagenes/fondo4.jpg');
            background-size: 100% 100%;
    background-repeat: no-repeat;
    background-attachment: fixed;
            text-align: center;
            padding: 50px;
            margin: 0;
        }
     

    </style>
</head>
<body>
    <div class="message-box">
        <h1>¡Registro Exitoso!</h1>
        <p>¡Gracias por registrarte con nosotros!</p>
        <a href="../vistas/index.php" class="regresar-btn">Regresar al inicio</a>
    </div>
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