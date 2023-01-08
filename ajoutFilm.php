<?php

session_start();
require_once 'config.php';
// session_start();

if (isset($_POST['film'])) {
    echo '<pre>';
    print_r($_POST);
    echo '</pre>';
    $album = $_POST['film'];
    echo $album;
    $_SESSION["idFilm"];

    // $check = $bdd->prepare('SELECT :idFilm FROM :album WHERE name = ?');
    // $check->execute([
    //     'idFilm' => $_SESSION['idFilm'],
    //     'album' => $album
    // ]);
    // $data = $check->fetch();
    // $row = $check->rowCount();


    // Si l'album a deja le film on annule



    $check = $bdd->prepare(
        'SELECT id_film, album_id, films.name, bin FROM films  
    JOIN album ON album_id = album.id 
    WHERE album.id = :album
    AND films.id_film = :idFilm'
    );
    $check->execute([
        'idFilm' => $_SESSION['idFilm'],
        'album' => $album
    ]);
    $data = $check->fetchAll();
    $row = $check->rowCount();

    print_r($data);


    if ($row == 0) {
        $insert = $bdd->prepare('INSERT INTO films(id_film, album_id,name,bin) VALUES(:id_film,:album_id, :name, :bin)');
        $insert->execute([
            'id_film' => $_SESSION['idFilm'],
            'album_id' => $album,
            'name' => $_SESSION['nameFilm'],
            'bin' => $_SESSION['binFilm']


        ]);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else header('Location: ' . $_SERVER['HTTP_REFERER'] . "?reg_err=already");
}
