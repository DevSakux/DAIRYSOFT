<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Recuperar Contraseña</title>
    <link rel="stylesheet" href="./style.css">
    <style>
        body {
            background-image: url('buenas3.jpg');
            background-size: cover;
            background-repeat: no-repeat;
        }
        /* Estilo para el casillero de entrada */
        .inputBox {
            position: relative;
            margin-bottom: 10px; /* Ajuste de margen inferior */
        }
        /* Estilo para el input */
        .form {
            max-width: 400px; /* Ancho máximo del formulario */
            margin: auto; /* Centrar el formulario horizontalmente */
            padding: 20px;
        }
        .inputBox input {
            position: relative;
            width: 100%;
            background: #333;
            border: none;
            outline: none;
            padding: 25px 10px 7.5px;
            border-radius: 4px;
            color: #fff;
            font-weight: 500;
            font-size: 1em;
        }
        .inputBox i {
            position: absolute;
            left: 0;
            padding: 15px 10px;
            font-style: normal;
            color: #fff;
            transition: 0.5s;
            pointer-events: none;
        }
        .inputBox input:focus ~ i,
        .inputBox input:valid ~ i {
            transform: translateY(-7.5px);
            font-size: 0.8em;
            color: #fff;
        }
        /* Estilo para el botón de enviar */
        input[type="submit"] {
            padding: 10px;
            background: #0f0;
            color: #000;
            font-weight: 600;
            font-size: 1.35em;
            letter-spacing: 0.05em;
            cursor: pointer;
            width: 100%; /* Ancho completo */
        }
        input[type="submit"]:active {
            opacity: 0.6;
        }
        /* Estilo para el enlace de regresar */
        .back-link {
            color: #8bc34a;
            text-decoration: none;
            font-weight: 600;
            font-size: 1em;
            display: block; /* Convertir en bloque para ocupar el ancho completo */
            margin-top: 20px; /* Espacio superior */
            text-align: center; /* Alinear al centro */
        }
        /* Estilo para centrar el texto */
        h2 {
            text-align: center;
            margin-bottom: 20px; /* Ajuste de margen inferior */
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
</body>
</html>
