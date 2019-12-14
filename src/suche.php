<!DOCTYPE html>
<html>
<head>
</head>
<body>
<form method="get">
    suchen nach:
    <input type="hidden" name="aktion" value="suchen">
    <input type="text" class="suchfeld" name="suchen">
    <input type="submit" value="Los!">
</form>
<?php
$pdo = new PDO('mysql:host=localhost;dbname=Weiterbildungstool', 'phpmyadmin', '40never65');
if (isset($_GET["suchen"])){
	$suchwort = $_GET["suchen"];
	// Suche in Kurse
	echo "<br> Die Suche nach " .$suchwort ." ergab folgende Treffer in Kurse: <br>"; 
	$abfrage = "";
	$abfrage2 = ""; 
	$sw = explode(" ", $suchwort); 
	for ($i = 0; $i < sizeof ($sw); $i++)
	{
	$abfrage .= " name LIKE '%" . $sw[$i] . "%'";
	$abfrage2 .= " schlagwort LIKE '%" . $sw[$i] . "%'";
	if ($i < sizeof ($sw) -1) {
	$abfrage .= " OR"; 
	$abfrage2 .= " OR";  
	}
	
	}
	
	
	$sql = "SELECT * FROM kurs WHERE " .$abfrage ." OR" .$abfrage2;
	
	$erg = $pdo->query($sql); 

	//Ausgabe für jedes Suchergebnis 
	foreach ($pdo->query($sql) as $row) {
  	 echo "<br>" .$row['k_id']." ".$row['name']." Gebühr: ".$row['gebuehr']." Startdatum: ".$row['startdatum']." Späteste Anmeldung: ".$row['spaeteste_anmeldung']." ";
  	 echo "<br />";
	}
	if ($erg->rowCount() == 0){echo "Die Suche lieferte keine Ergebnisse. ";}

	//Suche in Dozenten
	
	// View erzeugen
	$view_sql= create view dozenten (d_id, name, vorname)
		as select d_id, name, vorname
		from benutzer, dozent
		where b_id == d_id;
		$view_d=$pdo->query($view_sql);
	
	echo "<br><br><br> Die Suche nach " .$suchwort ." ergab folgende Treffer in Dozenten: <br>"; 
	$abfrage = "";
	$abfrage2 = ""; 
	
	for ($i = 0; $i < sizeof ($sw); $i++)
	{
	$abfrage .= " name LIKE '%" . $sw[$i] . "%'";
	$abfrage2 .= " vorname LIKE '%" . $sw[$i] . "%'";
	if ($i < sizeof ($sw) -1) {
	$abfrage .= " OR"; 
	$abfrage2 .= " OR";  
	}
	
	}
	
	
	$sql = "SELECT * FROM benutzer WHERE " .$abfrage ." OR" .$abfrage2;
	
	$erg = $pdo->query($sql); 

	//Ausgabe für jedes Suchergebnis 
	foreach ($pdo->query($sql) as $row) {
	
  	 echo "<br>" .$row['k_id']." ".$row['name']." Gebühr: ".$row['gebuehr']." Startdatum: ".$row['startdatum']." Späteste Anmeldung: ".$row['spaeteste_anmeldung']." ";
  	 echo "<br />";
	}
	if ($erg->rowCount() == 0){echo "Die Suche lieferte keine Ergebnisse. ";}

	

	
}
?>
