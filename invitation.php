<?php
session_start();
require_once('config.php');
if (!isset($_SESSION['user'])) {
    header('Location:index.php');
}

error_reporting(E_ALL & ~E_NOTICE);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src='axios.js' async></script>

    <link href="dist/output.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Bonjour</title>
</head>

<body class='overflow-x-hidden bg-gray-800 overflow-x'>
    <header>

        <div class="pt-[20px] text-white  hidden place-content-around bg-gray-800 w-[100%] sm:flex  sm:justify-items-center">

            <a class="flex ease-in-out duration-300 hover:text-gray-300" href="profil.php"> <img class="w-[25px] h-[25px]" src="img/profile.png" alt="">
                <p class="ml-[15px]">profil</p>
            </a>
            <a class="flex ease-in-out duration-300 hover:text-gray-300" href="landing.php"><img class="w-[25px] h-[25px]" src="img/home.png" alt="">
                <p class="ml-[15px]">accueil</p>
            </a>
            <a class="flex ease-in-out duration-300 hover:text-gray-300" href="search.php"><img class="w-[25px] h-[25px]" src="img/loupe%20(1).png" alt="">
                <p class="ml-[15px]">recherche</p>
            </a>
            <a class="flex ease-in-out duration-300 hover:text-gray-300" href="invitation.php"><img class="w-[22px] h-[25px]" src="img/invit.png" alt="">
                <p class="ml-[15px]">invitations</p>
            </a>
            <a href="deconnexion.php" class="  text-white bg-orange-500 px-5 p-2 rounded-[16px] -translate-y-2">
                <p>Déconnexion</p>
            </a>

        </div>
    </header>
    <a href="deconnexion.php" class="sm:hidden flex justify-end mr-[30px] mt-[20px] ">
        <img class="w-[25px] h-[25px]" src="img/power.png" alt="power">
    </a>
    <h1 class="text-white mt-[50px] text-center font-poppins font-semibold text-[20px]">Bonjour <?php echo $_SESSION['user']; ?></h1>

    <h2 class="text-orange-500 ml-[20px] mt-[20px] font-poppins font-semibold text-[25px] ">Découvrez les albums d'autres utilisateurs</h2>

    <?php


    $affichageUsers = $bdd->prepare('SELECT  * FROM users 
    WHERE NOT id = :users_id');
    $affichageUsers->execute(
        [
            'users_id' => $_SESSION['id']
        ]

    );
    $users = $affichageUsers->fetchAll();


    $affichageAlbums = $bdd->prepare('SELECT  users_id,album.id, name, isPublic, likes, isDefault FROM ALBUM 
    JOIN users_album ON album.id = album_id
    JOIN users ON users.id = users_id WHERE users_id = users_album.users_id');
    $affichageAlbums->execute(
        []

    );
    $albums = $affichageAlbums->fetchAll();

    // echo "<pre>";
    // print_r($albums);
    // echo "</pre>";


    $affichageFilms = $bdd->prepare('SELECT * FROM films
    JOIN album on album.id = album_id

    -- WHERE album_id = 100
');
    $affichageFilms->execute(
        []

    );
    $films = $affichageFilms->fetchAll();



    $affichageCoeurs = $bdd->prepare('SELECT  * FROM ALBUM 
    JOIN coeurs ON album.id = album_id
    JOIN users ON users_id = users.id
    -- WHERE  album_id = album.id
    -- AND  users_id = :users_id
');
    $affichageCoeurs->execute(
        [
            // 'users_id' => $_SESSION['id']
        ]

    );
    $Coeurs = $affichageCoeurs->fetchAll();

    // echo "<pre>";
    // print_r($Coeurs);
    // echo "</pre>";

    $i = "";
    foreach ($users as $user) {

        echo "<div class='text-white font-bold text-[30px] w-[10vw] text-center mt-8'>" . $user['pseudo'] . "</div>";

        foreach ($albums as $album) {
            if ($album['users_id'] == $user['id']) {
                // echo $album['name'];
                foreach ($Coeurs as $coeur) {
                    if ($coeur['album_id'] == $album['id']) {
                        break;
                    }
                }




                if ($album['isPublic'] == 0) {
                    if ($coeur['album_id'] == $album['id']) {
                        echo "<br><br>
                <div class=''>
                <div class='flex text-white ml-[20px] font-poppins font-semibold text-[16px]'>
                <button id='my-button'>
                
        
        
        
                <form action='ajoutCoeurs.php' method='POST'>
                    
                        
                <input type='hidden' name='albumId' value='" . $album['id'] . "'>
                <input type='hidden' name='albumUsersId' value='" . $album['users_id'] . "'>
                
                <input type='image' alt='Submit' src='img/heart-full.png' class='w-[20px] h-[20px] mr-[10px]' />
        
            </form>
                </button><h3 class='text-white'> " . $album['name'] . "</h3></div>
                <p class='text-gray-400 ml-[20px] font-poppins text-[12px]'>" . $album['likes'] . " likes</p>
                ";
                        if ($album['isPublic'] == 0) {
                            echo "<p class='text-gray-400 ml-[20px] font-poppins text-[12px]'>publique</p>";
                        } else {
                            echo "<p class='text-gray-400 ml-[20px] font-poppins text-[12px]'>privé</p><br>";
                        }
                    } else {
                        echo "<br><br>
                <div class=''>
                <div class='flex text-white ml-[20px] font-poppins font-semibold text-[16px]'>
                <button id='my-button'>
                
        
        
        
                <form action='ajoutCoeurs.php' method='POST'>
                    
                        
                <input type='hidden' name='albumId' value='" . $album['id'] . "'>
                <input type='hidden' name='albumUsersId' value='" . $album['users_id'] . "'>
                
                <input type='image' alt='Submit' src='img/heart.png' class='w-[20px] h-[20px] mr-[10px]' />
        
            </form>
                </button><h3 class='text-orange-500'> " . $album['name'] . "</h3></div>
                <p class='text-gray-400 ml-[20px] font-poppins text-[12px]'>" . $album['likes'] . " likes</p>
                ";
                        if ($album['isPublic'] == 0) {
                            echo "<p class='text-gray-400 ml-[20px] font-poppins text-[12px]'>publique</p>";
                        } else {
                            echo "<p class='text-gray-400 ml-[20px] font-poppins text-[12px]'>privé</p><br>";
                        }

                        if ($album['isDefault'] == 0) {
                            echo " <form action='delete.php' method='POST'>
                    
                    <div class='flex_supp'>
                        <div><input type='hidden' name='supp' value='" . $album['id'] . "'></div>
                        <div><button type='submit' class='py-[3px] px-[15px] rounded-[9px] bg-gray-700 text-white ml-[20px] font-poppins text-[12px]'>Supprimer l'album " . $album['name'] . "</button></div><br>
                    </div>
            
            
                    </form></div>
                ";
                        }
                    }
                }


                echo "<div class='flex flex-wrap gap-3 ml-5 mt-5'>";
                foreach ($films as $film) {
                    if ($film['album_id'] == $album['id']) {


                        // echo "<div class='text-purple-700'><a href='movie.php?id=" . $film['id_film'] . alt>" . $film['id_film'] . "</a></div>";
                        echo " <div class='w-[145px] h-[250px] relative'><a href='movie.php?id=" . $film['id_film'] . "&name=" . $film['name'] . "&bin=" . $film['bin'] . "' alt><img class='object-cover rounded-[12px]' src='https://www.themoviedb.org/t/p/w600_and_h900_bestv2" . $film['bin'] . "'/></a>
    
                    
                ";



                        // echo "<img src='img/croix.png' alt='delete' class='absolute top-3 right-3 z-10' /></a></div>";



                        // echo "<a href='movie.php?id='" . $_SESSION['idFilm'] .
                        //     "'>

                        // </a>";
                        echo "</div>";


                        echo "<div class='containerListeFilms'></div>";
                    }
                }
                // echo "</div>";
                // echo "</div>";
                echo "</div>";
            }

            // require("connexion.php");

        }
    }
    ?>