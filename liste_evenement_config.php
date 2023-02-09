<?php
require_once 'bd/connexion.php';
require_once 'bd/parametre.php';
require_once 'evenement_config.php';


$db = connect($config);
if ($db == null){
    echo "Revenez dans quelques instants";
} else {
    // select on the database name of event
    $id = $db->prepare("select id from evenement");
    $nom = $db->prepare("select nom_evenement,description,date_debut,lieux from evenement");
    /*$description = $db->prepare("select description from evenement");
    $date_debut = $db->prepare("select date_debut from evenement");
    $date_fin = $db->prepare("select date_fin from evenement");
    $lieux = $db->prepare("select lieux from evenement");*/
    $nom->execute();
}   
?>