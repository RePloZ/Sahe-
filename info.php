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
}?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="index.css">
    <title>Information image</title>
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

<h1>
    Informations Photo :
</h1>

<div class="row">
    <div class="col-xs-6">
        <img src="<?= $info[0]['link'] ?>" id="img">
    </div>
    <div class="list-group col-xs-6">
        <ul>
            <li class="list-group-item">Nom :<?php echo $info[0]['name'] ?></li>
            <li class="list-group-item">Description :<?php echo $info[0]['description'] ?></li>
            <li class="list-group-item">Date D'Ajout :<?php echo $info[0]['date'] ?></li>
        </ul>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>
