<?php
session_start();
require_once('config.php');
if (!isset($_SESSION['user'])) {
    header('Location:index.php');
}
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

    <h2 class="ml-[20px] mt-[20px] font-poppins text-[16px]">Genres</h2>
    <div class='containerGenre flex  overflow-x-auto sm:block  id='crudApp'></div>

    <h2 class='ml-[20px] mt-[20px] font-poppins font-semibold text-[16px]'>Films populaires du moment</h2>
    <div class='container grid px-4 py-4 grid-cols-3 md:grid-cols-6 lg:grid-cols-10' id='crudApp'></div>

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
            <h2 class="text-[20px] font-bold ">Ajouter un album</h2>

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
    echo "<pre>";
    print_r($albums);
    echo "</pre>";


    foreach ($albums as $album) {
        echo "<h2 class='text-red-500 font-bold' text-10>" . $album['name'] . "</h2>";
    }



    foreach ($albums as $album) {
        // if $utilisateur

        echo "<br><br>
         <div class='bg-green-800'><h3> " . $album['name'] . "</h3><br></div>
        <p>Il a " . $album['likes'] . " likes</p>
        ";
        if ($album['isPublic'] == 0) {
            echo "<p>L'album est public</p>";
        } else {
            echo "<p>L'album est privé</p>";
        }


        if ($album['isDefault'] == 0) {
            echo " <form action='delete.php' method='POST'>
    
            <div class='flex_supp'>
                <div><input type='hidden' name='supp' value='" . $album['id'] . "'></div>
                <div><button type='submit' class='text-red-500'>Supprimer le post</button></div>
            </div>
    
    
            </form>
        ";
        }
    }

    // require("connexion.php");

    ?>



</body>

</html>