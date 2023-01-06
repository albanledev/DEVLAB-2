<?php
session_start();
require_once("config.php");
if (!isset($_SESSION['user'])) {

    header('Location:index.php');
}
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <!-- <script src='axios.js' defer></script> -->
    <link href="dist/output.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src='globalJS/movie.js' async></script>

    <title>Bonjour</title>
</head>

<body class="overflow-x-hidden">
    <header>
        <div class="py-[20px] text-white  hidden place-content-around bg-gray-900 w-[100%] sm:flex">
            <a class="flex hover:text-gray-300" href="profil.php"> <img class="w-[25px] h-[25px]" src="img/profile.png" alt=""><p class="ml-[10px]">profil</p> </a>
            <a class="flex hover:text-gray-300" href="landing.php"><img class="w-[25px] h-[25px]" src="img/home.png" alt=""><p class="ml-[10px]">accueil</p></a>
            <a class="flex hover:text-gray-300" href="#"><img class="w-[25px] h-[25px]" src="img/loupe%20(1).png" alt=""><p class="ml-[10px]">recherche</p></a>
            <a class="flex hover:text-gray-300" href="#"><img class="w-[22px] h-[25px]" src="img/invit.png" alt=""><p class="ml-[10px]">invitations</p></a>
        </div>
    </header>
    <div class="containerMovie"></div>
    <?php

    $_SESSION["idFilm"] = $_GET['id'];
    $_SESSION["nameFilm"] = $_GET['name'];
    $_SESSION["binFilm"] = $_GET['bin'];
    // echo $_SESSION["idFilm"];

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

    // echo '<pre>';
    // print_r($albums);
    // echo '</pre>';
    ?>


    <form class="mb-[200px] mt-[20px] ml-[20px]" action="ajoutFilm.php" method="POST" enctype="multipart/form-data">
        <label class="font-semibold" for="pet-select">Ajouter ce film dans l'album : </label>

        <select name="film" id="pet-select">
            <?php

            foreach ($albums as $album) {
                // echo "<h2 class='text-red-500 font-bold' text-10>" . $album['name'] . "</h2><h3>" . $album['id'] . "</h3>";
                echo "<option value=" . $album['id'] . ">" . $album['name'] . "</option>";
                // "<input type='hidden' name='idAlbum' value='" .  $album['id']  . "'>";
                // '<input type="hidden" name="idAlbum" value="' . $album['id'] . '">';


            }
            ?>
        </select>
        <?php

        foreach ($albums as $album) {

            // echo '<input type="hidden" name="idAlbum" value="' . $album['id'] . '">';
        }
        ?>
        <br>
        <button type="submit" class="mt-[20px] px-[6px] py-[4px] rounded-[8px] bg-gray-600 text-white">Ajouter</button>
    </form>


    <?php

    // foreach ($albums as $album) {
    //    echo "<div class='mb-[80px]'><h2 class='text-red-500 font-bold' text-10>" . $album['name'] . "</h2><h3>" . $album['id'] . "</h3></div>";
    // }
    ?>




    <?php if (isset($_GET['reg_err'])) {
        $err = htmlspecialchars($_GET['reg_err']);
        switch ($err) {



            case 'already':
    ?>

                <div class="alert">
                    <strong>Erreur</strong>Vous ne pouvez pas mettre 2 fois le film dans le même album


                </div>
    <?php
                break;
        }
    } ?>

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