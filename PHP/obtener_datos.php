<?php
include 'funciones.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = $_POST['accion'] ?? null;

    if ($accion == 'obtenerProvincias') {
        // Obtener las provincias
        $provincias = obtenerProvincias();
        header('Content-Type: application/json');
        echo json_encode($provincias);
    } elseif ($accion == 'obtenerDistritos' && isset($_POST['codigo_provincia'])) {
        // Obtener los distritos para una provincia específica
        $codigo_provincia = $_POST['codigo_provincia'];
        $distritos = obtenerDistritos($codigo_provincia);
        header('Content-Type: application/json');
        echo json_encode($distritos);
    } elseif ($accion == 'obtenerCorregimientos' && isset($_POST['codigo_distrito'])) {
        // Obtener los corregimientos para un distrito específico
        $codigo_distrito = $_POST['codigo_distrito'];
        $corregimientos = obtenerCorregimientos($codigo_distrito);
        header('Content-Type: application/json');
        echo json_encode($corregimientos);
    } else {
        http_response_code(400); 
        echo json_encode(["error" => "Acción no válida o parámetros faltantes"]);
    }
} else {
    http_response_code(405); 
    echo json_encode(["error" => "Método no permitido"]);
}
?>
