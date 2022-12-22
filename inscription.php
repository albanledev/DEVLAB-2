<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h2>Inscription</h2>

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

    <form action="inscription_traitement.php" method="post">

        <div class="form-group">
            <input type="text" name="pseudo" class="form-control" placeholder="Pseudo" required>
        </div>
        <div class="form-group">
            <input type="email" name="email" class="form-control" placeholder="Email" required>
        </div>
        <div class="form-group">
            <input type="password" name="password" class="form-control" placeholder="Mot de passe" required>
        </div>
        <div class="form-group">
            <input type="password" name="password2" class="form-control" placeholder="Confirmer le mot de passe" required>
        </div>
        <div class="form-group">
            <button type="submit">Inscription</button>
        </div>
    </form>
</body>

</html>