<?php
require_once('connect.php');
if (isset($_GET['nom'])) {
    global $dbh;
    $req = $dbh->prepare('SELECT * FROM image
                          WHERE name = :name');
    $req->execute([
        ':name' => $_GET['nom'],
    ]);
    $info = $req->fetchAll();
} else {
    header('Location:index.php');
    //Ajputer un message d'erreur en javascript
} ?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="css/info.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<header>
	<p><a href="index.php"><strong>8GAG</strong></a>, site d'hébergement d'images en ligne</p>
	<div class="connect"><a href="connection.php">Connection</a></div>
	<div class="inscription"><a href="inscription.php">Inscription</a></div>
</header>
<h1>
	Informations Photo :
</h1>
<div id="img">
	<img src="<?= $info[0]['link'] ?>" id="img">
</div>
<div id="info">
	<ul>
		<li class="list-group-item">Nom :<?php echo $info[0]['name'] ?></li>
		<li class="list-group-item">Description :<?php echo $info[0]['description'] ?></li>
		<li class="list-group-item">Date D'Ajout :<?php echo $info[0]['date'] ?></li>
	</ul>
</div>
</body>
</html>
