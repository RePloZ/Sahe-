<?php
ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);

if (!empty($_POST)) {
    $image = '';
    if (!empty($_FILES)) {
        var_dump($_FILES);
        // 1.2.3  => [1, 2, 3]
        $explode = explode('.', $_FILES['image']['name']);
        $extension = $explode[count($explode) - 1];
        // On demande au système de vérifier le type MIME après l'ouverture du fichier
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        // On regarde les informations sur le fichier temporaire
        $mime = finfo_file($finfo, $_FILES['image']['tmp_name']);
        // On ferme la connexion au fichier
        finfo_close($finfo);
        echo $extension . ' ' . $mime;
        // On accepte seulement du PNG
        if (($extension == 'png' && $mime == 'image/png')||($extension == 'JPEG' && $mime == 'image/jpeg')){
            move_uploaded_file($_FILES['image']['tmp_name'],
                'upload/' . $_FILES['image']['name']);
            $image = $_FILES['image']['name'];
        }
    }
    $req = $dbh->prepare('INSERT INTO image VALUES (NULL, :name, :description, NOW(), :ip, link)');
    $req->execute([
        ':name' => $_POST['name'],
        ':description' => $_POST['description'],
        ':image' => $image,
        ':ip' => $_SERVER['REMOTTE_ADDR'],
        ':link' => $image,
    ]);
}
