
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login and Registration</title>
    <link rel="stylesheet" href="style.css">
    <!--<link rel="stylesheet" href="loginheader.css">-->
    <link rel="stylesheet" href="homestyle.css">

</head>
<body>
<header>
    <a href="home.html"><img class="logo" src="logo.jpg" alt="logo"></a>
    <nav>
        <ul class="nav_links">
            <li><a class="yes" href="#">Services</a> </li>
            <li><a class="yes" href="#">Projects</a> </li>
            <li><a class="yes" href="#">About</a> </li>
        </ul>
    </nav>
    <a class="cta" class="yes" href="loginpage.html"><button class="header-button">Login</button></a>
</header>
<div class="login-page">
    <div class="form">
        <form class="register-form" id="register-form">
            <input type="text" placeholder="username"/>
            <input type="text" placeholder="password"/>
            <input type="text" placeholder="e-mail"/>
            <button >Create</button>
            <p class="message">Already registered? <a href="#" class="no" onclick="swfromreg()">Login</a></p>
        </form>
        <form class="login-form" id="login-form" method="post">
            <input type="email" placeholder="email" name="email"/>
            <input type="password" placeholder="password" name="password"/>
            <button class="form-button" type="submit" value="Abschicken">login</button>
            <p class="message" onclick="sw()">Not registered? <a href="#" class="no" onclick="swfromlog()" >Register</a></p>
        </form>



    </div>


</div>
<script src="login.js"></script>

<!--
    <script src='https://code.jquery.com/jquery-3.2.1.min.js'></script>
       <script>
        $('.message a').click(function(){
            $('form').animate({height:"toggle", opacity:"toggle"},"slow");
        });
       </script>
-->

<?php 
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=Weiterbildungstool', 'phpmyadmin', '40never65');
 
if(isset($_GET['login'])) {
    $email = $_POST['email'];
    $passwort = $_POST['passwort'];
    $statement = $pdo->prepare("SELECT b_id, vorname, email, benutzername, passwort, anzahl_fehlversuche, gesperrt FROM benutzer WHERE email = :email");
    $result = $statement->execute(array('email' => $email));
    $user = $statement->fetch();
    $statement2 = $pdo->prepare ("SELECT Aktiviert FROM Aktivierung WHERE email = :email");
    $aktiviert = $statement2 -> execute(array('email' => $email));
         
    //‹berpr¸fung des Passworts 
	$verify=password_verify($passwort, $user['passwort']);
    if (($user !== false) && ($user['gesperrt'] == 0) && $verify && ($aktiviert == 1)) {
	
        $_SESSION['userid'] = $user['id'];
	$_SESSION['username'] = $user['vorname'];
	$versuche=0;
	$statement = $pdo->prepare("UPDATE benutzer SET anzahl_fehlversuche = :versuche WHERE email = :email");
 	$result = $statement->execute(array('versuche' => $versuche, 'email'=> $email ));
        die('Login erfolgreich. Weiter zu <a href="geheim.php">internen Bereich</a>');
    } 
    // Bei falschem Passwort: Erhˆhen der Versuche, Ausgabe der aktuellen Fehlversuche, ggf. Sperren f¸r n‰chstes Mal
   else{
	$versuche = $user['anzahl_fehlversuche'];
	$versuche++;
	$sperre = 1;
	
	$statement2 = $pdo->prepare("UPDATE benutzer SET anzahl_fehlversuche = :versuche WHERE email = :email");
 	$result = $statement2->execute(array('versuche' => $versuche, 'email'=> $email ));
		
	$errorMessage = "E-Mail oder Passwort war ung√ºltig<br> Anzahl an Fehlversuchen: " .$versuche;
		if ($versuche >= 5) {$errorMessage = "gesperrt";}	
		if ($versuche == 4) {$errorMessage = "E-Mail oder Passwort war ung√ºltig<br> Achtung: Ihr Konto wird beim n√§chsten Fehlversuch gesperrt!<br>";}
		
		    
	//Ggf. Sperren
	
	if ($versuche > 4){
	$statement3 = $pdo->prepare("UPDATE benutzer SET gesperrt = :sperre WHERE email = :email");
 	$result = $statement3->execute(array('sperre' => $sperre, 'email'=> $email ));}
    
 }
}
?>
if(isset($errorMessage)) {
    echo $errorMessage;
}
?>


</body>
</html>





