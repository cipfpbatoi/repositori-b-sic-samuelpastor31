<?php
session_start();

// Inicialitzem el carret si no existeix
if (isset($_SESSION['carret'])) {
    $carret = $_SESSION['carret'];
} else {
    $carret = array();
}

// Eliminar producte del carret
if (isset($_GET['producte'])){
    $producte_a_eliminar = $_GET['producte'];
    
    // Busca el producte en el carret i elimina la primera coincidència
    $index = array_search($producte_a_eliminar, $carret);
    if ($index !== false) {
        unset($carret[$index]);
        // Reindexar el carret després de l'ús de unset
        $carret = array_values($carret);
        $_SESSION['carret'] = $carret;
    }
}

?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>El teu carret de compra</title>
</head>
<body>
    <h1>El teu carret de compra</h1>
    
    <?php if (count($carret) > 0): ?>
        <ul>
            <?php
            // Comptadors per a cada tipus de producte
            $taronjes= [];
            $pomes = [];
            $platans = [];

            // Bucle correcte per iterar sobre els elements del carret
            for ($i = 0; $i < count($carret); $i++) {
                if ($carret[$i] == "Taronja") {
                    $taronjes[] = $carret[$i];
                } elseif ($carret[$i] == "Poma") {
                    $pomes[] = $carret[$i];
                } elseif($carret[$i] == "Plàtan") {
                    $platans[] = $carret[$i];
                }
            }?>   
            <li><?php echo htmlspecialchars("Hi ha " . count($taronjes) . " taronjes, " .
                count($pomes) . " pomes i " . count($platans) . " platans"); ?></li>
        </ul>
    <?php else: ?>
        <p>El carret està buit.</p>
    <?php endif; ?>

    <h1>Eliminar productes del carret</h1>
    <form action="" method="GET">
        <label for="producte">Tria un producte per a eliminar:</label>
        <select name="producte" id="producte">
            <option value="Poma">Poma</option>
            <option value="Taronja">Taronja</option>
            <option value="Plàtan">Plàtan</option>
        </select>
        <input type="submit" value="Eliminar del carret">
    </form>
    
    <a href="index.php">Tornar a la selecció de productes</a>
</body>
</html>
