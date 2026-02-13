/*mostrarRegistro();
const contenedor = document.getElementById('iniciales');
const formulario = document.querySelector('#Registro form');

contenedor.addEventListener('click', function(event) {
    const botonClickeado = event.target.closest('.starter-seleccion');
    if (botonClickeado) {
        const botonAnterior = contenedor.querySelector('.activo');
        if (botonAnterior) {
            botonAnterior.classList.remove('activo');
        }
        botonClickeado.classList.add('activo');            
        //localStorage.setItem('spriteSeleccionado', botonClickeado.id);
    }
});

formulario.addEventListener('submit', function(event) {
    event.preventDefault(); 
    const inputs = formulario.querySelectorAll('input[type="text"]');
    const nombre = inputs[0].value.trim();
    const usuario = inputs[1].value.trim();
    
    const inicialSeleccionado = contenedor.querySelector('.activo');                
    if (!nombre || !usuario) {
        alert('Por favor, completa los campos de Nombre y Usuario.');
        return;
    }

    if (!inicialSeleccionado) {
        alert('Por favor, selecciona un inicial.');
        return;
    }
    const inicialId = inicialSeleccionado.id;
    guardarDatosEntrenador(nombre, usuario, inicialId);

});
function guardarDatosEntrenador(nombre, usuario, inicialId) {
    const entrenador = {
        nombre: nombre,
        usuario: usuario,
        inicialSeleccionado: inicialId 
    };
    const json = JSON.stringify(entrenador);
    localStorage.setItem('entrenador', json);
    mostrarRegistro()
}

function obtenerDatosEntrenador() {
    const json = localStorage.getItem('entrenador');
    if (json) {
        const entrenador = JSON.parse(json);
        return entrenador;
    } else {
        console.log('No hay datos a cargar, registrarse primero');
        return null;
    }
}

function mostrarRegistro() {
    const entrenador = obtenerDatosEntrenador();
    const registroDiv = document.getElementById('Registro');
    const dashboardDiv = document.getElementById('Dashboard');
    
    if (entrenador) {
        if (registroDiv) registroDiv.style.display = 'none';
        if (dashboardDiv) dashboardDiv.style.display = 'block'; 
                        
        const nombreDiv = document.getElementById('Nombre');
        if (nombreDiv) {
            nombreDiv.innerHTML = `<h2>¡Hola ${entrenador.nombre}!</h2>`;
            nombreDiv.innerHTML += `<p>Tu inicial es:<br>   <img src="juego/recursos/sprites/${entrenador.inicialSeleccionado}.png"></p>`;
        
        }

    } else {
        if (registroDiv) registroDiv.style.display = 'flex'; 
        if (dashboardDiv) dashboardDiv.style.display = 'none';
    }
}
*/