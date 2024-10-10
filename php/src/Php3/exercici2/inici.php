<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}

if (isset($_GET['unlogin'])) {
    session_destroy();
    header("Location: index.php");
    exit;
} 
?>

<p>Benvingut, <?php echo $_SESSION['user']; ?></p>

<form method="GET">
    <a href ="?unlogin=true">Tancat sessió</a>
</form>
