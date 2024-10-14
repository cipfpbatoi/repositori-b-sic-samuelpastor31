<?php
// Función para inicializar la graella (tablero)
function inicialitzarGraella()
{
    $graella = array();
    for ($i = 0; $i < 6; $i++) {
        for ($j = 0; $j < 7; $j++) {
            $graella[$i][$j] = 0;  // 0 indica que la celda está vacía
        }
    }
    return $graella;
}

// Función para pintar la graella como una tabla HTML
function pintarGraella($graella)
{
    $html = "<table>";
    foreach ($graella as $fila) {
        $html .= "<tr>";
        foreach ($fila as $celda) {
            if ($celda == 0) {
                $html .= "<td class='buid'></td>";  // Celda vacía
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


function ferMoviment(&$graella, $columna, $jugadorActual)
{
    // Recorremos la columna desde la última fila hacia la primera
    for ($fila = 5; $fila >= 0; $fila--) {
        if ($graella[$fila][$columna - 1] == 0) {
            $graella[$fila][$columna - 1] = $jugadorActual;
            return true; // Movimiento válido
        }
    }
    return false;  // Si la columna está llena, no se puede hacer el movimiento
}

// Función para comprobar si hay un ganador (4 en línea)
function comprobarGuanyador($graella, $jugador){
    for ($i = 0; $i < 6; $i++) {
        for ($j = 0; $j < 7; $j++) {
            if (
                ($j <= 3 && $graella[$i][$j] == $jugador && $graella[$i][$j + 1] == $jugador && $graella[$i][$j + 2] == $jugador && $graella[$i][$j + 3] == $jugador) ||
                ($i <= 2 && $graella[$i][$j] == $jugador && $graella[$i + 1][$j] == $jugador && $graella[$i + 2][$j] == $jugador && $graella[$i + 3][$j] == $jugador) ||
                ($i <= 2 && $j <= 3 && $graella[$i][$j] == $jugador && $graella[$i + 1][$j + 1] == $jugador && $graella[$i + 2][$j + 2] == $jugador && $graella[$i + 3][$j + 3] == $jugador) ||
                ($i >= 3 && $j <= 3 && $graella[$i][$j] == $jugador && $graella[$i - 1][$j + 1] == $jugador && $graella[$i - 2][$j + 2] == $jugador && $graella[$i - 3][$j + 3] == $jugador)
            ) {
                return true;
            }
        }
    }
    return false;
}

// Función para comprobar si la graella está llena (empate)
function comprobarTaulerPle($graella)
{
    foreach ($graella as $fila) {
        foreach ($fila as $celda) {
            if ($celda == 0) {
                return false;
            }
        }
    }
    return true;
}
?>
