<?php
include "../Servicios/Auth/seguridad.php";
// Incluir el archivo de conexión a la base de datos
include "../Servicios/Auth/conexion.php";

// Verificamos si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Verificamos si se han recibido todos los campos necesarios
    if (isset($_POST['nombreInsumo']) && isset($_POST['descripcionInsumo']) && isset($_POST['cantidadInsumo']) && isset($_POST['unidadInsumo']) && isset($_POST['precioInsumo']) && isset($_POST['codigoInsumo']) && isset($_POST['fechaCompra']) && isset($_POST['fechaLote']) && isset($_POST['fechaVencimiento']) && isset($_POST['ubicacionAlmacenamiento']) && isset($_POST['categoriaInsumo']) && isset($_POST['nombreProveedor']) && isset($_POST['contactoProveedor'])) {
        
        // Recibimos los datos del formulario
        $nombreInsumo = $_POST['nombreInsumo'];
        $descripcionInsumo = $_POST['descripcionInsumo'];
        $cantidadInsumo = $_POST['cantidadInsumo'];
        $unidadInsumo = $_POST['unidadInsumo'];
        $precioInsumo = $_POST['precioInsumo'];
        $codigoInsumo = $_POST['codigoInsumo'];
        $fechaCompra = $_POST['fechaCompra'];
        $fechaLote = $_POST['fechaLote'];
        $fechaVencimiento = $_POST['fechaVencimiento'];
        $ubicacionAlmacenamiento = $_POST['ubicacionAlmacenamiento'];
        $categoriaInsumo = $_POST['categoriaInsumo'];
        $nombreProveedor = $_POST['nombreProveedor'];
        $contactoProveedor = $_POST['contactoProveedor'];
        
        // Preparar la consulta SQL para insertar los datos en la tabla
        $sql = "INSERT INTO tbl_insumos (codigo, nombre, cantidad, unidad, precio, fecha_compra, fecha_lote, fecha_vencimiento, ubicacion, categoria, descripcion, proveedor_nombre, proveedor_contacto) VALUES ('$codigoInsumo', '$nombreInsumo', $cantidadInsumo, '$unidadInsumo', $precioInsumo, '$fechaCompra', '$fechaLote', '$fechaVencimiento', '$ubicacionAlmacenamiento', '$categoriaInsumo', '$descripcionInsumo', '$nombreProveedor', '$contactoProveedor')";
        
        // Ejecutar la consulta SQL
        if ($conex && $conex->query($sql) === TRUE) {
            // Redirigir a una página de éxito si la inserción fue exitosa
            header("Location: ../Vistas/insumos.php");
            exit();
        } else {
            // Mostrar un mensaje de error si hubo un problema con la inserción
            echo "Error al insertar datos en la base de datos: " . $conn->error;
        }
        
    } else {
        // Si no se reciben todos los campos necesarios, mostrar un mensaje de error
        echo "Error: No se han recibido todos los campos necesarios.";
    }
} else {
    // Si no se ha enviado el formulario, mostrar un mensaje de error
    echo "Error: El formulario no ha sido enviado.";
}
?>
