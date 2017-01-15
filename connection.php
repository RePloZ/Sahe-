<?php
require 'connect.php';
if(isset($_POST['password'])){
    $password = $_POST['password'];
    $password = crypt($password, '28$21$chienchatlion');
}
if (!empty($_POST)) {
    $req = $dbh->prepare('SELECT * FROM user 
                   WHERE email = :email 
                   AND password = :password');
    $req->execute([
        ':email' => $_POST['email'],
        ':password' => $password
    ]);
    $users = $req->fetchAll();
    if (count($users) > 0) {
        $_SESSION['connected'] = true;
        $_SESSION['id'] = $users[0]['id'];
        header('Location:profil.php');
    } else {
        echo 'Identifiant inconnu ou mot de passe inconnu';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="css/index.css">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Connection</title>
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
<div class="container">
	<h2>Se connecter</h2>


	<form action="post" class="col-xs 10 col-lg-10">
		<div class="row">
			<div class="input-group input-group-lg">
				<span class="input-group-addon glyphicon glyphicon-envelope" id="sizing-addon1"
				      aria-hidden="true"></span>
				<input type="text" class="form-control" placeholder="Adresse Mail" aria-describedby="sizing-addon1">
			</div>
			<br>
			<div class="input-group input-group-lg">
				<span class="input-group-addon glyphicon glyphicon-envelope" id="sizing-addon1"
				      aria-hidden="true"></span>
				<input type="text" class="form-control" placeholder="Search for...">
				<span class="input-group-btn">
       <button class="btn btn-default" type="submit">Login</button>
      </span>
			</div>
		</div>
	</form>
</div>

<div class="well bas">
	<p class="compte">Vous n'avez pas de compte ?
		Inscrivez-vous <a href="inscription.php">ICI</a></p>
	<a href="index.html"><input type="button" value="Retour à la page d'accueil"></a>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
</body>
</html>
