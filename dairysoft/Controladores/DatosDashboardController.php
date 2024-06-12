<?php

class DatosDashboardController
{
    private $host = "localhost";
    private $usuario = "root";
    private $contrasena = "";
    private $base_de_datos = "Dairysoft";
    private $conexion;

    public function __construct()
    {
        $this->conexion = mysqli_connect($this->host, $this->usuario, $this->contrasena, $this->base_de_datos);

        if (!$this->conexion) {
            die("Error de conexión: " . mysqli_connect_error());
        }
    }

    public function getTotalUsuarios()
    {
        $sql = "SELECT COUNT(*) AS total_usuarios FROM tbl_usuarios WHERE rol_id = 2";
        $resultado = mysqli_query($this->conexion, $sql);

        if ($resultado) {
            $fila = mysqli_fetch_assoc($resultado);
            return $fila['total_usuarios'];
        } else {
            return "Error al obtener el total de usuarios";
        }
    }

    public function getTotalAdministradores()
    {
        $sql = "SELECT COUNT(*) AS total_administradores FROM tbl_usuarios WHERE rol_id = '1'";
        $resultado = mysqli_query($this->conexion, $sql);

        if ($resultado) {
            $fila = mysqli_fetch_assoc($resultado);
            return $fila['total_administradores'];
        } else {
            return "Error al obtener el total de administradores";
        }
    }

    public function getTotalRevision()
    {
        $sql = "SELECT COUNT(*) AS total_revision FROM tbl_usuarios WHERE rol_id = '3'";
        $resultado = mysqli_query($this->conexion, $sql);

        if ($resultado) {
            $fila = mysqli_fetch_assoc($resultado);
            return $fila['total_revision'];
        } else {
            return "Error al obtener el total de Revisiones";
        }
    }

    public function cerrarConexion()
    {
        mysqli_close($this->conexion);
    }
}

?>
