<?php

session_start();
$pdo = new PDO('mysql:host=localhost;dbname=Weiterbildungstool', 'phpmyadmin', '40never65');
?>
<?php
if($_REQUEST['ID'] && $_REQUEST['Aktivierungscode'])
{

    $param_aktivierung= $_GET["Aktivierungscode"];
    $param_id= $_GET["ID"];
    $statement = $pdo->prepare("SELECT id, Aktiviert FROM Aktivierung WHERE id = :id AND Aktivierungscode = :aktivierungscode");
    $statement->execute(array('id' => $param_id, 'aktivierungscode' => $param_aktivierung));
    $row = $statement->fetch();
    $anzahl = $statement->rowCount();
    $bereits_aktiviert = $row['Aktiviert'];
    if($bereits_aktiviert >0)
    {
        echo"Sie sind bereits aktiviert!";
    }
    if($anzahl >0 && $bereits_aktiviert==0)
    {
        echo "Aktivierung erfolgreich";
        $statement2 = $pdo->prepare("UPDATE Aktivierung SET Aktiviert = :aktiviert WHERE ID = :id");
        $result = $statement2->execute(array('aktiviert' => 1, 'id'=> $param_id ));

    }
    else {
	echo "Es ist ein Fehler aufgetreten. Bitte antworten Sie auf Ihre Aktivierungsmail!";
}


}

?>