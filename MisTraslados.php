<?php
session_start();

// Verificar que el usuario esté logueado
if (!isset($_SESSION['usuario']) || !isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit();
}

$usuario_id = $_SESSION['usuario_id'];

$host = "localhost";
$usuario = "root";
$password = "root";
$nombre_base_datos = "traslados_obras";

$conn = new mysqli($host, $usuario, $password, $nombre_base_datos);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener la obra asignada al usuario
$sqlObra = "SELECT obra_asignada FROM obras WHERE usuario_id = ?";
$stmt = $conn->prepare($sqlObra);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$result = $stmt->get_result();

if ($fila = $result->fetch_assoc()) {
    $obra_usuario = $fila['obra_asignada'];
} else {
    $obra_usuario = null;
}

// Si no hay obra asignada
if (!$obra_usuario) {
    echo "No tienes una obra asignada.";
    exit();
}

// Obtener traslados que envió
$sqlEnviados = "SELECT * FROM traslados WHERE obra_envia = ? AND estado = 'pendiente'";
$stmt = $conn->prepare($sqlEnviados);
$stmt->bind_param("s", $obra_usuario);
$stmt->execute();
$enviados = $stmt->get_result();

// Obtener traslados que recibió
$sqlRecibidos = "SELECT * FROM traslados WHERE obra_recibe = ? AND estado = 'pendiente'";
$stmt = $conn->prepare($sqlRecibidos);
$stmt->bind_param("s", $obra_usuario);
$stmt->execute();
$recibidos = $stmt->get_result();

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
        <h2>Mis Traslados</h2>
        
       <div class="contenedor traslados">
            <section class="enviados">
            <h3>Traslados Enviados</h3>
            <table border="1">
                <tr>
                    <th>Insumo</th>
                    <th>Código</th>
                    <th>Cantidad</th>
                    <th>Tipo</th>
                    <th>Obra Recibe</th>
                    <th>Observaciones</th>
                </tr>
                <?php while ($fila = $enviados->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($fila['insumo']) ?></td>
                    <td><?= htmlspecialchars($fila['codigo']) ?></td>
                    <td><?= htmlspecialchars($fila['cantidad']) ?></td>
                    <td><?= htmlspecialchars($fila['tipo']) ?></td>
                    <td><?= htmlspecialchars($fila['obra_recibe']) ?></td>
                    <td><?= htmlspecialchars($fila['observaciones']) ?></td>
                    <td>
                        <form action="marcar_facturado.php" method="POST" onsubmit="return confirm('¿Estás seguro de marcar este traslado como cobrado?');">
                       <input type="hidden" name="traslado_id" value="<?= $fila['id'] ?>">
                       <button type="submit">✔️ Pendiente</button>
                       </form>
                       </td>
                </tr>
                <?php endwhile; ?>
            </table>
            </section>

            <section class="recibidos">
            <h3>Traslados Recibidos</h3>
            <table border="1">
                <tr>
                    <th>Insumo</th>
                    <th>Código</th>
                    <th>Cantidad</th>
                    <th>Tipo</th>
                    <th>Obra Envía</th>
                    <th>Observaciones</th>
                </tr>
                <?php while ($fila = $recibidos->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($fila['insumo']) ?></td>
                    <td><?= htmlspecialchars($fila['codigo']) ?></td>
                    <td><?= htmlspecialchars($fila['cantidad']) ?></td>
                    <td><?= htmlspecialchars($fila['tipo']) ?></td>
                    <td><?= htmlspecialchars($fila['obra_envia']) ?></td>
                    <td><?= htmlspecialchars($fila['observaciones']) ?></td>
                </tr>
                <?php endwhile; ?>
            </table>
         </section>
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
 <?php
 $stmt->close();
 $conn->close();
 ?>

</body>

</html>


