<?php
// Incluir el archivo de conexión
require_once('../Servicios/Auth/conexion.php');

// Verificar si se proporcionó un ID de insumo en la URL y que se haya enviado el formulario
if(isset($_GET['id']) && !empty($_GET['id']) && $_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener y escapar el ID del insumo desde la URL
    $id_insumo = mysqli_real_escape_string($conex, $_GET['id']);

    // Recibir los datos del formulario
    $nombre = mysqli_real_escape_string($conex, $_POST['nombre']);
    $cantidad = mysqli_real_escape_string($conex, $_POST['cantidad']);
    $unidad = mysqli_real_escape_string($conex, $_POST['unidad']);
    $ubicacion = mysqli_real_escape_string($conex, $_POST['ubicacion']);
    $descripcion = mysqli_real_escape_string($conex, $_POST['descripcion']);
    $proveedor = mysqli_real_escape_string($conex, $_POST['proveedor']);
    $contacto_proveedor = mysqli_real_escape_string($conex, $_POST['contacto_proveedor']);

    // Query para actualizar los datos del insumo
    $query = "UPDATE tbl_insumos SET nombre='$nombre', cantidad=$cantidad, unidad='$unidad', ubicacion='$ubicacion', descripcion='$descripcion', proveedor_nombre='$proveedor', proveedor_contacto='$contacto_proveedor' WHERE codigo='$id_insumo'";

    // Ejecutar la consulta
    if(mysqli_query($conex, $query)) {
        // Redireccionar a la página de insumos con un mensaje de éxito
        header("Location: ../Vistas/insumos.php?success=update_successful");
        exit();
    } else {
        // Si hubo un error al ejecutar la consulta, mostrar un mensaje de error
        echo "Error al actualizar los datos del insumo: " . mysqli_error($conex);
    }
} else {
    // Si no se proporcionó un ID de insumo en la URL o no se envió el formulario, redireccionar a la página de insumos con un mensaje de error
    header("Location: ../Vistas/admitir.php?error=invalid_request");
    exit();
}

// Cerrar la conexión
mysqli_close($conex);
?>
