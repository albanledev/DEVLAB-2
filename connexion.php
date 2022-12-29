<?php
session_start();
require_once 'config.php';

if (isset($_POST['email']) && isset($_POST['password'])) {

    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    $check = $bdd->prepare('SELECT pseudo, email, id, password FROM users WHERE email = ?');
    $check->execute(array($email));
    $data = $check->fetch();
    $row = $check->rowCount();
    if ($row == 1) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

            $password = hash('sha256', $password);

            if ($data['password'] == $password) {
                $_SESSION['user'] = $data['pseudo'];
                $_SESSION['id'] = $data['id'];

                // $date = $bdd->prepare("SELECT date_inscription FROM users WHERE ");
                // $request = $bdd->prepare("SELECT ")
                $date = date('y-m-d h:i:s');

                // Si l'album visionnés attribué au user n'existe pas encore, =0 ALors on insére l'album

                $affichageVisionnés = $bdd->prepare("SELECT album.id, name FROM album
                JOIN users_album ON album.id = album_id
                JOIN users ON users.id = users_id WHERE users_id = :users_id
                AND album.name = 'visionnés'
                ");
                $affichageVisionnés->execute(
                    [
                        'users_id' => $_SESSION['id']
                    ]

                );
                $Visionnés = $affichageVisionnés->fetchAll();
                $cptVisionnage = $affichageVisionnés->rowCount();
                print_r($Visionnés);
                print_r($cptVisionnage);

                if ($cptVisionnage == 0) {
                    $insertWatched = $bdd->prepare("INSERT INTO album(name, isPublic, likes, created_at) VALUES (:name,:public,:likes,:date) ");
                    $insertWatched->execute([
                        "name" => 'visionnés',
                        "public" => 0,
                        "likes" => 0,
                        "date" => $date

                    ]);

                    $insert5 = $bdd->prepare('SELECT id from album where name = :name and created_at = :date');
                    $insert5->execute(
                        [
                            'name' => 'visionnés',
                            'date' => $date

                        ]

                    );

                    $data5 = $insert5->fetch();
                    $rowCheckVisionnes = $insert5->rowCount();

                    $insert2 = $bdd->prepare('INSERT INTO users_album(users_id, album_id) VALUES (:users_id, :album_id )');
                    $insert2->execute([
                        'users_id' => $_SESSION['id'],
                        'album_id' => $data5[0]
                    ]);

                    // --------------------------------------------Listes d'envies

                    $insertEnvie = $bdd->prepare("INSERT INTO album(name, isPublic, likes, created_at) VALUES (:name,:public,:likes,:date) ");
                    $insertEnvie->execute([
                        "name" => "Liste d'envies",
                        "public" => 0,
                        "likes" => 0,
                        "date" => $date

                    ]);

                    $insert9 = $bdd->prepare('SELECT id from album where name = :name and created_at = :date');
                    $insert9->execute(
                        [
                            'name' => "Liste d'envies",
                            'date' => $date

                        ]

                    );

                    $data9 = $insert9->fetch();
                    $rowCheckEnvie = $insert9->rowCount();

                    $insert2 = $bdd->prepare('INSERT INTO users_album(users_id, album_id) VALUES (:users_id, :album_id )');
                    $insert2->execute([
                        'users_id' => $_SESSION['id'],
                        'album_id' => $data9[0]
                    ]);
                }




                // On récupère l'id de l'album qu'on vient de créer
                // $insert5 = $bdd->prepare('SELECT id from album where name = :name and created_at = :date');
                // $insert5->execute(
                //     [
                //         'name' => 'visionnés',
                //         'date' => $date

                //     ]

                // );
                // $data5 = $insert5->fetch();
                // $rowCheckVisionnes = $insert5->rowCount();

                // On l'insère dans la table intermédiaire users_album
                // $insert2 = $bdd->prepare('INSERT INTO users_album(users_id, album_id) VALUES (:users_id, :album_id )');
                // $insert2->execute([
                //     'users_id' => $_SESSION['id'],
                //     'album_id' => $data5[0]
                // ]);



                header('Location:landing.php');
            } else header('Location:index.php?login_err=password');
        } else header('Location:index.php?login_err=email');
    } else header('Location:index.php?login_err=already');
} else header('Location:index.php');
