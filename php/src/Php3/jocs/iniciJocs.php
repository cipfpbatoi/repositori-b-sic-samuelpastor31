<?php
session_start();

if (isset($_GET['unlogin'])) {
    session_destroy();
    setcookie('remembered_user','', time() -3600,'/');
    header("Location: indexJocs.php");
    exit();
}

if (isset($_GET['ofegat'])) {
    header("Location: ./ofegat/index.php");
    exit();
}

if (isset($_GET['4enratlla'])) {
    header("Location: ./4EnRatlla/index.php");
    exit();
}
?>

<p>Benvingut, <?php echo $_SESSION['user']; ?> ellegeix el joc al que vols jugar</p>

<ul>
    <li>
    <a href="?ofegat=true">Ofegat</a>
</li>
    <li>
    <a href="?4enratlla=true">4 en ratlla</a>
</li>
</ul>
    <a href="?unlogin=true">Tancar sessió</a>

