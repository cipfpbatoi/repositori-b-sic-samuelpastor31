<!DOCTYPE html>
<html>
<body>
    <h1>Exercici 6: Utilitzant match per a categoritzar</h1>
    <h2>Crea un fitxer que utilitze la instrucció match per 
        categoritzar una variable $nota segons el següent 
        criteri: 
        - Si la nota és 10, imprimir "Excel·lent". 
        - Si la nota és 8 o 9, imprimir "Molt bé". 
        - Si la nota és 5, 6 o 7, imprimir "Bé". 
        - Per qualsevol altra nota, imprimir "Insuficient".</h2>
    <?php

    $nota = 5;

    $result = match ($nota) {
        10 => "Excelent".'<br/>',
        8,9 => "Molt bé".'<br/>',
        5,6,7 => "Bé".'<br/>',
        default =>  "Insuficient".'<br/>',
    };

    echo $result;

    ?>
</body>
</html>