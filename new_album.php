<?php


require_once 'config.php';

if (isset($_POST['name']) && isset($_POST['public'])) {
    $name = htmlspecialchars($_POST['name']);
    $public = htmlspecialchars($_POST['public']);
    $likes = 0;
    $date = date('y-m-d h:i:s');

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
        if (strlen($name) <= 100) {




            // $_SESSION['user'] = $data['pseudo'];

            $insert = $bdd->prepare('INSERT INTO album(name, isPublic, likes, created_at) VALUES(:name,:public,:likes,:date)');
            $insert->execute(array(
                'name' => $name,
                'public' => $public,
                'likes' => $likes,
                'date' => $date
            ));
            $insert2 = $bdd->prepare('INSERT INTO users_album(album_id) SELECT id FROM album');
            $insert2->execute(array());

            // $insert3 = $bdd->prepare('INSERT INTO users_album(users_id) SELECT id FROM users WHERE pseudo ');
            // $insert3->execute(array());


            // $_SESSION['user'] = $data['pseudo'];
            header('Location:landing.php');
        } else header('Location: landing.php?reg_err=name_length');
    } else header('Location: landing.php?reg_err=already');
}
