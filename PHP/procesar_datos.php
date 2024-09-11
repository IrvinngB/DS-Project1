<?php
// Incluir el archivo de conexión
global $conn;
include 'conexion.php'; // Asegúrate de que la ruta al archivo de conexión sea correcta

// Capturar los datos del formulario usando el método POST
$prefijo = $_POST['prefijo'];
$tomo = $_POST['tomo'];
$asiento = $_POST['asiento'];
$nombre1 = $_POST['nombre1'];
$nombre2 = $_POST['nombre2'];
$apellido1 = $_POST['apellido1'];
$apellido2 = $_POST['apellido2'];
$provincia = $_POST['provincia'];
$distrito = $_POST['distrito'];
$corregimiento = $_POST['corregimiento'];
$horasTrabajadas = $_POST['htrabajadas'];
$salarioHora = $_POST['shora'];
$salarioBruto = $_POST['sbruto'];
$seguroSocial = $_POST['ssocial'];
$seguroEducativo = $_POST['seducativo'];
$impuestoRenta = $_POST['irenta'];
$otrosDescuentos1 = $_POST['otros_descuentos1'];
$otrosDescuentos2 = $_POST['otros_descuentos2'];
$otrosDescuentos3 = $_POST['otros_descuentos3'];
$sueldoNeto = $_POST['sneto'];

// Concatenar el tomo, asiento y prefijo
$cedula = concatenarTomoAsientoPrefijo($tomo, $asiento, $prefijo);

// Función para concatenar los valores
function concatenarTomoAsientoPrefijo($tomo, $asiento, $prefijo) {
    return $prefijo . '-' . $tomo . '-' . $asiento;
}

// Preparar la declaración
$stmt = $conn->prepare("INSERT INTO planilla (prefijo,tomo,asiento,cedula,nombre1,nombre2,apellido1,apellido2,provincia,distrito,corregimiento,htrabajadas,shora,sbruto,ssocial,seducativo,irenta,descuento1,descuento2,descuento3,sneto) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

// Vincular los parámetros
$stmt->bind_param("sssssssssssiddddddddd",
    $prefijo,
    $tomo,
    $asiento,
    $cedula,
    $nombre1,
    $nombre2,
    $apellido1,
    $apellido2,
    $provincia,
    $distrito,
    $corregimiento,
    $horasTrabajadas,
    $salarioHora,
    $salarioBruto,
    $seguroSocial,
    $seguroEducativo,
    $impuestoRenta,
    $otrosDescuentos1,
    $otrosDescuentos2,
    $otrosDescuentos3,
    $sueldoNeto
);

// Ejecutar la declaración
if ($stmt->execute()) {
    echo "<script>
        alert('Los datos se enviaron correctamente ✔');
         window.location.href = '../Web/index.html';
    </script>";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
