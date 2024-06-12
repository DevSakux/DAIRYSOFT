<?php 
include "../Servicios/Auth/seguridad.php";
include "../Servicios/Auth/conexion.php";


?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario</title>
    <link rel="stylesheet" href="../public/css/style.css?v=<?php echo time(); ?>">
    <!-- Incluir estilos del plugin Malihu custom scrollbar -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    
</head>
<body>
    <div class="menu" id="menu">
        <div class="footer">
            <div class="dairysoft-box">
         
   <!-- Icono para ocultar menu -->
   <a href="#" class="icon-button2">
    <i class="fas fa-eye-slash"></i>
</a>

<a href="editarperfil.php"  target="iframeContent" class="icon-button">
    <i class="fas fa-cog"></i>
</a>

<a href="#" class="icon-button">
    <i class="fas fa-bell"></i>
</a>
            
<a href="logout.php" class="icon-button">
    <i class="fas fa-power-off"></i>
</a>


<div class="profile2">
    <p class="user-name">
        <?php 
            $nombre = isset($_SESSION['nombre_usuario']) ? $_SESSION['nombre_usuario'] : 'Nombre';
            $apellido = isset($_SESSION['apellido_usuario']) ? $_SESSION['apellido_usuario'] : 'Apellido';
            echo $nombre . ' ' . $apellido;
        ?>
    </p>
    <img src="../public/imagenes/silueta.png" alt="Silueta de persona">
</div>

            </div>
            <div class="profile">
                <div class="profile-title">DAIRYSOFT</div> <!-- Agregar este div -->
                <img src="../public/imagenes/silueta.png" alt="Silueta de persona">
                <p> <?php 
            $nombre = isset($_SESSION['nombre_usuario']) ? $_SESSION['nombre_usuario'] : 'Nombre';
            $apellido = isset($_SESSION['apellido_usuario']) ? $_SESSION['apellido_usuario'] : 'Apellido';
            echo $nombre . ' ' . $apellido;
        ?></p>
            </div>
            <ul class="sections">
                <li> <a href="Dashboard.php" target="iframeContent"><i class="fas fa-cube"></i> Dashboard</a></li>
                <li><a href="Usuarios.php" target="iframeContent"><i class="fas fa-users"></i> Usuarios</a></li>
                <li><a href="Insumos.php" target="iframeContent"><i class="fas fa-tools"></i> Insumos</a></li>
                <li><a href="productos.php" target="iframeContent"><i class="fas fa-box"></i> Productos</a></li>
                <li><a href="RegistroSalida.php" target="iframeContent"><i class="fas fa-chart-bar"></i> Ventas</a></li>
                <li><a href="Stock.php" target="iframeContent"><i class="fas fa-exchange-alt"></i> Movimientos</a></li>
                <li><a href="fechainventario.php" target="iframeContent"><i class="fas fa-exclamation-triangle"></i> Alertas</a></li>
                <li><a href="Controldecalidad.php" target="iframeContent"><i class="fas fa-history"></i> Historial</a></li>
                <li><a href="Facturas.php" target="iframeContent"><i class="fas fa-file-invoice"></i> Facturas</a></li>


                <!-- Agrega más secciones según sea necesario -->
                <li class="extra-space"></li>
            </ul>
            <div class="iframe-container">
                <iframe name="iframeContent"></iframe>
            </div>
        </div>
        <ul class="sections">
            <!-- Tus enlaces de secciones aquí -->
            <li class="copyright">&copy; DairySoft 2024</li>
        </ul>
    </div>

    <!-- Incluir jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Incluir el plugin Malihu custom scrollbar -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
    <script>
        $(document).ready(function(){
            // Inicializar el plugin Malihu custom scrollbar en el menú lateral
            $("#menu").mCustomScrollbar({
                theme: "dark",
                scrollbarPosition: "inside",
                scrollButtons: { enable: true }
            });
        });
    </script>
    <script>
        // Función para guardar la URL actual en el historial
        function guardarHistorial(url) {
            if (window.history.state) {
                window.history.replaceState({ page: url }, '', '');
            } else {
                window.history.pushState({ page: url }, '', '');
            }
        }
        // Funcion para cargar la URL del historial al cargar la pagina
        window.onload = function() {
            var url = window.history.state ? window.history.state.page : 'dashboard.php';
            document.getElementsByName('iframeContent')[0].src = url;
        }
        // Funcion para cambiar la URL del historial cuando se hace clic en un enlace del menu
        $(document).ready(function() {
            $('ul.sections li a').click(function() {
                var url = $(this).attr('href');
                document.getElementsByName('iframeContent')[0].src = url; // Cambia la URL del iframe
                guardarHistorial(url); // Guarda la URL en el historial
                return false; // Evita que el enlace realice su acción predeterminada
            });
        });
    </script>
</body>
</html>
