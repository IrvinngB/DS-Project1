<?php
// Incluir el archivo de conexión
include 'conexion.php'; // Asegúrate de que la ruta al archivo de conexión sea correcta

// Verificar que los datos estén presentes
if (isset($_POST['prefijo']) && isset($_POST['tomo']) && isset($_POST['asiento'])) {
    $prefijo = $_POST['prefijo'];
    $tomo = $_POST['tomo'];
    $asiento = $_POST['asiento'];

    // Concatenar el tomo, asiento y prefijo para formar la cédula
    $cedula = $prefijo . '-' . $tomo . '-' . $asiento;

    // Preparar la declaración de eliminación
    $stmt = $conn->prepare("DELETE FROM planilla WHERE cedula = ?");
    $stmt->bind_param("s", $cedula);

    // Ejecutar la declaración
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

    // Cerrar la declaración y la conexión
    $stmt->close();
    $conn->close();
} else {
    echo "<script>
        alert('Faltan datos necesarios para eliminar el registro.');
    </script>";
}
?>
