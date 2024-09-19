document.addEventListener("DOMContentLoaded", function() {
    // Cargar provincias al cargar la página
    fetch('../PHP/obtener_datos.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'accion=obtenerProvincias'
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Error en la respuesta del servidor');
        }
        return response.json();
    })
    .then(data => {
        const selectProvincia = document.getElementById('provincia');
        
        
        selectProvincia.innerHTML = '<option value="" disabled selected>Seleccione una provincia</option>';

        data.forEach(provincia => {
            let option = document.createElement('option');
            option.value = provincia.codigo_provincia;
            option.textContent = provincia.nombre_provincia;
            selectProvincia.appendChild(option);
        });

        selectProvincia.addEventListener('change', function() {
            const codigoProvincia = this.value;
            cargarDistritos(codigoProvincia);
        });
    })
    .catch(error => {
        console.error('Error al cargar las provincias:', error);
        alert('Hubo un problema al cargar las provincias. Por favor, inténtalo de nuevo más tarde.');
    });
});

function cargarDistritos(codigoProvincia) {
   
    fetch('../PHP/obtener_datos.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `accion=obtenerDistritos&codigo_provincia=${codigoProvincia}`
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Error en la respuesta del servidor');
        }
        return response.json();
    })
    .then(data => {
        const selectDistrito = document.getElementById('distrito');
        
       
        selectDistrito.innerHTML = '<option value="" disabled selected>Seleccione un distrito</option>';

       
        data.forEach(distrito => {
            let option = document.createElement('option');
            option.value = distrito.codigo_distrito;
            option.textContent = distrito.nombre_distrito;
            selectDistrito.appendChild(option);
        });

        // Agregar un evento para cargar corregimientos cuando se seleccione un distrito
        selectDistrito.addEventListener('change', function() {
            const codigoDistrito = this.value;
            cargarCorregimientos(codigoDistrito);
        });
    })
    .catch(error => {
        console.error('Error al cargar los distritos:', error);
        alert('Hubo un problema al cargar los distritos. Por favor, inténtalo de nuevo más tarde.');
    });
}

function cargarCorregimientos(codigoDistrito) {
    fetch('../PHP/obtener_datos.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `accion=obtenerCorregimientos&codigo_distrito=${codigoDistrito}`
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Error en la respuesta del servidor');
        }
        return response.json();
    })
    .then(data => {
        const selectCorregimiento = document.getElementById('corregimiento');
        
       
        selectCorregimiento.innerHTML = '<option value="" disabled selected>Seleccione un corregimiento</option>';

        // Recorrer los datos recibidos y crear opciones para el select de corregimientos
        data.forEach(corregimiento => {
            let option = document.createElement('option');
            option.value = corregimiento.codigo_corregimiento;
            option.textContent = corregimiento.nombre_corregimiento;
            selectCorregimiento.appendChild(option);
        });
    })
    .catch(error => {
        alert('Hubo un problema al cargar los corregimientos. Por favor, inténtalo de nuevo más tarde.');
    });
}



