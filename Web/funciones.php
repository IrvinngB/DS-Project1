<?php
// Incluir archivo de conexión
include 'conexion.php';

// Función para obtener los datos de las provincias
function obtenerProvincias() {
    global $conn; // Usar la conexión global

    $query = "SELECT codigo_provincia, nombre_provincia FROM provincia";
    $result = $conn->query($query);

    $provincias = array();

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $provincias[] = $row;
        }
    }

    return $provincias; // Devolver los datos como un array
}

// Función para obtener los datos de los distritos filtrados por provincia
function obtenerDistritos($codigo_provincia) {
    global $conn; // Usar la conexión global

    $query = "SELECT codigo_distrito, nombre_distrito FROM distrito WHERE codigo_provincia = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $codigo_provincia);
    $stmt->execute();
    $result = $stmt->get_result();

    $distritos = array();

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $distritos[] = $row;
        }
    }

    return $distritos; // Devolver los datos como un array
}

// Función para obtener los corregimientos filtrados por distrito
function obtenerCorregimientos($codigo_distrito) {
    global $conn; // Usar la conexión global

    $query = "SELECT codigo_corregimiento, nombre_corregimiento FROM corregimiento WHERE codigo_distrito = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $codigo_distrito);
    $stmt->execute();
    $result = $stmt->get_result();

    $corregimientos = array();

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $corregimientos[] = $row;
        }
    }

    return $corregimientos; // Devolver los datos como un array
}
?>
