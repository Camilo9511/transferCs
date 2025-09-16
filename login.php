<?php
session_start();
require 'config.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'];
    $clave = $_POST['contraseña'];

    $sql = "SELECT * FROM usuarios WHERE usuario = ? AND contraseña = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ss", $usuario, $clave);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $row = $resultado->fetch_assoc(); 
    
        $_SESSION['usuario'] = $usuario;
        $_SESSION['usuario_id'] = $row["id"]; 
    
        header("Location: index.php");
        exit();
    } else {
        echo "<script>
            alert('Credenciales incorrectas');
            window.location.href = 'login.php';
          </script>";
    }
    
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
        <a href="index.html">


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
        <a class="navegacion__enlace" href="login.php"><i class="fa-solid fa-user"></i></a>
    </nav>
    <main class="contenedor">
       <div class="contenedor__formulario">
        <h2>Iniciar sesión</h2>
        <form action="" method="POST" class="formulario">
            <div class="campo">
                <label for="usuario">Usuario</label>
                <input type="text" name="usuario" id="usuario" placeholder="Tu usuario" required>
            </div>
            <div class="campo">
                <label for="clave">Contraseña</label>
                <input type="password" name="contraseña" id="contraseña" placeholder="Tu contraseña" required>
            </div>
            <div class="boton">
                <input type="submit" value="Ingresar">
            </div>
        </form>
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
</body>
</html>
