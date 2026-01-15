const galeria = document.getElementById('galeria-pokemon');
function formatNumber(num) {
    return String(num).padStart(3, '0');
}
function mostrarNumero(num) {
    alert(`Pokémon #${num}`);
}
for (let i = 1; i <= 151; i++) {
    const numeroFormateado = formatNumber(i);
    const pokemonDiv = document.createElement('div');
    pokemonDiv.classList.add('pokemon-card');
    pokemonDiv.setAttribute('onclick', `mostrarNumero(${i})`);

    pokemonDiv.innerHTML = `<img src="juego/recursos/sprites/0${numeroFormateado}.png" 
                                alt="Pokemon #${i}">`;
    galeria.appendChild(pokemonDiv);
}