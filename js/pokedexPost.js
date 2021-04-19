function previous(id) {
    document.pokemonIdSend.pokemonId.value = id;
    document.pokemonIdSend.submit();
}

function next(id) {
    document.pokemonIdSend.pokemonId.value = id;
    document.pokemonIdSend.submit();
}

function pokemonKeyId() {
    let pokemonId = document.pokemonKeySend.pokemonId
    pokemonId.value = (pokemonId.value <= 1) ? 1 : pokemonId.value;
    pokemonId.value = (pokemonId.value >= 898) ? 898 : pokemonId.value;
    document.pokemonKeySend.submit();
}