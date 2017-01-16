<?php
require('connect.php');

if (isset($_POST['resultats'])) {
    $_SESSION['nb_max'] = intval($_POST['resultats']);
    header('Location:galerie.php?page=1');
}

function get_page_images($page, $nb_resultats)
{
    global $dbh;
    $fin = intval($page) * intval($nb_resultats);
    $debut = $fin - intval($nb_resultats) + 1;

    $req = $dbh->prepare('SELECT lien FROM image LIMIT :debut,:fin');
    $req->bindParam(':debut', $debut, PDO::PARAM_INT);
    $req->bindParam(':fin', $fin, PDO::PARAM_INT);
    $req->execute();
    $images = $req->fetchAll();
    var_dump($debut, ' ', $fin);
    global $dbh;
    $req = $dbh->prepare('SELECT COUNT(*) as count FROM image');
    $req->execute();
    $count = $req->fetch()['count'];
    $max = $_SESSION['nb_max'] * intval($page) - intval($count);
    var_dump($max);
    if ($max <= $debut) {
        echo 'Aucune image disponible';
    }
    return $images;
}

if (!empty($_GET['page'])) {
    $page = intval($_GET['page']);
    $precedent = $page - 1;
    $suivant = $page + 1;
} else {
    header('Location: galerie.php?page=1');
}

if ($page <= 0) {
    header('Location: galerie.php?page=1');
}
?>
<!doctype html>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="./css/bibliotheque.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
	      integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

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
<div class="fluid-container">
	<div class="col-xs-10">
		<h1>Bibliothèque D'Images</h1>
		<p>Nombre d'image par page :</p>
		<form action="" method="post">
            <?php var_dump($_SESSION);
            if (!isset($_SESSION['nb_max'])) {
                $_SESSION['nb_max'] = '10';
            } ?>
			<select class="form-control" name="resultats">
				<option value="10" <?= ($_SESSION['nb_max'] == '10') ? 'selected' : '' ?>>10</option>
				<option value="15" <?= ($_SESSION['nb_max'] == '15') ? 'selected' : '' ?>>15</option>
				<option value="20" <?= ($_SESSION['nb_max'] == '20') ? 'selected' : '' ?>>20</option>
				<option value="25" <?= ($_SESSION['nb_max'] == '25') ? 'selected' : '' ?>>25</option>
				<option value="30" <?= ($_SESSION['nb_max'] == '30') ? 'selected' : '' ?>>30</option>
			</select>
			<input type="submit" name="Envoyer">
		</form>
	</div>
</div>
<div class="row">
    <?php
    $images = get_page_images($page, $_SESSION['nb_max']);
    foreach ($images as $cle => $image) {
        $images[$cle]['name'] = htmlentities($image['name']);
        ?>
		<div class="col-xs-6 col-md-3">
			<a href="info.php?<?= $images[$cle]['name'] ?>" class="thumbnail">
				<img src="<?= $image['link'] ?>" alt="" id="photo1">
			</a>
		</div>
    <?php } ?>
</div>
<br>
<form>
	<a href="?page=<?php if (isset($precedent)) echo $precedent; ?>"><input type="button" value="precedent"
	                                                                        class="bvalid"></a>
	<a href="?page=<?php if (isset($suivant)) echo $suivant; ?>"><input type="button" value="suivant"
	                                                                    class="bvalid"></a>
</form>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
</body>
</html>


