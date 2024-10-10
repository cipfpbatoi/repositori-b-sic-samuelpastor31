<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
    <?php
    // Función para inicializar la graella (tablero)
    function inicialitzarGraella() {
        $graella = array();
        for ($i = 0; $i < 6; $i++) {
            for ($j = 0; $j < 7; $j++) {
                $graella[$i][$j] = 0;  // 0 indica que la celda está vacía
            }
        }
        return $graella;
    }
    
    // Función para pintar la graella como una tabla HTML
    function pintarGraella($graella) {
        $html = "<table>";
        foreach ($graella as $fila) {
            $html .= "<tr>";
            foreach ($fila as $celda) {
                if ($celda == 0) {
                    $html .= "<td></td>";  // Celda vacía
                } elseif ($celda == 1) {
                    $html .= "<td class='player1'></td>";  // Jugador 1 (rojo)
                } elseif ($celda == 2) {
                    $html .= "<td class='player2'></td>";  // Jugador 2 (amarillo)
                }
            }
            $html .= "</tr>";
        }
        $html .= "</table>";
        return $html;
    }
    
    // Función para manejar el movimiento del jugador
    function ferMoviment(&$graella, $columna, $jugadorActual) {
        // Recorremos la columna desde la última fila hacia la primera
        for ($fila = 5; $fila >= 0; $fila--) {
            if ($graella[$fila][$columna-1] == 0) {
                $graella[$fila][$columna-1] = $jugadorActual;
                return true; // Movimiento válido
            }
        }
        return false;  // Si la columna está llena, no se puede hacer el movimiento
    }    
    ?>
</body>
</html>