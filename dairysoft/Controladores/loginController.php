<?php 
include('../Servicios/Auth/conexion.php');
include('../Modelos/AuthModelo.php'); 

$usuario = $_POST['correo'];
$contraseña = $_POST['contrasena'];
$mensaje_error = "";
session_start();

$_SESSION['correo'] = $usuario;

// Crear una instancia del modelo AuthModelo
$modeloAuth = new AuthModelo($conex);

// Llamar al método autenticarUsuario del modelo para verificar las credenciales
$datosUsuario = $modeloAuth->autenticarUsuario($usuario, $contraseña);

if ($datosUsuario) {
    $_SESSION['nombre_usuario'] = $datosUsuario['nombre'];
    $_SESSION['apellido_usuario'] = $datosUsuario['apellido']; // Agregar el apellido a la sesión

    // Redireccionar según el rol del usuario
    switch ($datosUsuario['rol_id']) {
        case 1: // Administrador
            header("Location: ../vistas/pagina.php");
            exit(); // Salir del script después de redirigir
            break;
        case 2: // Empleado
            header("Location: ../vistas/paginaempleados.php");
            exit(); // Salir del script después de redirigir
            break;
        case 3: // Revisión
            header("Location: ../vistas/paginarevision.php");
            exit(); // Salir del script después de redirigir
            break;
    }
} else {
    // Si las credenciales son incorrectas, establecer un mensaje de error
    $mensaje_error = "¡Correo electrónico o contraseña incorrectos!";
    $_SESSION['mensaje_error'] = $mensaje_error;
    header("Location: ../vistas/index.php"); // Redireccionar de nuevo a la página de inicio de sesión
    exit();
}

?>
