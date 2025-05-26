<?php
// Conexión con la base de datos
$servername = "localhost";
$username = "root";  // Usuario de MySQL
$password = "root";  // Contraseña de MySQL
$dbname = "traslados_obras"; // Nombre de la base de datos

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar si la conexión fue exitosa
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Datos del usuario
$usuario = "camilo";
$contraseña = "1234";  // La contraseña que deseas guardar

// Hashear la contraseña
$contraseña_hash = password_hash($contraseña, PASSWORD_DEFAULT);

// Insertar el nuevo usuario en la base de datos
$sql = "INSERT INTO usuarios (usuario, contraseña) VALUES ('$usuario', '$contraseña_hash')";

if ($conn->query($sql) === TRUE) {
    echo "Usuario creado correctamente";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
