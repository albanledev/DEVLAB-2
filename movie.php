<?php
session_start();
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

<body>

    <div class="containerMovie"></div>



    <?php

    $_SESSION["idFilm"] = $_GET['id'];
    echo $_SESSION["idFilm"];

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

    ?>
    <form action="ajoutFilm.php" method="POST">
        <label for="pet-select">Ajouter ce film dans l'album : </label>

        <select name="film" id="pet-select">
            <?php

            foreach ($albums as $album) {
                // echo "<h2 class='text-red-500 font-bold' text-10>" . $album['name'] . "</h2>";
                echo "<option value=" . urlencode($album['name']) . ">" . $album['name'] . "</option>";
            }
            ?>
        </select>
        <br>
        <button type="submit" class="bg-gray-600 text-white">Ajouter</button>
    </form>

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

    <footer>
        <div class="py-[20px] text-white flex place-content-around bg-gray-800 fixed bottom-0 w-[100%]">
            <a href="#">profil</a>
            <a href="landing.php">accueil</a>
            <a href="#">recherche</a>
            <a href="#">invitations</a>
        </div>
    </footer>

</body>