<?php
$servername = "localhost";
$username = "d42024"; 
$password = "1234"; 
$database = "planilla";


//conexión
$conn = new mysqli($servername, $username, $password, $database);


if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
} 
?>
