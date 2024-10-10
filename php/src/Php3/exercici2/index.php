<?php
session_start();
// Llista d'usuaris predefinits amb contrasenyes en text pla
$users = [
    'user1' => 'password1',
    'user2' => 'password2',
    '1' => '1',
];

// Convertir les contrasenyes a un format encriptat
foreach ($users as $user => $password) {
    $users[$user] = password_hash($password, PASSWORD_BCRYPT);
}

// Formulari d'autenticació
if (isset($_POST['login'])) {
    $user = $_POST['user'];
    $password = $_POST['password'];

    if (isset($users[$user]) && password_verify($password, $users[$user])) {
        $_SESSION['user'] = $user;
        header("Location: inici.php");
        exit;
    } else {
        // Credencials incorrectes
        echo "Invalid user or password.";
    }
}
?>
<form method="post">
    User: <input type="text" name="user" required>
    Password: <input type="password" name="password" required>
    <button type="submit" name="login">Login</button>
</form>