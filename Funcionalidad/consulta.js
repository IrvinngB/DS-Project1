function consultarDatos() {
    var prefijo = $('#prefijo').val();
    var tomo = $('#tomo').val();
    var asiento = $('#asiento').val();

    console.log("Prefijo:", prefijo, "Tomo:", tomo, "Asiento:", asiento); // Verificar datos

    if (!prefijo || !tomo || !asiento) {
        alert("Por favor, complete todos los campos.");
        return;
    }

    $.ajax({
        url: '../PHP/consultar.php',
        type: 'POST',
        data: {
            prefijo: prefijo,
            tomo: tomo,
            asiento: asiento
        },
        success: function(response) {
            $('#resultados').html(response);
        },
        error: function(xhr, status, error) {
            console.error('Error al realizar la consulta:', error);
            alert('Hubo un error al procesar la solicitud.');
        }
    });
}
