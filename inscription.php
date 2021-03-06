<?php
require('connect.php');

if (isset($_POST['password'])){
    $password = $_POST['password'];
    $hash = crypt($password, '$82$28$chatchienlion$');
}

if (!empty($_POST)) {
    $requete = $dbh->prepare('INSERT INTO user VALUES(NULL,
      :name, :password, :email, :prenom, :sexe,:tel, :anniversaire, :codepostal, :pays, :ville, :fixe, :adresse)');

    $a = $requete->execute([
        ':name' => $_POST['name'],
        ':password' => $_POST['password'],
        ':email' => $_POST['email'],
        ':prenom' => $_POST['prenom'],
        ':adresse'=> $_POST['adresse'],
        ':ville'=> $_POST['ville'],
        ':pays'=> $_POST['pays'],
        ':anniversaire'=> $_POST['anniversaire'],
        ':sexe'=>$_POST['sexe'],
        ':tel'=>$_POST['tel'],
        ':fixe'=>$_POST['fixe'],
        ':codepostal'=>$_POST['codepostal']]);

    header('Location:index.php');
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
</head>
<body>
<form method="post" action="">
    <fieldset>
        <legend>Vos coordonnées</legend>
        <br>
        <label for="nom">Nom:</label><br>
        <input type="text" name="name" id="nom"/>*
        <br><br>

        <label for="prénom">Prénom:</label><br>
        <input type="text" name="prenom" id="prénom"/>*
        <br><br>
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
        <br>
        <a href="index.php"><input class="inscription" type="button" value="Retour à la page d'accueil"></a>
</body>
</html>
