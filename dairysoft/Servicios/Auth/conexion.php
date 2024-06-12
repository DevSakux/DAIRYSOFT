<?php
// Conexión a la base de datos
$conex = mysqli_connect("localhost", "root", "", "dairysoft");

// Verificar la conexión
if (!$conex) {
    die("Conexión fallida: " . mysqli_connect_error());
}
?>