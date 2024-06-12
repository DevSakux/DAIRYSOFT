<?php
include "../Servicios/Auth/seguridad.php";
include "../Controladores/DatosDashboardController.php";

$datosDashboardController = new DatosDashboardController();

$total_usuarios = $datosDashboardController->getTotalUsuarios();
$total_administradores = $datosDashboardController->getTotalAdministradores();
$total_revision = $datosDashboardController->getTotalRevision();

$datosDashboardController->cerrarConexion();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Animated Login Form using Html & CSS Only</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Quicksand', sans-serif;
    }
    body {
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      background: #000;
    }

    section {
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 2px;
      flex-wrap: wrap;
      overflow: hidden;
    }

    @keyframes animate {
      0% {
        transform: translateY(-100%);
      }

      100% {
        transform: translateY(100%);
      }
    }

    section span {
      position: relative;
      display: block;
      width: calc(6.25vw - 2px);
      height: calc(6.25vw - 2px);
      background: #181818;
      z-index: 2;
      transition: 1.5s;
    }

    section span:hover {
      background: #0f0;
      transition: 0s;
    }

    .user,
    .producto,
    .revision,
    .alertas,
    .admin,
    .menudai {
      background: #222;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 10px;
      border-radius: 1px;
      box-shadow: 0 4px 25px rgba(0, 0, 0, 9);
      margin: 10px;
      width: 400px;
    }

    .user .content,
    .producto .content,
    .revision .content,
    .alertas .content,
    .admin .content,
    .menudai .content {
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
      gap: 1px;
    }

    .user .content h2,
    .producto .content h2,
    .revision .content h2,
    .alertas .content h2,
    .admin .content h2,
    .menudai .content h2 {
      font-size: 2em;
      color: #0f0;
      text-transform: uppercase;
    }

    .user {
      width: calc(50% - 30px);
    }

    .producto {
      width: calc(50% - 30px);
    }

    .revision {
      width: calc(50% - 30px);
    }

    .alertas {
      width: calc(50% - 30px);
    }

    .admin {
      width: calc(100% - 30px);
    }

    .menudai {
      width: calc(100% - 30px);
    }

    .menudai .content {
      text-align: left;
      display: flex;
      flex-direction: row;
      align-items: center;
    }

    .menudai .content img {
      width: 200px; /* Adjust width as needed */
      height: auto; /* Maintain aspect ratio */
      margin-right: 350px; /* Space between image and text */
      margin-left: 120px; /* Move image to the left */
    }

    .menudai .content .text {
      max-width: 600px; /* Adjust max width as needed */
    }

    .menudai .content .text h2 {
      font-size: 24px;
      margin-bottom: 10px;
    }

    .menudai .content .text h1 {
      font-size: 14px;
      color: white;
      margin: 5px 0;
    }
  </style>
</head>

<body>
  <section>
    <div class="menudai">
      <div class="content">
        <img src="../public/imagenes/logo.jpg">
        <div class="text">
          <h2>¡BIENVENIDO ADMINISTRADOR!</h2>
          <h1>Como administrador, tus funciones incluyen:</h1>
          <h1>1. Aceptar a los usuarios en estado de revisión para que obtengan el rol que eligieron al registrarse y acceder al programa</h1>
          <h1>2. Consultar, modificar o eliminar usuarios, Agregar nuevos usuarios</h1>
          <h1>3. Generar informes</h1>
          <h1>4. Observar alertas de vencimiento</h1>
          <h1>5. Observar movimientos</h1>
          <h1>6. Revisar plataforma completa</h1>
          <h1>7. Ver Entradas y Salidas</h1>
          <h1>8. Ver Historial</h1>
        </div>
      </div>
    </div>

    <div class="user">
      <div class="content">
        <h2>EMPLEADOS</h2>
        <hr style="border-top: 1px solid #8bc34a; width: 400px;"> <!-- Línea verde -->
        <h2><i class="fas fa-users" style="font-size: 2em;"></i></h2>
        <h2><?php echo $total_usuarios; ?> REGISTRADOS</h2> <!-- Mostrar el total de usuarios -->
      </div>
    </div>

    <div class="producto">
      <div class="content">
        <h2>PRODUCTOS</h2>
        <hr style="border-top: 1px solid #8bc34a; width: 400px;"> <!-- Línea verde -->
        <h2><i class="fas fa-box" style="font-size: 2em;"></i></h2>
        <h2><?php echo $total_usuarios; ?> REGISTRADOS</h2> <!-- Mostrar el total de usuarios -->
      </div>
    </div>

    <div class="revision">
      <div class="content">
        <h2>Revision</h2>
        <hr style="border-top: 1px solid #8bc34a; width: 400px;"> <!-- Línea verde -->
        <h2><i class="fas fa-clock" style="font-size: 2em;"></i></h2>
        <h2><?php echo $total_revision; ?> USUARIOS </h2> <!-- Mostrar el total de usuarios -->
      </div>
    </div>

    <div class="alertas">
      <div class="content">
        <h2>Alertas</h2>
        <hr style="border-top: 1px solid #8bc34a; width: 400px;"> <!-- Línea verde -->
        <h2><i class="fas fa-exclamation-triangle" style="font-size: 2em;"></i></h2>
        <h2><?php echo $total_usuarios; ?> Alertas </h2> <!-- Mostrar el total de usuarios -->
      </div>
    </div>

    <div class="admin">
      <div class="content">
        <h2>Administradores</h2>
        <hr style="border-top: 1px solid #8bc34a; width: 865px;"> <!-- Línea verde -->
        <h2><i class="fas fa-user-tie" style="font-size: 2em;"></i></h2>
        <h2><?php echo $total_administradores; ?> STAFF</h2>
      </div>
    </div>
  </section>
</body>

</html>
