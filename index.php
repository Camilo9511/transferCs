<?php
session_start();  // Inicia la sesión

// Verifica si el usuario está logueado
if (!isset($_SESSION['usuario'])) {
    // Si no está logueado, redirige al login
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Builder</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Staatliches&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <link rel="stylesheet" href="css/styles.css">

</head>


<body>
    <header class="header">
        <a href="index.php">


        </a>

    </header>

    <nav class="navegacion">
        <div class="navegacion_nombre">
        <a class="navegacion_nombre titulo" href="index.php">
            <h1>TRANSFER<span class="cs">CS</span></h1>
        </a>
        </div>
        <a class="navegacion__enlace" href="MisTraslados.php">Mis Traslados</a>
        <a class="navegacion__enlace" href="registrarse.php">Traslados</a>
        <a class="navegacion__enlace" href="nosotros.php">Nosotros</a>
        <a class="navegacion__enlace cerrar" href="logOut.php">Cerrar Sesion</a>
   
        
            
    </nav>
    <main class="contenedor">

        <h2>Bienvenido, <?php echo $_SESSION['usuario']; ?></h2>
        <div class="contenedor__imagenes">
            <img class="imagenes" src="img/img1.jpg" alt="imagen 1">
            <img class="imagenes" src="img/img2.jpg" alt="imagen 2">
            <img class="imagenes" src="img/img3.jpg" alt="imagen 3">
            <img class="imagenes" src="img/img4.jpg" alt="imagen 4">
            <img class="imagenes" src="img/img5.jpg" alt="imagen 5">
            <img class="imagenes" src="img/img6.jpg" alt="imagen 6">
        </div>
        <div id="lightbox" class="lightbox">
            <img id="imagen-grande" src="" alt="">
        </div>
    </main>
    <footer class="footer">
        <div class="footer_nombre">
        <a class="navegacion_nombre titulo" href="#">
           <h1>TRANSFER<span class="cs">CS</span></h1>
        </a>
        </div>
        <div class="footer_enlaceuno">
          <a class="footer__enlace" href="#"><i class="fa-solid fa-phone"></i></a>
          <a class="footer__enlace" href="#"><i class="fa-brands fa-whatsapp"></i></a>
          <a class="footer__enlace" href="#"><i class="fa-brands fa-instagram"></i></a>
          <a class="footer__enlace" href="#"><i class="fa-brands fa-facebook"></i></a>
        </div>    
        
    </footer>
 <script src="src/js/app.js"></script>
</body>

</html>