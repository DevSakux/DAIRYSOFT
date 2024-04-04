<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
    <style>
        body {
            background-image: url('buenas3.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        .signin {
            position: absolute;
            width: 400px;
            background: rgba(34, 34, 34, 0.8);
            backdrop-filter: blur(10px);
            z-index: 1000;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px;
            border: 1px solid rgba(0, 128, 0, 0.9);
            border-radius: 3px;
            box-shadow: 0 0 5px rgba(0, 128, 0, 0.9), 0 0 10px rgba(0, 128, 0, 0.9);
        }

        .content {
            color: #fff;
            text-align: center;
        }

        .form {
            width: 100%; /* Ajuste del ancho */
            padding: 20px;
        }

        .inputBox {
            position: relative;
            margin-bottom: 20px;
        }

        .inputBox input,
        .inputBox select {
            width: calc(100% - 22px); /* Ajuste del ancho */
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
            background: rgba(255, 255, 255, 0.5);
            color: #333;
            font-size: 16px;
        }

        .inputBox i {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            pointer-events: none;
            color: #ccc;
        }

        .inputBox input[type="submit"] {
            background-color: #8bc34a;
            color: #fff;
            border: none;
            cursor: pointer;
            font-size: 18px;
            transition: all 0.3s ease;
            width: calc(100% - 22px); /* Ajuste del ancho */
        }

        .inputBox input[type="submit"]:hover {
            background-color: #689f38;
        }

        .back-link {
            color: #8bc34a;
            text-decoration: none;
            display: block;
            margin-top: 20px;
        }

        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <section>
        <div class="signin">
            <div class="content">
                <h2>¡Regístrate!</h2>
                <div class="form">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="inputBox">
                            <input type="text" name="nombre" required> <i>Nombre</i>
                        </div>
                        <div class="inputBox">
                            <input type="text" name="apellido" required> <i>Apellido</i>
                        </div>
                        <div class="inputBox">
                            <input type="email" name="correo" required> <i>Correo electrónico</i>
                        </div>
                        <div class="inputBox">
                            <input id="passwordInput" type="password" name="contrasena" required> <i>Contraseña</i>
                        </div>
                        <div class="inputBox">
                            <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
                            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" required>
                        </div>
                        <div class="inputBox">
                            <input type="submit" value="Registrarse" name="submit"> <!-- Agregamos el atributo name -->
                        </div>
                    </form>
                    <?php
                    // Procesar el formulario cuando se envie
                    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
                        // Conexión a la base de datos (reemplaza los valores con los tuyos)
                        $servername = "localhost";
                        $username = "root"; // Reemplaza 'nombre_usuario' con el nombre de usuario correcto
                        $password = ""; // Reemplaza 'contraseña' con la contraseña correcta
                        $dbname = "dairysoft";

                        // Crear conexión
                        $conn = new mysqli($servername, $username, $password, $dbname);

                        // Verificar conexión
                        if ($conn->connect_error) {
                            die("Conexion fallida: " . $conn->connect_error);
                        }

                        $stmt = $conn->prepare("INSERT INTO usuarios (nombre, apellido, correo, contrasena, fecha_nacimiento, rol_id) VALUES (?, ?, ?, ?, ?, ?)");
                        if($stmt === false) {
                            die('Error al preparar la consulta SQL: ' . $conn->error);
                        }
                        $stmt->bind_param("sssssi", $nombre, $apellido, $correo, $contrasena, $fecha_nacimiento, $rol_id);

                        // Establecer los parámetros y ejecutar
                        $nombre = $_POST['nombre'];
                        $apellido = $_POST['apellido'];
                        $correo = $_POST['correo'];
                        $contrasena = $_POST['contrasena'];
                        $fecha_nacimiento = $_POST['fecha_nacimiento'];
                        $rol_id = 3; // Por ejemplo, asignamos el rol de "Empleado" por defecto

                        if ($stmt->execute()) {
                            echo "<p>Registro exitoso.</p>";
                        } else {
                            echo "Error: " . $stmt->error;
                        }

                        // Cerrar la conexión
                        $stmt->close();
                        $conn->close();
                    }
                    ?>
                </div>
                <a href="index.php" class="back-link">Volver al inicio</a>
            </div>
        </div>
    </section>
</body>
</html>
