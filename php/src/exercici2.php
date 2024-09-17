<!DOCTYPE html>
<html>
<body>
    <h1>Exercici 2: Control de Flux amb Bucles</h1>
    <h2>Utilitza un bucle for per imprimir els números parells del 0 al 20. Fes-ho també amb un bucle while.</h2>
    <?php

    for ($i=0; $i <= 20; $i++) { 
        if ($i % 2 == 0) {
            echo $i . '<br/>';
        }
    }

    $a = 0;

    while ($a <= 20) {
        if ($a % 2 == 0) {
            echo $a . '<br/>';
        }
        $a++;
    }

    ?>
</body>
</html>
