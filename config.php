<?php
$servidor = "localhost";
$usuario = "root";       
$contraseña = "root";        
$basedatos = "traslados_obras"; 

$conexion = new mysqli($servidor, $usuario, $contraseña, $basedatos);

if ($conexion -> connect_error) {
    die("conexion fallida" . $conexion -> connect_eror);
} 

