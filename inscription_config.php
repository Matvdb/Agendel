<?php

    
require_once 'bd/connexion.php';
require_once 'bd/parametre.php';

// analyze differents datas and return their if an error exist
function verif($email, $password, $nom, $prenom, $tel){
    if (empty($email)) {
        echo "email vide";
        return false;
    }
    if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
        echo "email incorrect";
        return false;
    } 
    if (empty($password)) {
        echo "password vide";
        return false;
    }    
    if (empty($nom)) {
        echo "nom vide";
        return false;
    }  
    if (empty($prenom)) {
        echo "prenom vide";
        return false;
    }  
    if (empty($tel)) {
        echo "tel vide";
        return false;
    }  
    return true;
}

// Connecting with database
// if connecting is good, code following, or else, dont connect
$db = connect($config);
if ($db == null){
    echo "Revenez dans quelques instants";
} else {
    if (isset($_POST['btInscrire'])) {
        // init differents var
        $email = $_POST['email'];
        $password = $_POST['password'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $civilite = $_POST["civilite"];
        $tel = $_POST['tel'];
        $role = $_POST['role'];

        // if verif function is finish, all of data are sending to database
        if (verif($email, $password, $nom, $prenom, $tel)) {
            $password = password_hash($password, PASSWORD_DEFAULT);
            $select = $db->prepare("select email from user where email = :email");
            $select->bindValue('email', $email, PDO::PARAM_STR);
            $select->execute();
            // if email is already used, return email false
            if ($select->fetch() != null) {
                echo "Email déjà existant";
            }

            $insert = $db->prepare("insert into user(role, nom, prenom, civilite ,email, password, tel) values (:role, :nom, :prenom, :civilite, :email, :password, :tel)");
            $insert->bindValue('role', $role, PDO::PARAM_STR);
            $insert->bindValue('nom', $nom, PDO::PARAM_STR);
            $insert->bindValue('prenom', $prenom, PDO::PARAM_STR);
            $insert->bindValue('email', $email, PDO::PARAM_STR);
            $insert->bindValue('password', $password, PDO::PARAM_STR);
            $insert->bindValue('tel', $tel, PDO::PARAM_STR);
            $insert->bindValue('civilite', implode("|",$civilite), PDO::PARAM_STR);
            $insert->execute();
            header('Location: //localhost/agendel/home.php#inscription_elu');

        }
    }
}
    ;
?>