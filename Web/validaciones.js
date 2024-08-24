// Función para limitar la cantidad de caracteres y permitir solo números
function limitarCaracteresYNumeros(input, maxLength) {
    input.addEventListener('input', function() {
        // Remueve todos los caracteres que no sean números
        this.value = this.value.replace(/\D/g, '');

        // Limita la longitud del campo al valor especificado
        if (this.value.length > maxLength) {
            this.value = this.value.slice(0, maxLength);
        }
    });
}

// Aplicar la función a los campos que necesiten la validación
document.addEventListener('DOMContentLoaded', function() {
    const tomoInput = document.getElementById('tomo');
    const asientoInput = document.getElementById('asiento');

    limitarCaracteresYNumeros(tomoInput, 5);  // Limitar a 10 caracteres
    limitarCaracteresYNumeros(asientoInput, 5);  // Limitar a 10 caracteres
});
