<?php
function comprobarIntentos($paraula, $letra, &$paraulaIncompleta) {
    $letraEncontrada = false;
    
    // Recorre la palabra y reemplaza los guiones con la letra si la encuentra
    for ($i = 0; $i < strlen($paraula); $i++) {
        if ($paraula[$i] == $letra) {
            $paraulaIncompleta[$i] = $letra; // Sustituye el guion
            $letraEncontrada = true;
        }
    }
    return $letraEncontrada;
}
?>