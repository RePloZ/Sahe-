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
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
<header>
    <div class="inscription"><a href="inscription.php">Inscription</a></div>
    <p><a href="index.html"><strong>8GAG</strong></a>  site d'hébergement d'images en ligne</p>
</header>
<form action="post">
    <fieldset>
        <legend>Vos informations de connection</legend>
        <br>
        <label for="email">E-mail:</label><input type="text" name="email" id="email"> <br><br>
        <label for="mdp">Mot de passe:</label>
        <input type="password" name="mdp" id="mdp"><br><br>
        <input type="submit">
    </fieldset>
</form>
<br><br>
<p class="compte">Vous n'avez pas de compte? <br>
    Inscrivez-vous <a href="inscription.php">ICI</a></p>
	<a href="index.php"><input class="inscription" type="button" value="Retour à la page d'accueil"></a>
</body>
</html>
