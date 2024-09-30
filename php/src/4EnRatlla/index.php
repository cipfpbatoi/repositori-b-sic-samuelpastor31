<!DOCTYPE html>
<html lang="en">
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
            border: 2px solid #000;
            background-color: #fff;
            text-align: center;
            vertical-align: middle;
        }
        .player1 {
            background-color: red;
        }
        .player2 {
            background-color: yellow;
        }
    </style>
</head>
<body>
    <h2>JOC 4 EN RATLLA</h2>

    <form action="" method="post">
        <?php
        // Incluir funciones desde el archivo separado
        require 'functions.php';

        // Inicializar la graella o recuperar su estado del formulario
        if (isset($_POST['graella'])) {
            $graella = json_decode($_POST['graella'], true);
            $jugadorActual = $_POST['jugadorActual'] == 1 ? 2 : 1;  // Alternar jugador
        } else {
            $graella = inicialitzarGraella();
            $jugadorActual = 1;  // Empezar con el jugador 1
        }

        // Si se ha enviado un movimiento
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['columna'])) {
            $columna = intval($_POST['columna']); // Obtener la columna seleccionada

            // Hacer el movimiento
            if (ferMoviment($graella, $columna, $jugadorActual)) {
                echo "<h3>Jugador $jugadorActual ha jugado en la columna $columna.</h3>";
            } else {
                echo "<h3>Columna $columna está llena. Intenta otra.</h3>";
            }
        }

        // Pintar la graella después de hacer el movimiento
        echo pintarGraella($graella);

        // Guardar el estado actual de la graella y el jugador en campos ocultos (serializado en JSON)
        ?>
        <input type="hidden" name="graella" value='<?php echo json_encode($graella); ?>'>
        <input type="hidden" name="jugadorActual" value='<?php echo $jugadorActual; ?>'>  <!-- Campo oculto para el jugador actual -->

        <div>
            <label for="columna">Número de columna (0-7):</label>
            <input type="number" id="columna" name="columna" min="0" max="7" required>
        </div>

        <div>
            <button type="submit">Jugar</button>
        </div>
    </form>
</body>
</html>
