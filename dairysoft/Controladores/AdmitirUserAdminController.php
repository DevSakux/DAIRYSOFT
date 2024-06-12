<?php
// Incluir el archivo de conexión a la base de datos
include "../Servicios/Auth/conexion.php";

// Verificar si se ha enviado un ID de usuario a través del formulario POST
if(isset($_POST['userId'])) {
    // Obtener el ID de usuario del formulario
    $userId = $_POST['userId'];

    // Consulta SQL para actualizar el rol del usuario a "Empleado" (ID de rol 2)
    $sql = "UPDATE tbl_usuarios SET rol_id = 2 WHERE id = $userId";

    // Ejecutar la consulta
    if(mysqli_query($conex, $sql)) {
        // Redirigir a la página de administración de usuarios con un mensaje de éxito
        header("Location: ../Vistas/admitir.php?admitido=1");
        exit();
    } else {
        // Si hay un error en la consulta, mostrar un mensaje de error y redirigir
        header("Location: ../Vistas/admitir.php?error=1");
        exit();
    }
} else {
    // Si no se proporcionó un ID de usuario válido, redirigir con un mensaje de error
    header("Location: ../Vistas/admitir.php?error=1");
    exit();
}
?>
