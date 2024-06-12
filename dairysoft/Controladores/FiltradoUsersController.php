<?php
// Iniciar la sesión (si es necesario)
session_start();

// Incluir la conexión a la base de datos
include('../Servicios/Auth/conexion.php');

// Obtener el rol seleccionado desde la solicitud GET
$rolSeleccionado = isset($_GET['rol']) ? intval($_GET['rol']) : 0;

if ($rolSeleccionado) {
    // Consulta SQL para seleccionar usuarios por rol_id
    $sql = "SELECT u.id, u.nombre, u.apellido, u.correo, r.nombre AS rol, u.fecha_nacimiento, u.fecha_registro
            FROM tbl_usuarios u
            INNER JOIN tbl_roles r ON u.rol_id = r.id
            WHERE u.rol_id = ?";
    $stmt = $conex->prepare($sql);
    $stmt->bind_param("i", $rolSeleccionado);
    $stmt->execute();
    $resultado = $stmt->get_result();

    // Verificar si se encontraron resultados
    if ($resultado->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>ID</th><th>Nombre</th><th>Apellido</th><th>Correo</th><th>Rol</th><th>Fecha de Nacimiento</th><th>Fecha de Registro</th><th>Acciones</th></tr>";

        // Iterar sobre los resultados y mostrarlos en una tabla
        while ($fila = $resultado->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $fila['id'] . "</td>";
            echo "<td>" . $fila['nombre'] . "</td>";
            echo "<td>" . $fila['apellido'] . "</td>";
            echo "<td>" . $fila['correo'] . "</td>";
            echo "<td>" . $fila['rol'] . "</td>";
            echo "<td>" . $fila['fecha_nacimiento'] . "</td>";
            echo "<td>" . $fila['fecha_registro'] . "</td>";
            echo "<td class='actions'><a class='editar' href='modificar.php?id=" . $fila['id'] . "'><i class='fas fa-edit'></i></a> <a class='eliminar' href='eliminarusuario.php?id=" . $fila['id'] . "'><i class='fas fa-trash-alt'></i></a></td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "No se encontraron usuarios.";
    }

    $stmt->close();
} else {
    // Consulta SQL para seleccionar todos los usuarios
    $sql = "SELECT u.id, u.nombre, u.apellido, u.correo, r.nombre AS rol, u.fecha_nacimiento, u.fecha_registro
            FROM tbl_usuarios u
            INNER JOIN tbl_roles r ON u.rol_id = r.id";
    $resultado = $conex->query($sql);

    // Verificar si se encontraron resultados
    if ($resultado->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>ID</th><th>Nombre</th><th>Apellido</th><th>Correo</th><th>Rol</th><th>Fecha de Nacimiento</th><th>Fecha de Registro</th><th>Acciones</th></tr>";

        // Iterar sobre los resultados y mostrarlos en una tabla
        while ($fila = $resultado->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $fila['id'] . "</td>";
            echo "<td>" . $fila['nombre'] . "</td>";
            echo "<td>" . $fila['apellido'] . "</td>";
            echo "<td>" . $fila['correo'] . "</td>";
            echo "<td>" . $fila['rol'] . "</td>";
            echo "<td>" . $fila['fecha_nacimiento'] . "</td>";
            echo "<td>" . $fila['fecha_registro'] . "</td>";
            echo "<td class='actions'><a class='editar' href='modificar.php?id=" . $fila['id'] . "'><i class='fas fa-edit'></i></a> <a class='eliminar' href='eliminarusuario.php?id=" . $fila['id'] . "'><i class='fas fa-trash-alt'></i></a></td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "No se encontraron usuarios.";
    }
}

// Cerrar la conexión
$conex->close();
?>
