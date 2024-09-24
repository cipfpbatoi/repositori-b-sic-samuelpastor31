<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Alta Llibre</title>
</head>
<body>

<?php
// Arrays per als valors del mòdul i l'estat
$moduls = ["DAW", "DAM", "ASIX"];
$estats = ["completat" => "Completat", "comenzado" => "Comenzat"];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $module = $_POST['module'][0];
    $publisher = $_POST['publisher'];
    $price = $_POST['price'];
    $pages = $_POST['pages'];
    $status = $_POST['status'][0];
    $comments = $_POST['comments'];
    
    
        if (is_uploaded_file($_FILES['photo']['tmp_name'])) {
            // subido con éxito
            $nombre = $_FILES['photo']['name'];
            move_uploaded_file($_FILES['photo']['tmp_name'], "./uploads/{$nombre}");

            echo "<p>Archivo $nombre subido con éxito</p>";
        }
        // Mostrar resultats en una taula
    echo "<h2>Resultat:</h2>";
    echo "<table>
            <tr><th>Mòdul</th><td>$module</td></tr>
            <tr><th>Editorial</th><td>$publisher</td></tr>
            <tr><th>Preu</th><td>$price</td></tr>
            <tr><th>Pàgines</th><td>$pages</td></tr>
            <tr><th>Estat</th><td>$status</td></tr>;
            <tr><th>Comentaris</th><td>$comments</td></tr>
            <tr><th>Photo</th><td><img src='uploads/$nombre' alt='Imagen subida'></td></tr>
          </table>";

}
    
    
    
?>

<form enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
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
        <span class="error"><!-- Missatge d'error per a l'editorial aquí --></span>
    </div>
    <div>
        <label for="price">Preu:</label>
        <input type="text" id="price" name="price" value="">
        <span class="error"><!-- Missatge d'error per al preu aquí --></span>
    </div>
    <div>
        <label for="pages">Pàgines:</label>
        <input type="text" id="pages" name="pages" value="">
        <span class="error"><!-- Missatge d'error per a les pàgines aquí --></span>
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
        <button type="submit" name="btnSubir" value = "subir">Donar d'alta</button>
    </div>
</form>
</body>
</html>