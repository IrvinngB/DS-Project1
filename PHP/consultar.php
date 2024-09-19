<?php

include 'conexion.php'; 

if (isset($_POST['prefijo']) && isset($_POST['tomo']) && isset($_POST['asiento'])) {
    $prefijo = $_POST['prefijo'];
    $tomo = $_POST['tomo'];
    $asiento = $_POST['asiento'];

    // Concatenar el tomo, asiento y prefijo para formar la cédula
    $cedula = $prefijo . '-' . $tomo . '-' . $asiento;

    // Preparar la consulta SQL utilizando la cédula concatenada
    $sql = "SELECT 
                p.cedula, p.nombre1, p.nombre2, p.apellido1, p.apellido2, 
                prov.nombre_provincia, dist.nombre_distrito, corr.nombre_corregimiento, 
                p.htrabajadas, p.shora, p.sbruto, p.ssocial, p.seducativo, p.irenta, 
                p.descuento1, p.descuento2, p.descuento3, p.sneto 
            FROM planilla p
            JOIN provincia prov ON CONVERT(p.provincia USING utf8mb4) = CONVERT(prov.codigo_provincia USING utf8mb4)
            JOIN distrito dist ON CONVERT(p.distrito USING utf8mb4) = CONVERT(dist.codigo_distrito USING utf8mb4)
            JOIN corregimiento corr ON CONVERT(p.corregimiento USING utf8mb4) = CONVERT(corr.codigo_corregimiento USING utf8mb4)
            WHERE p.cedula = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $cedula);

    // Ejecutar la consulta
    $stmt->execute();
    $result = $stmt->get_result();

    // Comprobar si se encontraron resultados
    if ($result->num_rows > 0) {
        // Mostrar los resultados en una tabla vertical
        while ($row = $result->fetch_assoc()) {
            echo "<table class='resultados-vertical'>";
            echo "<tr><th>Cédula</th><td>" . $row['cedula'] . "</td></tr>";
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
} else {
    echo "<p>Faltan datos necesarios para realizar la consulta.</p>";
}
?>
