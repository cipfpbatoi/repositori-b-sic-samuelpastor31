<!DOCTYPE html>
<html>
<body>
    <h1>Exercici 5: Arrays Multidimensionals</h1>
    <h2>Crea un array multidimensional que represente una taula de multiplicar del 1 al 5 i imprimeix els resultats en forma de taula.</h2>
    
    <?php

$taula = array();

// Omplir l'array amb els resultats de la multiplicació
for ($i = 1; $i <= 5; $i++) {
    for ($j = 1; $j <= 5; $j++) {
        // Guardar el resultat de la multiplicació a l'array
        $taula[$i][$j] = "$i x $j = " . ($i * $j);
    }
}

// Mostrar la taula de multiplicar amb els números i resultats
echo "<table border='1'>";
for ($i = 1; $i <= 5; $i++) {
    echo "<tr>"; //fila
    for ($j = 1; $j <= 5; $j++) {
        echo "<td>" . $taula[$i][$j] . "</td>"; //columna
    }
    echo "</tr>";
}
echo "</table>";
?>

</body>
</html>