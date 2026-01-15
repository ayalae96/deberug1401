
let atrapar = null;

function generarPokemonAleatorio(min, max) {
    const rndm = Math.floor(Math.random() * (max - min + 1)) + min
    // a futuro devolver un objeto con el # y sprite, por ahora basta asi
    return obtenerSprite(rndm)
}

function obtenerSprite(numero){
    const numeroFormateado = String(numero).padStart(4, '0');
    const nombreArchivo = `${numeroFormateado}.png`;
    return nombreArchivo;
}

const nombreDiv = document.getElementById('main-juego');
if (nombreDiv) {
    nombreDiv.innerHTML = `<h2>¡Un pokemon salvaje a aparecido! ¡Atrapalo!</h2>`;
    nombreDiv.innerHTML += `<p><br>   <img src="recursos/sprites/${generarPokemonAleatorio(1,151)}"></p>`;
    nombreDiv.innerHTML += `<button id="BtnAtrapar">Capturar</button>`;

    atrapar = document.getElementById('BtnAtrapar');
    if (atrapar) {
        atrapar.addEventListener('click', function(event){
        alert("Pokemon Capturado")
    });
}

}
