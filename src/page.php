<?php
    if($_SERVER["REQUEST_METHOD"] == "GET") {
        $pokedexApi = file_get_contents('https://pokeapi.co/api/v2/pokemon/1');
    } else {
        $pokedexApi = file_get_contents('https://pokeapi.co/api/v2/pokemon/'.$_POST["pokemonId"]);
    }

    $pokemonTypes = file_get_contents($_SERVER["DOCUMENT_ROOT"].'/assets/PokemonTypes.json');

    $pokemon = json_decode($pokedexApi);
    $imgs_types = json_decode($pokemonTypes, true);

    $previous_pokemon = $pokemon->id <= 1 ? 1 : $pokemon->id - 1;
    $next_pokemon = $pokemon->id >= 898 ? 898 : $pokemon->id + 1;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Pokedex</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/x-icon" href="favicon.ico">
        <link href="/css/style.css" rel="stylesheet">
        <link href="/css/pokedex.css" rel="stylesheet">
        <script src="/js/pokedexPost.js" async></script>
    </head>
    <body>
        <div class="pokedex">
            <div class="info-display center">
                <form name="pokemonKeySend" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <input type="text" name="pokemonId" class="id-display" value="<?php echo $pokemon->id ?>" onKeyUp="pokemonKeyId()"/>
                </form>
                <div class="name-display">
                    <b><?php echo ucfirst($pokemon->name) ?></b>
                </div>
            </div>
            <div style="clear: both;"></div>
            <div class="pokemon-display">
                <div class="pokemon">
                    <img src="<?php echo $pokemon->sprites->front_default; ?>" width="100%" height="100%">
                </div>
                <div class="pokemon type">
                <?php foreach ($pokemon->types as $types) { ?>
                    <img src='<?php echo $imgs_types[$types->type->name] ?>' height="50">
                <?php } ?>
                </div>
            </div>
            <div class="buttons">
                <form name="pokemonIdSend" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <input type="hidden" name="pokemonId" class="id-display" value="<?php echo $pokemon->id ?>"/>
                    <div class="button" onClick="previous('<?php echo $previous_pokemon; ?>')"><< Anterior</div>
                    <div class="button" onClick="next('<?php echo $next_pokemon; ?>')">Próximo >></div>
                </form>
            </div>
            <div class="api">
                API: <a href="https://pokeapi.co/" target="_blank">https://pokeapi.co/</a>
            </div>
            <div class="center dev">
                <a href="http://jigsaw.w3.org/css-validator/check/" target="_blank">
                    <img style="border:0;width:88px;height:31px"
                        src="http://jigsaw.w3.org/css-validator/images/vcss-blue"
                        alt="CSS válido!" />
                </a>
                <a href="#"><img src="/assets/phpIcon.png" height="60"></a>      
                <a href="https://github.com/luizbinario/angularPokedex" target="_blank"><img src="https://github.githubassets.com/images/modules/logos_page/GitHub-Logo.png" height="20"></a>      
            </div>
        </div>
    </body>
</html>