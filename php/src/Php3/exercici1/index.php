<?php
session_start();

// Inicialitzem el carret si no existeix
if (isset($_SESSION['carret'])) {
    $carret = $_SESSION['carret'];
}else{
    $carret = array();
}

if (isset($_POST['producte'])){
    $carret[] = $_POST['producte'];
    $_SESSION['carret'] = $carret;
}

?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Selecció de productes</title>
</head>
<body>
    <h1>Afegir productes al carret</h1>
    <form action="" method="POST">
        <label for="producte">Tria un producte:</label>
        <select name="producte" id="producte">
            <option value="Poma">Poma</option>
            <option value="Plàtan">Plàtan</option>
            <option value="Taronja">Taronja</option>
        </select>
        <input type="submit" value="Afegir al carret">
    </form>
    <a href="carret.php">Veure carret</a>
</body>
</html> 
