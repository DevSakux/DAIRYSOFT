<?php
// Verificar si se ha enviado un formulario para eliminar el insumo
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se ha enviado el nombre del insumo a eliminar
    if(isset($_POST['nombre']) && !empty($_POST['nombre'])) {
        // Incluir el archivo de conexión
        require_once('../Servicios/Auth/conexion.php');

        // Sanitizar el nombre del insumo a eliminar
        $nombre = mysqli_real_escape_string($conex, $_POST['nombre']);

        // Query para eliminar el insumo
        $query = "DELETE FROM tbl_insumos WHERE nombre = '$nombre'";

        // Ejecutar la consulta
        if(mysqli_query($conex, $query)) {
            // Redireccionar a la página de insumos después de eliminar el insumo
            header("Location: ../Vistas/insumos.php");
            exit();
        } else {
            // Si hay un error al eliminar el insumo, mostrar el mensaje de error
            echo "Error al eliminar el insumo: " . mysqli_error($conex);
        }

        // Cerrar la conexión
        mysqli_close($conex);
    } else {
        // Si no se proporcionó un nombre de insumo válido, mostrar un mensaje de error
        echo "No se proporcionó un nombre de insumo válido.";
    }
} else {
    // Si no se recibió una solicitud POST, redireccionar a la página de insumos
    header("Location: ..Vistas/insumos.php");
    exit();
}
?>
