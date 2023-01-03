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
    <h1 class="mt-[20px] text-center font-poppins font-semibold text-[20px]">Bonjour <?php echo $_SESSION['user']; ?></h1>



    <h2 class=" ml-[20px] mt-[20px] font-poppins text-[30px] font-bold ">Genres</h2>
    <div class="containerGenre  ml-[10px] flex  overflow-x-auto sm:block  id='crudApp'"></div>


    <h2 class='ml-[20px] mt-[20px] mb-[20px] font-poppins font-semibold text-[16px]'>Films populaires du moment</h2>
    <div class='container ml-[20px] flex overflow-x-auto  md:grid md:grid-cols-6 lg:grid-cols-10' id='crudApp'></div>

    <button id='getBtn'>get Data</button>
    <!-- <button id='postBtn'>2</button> -->

    <a href="deconnexion.php"><button>Déconnexion</button></a>
    <!-- <script src='axios.js' async></script> -->

    <?php
    require_once('new_album.php');
    if (isset($_GET['reg_err'])) {
        $err = htmlspecialchars($_GET['reg_err']);
        switch ($err) {


            case 'name_length':
    ?>

                <div class="alert">
                    <strong>Erreur</strong> taille du nom de l'album invalide
                </div>
            <?php
                break;

            case 'already':
            ?>

                <div class="alert">
                    <strong>Erreur</strong>Un des vos albums avec le même nom existe
                </div>
    <?php
                break;
        }
    } ?>






    <form action="new_album.php" method="post" class="mt-[40px]">
        <fieldset>
            <h2 class='ml-[20px] mt-[20px] font-poppins font-semibold text-[16px]'>Ajouter un album</h2>

            <input type="text" name="name" placeholder="Nom de l'album" /><br>
            <div>
                <select name="public" id="">
                    <option value="prive">Privé</option>
                    <option value="publique">Publique</option>
                </select>
            </div>
            <button type="submit" value="Créer" class="bg-gray-200">Créer</button>
        </fieldset>
    </form>


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
        // if $utilisateur



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
                echo "<a href='movie.php?id=" . $film['id_film'] . "&name=" . $film['name'] . "&bin=" . $film['bin'] . "' alt><img src='https://www.themoviedb.org/t/p/w600_and_h900_bestv2" . $film['bin'] . "'/></a>";



                // echo "<a href='movie.php?id='" . $_SESSION['idFilm'] .
                //     "'>

                // </a>";
                echo "<div class='containerListeFilms'></div>";
            }
        }


        if ($album['isDefault'] == 0) {
            echo " <form action='delete.php' method='POST'>
            
            <div class='flex_supp'>
                <div><input type='hidden' name='supp' value='" . $album['id'] . "'></div>
                <div><button type='submit' class='py-[3px] px-[15px] rounded-[9px] bg-gray-700 text-white ml-[20px] font-poppins text-[12px]'>Supprimer l'album</button></div><br>
            </div>
    
    
            </form>
        ";
        }
    }

    // require("connexion.php");

    ?>
    <br>
    </div>




</body>

</html>