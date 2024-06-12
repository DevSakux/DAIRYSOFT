<?php
// Incluir archivo de conexión
require_once('../Servicios/Auth/conexion.php');

// Función para obtener los datos de los insumos
function obtenerInsumos() {
    global $conex; // Acceder a la conexión global

    $sql = "SELECT * FROM tbl_insumos";
    $result = mysqli_query($conex, $sql);

    // Verificar si hay errores en la consulta
    if (!$result) {
        die("Error al obtener los datos de los insumos: " . mysqli_error($conex));
    }

    return $result;
}

// Función para obtener los datos de los proveedores
function obtenerProveedores() {
    global $conex; // Acceder a la conexión global

    $sql = "SELECT * FROM vw_proveedores";
    $result = mysqli_query($conex, $sql);

    // Verificar si hay errores en la consulta
    if (!$result) {
        die("Error al obtener los datos de los proveedores: " . mysqli_error($conex));
    }

    return $result;
}
?>
