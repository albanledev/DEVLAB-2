<?php
session_start();
require_once('../config.php');

// $delete2 = $bdd->prepare("SELECT id from album where id = :id_film");
// $data5 = $insert5->fetch();
$delete3 = $bdd->prepare("DELETE FROM films where id_film = :id_film AND album_id = :album_id");




$delete3->execute(
    [
        "album_id" => $_POST['supp'],
        "id_film" => $_POST['supp2']

    ]
);

header('Location: ' . $_SERVER['HTTP_REFERER']);
