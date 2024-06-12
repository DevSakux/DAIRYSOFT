<?php
// Verificar si se ha enviado el ID del usuario a eliminar
if (isset($_POST['userId'])) {
    // Obtener el ID del usuario a eliminar
    $usuario_id = $_POST['userId'];
    
    // Realizar la conexión a la base de datos (asegúrate de tener la conexión correctamente configurada)
    include('../Servicios/Auth/conexion.php');

    // Consulta SQL para eliminar el usuario
    $sql = "DELETE FROM tbl_usuarios WHERE id = $usuario_id";

    // Ejecutar la consulta
    if (mysqli_query($conex, $sql)) {
        // Cerrar la conexión
        mysqli_close($conex);
        // Redireccionar de vuelta a la página Usuarios.php
        header('Location: ../Vistas/Usuarios.php');
        exit(); // Asegurarse de que el script se detenga después de la redirección
    } else {
        echo "Error al eliminar el usuario: " . mysqli_error($conex);
    }
} else {
    echo "ID de usuario no proporcionado.";
}
?>
