<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit();
}

$host = "localhost";
$usuario = "root";
$password = "root";
$nombre_base_datos = "traslados_obras";

$conn = new mysqli($host, $usuario, $password, $nombre_base_datos);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

if (
    isset($_POST['insumo'], $_POST['codigo'], $_POST['cantidad'], $_POST['tipo'],
          $_POST['obra_envia'], $_POST['obra_recibe'], $_POST['observaciones'])) 
          
   

    $insumo = $_POST['insumo'];
    $codigo = $_POST['codigo'];
    $cantidad = $_POST['cantidad'];
    $tipo = $_POST['tipo'];
    $obra_envia = $_POST['obra_envia'];
    $obra_recibe = $_POST['obra_recibe'];
    $observaciones = $_POST['observaciones'];
   

    $stmt = $conn->prepare("INSERT INTO traslados (insumo, codigo, cantidad, tipo, obra_envia, obra_recibe, observaciones)
                            VALUES (?, ?, ?, ?, ?, ?, ? )");
    $stmt->bind_param("ssissss", $insumo, $codigo, $cantidad, $tipo, $obra_envia, $obra_recibe, $observaciones);

    if ($stmt->execute()) {
        header("Location: index.php?exito=1");
        exit();
    } else {
        echo "Error al guardar los datos: " . $stmt->error;
    }

    $stmt->close();

$conn->close();
?>
