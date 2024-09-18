<?php
// Incluir el archivo de conexión
include 'conexion.php'; // Asegúrate de que la ruta al archivo de conexión sea correcta

// Capturar los datos del formulario usando el método POST
$prefijo = $_POST['prefijo'];
$tomo = $_POST['tomo'];
$asiento = $_POST['asiento'];

// Preparar la consulta SQL con JOIN para buscar los nombres
$sql = "SELECT 
            p.prefijo, p.tomo, p.asiento, p.nombre1, p.nombre2, p.apellido1, p.apellido2, 
            prov.nombre_provincia, dist.nombre_distrito, corr.nombre_corregimiento, 
            p.htrabajadas, p.shora, p.sbruto, p.ssocial, p.seducativo, p.irenta, 
            p.descuento1, p.descuento2, p.descuento3, p.sneto 
        FROM planilla p
        JOIN provincia prov ON CONVERT(p.provincia USING utf8mb4) = CONVERT(prov.codigo_provincia USING utf8mb4)
        JOIN distrito dist ON CONVERT(p.distrito USING utf8mb4) = CONVERT(dist.codigo_distrito USING utf8mb4)
        JOIN corregimiento corr ON CONVERT(p.corregimiento USING utf8mb4) = CONVERT(corr.codigo_corregimiento USING utf8mb4)
        WHERE p.prefijo = ? AND p.tomo = ? AND p.asiento = ?";

// Preparar la declaración
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $prefijo, $tomo, $asiento);

// Ejecutar la consulta
$stmt->execute();
$result = $stmt->get_result();

// Comprobar si se encontraron resultados
if ($result->num_rows > 0) {
    // Mostrar los resultados en una tabla vertical
    while ($row = $result->fetch_assoc()) {
        echo "<table class='resultados-vertical'>";
        echo "<tr><th>Prefijo</th><td>" . $row['prefijo'] . "</td></tr>";
        echo "<tr><th>Tomo</th><td>" . $row['tomo'] . "</td></tr>";
        echo "<tr><th>Asiento</th><td>" . $row['asiento'] . "</td></tr>";
        echo "<tr><th>Nombre</th><td>" . $row['nombre1'] . " " . $row['nombre2'] . "</td></tr>";
        echo "<tr><th>Apellido</th><td>" . $row['apellido1'] . " " . $row['apellido2'] . "</td></tr>";
        echo "<tr><th>Provincia</th><td>" . $row['nombre_provincia'] . "</td></tr>";
        echo "<tr><th>Distrito</th><td>" . $row['nombre_distrito'] . "</td></tr>";
        echo "<tr><th>Corregimiento</th><td>" . $row['nombre_corregimiento'] . "</td></tr>";
        echo "<tr><th>Horas Trabajadas</th><td>" . $row['htrabajadas'] . "</td></tr>";
        echo "<tr><th>Salario por Hora</th><td>" . $row['shora'] . "</td></tr>";
        echo "<tr><th>Salario Bruto</th><td>" . $row['sbruto'] . "</td></tr>";
        echo "<tr><th>Seguro Social</th><td>" . $row['ssocial'] . "</td></tr>";
        echo "<tr><th>Seguro Educativo</th><td>" . $row['seducativo'] . "</td></tr>";
        echo "<tr><th>Impuesto Renta</th><td>" . $row['irenta'] . "</td></tr>";
        echo "<tr><th>Descuento 1</th><td>" . $row['descuento1'] . "</td></tr>";
        echo "<tr><th>Descuento 2</th><td>" . $row['descuento2'] . "</td></tr>";
        echo "<tr><th>Descuento 3</th><td>" . $row['descuento3'] . "</td></tr>";
        echo "<tr><th>Sueldo Neto</th><td>" . $row['sneto'] . "</td></tr>";
        echo "</table>";
    }
} else {
    echo "<p>No se encontraron registros con los datos proporcionados.</p>";
}

$stmt->close();
$conn->close();
?>
