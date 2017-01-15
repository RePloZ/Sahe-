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
<html lang=fr>
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
	      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="css/index.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<title>Profil</title>
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
<div class="row">
	<div class="col-xs-1"></div>
	<div class="list-group col-xs-10">
		<h4>Page profil</h4>
		<ul>
			<li class="list-group-item">Nom :<?php echo $info[0]['name'] ?></li>
			<li class="list-group-item">Prénom :<?php echo $info[0]['prénom'] ?></li>
			<li class="list-group-item">Sexe <?php echo $info[0]['sexe'] ?>:</li>
			<li class="list-group-item">Anniversaire :<?php echo $info[0]['anniversaire'] ?></li>
			<li class="list-group-item">Fixe :<?php echo $info[0]['fixe'] ?></li>
			<li class="list-group-item">Téléphone :<?php echo $info[0]['name'] ?></li>
			<li class="list-group-item">Email :<?php echo $info[0]['email'] ?></li>
			<li class="list-group-item">Adresse :<?php echo $info[0]['adresse'] ?></li>
			<li class="list-group-item">Ville :<?php echo $info[0]['ville'] ?></li>
			<li class="list-group-item">Code Postal :<?php echo $info[0]['cp'] ?></li>
			<li class="list-group-item">Pays :<?php echo $info[0]['pays'] ?></li>
		</ul>
	</div>
	<div class="col-xs-1"></div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2m
</body>
</html>
