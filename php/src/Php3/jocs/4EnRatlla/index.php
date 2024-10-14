<?php
session_start();

// Incluir funciones desde el archivo separado
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

// Inicializar la graella y el jugador actual
if (isset($_POST['graella'])) {
    $graella = json_decode($_POST['graella'], true);
    $jugadorActual = $_POST['jugadorActual'] == 1 ? 2 : 1;
} else {
    $graella = inicialitzarGraella();
    $jugadorActual = 1;
}

// Variable para determinar si la partida ha finalizado
$finalitzat = false;

// Si se ha enviado un movimiento
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['reiniciar'])) {
        unset($_SESSION['graella']);
        header("Location: ../4EnRatlla/index.php");
        exit();
    }

    if (isset($_POST['columna'])) {
        $columna = intval($_POST['columna']); // Obtener la columna

        // Hacer el movimiento
        if (ferMoviment($graella, $columna, $jugadorActual)) {
            echo "<h3>Jugador $jugadorActual ha jugat en la columna $columna.</h3>";

            // Comprobar si el movimiento ha generado un ganador
            if (comprobarGuanyador($graella, $jugadorActual)) {
                echo "<h2>¡Jugador $jugadorActual ha guanyat!</h2>";
                $finalitzat = true;
            }
        } else {
            echo "<h3>Columna $columna está plena. Perds el torn.</h3>";
        }
    }

    // Comprobar si la graella está llena
    if (comprobarTaulerPle($graella) && !$finalitzat) {
        echo "<h2>La partida ha finalitzat en empat. ¡No hi ha més movimients possibles!</h2>";
        $finalitzat = true;
    }
}

// Pintar graella
echo pintarGraella($graella);
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Joc 4 en ratlla</title>
    <style>
        table { border-collapse: collapse; }
        td {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            border: 10px dotted #fff;
            background-color: #000;
            display: inline-block;
            margin: 10px;
            color: white;
            font-size: 2rem;
            text-align: center;
            vertical-align: middle;
        }
        .player1 {
            background-color: red;
        }
        .player2 {
            background-color: yellow;
        }
        .buid {
            background-color: white;
            border-color: #000;
        }
    </style>
</head>

<body>
    <h1>Joc 4 en ratlla</h1>
    <?php if (!$finalitzat): ?>
        <form action="" method="post">
            <input type="hidden" name="graella" value='<?php echo json_encode($graella); ?>'>
            <input type="hidden" name="jugadorActual" value='<?php echo $jugadorActual; ?>'>
            <div>
                <label for="columna">Número de columna (0-7):</label>
                <input type="number" id="columna" name="columna" min="0" max="7" required>
            </div>
            <div>
                <button type="submit">Jugar</button>
            </div>
        </form>
    <?php else: ?>
        <p>La partida ha finalitzat.</p>
    <?php endif; ?>

    <!-- Formulario para reiniciar el juego siempre visible -->
    <form action="" method="post">
        <button type="submit" name="reiniciar">Reiniciar joc</button>
    </form>

    <br><a href="?unlogin=true">Tancar sessió</a>
</body>
</html>
