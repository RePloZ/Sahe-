<?php
session_start();
ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);
//Connexion au részau
$dsn = 'mysql:dbname=8gag;host=127.0.0.1';
$user = 'root';
$password = '';
try {
    $dbh = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    echo 'Connexion échouée : ' . $e->getMessage();
}

//Trier les images
$trier = $dbh->prepare('
    SELECT * 
    FROM image
    ORDER BY date
');
$trier->execute([]);
