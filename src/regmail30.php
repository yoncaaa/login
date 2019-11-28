<?php
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=Weiterbildungstool', 'phpmyadmin', '40never65');
?>


<?php
$showFormular = true; //Variable ob das Registrierungsformular anezeigt werden soll

    $error = false;
    $nachname= $_POST['nachname'];
    $vorname=$_POST['vorname'];
    $email = $_POST['email'];
    $beruf = $_POST['beruf'];
    $passwort = $_POST['passwort'];
    $passwort2 = $_POST['passwort2'];

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo 'Bitte eine gÃƒÂ¼ltige E-Mail-Adresse eingeben<br>';
        $error = true;
    }
    if(strlen($passwort) == 0) {
        echo 'Bitte ein Passwort angeben<br>';
        $error = true;
    }
    if($passwort != $passwort2) {
        echo 'Die PasswÃƒÂ¶rter mÃƒÂ¼ssen ÃƒÂ¼bereinstimmen<br>';
        $error = true;
    }

    //ÃœberprÃ¼fe, dass die E-Mail-Adresse noch nicht registriert wurde
    if(!$error) {
        $statement = $pdo->prepare("SELECT * FROM teilnehmer WHERE email = :email");
        $result = $statement->execute(array('email' => $email));
        $user = $statement->fetch();

        if($user !== false) {
            echo 'Diese E-Mail-Adresse ist bereits vergeben<br>';
            $error = true;
        }


    //Keine Fehler, wir kÃ¶nnen den Nutzer registrieren
    if(!$error) {
        $passwort_hash = password_hash($passwort, PASSWORD_DEFAULT);
        $statement = $pdo->prepare("INSERT INTO teilnehmer (nachname, vorname, beruf, email, passwort) VALUES (:nachname, :vorname, :beruf, :email, :passwort)");
        $result = $statement->execute(array('email' => $email, 'passwort' => $passwort_hash, 'nachname' => $nachname, 'vorname' => $vorname, 'beruf' => $beruf));
        $TableAktivierung = "Aktivierung";

        $Absender = "Weiterbildungstool@gmail.com";

        $Erstellt = date("Y-m-d H:i:s");
        $Aktivierungscode = rand(1, 9999);
        $statement2 = $pdo->prepare("INSERT INTO Aktivierung (Aktivierungscode, Erstellt, EMail) VALUES (:Aktivierungscode, :Erstellt, :EMail)");
        $result = $statement2->execute(array('Aktivierungscode' => $Aktivierungscode, 'Erstellt' => $Erstellt, 'EMail' => $email ));

        $ID = $pdo->lastInsertId();


        mail($email, "Registrierung abschlieÃŸen", "Hallo,\n\num die Registrierung abzuschlieÃŸen, klicken Sie bitte auf den folgenden Link:\n\nhttp://132.231.36.205/Aktivierung.php?ID=$ID&Aktivierungscode=$Aktivierungscode", "FROM: $Absender");
        echo"Um die Registrierung abzuschlieÃŸen, rufen Sie Ihr E-Mail-Postfach ab und klicken Sie auf den Aktivierungslink in der soeben an Sie versandten E-Mail.";
        if($result) {
            echo 'Du wurdest erfolgreich registriert. <a href="login.php">Zum Login</a>';
            $showFormular = false;
        } else {
            echo 'Beim Abspeichern ist leider ein Fehler aufgetreten<br>';
        }
    }
}

if($showFormular) {
    ?>



    <?php
} //Ende von if($showFormular)
?>


