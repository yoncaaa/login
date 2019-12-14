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
	echo "<br> Die Suche nach " .$suchwort ." ergab folgende Treffer: <br>"; 
	$abfrage = "";
	$abfrage2 = ""; 
	$suchwort = explode(" ", $suchwort); 
	for ($i = 0; $i < sizeof ($suchwort); $i++)
	{
	$abfrage .= " vorname LIKE '%" . $suchwort[$i] . "%'";
	$abfrage2 .= " nachname LIKE '%" . $suchwort[$i] . "%'";
	if ($i < sizeof ($suchwort) -1) {
	$abfrage .= " OR"; 
	$abfrage2 .= " OR";  
	}
	
	}
	
	
	$sql = "SELECT * FROM benutzer WHERE " .$abfrage ." OR" .$abfrage2;
	
	$erg = $pdo->query($sql); 

	//Ausgabe für jedes Suchergebnis 
	foreach ($pdo->query($sql) as $row) {
   echo "<br>" .$row['id']." ".$row['nachname']." ".$row['vorname']." E-Mail: ".$row['email']." ".$row['beruf']." ";
   echo "<br />";
}
	

	
}
?>
