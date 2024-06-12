<?php
include('../Servicios/Auth/conexion.php');

class UserController {
    public static function filtrarUsuariosPorRol($rolSeleccionado) {
        global $conex;
        // Consulta SQL para seleccionar usuarios por rol
        $sql = "SELECT u.id, u.nombre, u.apellido, u.correo, r.nombre AS rol, u.fecha_nacimiento, u.fecha_registro
                FROM tbl_usuarios u
                INNER JOIN tbl_roles r ON u.rol_id = r.id
                WHERE r.nombre = '$rolSeleccionado'";
        
        $resultado = mysqli_query($conex, $sql);

        // Verificar si se encontraron resultados
        if (mysqli_num_rows($resultado) > 0) {
            $usuarios = [];
            // Iterar sobre los resultados y almacenarlos en un array
            while ($fila = mysqli_fetch_assoc($resultado)) {
                $usuarios[] = $fila;
            }
            return $usuarios;
        } else {
            return null;
        }
    }
}

?>
