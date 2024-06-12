<?php
// Incluir el archivo de seguridad para evitar el acceso directo al script
include "../Servicios/Auth/seguridad.php";
// Incluir el archivo de conexión a la base de datos
include "../Servicios/Auth/conexion.php";

// Verificar si se recibió el ID del usuario a denegar mediante POST
if(isset($_POST['userId'])) {
    // Obtener el ID del usuario a denegar
    $userId = $_POST['userId'];

    // Consulta SQL para eliminar al usuario de la base de datos
    $sql = "DELETE FROM tbl_usuarios WHERE id = $userId";

    // Ejecutar la consulta
    if(mysqli_query($conex, $sql)) {
        // Si la consulta se ejecuta correctamente, redirigir a la página de usuarios con un mensaje de éxito
        header("Location: ../Vistas/admitir.php?mensaje=Usuario denegado correctamente.");
        exit();
    } else {
        // Si hay un error en la consulta, redirigir a la página de usuarios con un mensaje de error
        header("Location: ../Vistas/admitir.php?mensaje=Error al denegar el usuario. Por favor, inténtalo de nuevo.");
        exit();
    }
} else {
    // Si no se recibió el ID del usuario, redirigir a la página de usuarios con un mensaje de error
    header("Location: ../Vistas/admitir?mensaje=No se proporcionó un ID de usuario válido para denegar.");
    exit();
}
?>
