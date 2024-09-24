<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Functions</title>
</head>
<body>

<?php
function comprobarIntentos($paraula, $letra, $paraulaIncompleta) {
    $letraEncontrada = false;
    
    // Recorre la palabra y reemplaza los guiones con la letra si la encuentra
    for ($i = 0; $i < strlen($paraula); $i++) {
        $paraulaIncompleta[$i] = "_";
        if ($paraula[$i] == $letra) {
            $paraulaIncompleta[$i] = $letra; // Sustituye el guion
            $letraEncontrada = true;
        }
    }
    
    // Devuelve la palabra incompleta actualizada
    return $paraulaIncompleta;
}
?>

    
</body>
</html>