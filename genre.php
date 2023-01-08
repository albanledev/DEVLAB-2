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
    <script src='globalJS/genre.js' async></script>

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
    <div class='flex justify-end sm:hidden'><a href="deconnexion.php" class="  text-white bg-orange-500 px-5 p-2 rounded-[16px] mt-3 mr-5">
            <p>Déconnexion</p>
        </a>
    </div>
    <div class="containerTitre text-white"></div>
    <div class="containerGenre mx-[20px] mb-[40px] mt-[40px] grid grid-cols-2 overflow-x-auto  md:grid md:grid-cols-5 lg:grid-cols-7 xl:grid-cols-9 md:overflow-x-hidden"></div>

    <div class="h-[100px]"></div>
    <footer>
        <div class="py-[20px] text-white  flex place-content-around bg-gray-800 fixed bottom-0 w-[100%] sm:hidden">
            <a class="flex hover:text-gray-300" href="profil.php"> <img class="w-[25px] h-[25px]" src="img/profile.png" alt=""> </a>
            <a class="flex hover:text-gray-300" href="landing.php"><img class="w-[25px] h-[25px]" src="img/home.png" alt=""></a>
            <a class="flex hover:text-gray-300" href="search.php"><img class="w-[25px] h-[25px]" src="img/loupe%20(1).png" alt=""></a>
            <a class="flex hover:text-gray-300" href="#"><img class="w-[22px] h-[25px]" src="img/invit.png" alt=""></a>
        </div>
    </footer>
</body>