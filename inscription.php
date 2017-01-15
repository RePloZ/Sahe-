<?php
require('connect.php');

if (isset($_POST['mdp'])) {
    if ($_POST['mdp'] == $_POST['password']) {
//coder le mot de passe
        if (isset($_POST['password'])) {
            $password = $_POST['password'];
            $password = crypt($password, '28$21$chienchatlion');
        }
        if (!empty($_POST)) {
            $requete = $dbh->prepare('INSERT INTO user VALUES(NULL,
      :name, :password, :email, :prenom, :sexe, :tel, :anniversaire, :codepostal, :pays, :ville, :fixe, :adresse)');
            var_dump($_POST);
            $a = $requete->execute([
                ':name' => $_POST['name'],
                ':password' => $password,
                ':email' => $_POST['email'],
                ':prenom' => $_POST['prenom'],
                ':adresse'=> $_POST['adresse'],
                ':ville'=> $_POST['ville'],
                ':pays'=> $_POST['pays'],
                ':anniversaire'=> $_POST['anniversaire'],
                ':sexe'=>$_POST['sexe'],
                ':tel'=>$_POST['tel'],
                ':fixe'=>$_POST['fixe'],
                ':codepostal'=>$_POST['codepostal']
            ]);
            var_dump($a);
        }
    } else {
        echo 'Les deux mots de passe ne sont pas les mêmes !!!';
    }
}
?>
<!doctype html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
	      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Inscription</title>
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

<div class="row">
	<div class="col-xs-4"></div>
	<div class="col-xs-4">
		<form method="post" action="">
			<legend>Vos coordonnées</legend>
			<br>
			<label for="nom">Nom:</label><br>
			<input type="text" name="name" id="nom"/>*
			<br><br>

			<label for="prénom">Prénom:</label><br>
			<input type="text" name="prenom" id="prénom"/>*
			<br><br>

			<label for="adresse">Adresse:</label><br>
			<input type="text" name="adresse" id="adresse">*
			<br><br>

			<label for="codepostal">Code Postal:</label><br>
			<input type="text" name="codepostal" id="codepostal">*
			<br><br>

			<label for="ville">Ville:</label><br>
			<input type="text" name="ville" id="ville">*
			<br><br>

			<label for="pays">Pays:</label><br>
			<input type="text" name="pays" id="pays">*
			<br><br>
			<br>
			<legend>Vos informations</legend>
			<br>
			<label for="sexe">Sexe:</label><br>
			<input type="radio" name="sexe" value="Feminin" id="Feminin"/><label for="Feminin">Feminin</label>
			<input type="radio" name="sexe" value="Masculin" id="Masculin"/><label for="Masculin">Masculin</label>
			<br><br>
			<label for="anniversaire">Date de naissance:</label><br>
			<input type="date" name="anniversaire">*
			<br><br>
			<label for="tel">Portable:</label><br>
			<input type="tel" name="tel" id="tel">*
			<br><br>
			<label for="fixe">Téléphone fixe:</label><br>
			<input type="tel" name="fixe" id="fixe">
			<br><br>
			<label for="email">E-mail:</label><br>
			<input type="email" name="email" id="email"/>*
			<br><br>
			<label for="password">Mot de Passe:</label><br>
			<input type="password" name="password" id="password">*
			<br><br>
			<label for="mdp">Confirmation Mot de Passe:</label><br>
			<input type="password" name="mdp" id="mdp">*
			<br>
			<input type="submit" class="sub">
		</form>
	</div>
	<div class="col-xs-4"></div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
</body>
</html>
