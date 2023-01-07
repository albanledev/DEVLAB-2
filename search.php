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
    <!-- <script src='axios.js' async></script> -->
    <script src='globalJS/search.js' async></script>
    <link href="dist/output.css" rel="stylesheet">
    <!-- <script src="https://cdn.tailwindcss.com"></script> -->
    <title>Bonjour</title>
</head>

<body class='bg-gray-800'>
    <header>
        <div class="pt-[20px] text-white  hidden place-content-around bg-gray-900 w-[100%] sm:flex">
            <a class="flex hover:text-gray-300" href="profil.php"> <img class="w-[25px] h-[25px]" src="img/profile.png" alt="">
                <p class="ml-[10px]">profil</p>
            </a>
            <a class="flex hover:text-gray-300" href="landing.php"><img class="w-[25px] h-[25px]" src="img/home.png" alt="">
                <p class="ml-[10px]">accueil</p>
            </a>
            <a class="flex hover:text-gray-300" href="#"><img class="w-[25px] h-[25px]" src="img/loupe%20(1).png" alt="">
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
    <h1 class="mt-[20px] text-center font-poppins font-semibold text-[20px] ">Bonjour <?php echo $_SESSION['user']; ?></h1>



    <div class="flex justify-center">
        <input id="searchbar" type="text" class='rounded-[25px] w-[80vw] h-8 outline-none mt-[120px]'>
    </div>
    <ul id="submenu" class="ml-[10vw] mt-5"></ul>

</body>

</html>