<?php

require_once 'bd/secure.php';    
require_once 'bd/connexion.php';
require_once 'bd/parametre.php';
require_once 'fonction.php';

function verifProfil($pwd1, $pwd2){
    if(empty ($pwd1)){
        $erreur = "Veuillez saisir votre mot de passe.";
        $url = "/agendel/home.php?erreur=$erreur#profil";
        header('Location: '.$url);
        return false;
    }
    if(empty ($pwd2)){
        $erreur = "Veuillez confirmer votre mot de passe";
        $url = "/agendel/home.php?erreur=$erreur#profil";
        header('Location: '.$url);
        return false;
    }
    if($pwd1 != $pwd2){
        $erreur = "Les mots de passe sont différents.";
        $url = "/agendel/home.php?erreur=$erreur#profil";
        header('Location: '.$url);
        return false;
    }
    return true;
}

$db = connect($config);
if ($db == null){
    echo "Revenez dans quelques instants";
} else {
    if (isset($_POST['btnContact'])) {

        $nom = $_POST['nom'];
        $email = $_POST['email'];
        $message = $_POST['message'];

        /*$select = $db->prepare("select email from contact where email = :email");
        $select->bindValue('email', $email, PDO::PARAM_STR);
        $select->execute();*/

        $insert = $db->prepare("insert into contact(nom, email, message) values (:nom, :email, :message)");
        $insert->bindValue('nom', $nom, PDO::PARAM_STR);
        $insert->bindValue('email', $email, PDO::PARAM_STR);
        $insert->bindValue('message', $message, PDO::PARAM_STR);
        $insert->execute();
    }
	if (isset($_POST['btnProfil'])){
        $pwd1 = $_POST['pwd1'];
		$pwd2 = $_POST['pwd2'];
        if(verifProfil($pwd1, $pwd2)){
            $password = password_hash($pwd1, PASSWORD_DEFAULT);

            $update = $db->prepare("UPDATE user SET password = :password WHERE id = $id");
            $update->bindValue('password', $password, PDO::PARAM_STR);
            $update->execute();

            $url = "/agendel/home.php#profil";
            header('Location: '.$url);
        }
    }
}
    ;
?>