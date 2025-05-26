<?php
$servidor = "localhost";
$usuario = "root";       // o el usuario que uses para MySQL
$contraseña = "root";        // escribe aquí la contraseña si tiene
$basedatos = "traslados_obras"; // cambia por el nombre real de tu base de datos

$conexion = new mysqli($servidor, $usuario, $contraseña, $basedatos);

if ($conexion -> connect_error) {
    die("conexion fallida" . $conexion -> connect_eror);
} 

