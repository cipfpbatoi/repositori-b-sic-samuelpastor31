<!DOCTYPE html>
<html>
<body>
    <h1>Exercici 1: Manipulació de Variables i Operadors</h1>
    <h2>Assigna múltiples variables i utilitza operadors aritmètics i lògics. Mostra el resultat de cada operació.</h2>
    <?php

    // Funció amb valor per defecte per a $b
    function suma($a, $b = 4) {
        return $a + $b;
    }

    // Funció amb tipat de dades
    function sumar(int $a, int $b): int {
        return $a + $b;
    }

    // Crides a les funcions
    $resultat = sumar(5, 3);  // $resultat conté 8
    $resultat2 = suma(5);  // $resultat2 conté 9 (5 + 4)

    // Assignació de valors
    $x = 5;

    // Operacions aritmètiques
    $suma = $x + 10;  // 5 + 10 = 15
    $producte = $x * 2;  // 5 * 2 = 10

    // Operació lògica
    $resultatsIguals = $resultat == $resultat2;  // Compara si $resultat és igual a $resultat2

    // Mostrar resultats
    echo "Suma de 5 + 10 = ".$suma.'<br/>';  // 15
    echo "Resultat de la funció sumar(5, 3) = ".$resultat.'<br/>';  // 8
    echo "Resultat de la funció suma(5) = ".$resultat2.'<br/>';  // 9
    echo "Els resultats són iguals? ".($resultatsIguals ? 'Sí' : 'No').'<br/>';  // No, perquè 8 no és igual a 9

    ?>
</body>
</html>
