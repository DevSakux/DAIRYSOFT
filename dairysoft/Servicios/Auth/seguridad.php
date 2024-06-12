<?php 
// Seguridad de paginación 
session_start();

// Verificar si 'correo' está definido en la sesión
if (!isset($_SESSION['correo'])) {
    echo '<script>
              alert("Sesión cerrada por seguridad");
              window.location = "index.php";
          </script>';
    die();
}

// Conexión a la base de datos
include('../Servicios/Auth/conexion.php');

// Ahora se puede acceder a $_SESSION['correo'] con seguridad
$varsesion = $_SESSION['correo'];

// Consulta SQL para obtener el rol del usuario
$sql = "SELECT rol_id FROM tbl_usuarios WHERE correo = '$varsesion'";
$result = mysqli_query($conex, $sql);

// Verificar si se encontró el usuario
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $rol_id = $row['rol_id'];

    // Verificar si el rol es 3 (Revisión)
    if ($rol_id == 3) {
        echo '<script>
                  alert("Acceso denegado");
                  window.location = "index.php";
              </script>';
        die();
    }
} else {
    // Manejar el caso en que el usuario no se encontró en la base de datos
    echo '<script>
              alert("Usuario no encontrado");
              window.location = "index.php";
          </script>';
    die();
}
?>
