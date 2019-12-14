<html>
<body>
<?php
$pdo = new PDO('mysql:host=localhost;dbname=Weiterbildungstool', 'phpmyadmin', '40never65');
$email = 'goetz45@ads.uni-passau.de'
$statement4 = $pdo->prepare ("SELECT b_id FROM benutzer WHERE email = :email");
$b_id = $statement4 -> execute(array('email' => $email));
echo $b_id;

?>
</body>
</html>

