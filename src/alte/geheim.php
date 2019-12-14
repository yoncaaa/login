<?php
session_start();
if(!isset($_SESSION['userid'])) {
    die('Bitte zuerst <a href="login.php">einloggen</a>');
}
 
//Abfrage der Nutzer ID vom Login
$username = $_SESSION['username'];
 
echo "Hallo ".$username ."! <br>";

echo '<br><br>Zum <a href="logout.php"> Logout</a>';
?>