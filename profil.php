<?php
require_once ('connect.php');
if($_SESSION['connected']=true) {
    global $dbh;
    $req = $dbh->prepare('SELECT * FROM user
                          WHERE id = :id');
    $req->execute([
        ':id' => $users[0]['id'],
    ]);
    $info = $req->fetchAll();
} else {
    header('Location:connection.php');
}
?>
<!doctype html>
	header('Location:connection.php');
}
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="css/profil.css">
</head>
<body>
<header>
    <div class="connect"><a href="connection.html">Connection</a></div>
    <div class="inscription"><a href="inscription.html">Inscription</a></div>
    <p><a href="index.html"><strong>8GAG</strong></a>   ,site d'hébergement d'images en ligne</p>
</header>
<div id="info">
    <ul>
        <li>Nom:<?php echo $info[0]['name'] ?></li>
        <li>Prénom:<?php echo $info[0]['prénom'] ?></li>
        <li>sexe: <?php echo $info[0]['sexe'] ?></li>
        <li>Adresse:<?php echo $info[0]['adresse'] ?></li>
        <li>Code Postal:<?php echo $info[0]['cp'] ?></li>
        <li>Ville:<?php echo $info[0]['ville'] ?></li>
        <li>Pays:<?php echo $info[0]['pays'] ?></li>
        <li>date de naissance:<?php echo $info[0]['anniversaire'] ?></li>
        <li>Portable:<?php echo $info[0]['fixe'] ?></li>
        <li>E-mail:<?php echo $info[0]['email'] ?></li>
    </ul>
</div>

</body>
</html>
