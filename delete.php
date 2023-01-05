<?php
session_start();
require_once('config.php');
$data = [
    "formSupp" => $_POST['supp']
];
// $delete2 = $bdd->prepare("SELECT id from album where id = :formSupp");
// $data5 = $insert5->fetch();
$delete5 = $bdd->prepare("DELETE FROM films where films.album_id = :formSupp ");

$delete3 = $bdd->prepare("DELETE FROM users_album where users_album.album_id = :formSupp ");
// AND album_id != visionnés AND album_id != Liste d'envies
$delete = $bdd->prepare("DELETE  FROM album WHERE id = :formSupp");
// SI l'album ne s'appelle visionnés ou Liste d'envies


if ($delete5->execute($data) && $delete3->execute($data) && $delete->execute($data)) {
    header('Location: ' . $_SERVER['HTTP_REFERER']);


    exit;
} else {
    echo "Une erreur est survenue";
}
