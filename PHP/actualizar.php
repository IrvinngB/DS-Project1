<?php

global $conn;
include 'conexion.php'; 

// Obtener los valores del formulario
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

// Concatenar el tomo, asiento y prefijo para formar la cédula
$cedula = concatenar($tomo, $asiento, $prefijo);

function concatenar($tomo, $asiento, $prefijo) {
    return $prefijo . '-' . $tomo . '-' . $asiento;
}

// Verificar si la cédula existe
$checkStmt = $conn->prepare("SELECT cedula FROM planilla WHERE cedula = ?");
$checkStmt->bind_param("s", $cedula);
$checkStmt->execute();
$checkStmt->store_result();

if ($checkStmt->num_rows > 0) {
    // La cédula existe, proceder con la actualización

    // Preparar la declaración SQL para actualizar los datos
    $stmt = $conn->prepare("UPDATE planilla SET 
        nombre1 = ?, 
        nombre2 = ?, 
        apellido1 = ?, 
        apellido2 = ?, 
        provincia = ?, 
        distrito = ?, 
        corregimiento = ?, 
        htrabajadas = ?, 
        shora = ?, 
        sbruto = ?, 
        ssocial = ?, 
        seducativo = ?, 
        irenta = ?, 
        descuento1 = ?, 
        descuento2 = ?, 
        descuento3 = ?, 
        sneto = ? 
        WHERE prefijo = ? AND tomo = ? AND asiento = ?");

    // Validar datos para evitar valores nulos
    $nombre1 = $nombre1 ?: '';
    $nombre2 = $nombre2 ?: '';
    $apellido1 = $apellido1 ?: '';
    $apellido2 = $apellido2 ?: '';
    $provincia = $provincia ?: '';
    $distrito = $distrito ?: '';
    $corregimiento = $corregimiento ?: '';
    $horasTrabajadas = $horasTrabajadas ?: 0;
    $salarioHora = $salarioHora ?: 0;
    $salarioBruto = $salarioBruto ?: 0;
    $seguroSocial = $seguroSocial ?: 0;
    $seguroEducativo = $seguroEducativo ?: 0;
    $impuestoRenta = $impuestoRenta ?: 0;
    $otrosDescuentos1 = $otrosDescuentos1 ?: 0;
    $otrosDescuentos2 = $otrosDescuentos2 ?: 0;
    $otrosDescuentos3 = $otrosDescuentos3 ?: 0;
    $sueldoNeto = $sueldoNeto ?: 0;

    // Vincular los parámetros
    $stmt->bind_param("ssssssidddddddddsssd",
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
        $sueldoNeto,
        $prefijo,
        $tomo,
        $asiento
    );

    // Ejecutar la declaración de actualización
    if ($stmt->execute()) {
        echo "<script>
            alert('Los datos se enviaron correctamente ✔');
            window.location.href = '../Web/index.html';
        </script>";
    } else {
        echo "<script>
            alert('Error al actualizar los datos: " . $stmt->error . "');
        </script>";
    }

    $stmt->close();
} else {
    // La cédula no existe
    echo "<script>
        alert('La cédula no existe en la base de datos.');
        window.location.href = '../Web/actualizar.html';
    </script>";
}

// Cerrar la declaración de verificación y la conexión
$checkStmt->close();
$conn->close();

?>
