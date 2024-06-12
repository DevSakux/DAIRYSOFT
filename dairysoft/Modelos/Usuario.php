// Usuario.php (Modelo)
<?php
class Usuario {
    private $conex;

    public function __construct($conex) {
        $this->conex = $conex;
    }

    public function verificarCorreoExistente($correo) {
        $sql = "SELECT * FROM usuarios WHERE correo = '$correo'";
        $resultado = mysqli_query($this->conex, $sql);
        return mysqli_num_rows($resultado) > 0;
    }

    public function registrarUsuario($nombre, $apellido, $correo, $contrasena, $fecha_nacimiento, $rol_id) {
        $sql = "INSERT INTO usuarios (nombre, apellido, correo, contrasena, fecha_nacimiento, rol_id) 
                VALUES ('$nombre', '$apellido', '$correo', '$contrasena', '$fecha_nacimiento', $rol_id)";
        return mysqli_query($this->conex, $sql);
    }
}
?>
