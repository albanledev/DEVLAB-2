<?php
session_start();
require_once('config.php');
if (!isset($_SESSION['user'])) {
    header('Location:index.php');
}

error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
// error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE & ~E_USER_WARNING & ~E_USER_NOTICE & ~E_DEPRECATED & ~E_USER_DEPRECATED);
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
    <script src='globalJS/profil.js' async></script>

    <link href="dist/output.css" rel="stylesheet">
    <!-- <script src="https://cdn.tailwindcss.com"></script> -->
    <title>Bonjour</title>
</head>

<body class="bg-gray-800">
    <header>
        <div class="pt-[20px] text-white  hidden place-content-around bg-gray-800 w-[100%] sm:flex">
            <a class="flex hover:text-gray-300" href="profil.php"> <img class="w-[25px] h-[25px]" src="img/profile.png" alt="">
                <p class="ml-[10px]">profil</p>
            </a>
            <a class="flex hover:text-gray-300" href="landing.php"><img class="w-[25px] h-[25px]" src="img/home.png" alt="">
                <p class="ml-[10px]">accueil</p>
            </a>
            <a class="flex hover:text-gray-300" href="search.php"><img class="w-[25px] h-[25px]" src="img/loupe%20(1).png" alt="">
                <p class="ml-[10px]">recherche</p>
            </a>
            <a class="flex hover:text-gray-300" href="#"><img class="w-[22px] h-[25px]" src="img/invit.png" alt="">
                <p class="ml-[10px]">invitations</p>
            </a>
            <a href="deconnexion.php" class="  text-white bg-orange-500 px-5 p-2 rounded-[16px] -translate-y-2">
                <p>Déconnexion</p>
            </a>
        </div>
    </header>
    <div class="flex justify-end sm:hidden"><a href="deconnexion.php" class=" mt-[20px] text-white bg-orange-500 px-10 py-2 rounded-[9px] justify-end"><button>Déconnexion</button></a></div>
    <h1 class="mt-[20px] text-center font-poppins text-white font-semibold text-[20px]">Bonjour <?php echo $_SESSION['user']; ?></h1>



    <?php


    $affichageAlbums = $bdd->prepare('SELECT  users_id,album.id, name, isPublic, likes, isDefault FROM ALBUM 
    JOIN users_album ON album.id = album_id
    JOIN users ON users.id = users_id WHERE users_id = :users_id');
    $affichageAlbums->execute(
        [
            'users_id' => $_SESSION['id']
        ]

    );
    $albums = $affichageAlbums->fetchAll();
    // echo "<pre>";
    // print_r($albums);
    // echo "</pre>";

    // On recupère les films dans chaque album
    $affichageFilms = $bdd->prepare('SELECT * FROM films
    JOIN album on album.id = album_id

    -- WHERE album_id = 100
');
    $affichageFilms->execute(
        []

    );
    $films = $affichageFilms->fetchAll();
    // echo "<pre>";
    // print_r($films);
    // echo "</pre>";


    // <img class='w-[20px] h-[20px] mr-[10px]' src='img/heart.png' alt='heart'>
    // 

    // echo $_SESSION['id'];


    $affichageCoeurs = $bdd->prepare('SELECT  * FROM ALBUM 
    JOIN coeurs ON album.id = album_id
    WHERE users_id = :users_id
');
    $affichageCoeurs->execute(
        [
            'users_id' => $_SESSION['id']
        ]

    );
    $Coeurs = $affichageCoeurs->fetchAll();
    // echo "<pre>";
    // print_r($Coeurs);
    // echo "</pre>";



    $i = 0;
    foreach ($albums as $album) {
        // $_SESSION['id'] == $Coeurs[$i]['users_id']
        // $album['id'] == $Coeurs[$i]['album_id'] &&
        // Ici on veut afficher que les 2 premiers albums du user, c'est à dire visionnés et listes d'envie
        // foreach($Coeurs as $coeur){}
        if ($album['likes'] > 0) {
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

            if ($album['isDefault'] == 0) {
                echo " <form action='delete.php' method='POST'>
            
            <div class='flex_supp'>
                <div><input type='hidden' name='supp' value='" . $album['id'] . "'></div>
                <div><button type='submit' class='py-[3px] px-[15px] rounded-[9px] bg-gray-700 text-white ml-[20px] font-poppins text-[12px]'>Supprimer l'album " . $album['name'] . "</button></div><br>
            </div>
    
    
            </form></div>
        ";
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
        </button><h3 class='text-white'> " . $album['name'] . "</h3></div>
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
























        echo "<div class='flex flex-wrap gap-3 ml-5 mt-5'>";
        foreach ($films as $film) {
            if ($film['album_id'] == $album['id']) {
                // echo "<div class='text-purple-700'><a href='movie.php?id=" . $film['id_film'] . alt>" . $film['id_film'] . "</a></div>";
                echo " <div class='w-[145px] h-[250px] relative'><a href='movie.php?id=" . $film['id_film'] . "&name=" . $film['name'] . "&bin=" . $film['bin'] . "' alt><img class='object-cover rounded-[12px]' src='https://www.themoviedb.org/t/p/w600_and_h900_bestv2" . $film['bin'] . "'/></a>

                
                 <form action='delete/deleteFilms.php' method='POST'>
            
                
                    <input type='hidden' name='supp' value='" . $film['album_id'] . "'>
                    <input type='hidden' name='supp2' value='" . $film['id_film'] . "'>
                    
                    <input type='image' alt='Submit' src='img/croix.png' class='absolute top-3 right-3 z-10' /><br>
                
        
                
                </form>

                
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
        $i = $i + 1;
    }

    // require("connexion.php");

    ?>
    <br>
    </div>


    <?php
    require_once('new_album.php');
    if (isset($_GET['reg_err'])) {
        $err = htmlspecialchars($_GET['reg_err']);
        switch ($err) {


            case 'name_length':
    ?>

                <div class="alert flex">
                    <strong class="text-white bg-red-600 px-[8px] py-[4px] rounded-[8px] mx-[20px] my-[20px] ">Erreur</strong>
                    <p class="font-semibold text-red-500 px-[8px] py-[4px] rounded-[8px] my-[20px] ">taille du nom de l'album invalide</p>
                </div>
            <?php
                break;

            case 'already':
            ?>

                <div class="alert flex">
                    <strong class="text-white bg-red-600 px-[8px] py-[4px] rounded-[8px] mx-[20px] my-[20px] ">Erreur</strong>
                    <p class="font-semibold text-red-500 px-[8px] py-[4px] rounded-[8px] my-[20px] ">Un des vos albums avec le même nom existe !</p>
                </div>
    <?php
                break;
        }
    } ?>


    <form action="new_album.php" method="post" class="flex justify-center">
        <fieldset>
            <h2 class='text-white text-center mb-[20px] mt-[100px] font-poppins font-semibold text-[16px]'>Ajouter un album</h2>

            <input class="p-1 px-16 py-2 text-center rounded-[9px] border-2" type="text" name="name" placeholder="Nom de l'album" /><br>
            <div>
                <select class="rounded-[9px] my-[10px] text-center" name="public" id="">
                    <option value="prive">Privé</option>
                    <option value="publique">Publique</option>
                </select>
            </div>
            <button type="submit" value="Créer" class="mt-[20px] text-white bg-orange-500 px-16 py-2 rounded-[9px]">Créer</button>
        </fieldset>
    </form>



    <div class="h-[100px]"></div>
    <footer>
        <div class="py-[20px] text-white  flex place-content-around bg-gray-900 fixed bottom-0 w-[100%] sm:hidden">
            <a class="flex hover:text-gray-300" href="profil.php"> <img class="w-[25px] h-[25px]" src="img/profile.png" alt=""> </a>
            <a class="flex hover:text-gray-300" href="landing.php"><img class="w-[25px] h-[25px]" src="img/home.png" alt=""></a>
            <a class="flex hover:text-gray-300" href="search.php"><img class="w-[25px] h-[25px]" src="img/loupe%20(1).png" alt=""></a>
            <a class="flex hover:text-gray-300" href="#"><img class="w-[22px] h-[25px]" src="img/invit.png" alt=""></a>
        </div>
    </footer>





</body>

</html>