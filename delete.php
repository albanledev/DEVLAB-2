<?php
session_start();
require_once('config.php');
$data = [
    "formSupp" => $_POST['supp']
];
// $delete2 = $bdd->prepare("SELECT id from album where id = :formSupp");
// $data5 = $insert5->fetch();
$delete3 = $bdd->prepare("DELETE FROM users_album where album_id = :formSupp ");
// AND album_id != visionnés AND album_id != Liste d'envies
$delete = $bdd->prepare("DELETE  FROM album WHERE id = :formSupp");
// SI l'album ne s'appelle visionnés ou Liste d'envies


if ($delete3->execute($data) && $delete->execute($data)) {
    header('Location: ' . $_SERVER['HTTP_REFERER']);


    exit;
} else {
    echo "Une erreur est survenue";
}
