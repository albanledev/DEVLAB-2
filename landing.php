<?php
session_start();
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

<body>
    <h1 class="text-3xl font-bold underline text-center">Bonjour <?php echo $_SESSION['user']; ?></h1>



    <h2 class='pl-4 text-slate-800 '>Films populaires du moment</h2>
    <div class='container grid px-4 py-4 grid-cols-[150px_150px_150px] md:grid-cols-10' id='crudApp'></div>

    <button id='getBtn'>get Data</button>
    <!-- <button id='postBtn'>2</button> -->

    <a href="deconnexion.php"><button>Déconnexion</button></a>
    <!-- <script src='axios.js' async></script> -->
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




</body>

</html>