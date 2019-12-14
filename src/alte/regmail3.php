<?php
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=Weiterbildungstool', 'phpmyadmin', '40never65');
?>

<html> 
 <title>HTML with PHP</title>
 <body style="background: rgba(175, 126, 138, 0.5);">

<?php
$showFormular = true; //Variable ob das Registrierungsformular angezeigt werden soll

 
    $error = false;
    $nachname= $_POST['nachname'];
    $vorname=$_POST['vorname'];
    $email = $_POST['email'];
    $beruf = $_POST['beruf'];
    $passwort = $_POST['passwort'];
    $passwort2 = $_POST['passwort2'];
    $benutzername = $_POST['benutzername'];
    $strasse = $_POST['strasse'];
    $hausnummer = $_POST['hausnummer'];
    $plz = $_POST['plz'];
    $ort = $_POST['ort'];

// E-Mail validieren
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<p style='position: relative;
    z-index: 1;
    background: rgba(175, 126, 138, 0.5);
    max-width: 360px;
    margin: 0  auto;
    padding: 45px;
    text-align: center;
    color:white;'>".'Bitte eine g&uuml;ltige E-Mail-Adresse eingeben<br>'."</p>";
        $error = true;
    }
// Alle notwendigen Eingaben eingegeben?
  if(strlen($passwort) == 0) {
        echo "<p style='position: relative;
    z-index: 1;
    background: rgba(175, 126, 138, 0.5);
    max-width: 360px;
    margin: 0  auto 100px;
    padding: 45px;
    text-align: center;
    color:white;'>".'Bitte ein Passwort angeben<br>'."</p>";
        $error = true;
    }
if(strlen($vorname) == 0) {
        echo "<p style='position: relative;
    z-index: 1;
    background: rgba(175, 126, 138, 0.5);
    max-width: 360px;
    margin: 0  auto 100px;
    padding: 45px;
    text-align: center;
    color:white;'>".'Bitte einen Vornamen angeben<br>'."</p>";
        $error = true;
    }
  if(strlen($nachname) == 0) {
        echo "<p style='position: relative;
    z-index: 1;
    background: rgba(175, 126, 138, 0.5);
    max-width: 360px;
    margin: 0  auto 100px;
    padding: 45px;
    text-align: center;
    color:white;'>".'Bitte einen Nachnamen angeben<br>'."</p>";
        $error = true;
    }
  if(strlen($benutzername) == 0) {
        echo "<p style='position: relative;
    z-index: 1;
    background: rgba(175, 126, 138, 0.5);
    max-width: 360px;
    margin: 0  auto 100px;
    padding: 45px;
    text-align: center;
    color:white;'>".'Bitte einen Benutzernamen angeben<br>'."</p>";
        $error = true;
    }
  if(strlen($strasse) == 0) {
        echo "<p style='position: relative;
    z-index: 1;
    background: rgba(175, 126, 138, 0.5);
    max-width: 360px;
    margin: 0  auto 100px;
    padding: 45px;
    text-align: center;
    color:white;'>".'Bitte eine Straße angeben<br>'."</p>";
        $error = true;
    }
  if(strlen($hausnummer) == 0) {
        echo "<p style='position: relative;
    z-index: 1;
    background: rgba(175, 126, 138, 0.5);
    max-width: 360px;
    margin: 0  auto 100px;
    padding: 45px;
    text-align: center;
    color:white;'>".'Bitte eine Hausnummer angeben<br>'."</p>";
        $error = true;
    }
  if(strlen($plz) == 0) {
        echo "<p style='position: relative;
    z-index: 1;
    background: rgba(175, 126, 138, 0.5);
    max-width: 360px;
    margin: 0  auto 100px;
    padding: 45px;
    text-align: center;
    color:white;'>".'Bitte eine Postleitzahl angeben<br>'."</p>";
        $error = true;
    }
  if(strlen($ort) == 0) {
        echo "<p style='position: relative;
    z-index: 1;
    background: rgba(175, 126, 138, 0.5);
    max-width: 360px;
    margin: 0  auto 100px;
    padding: 45px;
    text-align: center;
    color:white;'>".'Bitte einen Ort angeben<br>'."</p>";
        $error = true;
    }
// Passwörter auf Gleichheit prüfen 
    if($passwort != $passwort2) {
        echo "<p style='position: relative;
    z-index: 1;
    background: rgba(175, 126, 138, 0.5);
    max-width: 360px;
    margin: 0  auto 100px;
    padding: 45px;
    text-align: center;
    color:white;'>".'Die Passw&ouml;rter m&uuml;ssen &uuml;bereinstimmen<br>'."</p>";
        $error = true;
    }
