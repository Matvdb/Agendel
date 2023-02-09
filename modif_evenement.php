<?php
require_once 'bd/secure.php';
require_once 'bd/connexion.php';
require_once 'bd/parametre.php';

// Connecting with database
// if connecting is good, code following, or else, dont connect
$db = connect($config);
if ($db == null) {
    echo "Revenez dans quelques instants";
} else {
    if (isset($_POST['btnSuppEvent'])) {
		print_r($_POST);exit();
        $select = $db->query("SELECT * FROM evenement");
        $select->execute();
        $data = $select->fetch(PDO::FETCH_ASSOC);
        foreach ($data as $key => $value) {
            $key = $data['id'];
            $delete = $db->prepare("DELETE FROM evenement WHERE id = $key");
            $delete->execute();
        }
        header('Location: /agendel/home.php#list_evenement');
    }
    
    if(isset($_POST['btnModifEvent'])){
        /*$select = $db->query("SELECT * FROM evenement");
        $select->execute();
        $data = $select->fetch(PDO::FETCH_ASSOC);*/
        /* foreach ($data as $key => $value) {
            $key = $data['id'];
            $update = $db->prepare("UPDATE evenement SET ");
            $update->execute();
        }
        header('Location: /agendel/home.php#list_evenement'); */
    }
    
}
?>