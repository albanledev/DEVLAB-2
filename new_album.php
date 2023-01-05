<?php

session_start();
require_once 'config.php';
// session_start();

if (isset($_POST['name']) && isset($_POST['public'])) {
    $name = htmlspecialchars($_POST['name']);
    $public = htmlspecialchars($_POST['public']);
    $likes = 0;
    $date = date('y-m-d h:i:s');
    $isDefault = 0;

    if ($_POST['public'] == 'publique') {
        $public = 0;
    } else {
        $public = 1;
    }



    $check = $bdd->prepare('SELECT name FROM album WHERE name = ?');
    $check->execute(array($name));
    $data = $check->fetch();
    $row = $check->rowCount();

    if ($row == 0) {
        if (strlen($name) <= 100 && strlen($name) > 0) {




            // $_SESSION['user'] = $data['pseudo'];

            $insert = $bdd->prepare('INSERT INTO album(name, isPublic, likes, created_at, isDefault) VALUES(:name,:public,:likes,:date, :isDefault)');
            $insert->execute([
                'name' => $name,
                'public' => $public,
                'likes' => $likes,
                'date' => $date,
                'isDefault' => $isDefault
            ]);




            $insert5 = $bdd->prepare('SELECT id from album where name = :name and created_at = :date');
            $insert5->execute(
                [
                    'name' => $name,
                    'date' => $date

                ]

            );
            $data5 = $insert5->fetch();

            // foreach ($data5 as $data){

            // }
            // print_r($data5[0]);

            $insert2 = $bdd->prepare('INSERT INTO users_album(users_id, album_id) VALUES (:users_id, :album_id )');
            $insert2->execute([
                'users_id' => $_SESSION['id'],
                'album_id' => $data5[0]
                // 'album_id' => $



            ]);


            // :users_id, SELECT id FROM album
            // $insert3 = $bdd->prepare('INSERT INTO users_album(users_id) SELECT id FROM users WHERE pseudo ');
            // $insert3->execute(array());


            // $_SESSION['user'] = $data['pseudo'];
            header('Location:profil.php');
        } else header('Location: profil.php?reg_err=name_length');
    } else header('Location: profil.php?reg_err=already');
}
