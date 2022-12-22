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
    <script src='axios.js' defer></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Bonjour</title>
</head>

<body>
    <h1 class='text-center text-8'>Bonjour <?php echo $_SESSION['user']; ?></h1>




    <div class='container' id='crudApp'></div>

    <button id='getBtn'>get Data</button>
    <!-- <button id='postBtn'>2</button> -->

    <a href="deconnexion.php"><button>Déconnexion</button></a>
</body>

</html>