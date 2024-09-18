function consultarDatos() {
    // Obtener los datos del formulario
    var prefijo = $('#prefijo').val();
    var tomo = $('#tomo').val();
    var asiento = $('#asiento').val();

    // Validar los campos requeridos
    if (!prefijo || !tomo || !asiento) {
        alert("Por favor, complete todos los campos.");
        return;
    }

    // Realizar la solicitud AJAX
    $.ajax({
        url: '../PHP/consultar.php', // URL del archivo PHP
        type: 'POST',
        data: {
            prefijo: prefijo,
            tomo: tomo,
            asiento: asiento
        },
        success: function(response) {
            // Mostrar los resultados en el contenedor de resultados
            $('#resultados').html(response);
        },
        error: function(xhr, status, error) {
            console.error('Error al realizar la consulta:', error);
            alert('Hubo un error al procesar la solicitud.');
        }
    });
}
