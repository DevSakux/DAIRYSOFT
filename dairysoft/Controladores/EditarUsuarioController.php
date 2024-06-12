<?php
// Incluir el archivo de conexión a la base de datos
include('../Servicios/Auth/conexion.php');

// Verificar si se han enviado datos a través del método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $userId = $_POST['userId'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $correo = $_POST['correo'];
    $rol_id = $_POST['rol'];

    // Consulta SQL para actualizar los datos del usuario
    $sql = "UPDATE tbl_usuarios SET nombre = '$nombre', apellido = '$apellido', correo = '$correo', rol_id = $rol_id WHERE id = $userId";

    // Ejecutar la consulta
    if (mysqli_query($conex, $sql)) {
        // Redireccionar a la página de Usuarios.php después de la actualización
       header("Location: ../Vistas/Usuarios.php");

        exit(); // Importante salir del script después de redirigir
    } else {
        // Si hay un error en la ejecución de la consulta, mostrar un mensaje de error
        echo "Error al actualizar el usuario: " . mysqli_error($conex);
    }
} else {
    // Si no se han enviado datos a través del método POST, redireccionar a la página de Usuarios.php
    header("Location: ../Vistas/usuarios.php");
    exit(); // Importante salir del script después de redirigir
}

// Cerrar la conexión a la base de datos
mysqli_close($conex);
?>
