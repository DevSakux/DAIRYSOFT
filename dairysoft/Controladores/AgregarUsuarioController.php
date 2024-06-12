<?php 
include "../Servicios/Auth/seguridad.php";
include('../Servicios/Auth/conexion.php');

// Recibir los datos del formulario
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$correo = $_POST['correo'];
$contrasena = $_POST['contrasena'];
$dia = $_POST['dia'];
$mes = $_POST['mes'];
$año = $_POST['año'];
$rol = $_POST['rol'];

// Concatenar los valores del día, mes y año para formar la fecha de nacimiento en formato YYYY-MM-DD
$fecha_nacimiento = "$año-$mes-$dia";

// Hash de la contraseña 
$hashed_password = password_hash($contrasena, PASSWORD_DEFAULT);

// Preparar la consulta SQL para insertar un nuevo usuario
$sql = "INSERT INTO tbl_usuarios (nombre, apellido, correo, contrasena, fecha_nacimiento, rol_id)
        VALUES ('$nombre', '$apellido', '$correo', '$hashed_password', '$fecha_nacimiento', '$rol')";

// Ejecutar la consulta
if (mysqli_query($conex, $sql)) {
    // Si el registro es exitoso, redirigir a agregarusuarioadmin.php con un parámetro de URL para indicar el éxito
    header("Location: ../vistas/agregarusuarioadmin.php?registro=exitoso&nombre=$nombre&rol=$rol");
    exit();
} else {
    // Si hay un error, redirigir a agregarusuarioadmin.php con un parámetro de URL para indicar el error
    header("Location: ../vistas/agregarusuarioadmin.php?registro=error");
    exit();
}

// Cerrar la conexión
mysqli_close($conex);
?>
