<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Joc del Ofegat</title>
    <style>
        .correct { color: green; }
        .incorrect { color: red; } 
    </style>
</head>
<body>

    <h1>Joc Ofegat</h1>

    <form action="" method="post">

    <?php 
    // La palabra a adivinar
    $paraula = "carnestoltes"; 

    // Si es la primera vez poner guiones, si no usar el valor enviado
    if (!isset($_POST['endevinar'])) {
        $endevinar = str_repeat("_", strlen($paraula));
    } else {
        $endevinar = $_POST['endevinar'];
    }

    // Si se ha enviado una letra, procesa la entrada
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $letra = $_POST['letra'];

        // Incluye las funciones desde otro archivo
        require 'functions.php';

        $endevinarAntic = $endevinar;

        // Actualiza la palabra incompleta con la función comprobarIntentos
        $endevinar = comprobarIntentos($paraula, $letra, $endevinar);


        // Missatge de lletra
        if ($endevinar == comprobarIntentos($paraula, " ", $endevinar)) {
            echo "<h2 class='incorrect'>Lletra '$letra' no trobada</h2>";
        } else {
            echo "<h2 class='correct'>Lletra '$letra' trobada</h2>";
        }
    }
    ?>

    <div>
        <label for="endevinar">Paraula a endevinar :</label>
        <p><?php echo $endevinar; ?></p>
        <!-- Campo oculto para mantener el estado de la palabra incompleta -->
        <input type="hidden" name="endevinar" value="<?php echo $endevinar; ?>">
    </div>

    <div>
        <label for="letra">Lletra :</label>
        <input type="text" id="letra" name="letra" maxlength="1" required>
    </div>

    <div>
        <button type="submit">Provar Lletra</button>
    </div>
    </form>

</body>
</html>
