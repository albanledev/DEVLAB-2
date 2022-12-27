<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Bienvenue</h1>

    <?php
    echo date('y-m-d h:i:s');
    require_once('inscription.php');

    if (isset($_GET['login_err'])) {
        $err = htmlspecialchars($_GET['login_err']);

        switch ($err) {


            case 'email':
    ?>

                <div class="alert">
                    <strong>Erreur</strong>Email incorrect
                </div>
            <?php
                break;

            case 'already':
            ?>

                <div class="alert">
                    <strong>Erreur</strong>Compte non existant
                </div>
            <?php
                break;

            case 'password':
            ?>

                <div class="alert">
                    <strong>Erreur</strong> mot de passe incorrect
                </div>
    <?php
                break;
        }
    }
    ?>





    <form action="connexion.php" method="post">
        <h2 class="text-center">Connexion</h2>
        <div class="form-group">
            <input type="email" name="email" class="form-control" placeholder="Email" required>
        </div>
        <div class="form-group">
            <input type="password" name="password" class="form-control" placeholder="Mot de passe" required>
        </div>
        <div class="form-group">
            <button type="submit">Connexion</button>
        </div>
    </form>





</body>

</html>