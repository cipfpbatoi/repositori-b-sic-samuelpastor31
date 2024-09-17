<!DOCTYPE html>
<html>
<body>
    <h1>Benvingut a la meva web</h1>
    <p>La data d'avui és: <?= date('Y-m-d') ?></p>
    <?php

function suma($a, $b = 4) {
    return $a + $b;
}

function sumar(int $a, int $b): int {
    return $a + $b;
}


$resultat = sumar(5, 1);  // $resultat conté 8
$resultat2 = suma(5);  // $resultat conté 5

// Assignació de valors
$x = 5;
$y = "Hola món";

// Operacions aritmètiques
$suma = $x + 10;
$producte = $x * 2;

// Concatenació de cadenes
$nom = "Joan";
$salutacio = $y . ", " . $nom;

// Impressió de resultats
echo $y.$suma.'<br/>';  // Hola món
echo $suma.'<br/>';  // 15
echo $resultat.'<br/>';  // 8 es la funció
echo $resultat2.'<br/>';  // 9 es la funció
echo $salutacio.'<br/>';  // Hola món, Joan
?>
</body>
</html>