// E-Mail noch nicht registriert?
       if(!$error) {
        $statement = $pdo->prepare("SELECT * FROM benutzer WHERE email = :email");
        $result = $statement->execute(array('email' => $email));
        $user = $statement->fetch();

        if($user !== false) {
            echo "<p style='position: relative;
    z-index: 1;
    background: rgba(175, 126, 138, 0.5);
    max-width: 360px;
    margin: 0  auto;
    padding: 45px;
    text-align: center;
    color:white;'>".'Diese E-Mail-Adresse ist bereits vergeben<br>'."</p>";

            $error = true;
        }
	}
// Benutzername noch nicht registriert?
if(!$error) {
        $statement = $pdo->prepare("SELECT * FROM benutzer WHERE benutzername = :benutzername");
        $result = $statement->execute(array('benutzername' => $benutzername));
        $user = $statement->fetch();

        if($user !== false) {
            echo "<p style='position: relative;
    z-index: 1;
    background: rgba(175, 126, 138, 0.5);
    max-width: 360px;
    margin: 0  auto;
    padding: 45px;
    text-align: center;
    color:white;'>".'Dieser Benutzername ist bereits vergeben<br>'."</p>";

            $error = true;
        }
	}
//Keine Fehler, Nutzer wird registriert
 if(!$error) {
        $passwort_hash = password_hash($passwort, PASSWORD_DEFAULT);
        $statement = $pdo->prepare("INSERT INTO benutzer (nachname, vorname, benutzername, email, passwort, strasse, hausnummer, plz, ort ) VALUES (:nachname, :vorname, :benutzername, :email, :passwort, :strasse, :hausnummer, :plz, :ort)");
        $result = $statement->execute(array('nachname' => $nachname, 'vorname' => $vorname, 'benutzername' => $benutzername, 'email' => $email, 'passwort' => $passwort_hash, 'strasse' => $strasse, 'hausnummer' => $hausnummer, 'plz' => $plz, 'ort' => $ort));
        	
	$TableAktivierung = "Aktivierung";

        $Absender = "Weiterbildungstool@gmail.com";
	$Erstellt = date("Y-m-d H:i:s");
        $Aktivierungscode = rand(1, 9999);
        $statement2 = $pdo->prepare("INSERT INTO Aktivierung (Aktivierungscode, Erstellt, EMail) VALUES (:Aktivierungscode, :Erstellt, :EMail)");
        $result = $statement2->execute(array('Aktivierungscode' => $Aktivierungscode, 'Erstellt' => $Erstellt, 'EMail' => $email ));
	 $ID = $pdo->lastInsertId();
	$statement4 = $pdo->prepare ("SELECT b_id FROM benutzer WHERE email = :email");
	$b_id = $statement4 -> execute(array('email' => $email));
	$statement3 = $pdo->prepare("INSERT INTO kursteilnehmer (b_id) VALUES (:b_id)");
	$statement3 -> execute (array('b_id' => $b_id));
	 mail($email, "Registrierung abschlie&szlig;en", "Hallo,\n\num die Registrierung abzuschlie&szlig;en, klicken Sie bitte auf den folgenden Link:\n\nhttp://132.231.36.205/Aktivierung.php?ID=$ID&Aktivierungscode=$Aktivierungscode", "FROM: $Absender");
        echo "<p style='position: relative;
    z-index: 1;
    background: rgba(175, 126, 138, 0.5);
    max-width: 360px;
    margin: 0  auto;
    padding: 45px;
    text-align: center;
    color:white;'>"."Um die Registrierung abzuschlie&szlig;en, rufen Sie Ihr E-Mail-Postfach ab und klicken Sie auf den Aktivierungslink in der soeben an Sie versandten E-Mail."."</p>";
        if($result) {
            echo "<p style='position: relative;
    z-index: 1;
    background: rgba(175, 126, 138, 0.5);
    max-width: 360px;
    margin: 0  auto;
    padding: 45px;
    text-align: center;
    color:white;'>".'Sie wurden erfolgreich registriert. <a href="login.php">Zum Login</a>'."</p>";

            $showFormular = false;
        } else {
            echo "<p style='position: relative;
    z-index: 1;
    background: rgba(175, 126, 138, 0.5);
    max-width: 360px;
    margin: 0  auto;
    padding: 45px;
    text-align: center;
    color:white;'>".'Beim Abspeichern ist leider ein Fehler aufgetreten<br>'."</p>";
        }

    }




if($showFormular) {
    ?>



    <?php
} //Ende von if($showFormular)
?>


  
 </body>
 </html>
