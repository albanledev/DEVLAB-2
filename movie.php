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

    <footer>
        <div class="py-[20px] text-white flex place-content-around bg-gray-800 fixed bottom-0 w-[100%]">
            <a href="#">profil</a>
            <a href="landing.php">accueil</a>
            <a href="#">recherche</a>
            <a href="#">invitations</a>
        </div>
    </footer>

</body>
