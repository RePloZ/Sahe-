<?php
require('connect.php');

if (!empty($_POST)) {
    $image = '';
    if (!empty($_FILES)) {
        // 1.2.3  => [1, 2, 3]
        $explode = explode('.', $_FILES['image']['name']);
        $extension = $explode[count($explode) - 1];
        // On demande au système de vérifier le type MIME après l'ouverture du fichier
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        // On regarde les informations sur le fichier temporaire
        $mime = finfo_file($finfo, $_FILES['image']['tmp_name']);
        // On ferme la connexion au fichier
        finfo_close($finfo);
        // On accepte seulement du PNG
        if (($extension == 'png' && $mime == 'image/png') || ((($extension == 'jpeg') || ($extension == 'jpg') || ($extension == 'jpe')) && $mime == 'image/jpeg')
        ) {
            move_uploaded_file($_FILES['image']['tmp_name'],
                'upload/' . $_FILES['image']['name']);
            $image = $_FILES['image']['name'];
        }
    }
    $req = $dbh->prepare('INSERT INTO image VALUES (NULL, :name, :description, NOW(), :ip, :link)');
//echo 'INSERT INTO image VALUES (NULL,"'.$_POST['titre'].'","'.$_POST['description'].'", NOW(),    "'.$_SERVER['REMOTE_ADDR'].'", "'.'upload/'. $image.'")';
    $req->execute([
        ':name' => $_POST['titre'],
        ':description' => $_POST['description'],
        ':ip' => $_SERVER['REMOTE_ADDR'],
        ':link' => 'upload /' . $image
    ]);
}

//Créer un programme capable de chercher les 5 dernières images en bdd
$req = $dbh->prepare('SELECT COUNT(link) as count FROM image');
$req->execute();
$fin = $req->fetch()['count'];
$debut = $fin - 5;
$fin = intval($fin);
function get_cinq_last()
{
    global $dbh;
    global $debut;
    global $fin;
    $req = $dbh->prepare('SELECT link, name FROM image LIMIT :debut, :fin');
    $req->bindParam(':debut', $debut, PDO::PARAM_INT);
    $req->bindParam(':fin', $fin, PDO::PARAM_INT);
    $req->execute();
    $images = $req->fetchAll();
    return $images;
} ?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
	      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="css/index.css">
	<link rel="stylesheet" href="index.css">
	<title>Page d'accueil </title>
</head>
<body>
<header>
    <?php
    if (defined($_SESSION['connected'])) {
        echo true;
    }
    if ($_SESSION['connected'] == false) { ?>
		<div class="connect"><a href="connection.php">Connection</a></div>
		<div class="inscription"><a href="inscription.php">Inscription</a></div>
    <?php } else { ?>
		<div class="connect"><p>Vous êtes connecté</p></div>
    <?php } ?>
	<p><a href="index.php"><strong>8GAG</strong></a> site d'hébergement d'images en ligne</p>
</header>

<div class="env">
	<h4>Envoyer vos images</h4>
	<p>Formats autorisés: PNG, JPEG
		(max 20Mo)</p>
	<form action="" method="post" enctype="multipart/form-data">
		<input type="file" name="image" accept="image/*"><br><br>
		<label for="titre">Titre du fichier (max. 50 caractères) :</label><br/>
		<input type="text" name="titre" id="titre"/><br/> <br>
		<label for="description">Description de votre fichier (max. 255 caractères) :</label><br/>
		<textarea name="description" id="description"></textarea><br/>
		<input type="submit">
	</form>
</div>

<div class="bibli">
	<h4>Les Cinq Dernières Images :</h4>
    <?php
    $images = get_cinq_last();
    for ($i=0; $i<5; $i++) { ?>
		<a href="info.php?nom=<?= $images[$i]['name'] ?>">
			<img src="<?= $images[$i]['link'] ?>" alt="" class="image">
		</a>
    <?php } ?>
	<br>
	<a href="galerie.php">Voir Toutes la bibliothèque d'image</a>
</div>
</body>
</html>