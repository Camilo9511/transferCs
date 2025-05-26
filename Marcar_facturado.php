<?php
session_start();

if (!isset($_SESSION['usuario']) || !isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['traslado_id'])) {
    $traslado_id = $_POST['traslado_id'];

    $conn = new mysqli("localhost", "root", "root", "traslados_obras");

    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    $sql = "UPDATE traslados SET estado = 'cobrado' WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $traslado_id);
    $stmt->execute();

    $stmt->close();
    $conn->close();
}

header("Location: MisTraslados.php");
exit();
?>
