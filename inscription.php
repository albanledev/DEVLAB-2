<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
</head>

<body>


    <?php
    if (isset($_GET['reg_err'])) {
        $err =  htmlspecialchars($_GET['reg_err']);

        switch ($err) {
            case 'success';
    ?>
                <div class="alert">
                    <strong>Succès</strong> inscription réussie !
                </div>
            <?php
                break;

            case 'password';
            ?>
                <div class="alert">
                    <strong>Erreur</strong> Mot de passe différent
                </div>
            <?php
                break;

            case 'email';
            ?>
                <div class="alert">
                    <strong>Erreur</strong> Email non valide
                </div>
            <?php
                break;

            case 'email_length';
            ?>
                <div class="alert">
                    <strong>Erreur</strong> Email trop long
                </div>
            <?php
                break;
            case 'pseudo_length';
            ?>
                <div class="alert">
                    <strong>Erreur</strong> Pseudo trop long
                </div>
            <?php
                break;
            case 'already';
            ?>
                <div class="alert">
                    <strong>Erreur</strong> Compte déjà existant
                </div>
    <?php
                break;
        }
    }
    ?>

    <form class="text-center" action="inscription_traitement.php" method="post">
        <h2 class="mt-[150px] mb-[50px] text-center font-poppins font-semibold text-[20px]">S'inscrire</h2>
        <div class="pt-[22px] px-[22px] form-group">
            <input type="text" name="pseudo" class="p-1 px-16 py-2 rounded-[9px] border-2 form-control" placeholder="Pseudo" required>
        </div>
        <div class="pt-[22px] px-[22px]  form-group">
            <input type="email" name="email" class="p-1 px-16 py-2 rounded-[9px] border-2 form-control" placeholder="Email" required>
        </div>
        <div class="pt-[22px] px-[22px]  form-group">
            <input type="password" name="password" class="p-1 px-16 py-2 rounded-[9px] border-2 form-control" placeholder="Mot de passe" required>
        </div>
        <div class="p-[22px] form-group">
            <input type="password" name="password2" class="p-1 px-16 py-2 rounded-[9px] border-2 form-control" placeholder="Confirmer le mot de passe" required>
        </div>
        <p class="text-center mb-[22px] text-[12px]">Vous êtes déjà inscrit ? <a class="text-[12px] font-poppins font-semibold " href="index.php">S'identifier</a></p>
        <div class="form-group">
            <button class=" text-white bg-gray-700 px-16 py-2 rounded-[9px]" type="submit">S'inscrire</button>
        </div>
    </form>
</body>

</html>