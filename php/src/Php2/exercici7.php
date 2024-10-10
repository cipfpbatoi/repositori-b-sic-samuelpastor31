<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Formulari de Contacte</title>
</head>
<body>

    <h1>Exercici 7: Validació de Formularis</h1>
    <h2>Crea un formulari en HTML que permeti als usuaris introduir el seu nom, 
        el correu electrònic i un password (dues vegades). Després de l'enviament del formulari, 
        valida que tots els camps han estat completats i que el correu electrònic és 
        vàlid, que el password tingui complexitat i que coincideixin. Mostra un missatge 
        d'error si alguna validació falla, i si tot és correcte, mostra un missatge 
        confirmant que l'usuari s'ha registrat correctament.</h2>

    <?php
    $nom = $email = $passwd = $passwdConfirm = "";
    $errors = [];
    $successMessage = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nom = htmlspecialchars($_POST['nom']);
        $email = htmlspecialchars($_POST['email']);
        $passwd = htmlspecialchars($_POST['passwd']);
        $passwdConfirm = htmlspecialchars($_POST['passwdConfirm']);

        // Validar el correu electrònic
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Adreça de correu electrònic no vàlida. Si us plau, torna-ho a intentar.";
        }

        // Validar contrasenyes
        if (strlen($passwd) < 8) {
            $errors[] = "La contrasenya ha de tenir almenys 8 caràcters.";
        }
        if ($passwd !== $passwdConfirm) {
            $errors[] = "Les contrasenyes no coincideixen.";
        }

        //Validar usuari
        if (strlen($nom) <= 0) {
            $errors[] = "Indica nom de usuari.";
        }

        // Si hi ha errors, mostrar-los
        if (empty($errors)) {
            // Si no hi ha errors, mostrar el missatge de confirmació
            $successMessage = "Gràcies, $nom! T'has registrat correctament.";
        } else {
            foreach ($errors as $error) {
                echo "<p style='color:red;'>$error</p>";
            }
        }
    }
    ?>

    <h2>Formulari de Contacte</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" value="<?php echo $nom; ?>"><br><br>

        <label for="email">Correu electrònic:</label>
        <input type="email" id="email" name="email" value="<?php echo $email; ?>"><br><br>

        <label for="passwd">Contrasenya:</label>
        <input type="password" id="passwd" name="passwd"><br><br>

        <label for="passwdConfirm">Confirmar Contrasenya:</label>
        <input type="password" id="passwdConfirm" name="passwdConfirm"><br><br>

        <input type="submit" value="Enviar">
    </form>

    <?php
    // Mostrar el missatge de confirmació si no hi ha errors
    if ($successMessage) {
        echo "<h2 style='color:green;'>$successMessage</h2>";
    }
    ?>
</body>
</html>
