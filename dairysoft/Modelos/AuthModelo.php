<?php

class AuthModelo {
    private $conex;

    public function __construct($conex) {
        $this->conex = $conex;
    }

    public function autenticarUsuario($correo, $contrasena) {
        // Consultar el usuario y la contraseña encriptada
        $consultaUser = "SELECT id, nombre, apellido, correo, contrasena, rol_id FROM tbl_usuarios WHERE correo='$correo'";
        $resultado = mysqli_query($this->conex, $consultaUser);
        $filas = mysqli_fetch_array($resultado);

        if ($filas) {
            // Verificar la contraseña encriptada
            if (password_verify($contrasena, $filas['contrasena'])) {
                return array(
                    'id' => $filas['id'],
                    'nombre' => $filas['nombre'],
                    'apellido' => $filas['apellido'],
                    'correo' => $filas['correo'],
                    'rol_id' => $filas['rol_id']
                );
            } else {
                return false; // Contraseña incorrecta
            }
        } else {
            return false; // Usuario no encontrado
        }

        mysqli_free_result($resultado);
    }
}
?>
