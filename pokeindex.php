<?php
if (isset($_GET['poke-id'])=== false){
    $pokeID = 1;
} else {
    $pokeID= $_GET['poke-id'];
}
$base="http://pokeapi.co/api/v2/pokemon/";
//$pokeID=$_GET["poke-id"];


//for($id=1;$id<3;$id++){
    $data=file_get_contents($base.$pokeID.'/');
    $pokemonData= json_decode($data);

//}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"><meta charset="utf-8">
    <meta name="description" content="game,pokemon,pokedex">
    <meta name="author" content="Viktor and Jenifer">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="pokedex.css">
    <title>Pokedex</title>
</head>
<body>

<h1>Pokemon</h1>
<form action="pokeindex.php" method="get">
    <div class="search-container">
         <input type="text" id="poke-id" name="poke-id" placeholder="Name / id" />
        <div id="pokeball" class="pokeballContainer">
            <input type="image" id="pokeball" src="pokeball.png"  alt="Submit">
        </div>
    </div>
</form>
<br>

<div id="pokedex">
    <div id="left">

        <div id="bg_curve1_left"></div>
        <div id="bg_curve2_left"></div>
        <div id="curve1_left">
            <div id="buttonGlass"></div>
            <div id="miniButtonGlass1"></div>
            <div id="miniButtonGlass2"></div>
            <div id="miniButtonGlass3"></div>
        </div>

        <div id="curve2_left">
            <div id="junction"></div>
        </div>


        <div id="screen">

             <img  id= "mainPicture" src="<?php echo $pokemonData->sprites->other->dream_world->front_default?>" alt="pokemon">
        </div>

        <div id="resetButton"></div>


        <div id="cross">
            <div id="leftcross">
                <div id="leftT">
                   
                </div>
            </div>
            <div id="topcross">
                <div id="upT"></div>
            </div>
            <div id="rightcross">
                <div id="rightT"></div>
            </div>
            <div id="midcross">
                <div id="midCircle"></div>
            </div>
            <div id="botcross">
                <div id="downT"></div>
            </div>
        </div>

    </div>

    <div id="right">
        <div id="pokeMovements">
            <h4>Moves</h4>
            <br>
            <ol>
                <li><?php echo $pokemonData->moves[1]->move->name?></li>
                <li><?php echo $pokemonData->moves[2]->move->name?></li>
                <li><?php echo $pokemonData->moves[3]->move->name?></li>
                <li><?php echo $pokemonData->moves[4]->move->name?></li>
            </ol>

        </div>

        <div id="Evolutions">
<?php

$speciesUrl = "https://pokeapi.co/api/v2/pokemon-species/";
$speciesData = file_get_contents($speciesUrl.$pokeID.'/');
$evolution = json_decode($speciesData);

//to do when I have time
//$chainURL = "https://pokeapi.co/api/v2/pokemon-species/evolution_chain/";
//$chainData= file_get_contents($chainURL.$pokeID.'/');
//$chainEvo= json_decode($chainData);


if (isset($evolution->evolves_from_species->name) ){
    echo $evolution->evolves_from_species->name;

} else{
    echo 'No Evolution';
}
?>
<?php

if (isset($evolution->evolves_from_species->name) ){
    $avatar = $evolution->evolves_from_species->name;


    $api = curl_init("https://pokeapi.co/api/v2/pokemon/$avatar");
                    curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
                    $response = curl_exec($api);
                    curl_close($api);

                    $newPic = json_decode($response);


                    echo '<img id="evo1" src="'.$newPic->sprites->other->dream_world->front_default.'" >';
                //}
            }
            ?>

        </div>

        <div id="nameBox">
            <!-- adding the name of input to the box name -->
            <h4>NAME</h4>
                <br>
                <?php echo $pokemonData->name?>
        </div>

        <div id="IDBox">
            <h4>ID</h4>
                <br>
                <?php echo $pokemonData->id?>

        </div>

        <div id="bg_curve1_right"></div>
        <div id="bg_curve2_right"></div>
        <div id="curve1_right"></div>
        <div id="curve2_right"></div>
    </div>
</div>

</body>
</html>





