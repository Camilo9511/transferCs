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
        <a class="navegacion__enlace cerrar" href="logOut.php">Cerrar Sesion</a>
    </nav>
    <main class="contenedor">

        <h2 >Control Traslados</h2>
        <div class="contenedor__formulario">
            <form action="procesar.php" method="POST" class="formulario">
                <fieldset>
                    <legend>Traslado entre obras</legend>
                    <div class="campo">
                        <label>Insumo</label>
                        <input class="inputs" type="text" name="insumo" placeholder="nombre insumo">
                    </div>
                    <div class="campo">
                        <label>Còdigo de insumo</label>
                        <input class="inputs" type="tel" name="codigo" placeholder="codigo insumo">
                    </div>
                    <div class="campo">
                        <label>Cantidad</label>
                        <input class="inputs" type="number" name="cantidad" placeholder="cantidad insumo">
                    </div>
                    <div class="campo">
                        <label>Prestamo o venta</label>
                        <select class="inputs" type="text" name="tipo">
                            <option value="prestamo">Prestamo</option>
                            <option value="venta">Venta</option>
                        </select> 
                    </div>
                    <div class="campo">
                        <label>Obra que presta</label>
                        <input class="inputs" type="number" name="obra_envia" placeholder="obra que presta o vende">
                    </div>
                    <div class="campo">
                        <label>Obra a la que se traslada</label>
                        <input class="inputs" type="number" name="obra_recibe" placeholder="obra a la que se traslada">
                    </div>
                    <div class="textarea">
                        <label>Observaciones</label>
                        <textarea name="observaciones"></textarea>
                    </div>
                    <div class="boton">
                        <input  type="submit" value="enviar">
                    </div>

                </fieldset>
            </form>
           
        </div>
        <div id="modal" class="modal">
            <div class="modal-contenido">
                <p>¡Formulario enviado con éxito!</p>
                <button id="cerrar-modal">Cerrar</button>
            </div>
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