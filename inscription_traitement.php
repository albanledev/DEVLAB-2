<?php
session_start();
require_once 'config.php';


if (isset($_POST['pseudo']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['password2'])) {
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $password2 = htmlspecialchars($_POST['password2']);
    $date = date('y-m-d h:i:s');

    $check = $bdd->prepare('SELECT pseudo, email, password FROM users WHERE email = ?');
    $check->execute(array($email));
    $data = $check->fetch();
    $row = $check->rowCount();

    if ($row == 0) {
        if (strlen($pseudo) <= 100) {
            if (strlen($email) <= 100) {
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    if ($password == $password2) {
                        $password = hash('sha256', $password);
                        $_SESSION['user'] = $data['pseudo'];
                        $id_session = session_id();

                        $insert = $bdd->prepare('INSERT INTO users(pseudo, email, password,date_inscription) VALUES(:pseudo,:email,:password,:date_inscription)');
                        $insert->execute(array(
                            'pseudo' => $pseudo,
                            'email' => $email,
                            'password' => $password,
                            'date_inscription' => $date

                        ));
                        $_SESSION['user'] = $data['pseudo'];
                        header('Location:landing.php');
                    } else header('Location: index.php?reg_err=password');
                } else header('Location: index.php?reg_err=email');
            } else header('Location: index.php?reg_err=email_length');
        } else header('Location: index.php?reg_err=pseudo_length');
    } else header('Location: index.php?reg_err=already');
}
