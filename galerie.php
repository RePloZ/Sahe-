<?php
require ('connect.php');
ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);

$gal = $dbh->prepare('SELECT COUNT(:id) FROM image');
$gal->execute([
    ':id' => id,
]);
$page = $gal/5;

?>
<!doctype html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="./css/bibliotheque.css">
</head>
<body>
<h1>Bibliothèque D'Images</h1>
<div id="photo1">
</div>
<div id="photo2">
</div>
<div id="photo3">
</div>
<div id="photo4">
	
</div>
<div id="photo5"></div>
<div id=photo6></div>
<div id="photo7"></div>
<div id="photo8"></div>
<div id="photo9"></div>
<br><form>
    <a href="page2.html"><input type="button" value="suivant" onclick="" class="bvalid" ></a>
</form>


</body>
</html>