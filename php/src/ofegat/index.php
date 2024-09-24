<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Joc del Ofegat</title>
</head>
<body>

    <h1>Joc Ofegat</h1>

    <<form action="index.php" method="post">

<div>
    <label for="module">Mòdul:</label>
    <select id="module" name="module">
        <?php
        $modules = ["DAM", "DAW", "ASIX"];
        foreach ($modules as $mod) {
            echo "<option value='$mod'>$mod</option>";
        }
        ?>
    </select>
</div>

<div>
    <label for="publisher">Editorial:</label>
    <input type="text" id="publisher" name="publisher" value="">
</div>

<div>
    <button type="submit">Donar d'alta</button>
</div>
</form>

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $module = $_POST['module'];
    $publisher = $_POST['publisher'];

    echo "<h2>Detalls del llibre:</h2>";
    echo "<table border='1'>";
    echo "<tr><th>Mòdul</th><td>$module</td></tr>";
    echo "<tr><th>Editorial</th><td>$publisher</td></tr>";
    echo "</table>";
    }
?>

</body>
</html>