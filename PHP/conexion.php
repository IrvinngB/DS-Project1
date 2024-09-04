<?php
$servername = "localhost";
$username = "d42024"; 
$password = "1234"; 
$database = "planilla";


// Crear la conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
} 
?>
