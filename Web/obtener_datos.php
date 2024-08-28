<?php
include 'funciones.php'; // Incluir el archivo que contiene las funciones

if (isset($_GET['accion'])) {
    $accion = $_GET['accion'];

    if ($accion == 'obtenerProvincias') {
        // Obtener las provincias
        $provincias = obtenerProvincias();
        header('Content-Type: application/json');
        echo json_encode($provincias);
    } elseif ($accion == 'obtenerDistritos' && isset($_GET['codigo_provincia'])) {
        // Obtener los distritos para una provincia específica
        $codigo_provincia = $_GET['codigo_provincia'];
        $distritos = obtenerDistritos($codigo_provincia);
        header('Content-Type: application/json');
        echo json_encode($distritos);
    } elseif ($accion == 'obtenerCorregimientos' && isset($_GET['codigo_distrito'])) {
        // Obtener los corregimientos para un distrito específico
        $codigo_distrito = $_GET['codigo_distrito'];
        $corregimientos = obtenerCorregimientos($codigo_distrito);
        header('Content-Type: application/json');
        echo json_encode($corregimientos);
    } else {
        http_response_code(400); // Código de respuesta de solicitud incorrecta
        echo json_encode(["error" => "Acción no válida o parámetros faltantes"]);
    }

} else {
    http_response_code(400); // Código de respuesta de solicitud incorrecta
    echo json_encode(["error" => "Acción no especificada"]);
}
?>
