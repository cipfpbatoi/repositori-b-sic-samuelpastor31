<!DOCTYPE html>
<html>
<body>
    <h1>Exercici 3: Treballar amb Arrays i Funcions¶</h1>
    <h2>Escriu una funció que prenga un array de números, calculi la mitjana i retorni el resultat. Utilitza aquesta funció per imprimir la mitjana d'un array de cinc números.</h2>
    <?php

    $array = array(1,2,3,4,5);

    function mitjanaArray ($array1){
        $sum = 0;
        for ($i=0; $i <count($array1) ; $i++) { 
            $sum += $array1[$i];
        }

        return $sum/count($array1);
    }

    $mitjana = mitjanaArray($array);

    echo $mitjana;

    ?>
</body>
</html>
