<?php
session_start();

$servername = "localhost";
$username = "phpmyadmin";
$password = "40never65";
$db = "Weiterbildungstool";

$con = new mysqli($servername, $username, $password, $db);

if(isset($_GET['login'])) {
    $email = $_POST['email'];
    $passwort = $_POST['passwort'];

    $statement = $con->prepare("SELECT * FROM users WHERE email = :email");
    $result = $statement->execute(array('email' => $email));
    $user = $statement->fetch();

    //Überprüfung ob die Aktivierung bereits erfolgt ist
    $akt_check = $con->prepare("Select aktiviert from aktivierung where email = :email");
    $res =  $akt_check->execute(array('email' => $email));
    $check = $res->fetch();

    if ($check ==0){
        $ermessage = "Sie müssen die Aktivierung abschließen, um sich einloggen zu können. Klicken sie hierfür auf den Link in der Registrierungsmail<br>";
    }

    //Überprüfung des Passworts
    if ($user !== false && password_verify($password, $user['passwort'])) {
        $_SESSION['userid'] = $user['id'];
        die('Login erfolgreich. Weiter zu <a href="geheim.php">internen Bereich</a>');
    } else {
        $errorMessage = "E-Mail oder Passwort war ungültig<br>";
    }


}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>

<?php
if(isset($errorMessage)) {
    echo $errorMessage;
}
?>

<form action="?login=1" method="post">
    E-Mail:<br>
    <input type="email" size="40" maxlength="250" name="email"><br><br>

    Dein Passwort:<br>
    <input type="password" size="40"  maxlength="250" name="passwort"><br>

    <input type="submit" value="Abschicken">
</form>
</body>
</html>
