// Función para limitar la cantidad de caracteres y permitir solo números
function limitarC(input, maxLength) {
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

    limitarC(tomoInput, 5);  
    limitarC(asientoInput, 5);  
    lim
});


function ValidadNombres(input, maxLength) {
    input.addEventListener('input', function() {
        // Remueve todos los caracteres que no sean números
        this.value = this.value.replace(/\d/g, '');

        // Limita la longitud del campo al valor especificado
        if (this.value.length > maxLength) {
            this.value = this.value.slice(0, maxLength);
        }
    });
}

// Aplicar la función a los campos que necesiten la validación
document.addEventListener('DOMContentLoaded', function() {
    const nombre1Input = document.getElementById('nombre1');
    const apellido1Input = document.getElementById('apellido1');
    const nombre2Input = document.getElementById('nombre2');
    const apellido2Input = document.getElementById('apellido2');

    ValidadNombres(nombre1Input, 30);  
    ValidadNombres(apellido1Input, 30);  
    ValidadNombres(nombre2Input, 30);  
    ValidadNombres(apellido2Input, 30);  
});


