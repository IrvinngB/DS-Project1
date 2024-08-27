<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "d42024";
$password = "1234";
$dbname = "planilla";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta para obtener las provincias
$sql = "SELECT id_provincia, nombre_provincia FROM provincia";
$result = $conn->query($sql);

$provincias = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $provincias[] = array("id" => $row["id_provincia"], "nombre" => $row["nombre_provincia"]);
    }
}

// Cerrar la conexión
$conn->close();

// Devolver los datos como JSON
echo json_encode($provincias);
?>
