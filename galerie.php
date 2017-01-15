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

    $req = $dbh->prepare('SELECT link, name FROM image LIMIT :debut, :fin');
    $req->bindParam(':debut', $debut, PDO::PARAM_INT);
    $req->bindParam(':fin', $fin, PDO::PARAM_INT);
    $req->execute();
    $images = $req->fetchAll();
    global $dbh;
    $req = $dbh->prepare('SELECT COUNT(*) as count FROM image');
    $req->execute();
    $count = $req->fetch()['count'];
    $max = $_SESSION['nb_max'] - intval($count);
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Galerie</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/index.css">
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
<h1>Bibliothèque D'Images</h1>
<div class="container-fluid">
<div class="col-xs-5">
    <p>Nombre d'image par page :</p>
    <form action="" method="post">
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


