<!DOCTYPE html>
<html>
<body>
    <h1>Exercici 4: Manipulació de Strings</h1>
    <h2>Escriu un script que prenga una cadena de text i compti el nombre de vocals. Imprimeix el resultat.</h2>
    
    <?php

    function contarVocales ($a){
        $numeroCaracteres = 0;
        for ($i=0; $i < strlen($a) ; $i++) { 
            if ($a[$i]=='a' || $a[$i]=='e' || $a[$i]=='o' || $a[$i]=='i' || $a[$i]=='u'){
            $numeroCaracteres += 1;
            }
        }
        return $numeroCaracteres;
    }

    $caracteres = contarVocales('Hello World');

    echo $caracteres.'<br/>';

    ?>
</body>
</html>