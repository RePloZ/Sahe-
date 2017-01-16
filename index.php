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
<<<<<<< HEAD
<html lang="en">
=======
<html lang="fr">
>>>>>>> origin/master
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
	      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
<<<<<<< HEAD
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
=======
	<link rel="stylesheet" href="index.css">
	<title>Page d'accueil</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
	      integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">


</head>
<body>
<header>
	<nav class="navbar navbar-default navbar-fixed-top">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
				        data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="index.php">8GAG</a>
			</div>

			<div class="collapse navbar-collapse">
				<div class="nav navbar-nav">
                    <?php
                    if ($_SESSION['connected'] == false) {
                        ?>
						<ul class="nav navbar-nav">
							<li><a href="connection.php">
									<span class="glyphicon glyphicon-log-in" aria-hidden="true"></span>
									Login
								</a></li>
							<li><a href="inscription.php">
									<span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>
									S'inscrire
								</a></li>
						</ul>
                    <?php } else { ?>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
							   aria-haspopup="true"
							   aria-expanded="false"> Bienvenue <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="profil.php">Mon profil</a></li>
								<li><a href="logout.php">Se déconnecter</a></li>
							</ul>
						</li>
                    <?php } ?>
					<p class="navbar-text">Site d'hebergement d'images en ligne.</p>
					</ul>
				</div>
			</div>
		</div>
	</nav>
</header>

<div class="container-fluid">
	<h4>Envoyer vos images</h4>
	<p>Formats autorisés : PNG, JPEG, (max 20Mo)</p>
>>>>>>> origin/master
	<form action="" method="post" enctype="multipart/form-data">
		<input type="file" name="image" accept="image/*"><br><br>
		<label for="titre">Titre du fichier (max. 50 caractères) :</label><br/>
		<input type="text" name="titre" id="titre"/><br/> <br>
		<label for="description">Description de votre fichier (max. 255 caractères) :</label><br/>
		<textarea name="description" id="description"></textarea><br/>
		<input type="submit">
	</form>
</div>
<<<<<<< HEAD

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
=======
<div>
	<h4>Les cinq dernières images</h4>
</div>
<div class="row">
    <?php
    $images = get_cinq_last();
    for ($i = 0; $i < 5; $i++) { ?>
		<div class="col-xs-6 col-md-3">
			<a href="info.php?nom=<?= $images[$i]['name'] ?>" alt="<?= $images[$i]['name']?>" class="thumbnail">
				<img src="<?= $images[$i]['link'] ?>" alt="<?= $images[$i]['name'] ?>">
			</a>
		</div>
    <?php } ?>
	<a href="galerie.php">
		<p>Voir Toute la bibliothèque d'image</p>
	</a>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
>>>>>>> origin/master
</body>
</html>