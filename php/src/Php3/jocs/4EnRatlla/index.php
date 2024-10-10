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
            echo "<h3>Jugador $jugadorActual ha jugado en la columna $columna.</h3>";
        } else {
            echo "<h3>Columna $columna está llena. Intenta otra.</h3>";
        }
    }

    if (comprobarTauler($graella) == true) {
    }  
}

// Pintar graella
echo pintarGraella($graella);

// Guardar el estado actual de la graella y el jugador en campos ocultos (serializado en JSON)
?>

<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Joc del Ofegat</title>
    <style>
        
        table { border-collapse: collapse; }
            td {
                width: 50px;
                height: 50px;
                border-radius: 50%;
                border: 10px dotted #fff; /* Cercle amb punts blancs */
                background-color: #000; /* Fons negre o pot ser un altre color */
                display: inline-block;
                margin: 10px;
                color: white;
                font-size: 2rem;
                text-align: center ;
                vertical-align: middle;
            }
            .player1 {
                background-color: red; /* Color vermell per un dels jugadors */
            }
            .player2 {
                background-color: yellow; /* Color groc per l'altre jugador */
            }
            .buid {
                background-color: white; /* Color blanc per cercles buits */
                border-color: #000; /* Puntes negres per millor visibilitat */
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
        <p>La partida se ha acabado. Intenta otra.</p>
<form action="" method="post">
    <button type="submit" name="reiniciar"> Reiniciar joc </button>
</form>
<br><a href="?unlogin=true">Tancar sessió</a>
</body>

</html>