<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prueba de API</title>
    <link rel="stylesheet" href="style.css">
</head>
<body style= "background-color: #F2D113;">
    <a href="/APItest" class="btn">Volver</a>
    <?php
    
    $pokenombre=$_POST['pokemon'];

    $ch=curl_init();

    $url="https://pokeapi.co/api/v2/pokemon/$pokenombre";

    curl_setopt($ch,CURLOPT_URL,$url,);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    $response=curl_exec($ch);

    if (curl_errno($ch)){
    }
    else{
        curl_close($ch);

        $pokemon_data=json_decode($response,true);
        if ($pokemon_data!=null){
            echo '<h1>'. $pokemon_data['name']. '</h1>';
            echo '<img src="'.$pokemon_data['sprites']['front_default'].'"alt="'.$pokemon_data['name'].'">';
            echo '<ul>';
            echo '<li><strong>Nombre: </strong>'.$pokemon_data['name']. '</li>';
            echo '<li><strong>Altura: </strong>'.($pokemon_data['height']/10). ' metros</li>';
            echo '<li><strong>Peso: </strong>'.($pokemon_data['weight']/10). ' kilogramos</li>';

            echo '<li><strong>Habilidades</strong></li>';
            echo '<ul>';
            foreach ($pokemon_data['abilities'] as $ability){
                echo '<li>'. $ability['ability']['name']. '</li>';
            }
            echo '</ul>';
            echo '</li>';
            echo '</ul>';;
        }
        else{
            echo "Pokemon no encontrado";
        }
        
    }
    ?>

</body>
</html>