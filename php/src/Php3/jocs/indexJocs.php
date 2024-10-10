<?php
session_start();

// Llista d'usuaris predefinits amb contrasenyes en text pla
$users = [
    'user1' => 'password1',
    'user2' => 'password2',
    '1' => '1',
];

// Convertir les contrasenyes a un format encriptat per motius de seguretat
foreach ($users as $user => $password) {
    $users[$user] = password_hash($password, PASSWORD_BCRYPT);
}

// Comprovar si hi ha una cookie per iniciar sessió automàticament
if (!isset($_SESSION['user']) && isset($_COOKIE['remembered_user'])) {
    $user = $_COOKIE['remembered_user'];
    if (isset($users[$user])) {
        $_SESSION['user'] = $user;
        header("Location: iniciJocs.php");
        exit();
    }
}

// Comprovar si s'ha enviat el formulari de login
if (isset($_POST['login'])) {
    $user = $_POST['user'];
    $password = $_POST['password'];

    // Comprovar les credencials
    if (isset($users[$user]) && password_verify($password, $users[$user])) {
        $_SESSION['user'] = $user;

        // Si la casella de "Recorda'm" està marcada, establir la cookie
        if (isset($_POST['remember'])) {
            setcookie(
                'remembered_user',
                $user,
                time() + (86400 * 30), // Cookie valida durant 30 dies
                '/',
                '',
                true, // Només enviar per HTTPS
                true  // Només accessible a través de HTTP (no JavaScript)
            );
        } else {
            // Si la casella no està marcada, esborrem qualsevol cookie existent
            setcookie('remembered_user', '', time() - 3600, '/', '', true, true);
        }

        header("Location: iniciJocs.php");
        exit();
    } else {
        // Credencials incorrectes
        $error = "Usuari o contrasenya incorrectes.";
    }
}

// Comprovar si l'usuari ha demanat tancar sessió
if (isset($_GET['unlogin'])) {
    session_destroy();
    setcookie('remembered_user', '', time() - 3600, '/', '', true, true); // Eliminar la cookie
    header("Location: indexJocs.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inici de Sessió</title>
</head>
<body>
    <?php if (isset($_SESSION['user'])): ?>
        <p>Benvingut, <?php echo htmlspecialchars($_SESSION['user']); ?></p>
        <form method="GET">
            <button type="submit" name="unlogin">Tanca la sessió</button>
        </form>
    <?php else: ?>
        <?php if (isset($error)): ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php endif; ?>
        <form method="post">
            <label for="user">Usuari:</label>
            <input type="text" id="user" name="user" required>
            <br>
            <label for="password">Contrasenya:</label>
            <input type="password" id="password" name="password" required>
            <br>
            <label>
                <input type="checkbox" name="remember"> Recorda'm
            </label>
            <br>
            <button type="submit" name="login">Inicia Sessió</button>
        </form>
    <?php endif; ?>
</body>
</html>
