<?php
session_start();

// Funció per generar un token CSRF
function generateCSRFToken() {
    // Generar un token únic i emmagatzemar-lo a la sessió
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32)); // Crea un token de 64 caràcters
    }
}

// Funció per verificar el token CSRF
function verifyCSRFToken($token) {
    // Comprovar si el token del formulari coincideix amb el de la sessió
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

// Generar el token CSRF quan es carrega la pàgina
generateCSRFToken();

// Inicialitzar variables per als missatges i errors
$successMessage = '';
$errorMessage = '';

// Comprovar si el formulari ha estat enviat
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    $csrfToken = $_POST['csrf_token'];

    // Validar el token CSRF
    if (verifyCSRFToken($csrfToken)) {
        // Si el token és vàlid, processar el formulari (en aquest cas, només un missatge de confirmació)
        $successMessage = "Gràcies, $name. El teu missatge ha estat enviat correctament!";
    } else {
        // Si el token no és vàlid, mostrar un missatge d'error
        $errorMessage = "Error: el token CSRF no és vàlid.";
    }
}
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulari de Contacte</title>
</head>
<body>
    <h1>Formulari de Contacte</h1>

    <?php if (!empty($successMessage)): ?>
        <p style="color: green;"><?php echo $successMessage; ?></p>
    <?php endif; ?>

    <?php if (!empty($errorMessage)): ?>
        <p style="color: red;"><?php echo $errorMessage; ?></p>
    <?php endif; ?>

    <form method="POST" action="">
        <label for="name">Nom:</label>
        <input type="text" id="name" name="name" required>
        <br><br>

        <label for="email">Correu electrònic:</label>
        <input type="email" id="email" name="email" required>
        <br><br>

        <label for="message">Missatge:</label>
        <textarea id="message" name="message" required></textarea>
        <br><br>

        <!-- Camp ocult per incloure el token CSRF -->
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

        <button type="submit">Enviar</button>
    </form>
</body>
</html>
