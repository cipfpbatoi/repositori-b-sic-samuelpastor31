<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Alta Llibre</title>
</head>
<body>

<h1>Exercici 8: Processament de Formularis amb Select i Radio Buttons</h1>
    <h2>A partir del formulari newBook.php, fes que el mòdul i el estat els 
        agafe de valors introduïts en arrays. Mostra el resultat en una taula.</h2>

<form action="exercici8.php" method="post">

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
        <label for="price">Preu:</label>
        <input type="text" id="price" name="price" value="">
    </div>

    <div>
        <label for="pages">Pàgines:</label>
        <input type="text" id="pages" name="pages" value="">
    </div>

    <div>
        <label for="status">Estat:</label>
        <?php
        $statuses = ["Disponible", "No disponible"];
        foreach ($statuses as $stat) {
            echo "<input type='radio' name='status' value='$stat'>$stat ";
        }
        ?>
    </div>

    <div>
        <label for="photo">Foto:</label>
        <input type="file" id="photo" name="photo">
    </div>

    <div>
        <label for="comments">Comentaris:</label>
        <textarea id="comments" name="comments"></textarea>
    </div>

    <div>
        <button type="submit">Donar d'alta</button>
    </div>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $module = $_POST['module'];
    $publisher = $_POST['publisher'];
    $price = $_POST['price'];
    $pages = $_POST['pages'];
    $status = $_POST['status'];
    $photo = $_POST['photo'];
    $comments = $_POST['comments'];

    echo "<h2>Detalls del llibre:</h2>";
    echo "<table border='1'>";
    echo "<tr><th>Mòdul</th><td>$module</td></tr>";
    echo "<tr><th>Editorial</th><td>$publisher</td></tr>";
    echo "<tr><th>Preu</th><td>$price</td></tr>";
    echo "<tr><th>Pàgines</th><td>$pages</td></tr>";
    echo "<tr><th>Estat</th><td>$status</td></tr>";
    echo "<tr><th>Foto</th><td>$photo</td></tr>";
    echo "<tr><th>Comentaris</th><td>$comments</td></tr>";
    echo "</table>";
}
?>

</body>
</html>