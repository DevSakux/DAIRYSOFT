<?php
// Aquí deberías tener código para verificar si el usuario ha iniciado sesión y obtener sus datos desde la sesión o la base de datos.
$nombre_usuario = "Usuario";
$rol_usuario = "";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SoftwareDairysoft</title>
    <style>
        body {
            background: linear-gradient(to bottom right, #2ecc71, #27ae60); /* Fondo degradado verde */
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }
        
        #container {
            max-width: 1200px;
            margin: 0 auto;
        }
        
        #header {
            padding: 20px;
            text-align: center;
        }
        
        h1 {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
            display: inline-block;
        }
        
        #menu {
            background-color: rgba(255, 255, 255, 0.8);
            text-align: center;
            padding: 10px 0;
        }
        
        ul {
            list-style-type: none;
            padding: 0;
            text-align: top;
            display: table;
            margin: auto;
        }
        
        ul li {
            display: inline-block;
            margin: 0 80px;
            position: relative; /* Añadimos posición relativa */
        }
        
        ul ul {
            display: none;
            position: absolute;
            background-color: rgba(255, 255, 255, 0.8);
            padding: 15px;
            border-radius: 5px;
            top: 100%; /* Posicionamos el submenu por debajo del elemento padre */
            left: 0;
        }
        
        ul li:hover ul {
            display: block;
        }
        
        #cerrar-sesion {
            float: right;
            background-color: rgba(255, 255, 255, 0.8);
            padding: 5px 10px;
            border-radius: 5px;
            margin-top: 10px;
        }
        
        #user-info {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 10px;
            border-radius: 5px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div id="container">
        <div id="header">
            <h1>Bienvenido Dairysoft</h1>
            <a href="cerrar_sesion.php" id="cerrar-sesion">Cerrar sesión</a>
            <div id="user-info"><?php echo $nombre_usuario; ?> (<?php echo $rol_usuario; ?>)</div>
        </div>
        <div id="menu">
            <ul>
                <li>Proveedor
                    <ul>
                        <li>Seguimiento</li>
                        <li>Proporcionar informe</li>
                    </ul>
                </li>
                <li>Insumos
                    <ul>
                        <li>Registro de datos</li>
                        <li>Verificación de asistencias</li>
                        <li>Agregar número único de serie</li>
                        <li>Registro de entrada</li>
                    </ul>
                </li>
                <li>Productos
                    <ul>
                        <li>Control de cantidad</li>
                        <li>Alertas de vencimiento</li>
                        <li>Registro de salida</li>
                    </ul>
                </li>
            </ul>
        </div>
        <div id="contenido">
            <!-- Contenido de la página -->
        </div>
    </div>
</body>
</html>
