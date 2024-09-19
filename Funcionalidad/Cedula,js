// Función para limitar la cantidad de caracteres y permitir solo números
function limitarNumeros(input, maxLength) {
    input.addEventListener('input', function() {
      
        this.value = this.value.replace(/[-\D]/g, '');

        if (this.value.length > maxLength) {
            this.value = this.value.slice(0, maxLength);
        }
    });
}

document.addEventListener('DOMContentLoaded', function() {
    
    const tomoInput = document.getElementById('tomo');
    const asientoInput = document.getElementById('asiento');
    
    limitarNumeros(tomoInput, 4);
    limitarNumeros(asientoInput, 5);
});