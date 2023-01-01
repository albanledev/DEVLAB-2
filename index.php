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
    // echo date('y-m-d h:i:s');
    // require_once('inscription.php');

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





    <form class="text-center" action="connexion.php" method="post">
        <h2 class="mt-[150px] mb-[50px] text-center font-poppins font-semibold text-[20px]">S'identifier</h2>
        <div class="pt-[22px] px-[22px] form-group">
            <input type="email" name="email" class="p-1 px-16 py-2 rounded-[9px] border-2 form-control" placeholder="Email" required>
        </div>
        <div class="p-[22px] form-group">
            <input type="password" name="password" class="p-1 px-16 py-2 rounded-[9px] border-2 form-control" placeholder="Mot de passe" required>
        </div>
        <p class="mb-[22px] text-[12px]">Vous n'êtes pas encore inscrits ? <a class="text-[12px] font-poppins font-semibold " href="inscription.php">Cliquez sur ce lien</a></p>
        <div class="form-group">
            <button class="text-white bg-gray-700 px-16 py-2 rounded-[9px]" type="submit">S'identifier</button>
        </div>
    </form>

</body>

</html>