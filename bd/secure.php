<?php
session_start();

if (!isset($_SESSION['logged_in']))
{
	header("Location: index.php?erreur=Accès Administrateurs");
	exit;
}

// lecture des droits dans session de l'utilisateur

if (! empty($_SESSION["civilite"])) {
    $civilite = $_SESSION["civilite"];
    
} else {
    echo '';
}

if (! empty($_SESSION["nom"])) {
    $nom = $_SESSION["nom"];
    
} else {
    //session_unset();
    echo '';
}

if (! empty($_SESSION["prenom"])) {
    $prenom = $_SESSION["prenom"];
    
} else {
    //session_unset();
    echo '';
}
if (! empty($_SESSION["id"])) {
    $id = $_SESSION["id"];
    
} else {
    //session_unset();
    echo '';
}

if (! empty($_SESSION["role"])) {
    $role = $_SESSION["role"];
    
} else {
    //session_unset();
    echo '';
}

if (! empty($_SESSION["email"])) {
    $email = $_SESSION["email"];
    
} else {
    //session_unset();
    echo '';
}

session_write_close();




?>
