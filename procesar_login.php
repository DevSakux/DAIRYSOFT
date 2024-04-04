<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
            session_start();
            $_SESSION['correo'] = $correo; // Guardar el correo en la sesión
            header("Location: pagina.php"); // Redireccionar a bogota.html después del inicio de sesión exitoso
        } else {
            // Error de inicio de sesión
            echo "Correo electrónico o contraseña incorrectos";
        }
    } else {
        // Error en la consulta SQL
        echo "Error: " . mysqli_error($conex);
    }

    mysqli_close($conex);
}
?>
