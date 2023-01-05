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

<body class='overflow-x-hidden'>
    <header>
        <div class="py-[20px] text-white  hidden place-content-around bg-gray-900 w-[100%] sm:flex">
            <a class="flex hover:text-gray-300" href="#"> <img class="w-[25px] h-[25px]" src="img/profile.png" alt=""><p class="ml-[10px]">profil</p> </a>
            <a class="flex hover:text-gray-300" href="landing.php"><img class="w-[25px] h-[25px]" src="img/home.png" alt=""><p class="ml-[10px]">accueil</p></a>
            <a class="flex hover:text-gray-300" href="#"><img class="w-[25px] h-[25px]" src="img/loupe%20(1).png" alt=""><p class="ml-[10px]">recherche</p></a>
            <a class="flex hover:text-gray-300" href="#"><img class="w-[22px] h-[25px]" src="img/invit.png" alt=""><p class="ml-[10px]">invitations</p></a>
        </div>
    </header>
    <a href="deconnexion.php" class="flex justify-end pr-2 pt-2"><button>Déconnexion</button></a>
    <h1 class="mt-[20px] text-center font-poppins font-semibold text-[20px]">Bonjour <?php echo $_SESSION['user']; ?></h1>



    <h2 class=" ml-[20px] mt-[20px] font-poppins font-semibold text-[16px] ">Genres</h2>
    <div class="containerGenre  ml-[10px] flex  overflow-x-auto lg:overflow-x-hidden id='crudApp'"></div>

    <input id="search-input" type="text" class="bg-gray-300 rounded-xl pl-2 ml-4">
    <div class='movieSearch'></div>


    <h2 class='ml-[20px] mt-[20px] mb-[20px] font-poppins font-semibold text-[16px]'>Films populaires du moment</h2>
    <div class='container ml-[20px]  flex overflow-x-auto  md:grid md:grid-cols-5 lg:grid-cols-7 xl:grid-cols-9 md:overflow-x-hidden' id='crudApp'></div>

    <!-- <button id='getBtn'>get Data</button> -->
    <!-- <button id='postBtn'>2</button> -->


    <!-- <script src='axios.js' async></script> -->











    <?php
    // $sql = "SELECT * FROM `album` "
    // var_dump($_SESSION);

    $affichageAlbums = $bdd->prepare('SELECT  album.id, name, isPublic, likes, isDefault FROM ALBUM 
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









    foreach ($albums as $album) {

        // Ici on veut afficher que les 2 premiers albums du user, c'est à dire visionnés et listes d'envie

        // if ($albums[2] == $album) {
        //     break;
        // }




        echo "<br><br>
        <div class='block'>
        <div class='ml-[20px] font-poppins font-semibold text-[16px]'><h3> " . $album['name'] . "</h3></div>
        <p class='text-gray-400 ml-[20px] font-poppins text-[12px]'>" . $album['likes'] . " likes</p>
        ";
        if ($album['isPublic'] == 0) {
            echo "<p class='text-gray-400 ml-[20px] font-poppins text-[12px]'>publique</p>";
        } else {
            echo "<p class='text-gray-400 ml-[20px] font-poppins text-[12px]'>privé</p><br>";
        }

        foreach ($films as $film) {
            if ($film['album_id'] == $album['id']) {
                // echo "<div class='text-purple-700'><a href='movie.php?id=" . $film['id_film'] . alt>" . $film['id_film'] . "</a></div>";
                echo "<a href='movie.php?id=" . $film['id_film'] . "&name=" . $film['name'] . "&bin=" . $film['bin'] . "' alt><img class=' ml-[4px] p-[4px] object-cover rounded-[10px] w-[145px] h-[250px] ' src='https://www.themoviedb.org/t/p/w600_and_h900_bestv2" . $film['bin'] . "'/></a>";



                // echo "<a href='movie.php?id='" . $_SESSION['idFilm'] .
                //     "'>

                // </a>";
                // echo "<div class='containerListeFilms  '></div>";
            }
        }
    }

    // require("connexion.php");


        ?>
        <br>
    <div class="h-[100px]"></div>
    <footer>
        <div class="py-[20px] text-white  flex place-content-around bg-gray-900 fixed bottom-0 w-[100%] sm:hidden">
            <a class="flex hover:text-gray-300" href="profil.php"> <img class="w-[25px] h-[25px]" src="img/profile.png" alt=""> </a>
            <a class="flex hover:text-gray-300" href="landing.php"><img class="w-[25px] h-[25px]" src="img/home.png" alt=""></a>
            <a class="flex hover:text-gray-300" href="#"><img class="w-[25px] h-[25px]" src="img/loupe%20(1).png" alt=""></a>
            <a class="flex hover:text-gray-300" href="#"><img class="w-[22px] h-[25px]" src="img/invit.png" alt=""></a>
        </div>
    </footer>

</body>

</html>