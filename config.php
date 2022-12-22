<?php
try {
    $bdd = new PDO('mysql:host=localhost;dbname=devlab2v2;charset=utf8', 'root', '');
} catch (Exception $e) {
    die('Erreur' . $e->getMessage());
}


