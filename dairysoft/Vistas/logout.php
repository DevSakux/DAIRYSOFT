<?php 
include "../Servicios/Auth/cerrarsesion.php";

?>

<!DOCTYPE html>
<html lang="es">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/css/style.css?v=<?php echo time(); ?>">
    <title>Sesión Finalizada</title>
    <style>

        
        body {
            font-family: Arial, sans-serif;
            background-image: url('../public/imagenes/fondo4.jpg');
            background-size: 100% 100%;
            background-repeat: no-repeat;
            text-align: center;
            padding: 50px;
            margin: 0; /* Añadir esto para evitar el espacio adicional alrededor del cuerpo */
            background-attachment: fixed;
        }

        body {
    background-image: url('../public/imagenes/Fondo4.jpg');
    background-size: 100% 100%;
    background-repeat: no-repeat;
    background-attachment: fixed;
}

   
    </style>
</head>
<body>
<h1 class="salidamensaje">Sesión Finalizada</h1>
<p class="gracias">Gracias por utilizar nuestro sitio web</p>

    
    <!-- Botón de regresar al inicio -->
    <a href="index.php" class="regresar-btn">Regresar al inicio</a>

</body>
</html>
