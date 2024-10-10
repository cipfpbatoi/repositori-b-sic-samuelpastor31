<?php
session_start();

// Incluir funciones desde otro archivo
require 'functions.php';

// Comprobar si el usuario está autenticado
if (!isset($_SESSION['user'])) {
    header("Location: ../indexJocs.php");
    exit();
}

// Comprobar si el usuario quiere cerrar sesión
if (isset($_GET['unlogin'])) {
    session_destroy();
    header("Location: ../indexJocs.php");
    exit();
}

// La palabra a adivinar
$paraula = "carnestoltes";

// Si es la primera vez, inicializar la palabra a adivinar con guiones bajos y los errores a 0
if (!isset($_POST['endevinar'])) {
    $errors = 0;
    $letrasUsadas = "";
    $endevinar = str_repeat("_", strlen($paraula));
} else {
    $letrasUsadas = $_POST['letrasUsadas'];
    $endevinar = $_POST['endevinar'];
    $errors = $_POST['errors'];
}

// Variable para determinar si el juego ha finalizado
$finalitzat = false;

// Lógica para procesar la letra ingresada por el usuario
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //reiniciar joc
    if (isset($_POST['reiniciar'])) {
        unset($_SESSION['endevinar']);
        unset($_SESSION['errors']);
        header("Location: ../ofegat/index.php");
        exit();
    }

    if (isset($_POST['letra']) && !$finalitzat) {
        $letra = strtolower($_POST['letra']); // Convertir la letra a minúscula para evitar problemas de case-sensitive

        // Actualiza la palabra incompleta con la función comprobarIntentos
        $letraEncontrada = comprobarIntentos($paraula, $letra, $endevinar);

        // Mostrar mensaje sobre el resultado de la letra ingresada
        if ($letraEncontrada) {
            echo "<h2 class='correct'>Lletra '$letra' trobada</h2>";
            $letrasUsadas = $letrasUsadas . " <span class='correct'> $letra</span>";
        } else {
            echo "<h2 class='incorrect'>Lletra '$letra' no trobada</h2>";
            $letrasUsadas = $letrasUsadas . " <span class='incorrect'> $letra</span>";
            $errors++;
        }

        // Comprobar si la palabra ha sido completamente adivinada
        if ($endevinar === $paraula) {
            $finalitzat = true;
            echo "<h2 class='correct'>Felicitats, has completat la paraula '$paraula'!</h2>";
        }

        // Comprobar si se han superado los 5 errores permitidos
        if ($errors > 5) {
            $finalitzat = true;
            echo "<h2 class='incorrect'>El joc ha finalitzat! Has fet més de 5 errors.</h2>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Joc del Ofegat</title>
    <style>
        .correct {
            color: green;
        }

        .incorrect {
            color: red;
        }
    </style>
</head>

<body>
    <h1>Joc Ofegat</h1>

    <?php if (!$finalitzat): ?>
        <form action="" method="post">
            <div>
                <label for="endevinar">Paraula a endevinar:</label>
                <p><?php echo $endevinar; ?></p>
                <!-- Campo oculto para mantener el estado de la palabra incompleta -->
                <input type="hidden" name="endevinar" value="<?php echo $endevinar; ?>">
                <input type="hidden" name="errors" value="<?php echo $errors; ?>">
                <input type="hidden" name="letrasUsadas" value="<?php echo $letrasUsadas; ?>">
            </div>

            <div>
                <label for="letra">Lletra:</label>
                <input type="text" id="letra" name="letra" maxlength="1" required>
            </div>

            <div>
                <button type="submit">Provar Lletra</button>
            </div>
            <div>
                <p>Lletres encertades: <?php echo $letrasUsadas; ?></p>
                <p>Errors: <?php echo $errors; ?></p>
            </div>
        </form>
    <?php elseif ($errors > 5): ?>
        <p>El joc ha finalitzat! Has fet més de 5 intents.</p>
    <?php else: ?>
        <p>El joc ha finalitzat! Has endevinat la paraula: <?php echo $paraula; ?></p>
    <?php endif; ?>

    <form action="" method="post">
        <button type="submit" name="reiniciar"> Reiniciar joc </button>
    </form>

    <br><a href="?unlogin=true">Tancar sessió</a>
</body>

</html>