<?php
require 'connect.php';
var_dump($_SESSION);
if (!empty($_POST)) {
    $req = $dbh->prepare('SELECT * FROM user 
                   WHERE email = :email 
                   AND password = :password');
    $req->execute([
        ':email' => $_POST['email'],
        ':password' => $_POST['password']
    ]);
    $users = $req->fetchAll();
    echo '<pre>';
    var_dump($users);
    echo '</pre>';
    if(count($users) > 0){
        $_SESSION['connected'] = true;
        $_SESSION['id'] = $users[0]['id'];
        //header('Location:account.php');
    } else {
        echo 'Unknown';
    }
}
