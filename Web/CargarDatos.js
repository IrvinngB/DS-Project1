$(document).ready(function() {
    // Realizar la solicitud AJAX al cargar la página
    $.ajax({
        url: 'cargar_provincias.php', // URL del archivo PHP que devuelve las provincias
        type: 'POST', // Cambiado a POST
        dataType: 'json',
        data: {}, // Puedes enviar datos adicionales aquí si es necesario
        success: function(data) {
            var select = $('#provincia');
            // Recorrer los datos recibidos y agregarlos al select
            $.each(data, function(index, provincia) {
                select.append('<option value="' + provincia.id + '">' + provincia.nombre + '</option>');
            });
        },
        error: function(xhr, status, error) {
            console.error('Error al cargar las provincias: ' + error);
        }
    });
});
