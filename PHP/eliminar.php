<?php

include 'conexion.php'; 

if (isset($_POST['prefijo']) && isset($_POST['tomo']) && isset($_POST['asiento'])) {
    $prefijo = $_POST['prefijo'];
    $tomo = $_POST['tomo'];
    $asiento = $_POST['asiento'];

    // Concatenar el tomo, asiento y prefijo para formar la cédula
    $cedula = $prefijo . '-' . $tomo . '-' . $asiento;

    // Verificar si la cédula existe
    $checkStmt = $conn->prepare("SELECT cedula FROM planilla WHERE cedula = ?");
    $checkStmt->bind_param("s", $cedula);
    $checkStmt->execute();
    $checkStmt->store_result();

    if ($checkStmt->num_rows > 0) {
        // La cédula existe, proceder con la eliminación
        $stmt = $conn->prepare("DELETE FROM planilla WHERE cedula = ?");
        $stmt->bind_param("s", $cedula);

        if ($stmt->execute()) {
            echo "<script>
                alert('Registro eliminado correctamente ✔');
                window.location.href = '../Web/index.html';
            </script>";
        } else {
            echo "<script>
                alert('Error al eliminar el registro: " . $stmt->error . "');
            </script>";
        }
        $stmt->close();
    } else {
        // La cédula no existe
        echo "<script>
            alert('La cédula no existe en la base de datos.');
            window.location.href = '../Web/eliminar.html';
        </script>";
    }

    // Cerrar la declaración de verificación y la conexión
    $checkStmt->close();
    $conn->close();
} else {
    echo "<script>
        alert('Faltan datos necesarios para eliminar el registro.');
    </script>";
}
?>
