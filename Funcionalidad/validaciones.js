// Función para limitar la cantidad de caracteres y permitir solo números
function limitarC(input, maxLength) {
    input.addEventListener('input', function() {
        // Remueve todos los caracteres que no sean números
        this.value = this.value.replace(/[-\D]/g, '');

        this.value = this.value.replace(/\s{2,}/g, ' ');
        // Limita la longitud del campo al valor especificado
        if (this.value.length > maxLength) {
            this.value = this.value.slice(0, maxLength);
        }

    });
}

// Función para validar nombres y apellidos (solo letras)
function ValidadNombres(input, maxLength) {
    input.addEventListener('input', function() {
        // Remueve todos los caracteres que no sean letras
        this.value = this.value.replace(/\d/g, '');

          this.value = this.value.replace(/\s{2,}/g, ' ');
        // Limita la longitud del campo al valor especificado
        if (this.value.length > maxLength) {
            this.value = this.value.slice(0, maxLength);
        }
    });
}

// Función para calcular salarios
function calcularSalarios() {
    const horasTrabajadas = parseFloat(document.getElementById('htrabajadas').value) || 0;
    const salarioHora = parseFloat(document.getElementById('shora').value) || 0;

    // Calcular salario bruto
    const salarioBruto = horasTrabajadas * salarioHora;
    document.getElementById('sbruto').value = salarioBruto.toFixed(2);

    const otrosDescuentos1 = parseFloat(document.getElementById('otros_descuentos1').value) || 0;
    const otrosDescuentos2 = parseFloat(document.getElementById('otros_descuentos2').value) || 0;
    const otrosDescuentos3 = parseFloat(document.getElementById('otros_descuentos3').value) || 0;

    // Validar que los otros descuentos no sean mayores al salario bruto
    const totalOtrosDescuentos = otrosDescuentos1 + otrosDescuentos2 + otrosDescuentos3;
    if (totalOtrosDescuentos > salarioBruto && totalOtrosDescuentos > 0) {
        alert("Los descuentos adicionales no pueden ser mayores al salario bruto.");
        return;
    }

    // Calcular deducciones
    const seguroSocial = salarioBruto * 0.0975; // 9.75% de seguro social
    const seguroEducativo = salarioBruto * 0.0125; // 1.25% de seguro educativo

    // Calcular impuesto sobre la renta basado en la ley panameña
    let impuestoRenta = 0;
    const salarioAnual = salarioBruto * 12;

    if (salarioAnual > 11000 && salarioAnual <= 50000) {
        impuestoRenta = (salarioAnual - 11000) * 0.15 / 12;
    } else if (salarioAnual > 50000) {
        impuestoRenta = ((50000 - 11000) * 0.15 + (salarioAnual - 50000) * 0.25) / 12;
    }

    document.getElementById('ssocial').value = seguroSocial.toFixed(2);
    document.getElementById('seducativo').value = seguroEducativo.toFixed(2);
    document.getElementById('irenta').value = impuestoRenta.toFixed(2);

    // Calcular sueldo neto
    const totalDeducciones = seguroSocial + seguroEducativo + impuestoRenta + totalOtrosDescuentos;
    const sueldoNeto = salarioBruto - totalDeducciones;
    document.getElementById('sneto').value = sueldoNeto.toFixed(2);
}

// Función para evitar la entrada de valores negativos
function validarIM(event) {
    const key = event.key;
    const isControlKey = ['Backspace', 'Delete', 'ArrowLeft', 'ArrowRight', 'Tab'].includes(key);

    // Permitir sólo números, punto decimal, y teclas de control (como retroceso, flechas, etc.)
    if (!/[\d.]/.test(key) && !isControlKey) {
        event.preventDefault();
    }

    // Evitar más de un punto decimal
    if (key === '.' && event.target.value.includes('.')) {
        event.preventDefault();
    }
}


// Aplicar las validaciones cuando el contenido esté cargado
document.addEventListener('DOMContentLoaded', function() {
    // Aplicar la validación en los campos de salario y descuentos
    const inputsMonetarios = [
        document.getElementById('htrabajadas'),
        document.getElementById('shora'),
        document.getElementById('otros_descuentos1'),
        document.getElementById('otros_descuentos2'),
        document.getElementById('otros_descuentos3')
    ];

    inputsMonetarios.forEach(input => {
        input.addEventListener('keydown', validarIM);
    });

    // Validación de campos numéricos
    const tomoInput = document.getElementById('tomo');
    const asientoInput = document.getElementById('asiento');
    limitarC(tomoInput, 4);
    limitarC(asientoInput, 5);

    // Validación de nombres y apellidos
    const nombre1Input = document.getElementById('nombre1');
    const apellido1Input = document.getElementById('apellido1');
    const nombre2Input = document.getElementById('nombre2');
    const apellido2Input = document.getElementById('apellido2');
    ValidadNombres(nombre1Input, 30);
    ValidadNombres(apellido1Input, 30);
    ValidadNombres(nombre2Input, 30);
    ValidadNombres(apellido2Input, 30);
});

