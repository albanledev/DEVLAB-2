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
    <script src='axios.js' async></script>

    <link href="dist/output.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Bonjour</title>
</head>

<body class='overflow-x-hidden'>
    <h1 class="text-3xl font-bold underline text-center p-4">Bonjour <?php echo $_SESSION['user']; ?></h1>

    <h2>Genres</h2>
    <div class='containerGenre  px-4 py-4 md:px-0 flex overflow-x-visible md:grid md:grid-cols-10 m-auto ' id='crudApp'></div>

    <h2 class='pl-4 text-slate-800 '>Films populaires du moment</h2>
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

    $affichageAlbums = $bdd->prepare('SELECT name FROM ALBUM 
    JOIN users_album ON album.id = album_id
    JOIN users ON users.id = users_id WHERE users_id = :users_id');
    $affichageAlbums->execute(
        [
            'users_id' => $_SESSION['id']
        ]

    );
    $albums = $affichageAlbums->fetchAll();
    print_r($albums);

    foreach ($albums as $album) {
        echo "<h2 class='text-red-500 font-bold' text-10>" . $album['name'] . "</h2>";
    }

    // require("connexion.php");

    ?>



</body>

</html>