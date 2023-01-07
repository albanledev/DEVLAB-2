<?php

session_start();
require_once 'config.php';
// session_start();


echo '<pre>';
print_r($_POST);
echo '</pre>';


// if (isset($_POST['albumId']) && isset($_POST['AlbumUsersId'])) {
$album_id = htmlspecialchars($_POST['albumId']);
$users_id = htmlspecialchars($_POST['albumUsersId']);
$date = date('y-m-d h:i:s');





// Si l'album a deja le film on annule



$check = $bdd->prepare(
    'SELECT coeurs.id FROM coeurs
        JOIN album ON album_id = album.id
        JOIN users ON users_id = users.id
        WHERE users_id = :users_id
        AND album_id = :album_id'
);
$check->execute([
    'users_id' => $users_id,
    'album_id' => $album_id
]);
$data = $check->fetchAll();
$row = $check->rowCount();

print_r($data);

// echo $row;
if ($row == 0) {
    $insert = $bdd->prepare('INSERT INTO coeurs(users_id, album_id,created_at) VALUES(:users_id,:album_id, :created_at)');
    $insert->execute([
        'users_id' => $users_id,
        'album_id' => $album_id,
        'created_at' => $date
    ]);

    $insert2 = $bdd->prepare('UPDATE album 
        JOIN coeurs ON coeurs.album_id = album.id
        SET likes = likes + 1
        WHERE users_id = :users_id
        AND album_id = :album_id');

    $insert2->execute([
        'users_id' => $users_id,
        'album_id' => $album_id
    ]);
    header('Location: ' . $_SERVER['HTTP_REFERER']);
} else


    $insert3 = $bdd->prepare('UPDATE album 
        JOIN coeurs ON coeurs.album_id = album.id
        SET likes = likes - 1
        WHERE users_id = :users_id
        AND album_id = :album_id');

$insert3->execute([
    'users_id' => $users_id,
    'album_id' => $album_id
]);


$insert4 = $bdd->prepare('DELETE FROM coeurs WHERE users_id = :users_id AND album_id = :album_id');
$insert4->execute([
    'users_id' => $users_id,
    'album_id' => $album_id
]);


header('Location: ' . $_SERVER['HTTP_REFERER']);
// }
