<?php
include('../Servicios/Auth/conexion.php');

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];
    $fecha_nacimiento = $_POST['año'] . '-' . $_POST['mes'] . '-' . $_POST['dia'];
    $rol_id = 3; // Por defecto, asignar el rol de "Revision"

    // Verificar si el correo ya está registrado
    $sql_verificar = "SELECT * FROM tbl_usuarios WHERE correo = '$correo'";
    $resultado = mysqli_query($conex, $sql_verificar);
    if (mysqli_num_rows($resultado) > 0) {
        // El correo ya está registrado, redirigir con mensaje de error
        session_start();
        $_SESSION['mensaje'] = 'El correo ya está registrado, intenta con otro diferente!';
        header("Location: ../vistas/registro.php");
        exit;
    }

    // Encriptar la contraseña
    $contrasenaEncriptada = password_hash($contrasena, PASSWORD_BCRYPT);

    // Preparar la consulta SQL para insertar los datos
    $sql = "INSERT INTO tbl_usuarios (nombre, apellido, correo, contrasena, fecha_nacimiento, rol_id) 
            VALUES ('$nombre', '$apellido', '$correo', '$contrasenaEncriptada', '$fecha_nacimiento', $rol_id)";

    // Ejecutar la consulta
    if (mysqli_query($conex, $sql)) {
        // Redirigir a la página de registro exitoso
        header("Location: registro_exitoso.php");
        exit;
    } else {
        // Redirigir a la página de registro con mensaje de error
        header("Location: ../vistas/registro.php");
        exit;
    }

} else {
    // Si no se ha enviado el formulario, redirigir al formulario de registro
    header("Location: ../vistas/registro.php");
    exit;
}
?>
