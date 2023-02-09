<?php
require_once 'bd/secure.php';
require_once 'bd/connexion.php';
require_once 'bd/parametre.php';
require_once("ics_generator.php"); 


$pre = "<pre>";
$pre2 = "</pre>";
// Connecting with database
// if connecting is good, code following, or else, dont connect
$db = connect($config);
if ($db == null) {
    echo "Revenez dans quelques instants";
} else {
    if (isset($_POST['btnAjtEvenement'])) {
        
        // init differents var
        $url = "/agendel/home.php#ajout_evenement";
        
        $date_debut = $_POST['date_debut'];
        $lieux = $_POST['lieux'];
        $evenement = $_POST['nom_evenement'];
        $categorie = $_POST['categorie'];
        $organisateur = $_POST['organisateur'];
        //print_r($categorie);
        $avis = $_POST['list'];

        if (empty($date_debut)) {
            $err = "2";
            $url = "/agendel/home.php?err=$err#ajout_evenement";
            header('Location: '.$url);
        }
        if (empty($lieux)) {
            $err = "3";
            $url = "/agendel/home.php?err=$err#ajout_evenement";
            header('Location: '.$url);
        }
        if (empty($evenement)) {
            $err = "4";
            $url = "/agendel/home.php?err=$err#ajout_evenement";
            header('Location: '.$url);
        }  
        if(empty($avis)){
            $err = "1";
            $url = "/agendel/home.php?err=$err#ajout_evenement";
            header('Location: '.$url);
        } else if(!empty($avis) && in_array('1',$avis) && in_array('2', $avis)){
            $err = "0";
            
            $url = "/agendel/home.php?err=$err#ajout_evenement";
            header('Location: '.$url);
        }

        

        if(in_array('1', $avis)){
            array_push($avis, '2');
            echo 'gm';
        }
        foreach ($avis as $keys => $value){
            if ($keys < 1) {
                $cond = $avis[$keys];
            }else{
                $cond = $cond." OR liste=".$avis[$keys];
            }
        }
            
            $request = $db->query("SELECT id, liste FROM user WHERE liste=$cond");
            $data = $request->fetchAll(PDO::FETCH_ASSOC);
 
            $liste = array();
            foreach($data as $key => $value){
                $v=array(
                    "p"=>null,
                    "c"=>null,
					"col"=>null
                );
                $liste[$value['id']] = $v;

            }

            $liste = base64_encode(serialize($liste));
            //echo $liste;

            $insert = $db->prepare("insert into evenement(date_debut, categorie, organisateur, lieux, nom_evenement, liste) values (:date_debut, :categorie, :organisateur, :lieux, :nom_evenement, :liste)");
            $insert->bindValue('date_debut', $date_debut, PDO::PARAM_STR);
            $insert->bindValue('categorie', implode("-",$categorie), PDO::PARAM_STR);
            $insert->bindValue('lieux', $lieux, PDO::PARAM_STR);
            $insert->bindValue('organisateur', $organisateur, PDO::PARAM_STR);
            $insert->bindValue('nom_evenement', $evenement, PDO::PARAM_STR);
            $insert->bindValue('liste', $liste, PDO::PARAM_STR);
            /*$req = $bdd->prepare('SELECT ID, FROM elu');
            $tableauMD = [
                $req => [$checkbox]
            ];
            $insert->$tableauMD;*/
            $insert->execute();
            $idEvent = $db->lastInsertId();

            // Generation Calendar ICS
            $event = new ICSGenerator($date_debut,$date_debut++,$evenement,$lieux,$idEvent);
            $event->save();

            // refresh page and replace him with an other url page
            header('Location: '.$url);
        
    }
    if(isset($_POST['btnComElu'])){
        $commentaire = $_POST['com'];
        print_r($_POST);
        foreach ($commentaire as $key => $value) {
            $select = $db->prepare("SELECT id, liste FROM evenement WHERE id = $key");
            $select->execute();
            $data = $select->fetchAll(PDO::FETCH_ASSOC);
/*             echo "<pre>";
            print_r($data);
            echo "</pre>"; */
            $liste = unserialize(base64_decode($data[0]['liste']));
/*             echo "<pre>";
            print_r($liste);
            echo "</pre>"; */
            $liste[$id]['c'] = $commentaire[$key][0];
            $liste = base64_encode(serialize($liste));
            $update = $db->prepare("UPDATE evenement SET liste = :liste WHERE id = $key");
            $update->bindValue('liste', $liste, PDO::PARAM_STR);
            $update->execute();
        }
        header('Location: /agendel/home.php#list_evenement');
    }
    if (isset($_POST['btnValider'])){
		
		$url = "/agendel/home.php#list_evenement";
		
        $commentaire = $_POST['com'];
        $present = $_POST['present'];
        $presentielCollation = $_POST['presentielCollation'];

/*         echo "<pre>";
        print_r($_POST);
        echo "</pre>"; */
        foreach ($present as $key => $value) {
            $select = $db->prepare("SELECT id, liste FROM evenement WHERE id = $key");
            $select->execute();
            $data = $select->fetchAll(PDO::FETCH_ASSOC);
            
             echo "<pre>";
            print_r($data);
            echo "</pre>";
            $liste = unserialize(base64_decode($data[0]['liste']));

            $liste[$id]['p'] = $present[$key][0];
            $liste[$id]['c'] = $commentaire[$key]['C'];
            $liste[$id]['col'] = $presentielCollation[$key]['col'];
            echo "<pre>";
            print_r($liste);
            echo "</pre>";
			//exit();
            
            $liste = base64_encode(serialize($liste));
            $update = $db->prepare("UPDATE evenement SET liste = :liste WHERE id = $key");
            $update->bindValue('liste', $liste, PDO::PARAM_STR);
            $update->execute();
        }
  
        header('Location: '.$url);
        
    }
    if (isset($_POST['btnSuppEvent'])) {
        $date_debut = $_POST['date_debut'];
        $lieux = $_POST['lieux'];
        $evenement = $_POST['nom_evenement'];
		
		echo"<pre>";
		print_r($_POST);
		echo"</pre>";

		$id=$_POST['btnSuppEvent'];

/*         $select = $db->query("SELECT * FROM evenement");
        $select->execute();
        $data = $select->fetch(PDO::FETCH_ASSOC);
        foreach ($data as $key => $value) { */
            $delete = $db->prepare("DELETE FROM evenement WHERE id = $id");
            $delete->execute();

            $idEvent = $db->lastInsertId();

            // DELETE Calendar ICS
            $event = new ICSGenerator($date_debut,$date_debut++,$evenement,$lieux,$id);
            $delete = unlink("saved-ics/$id.ics");
        // }
        header('Location: /agendel/home.php#list_evenement');
    }
    if(isset($_POST['btnEditEvent'])){
        $id=$_POST['btnEditEvent'];

        $evenement = $_POST['nom_evenement'];
        $dateEvent = $_POST["date_debut"];
        $lieux = $_POST['lieux'];
        $categorie = $_POST['categorie'];
        $organisateur = $_POST['organisateur'];
        
        echo"<pre>";
		print_r($id);
		echo"</pre>";

        echo"<pre>";
		print_r($_POST);
		echo"</pre>";
        $update = $db->prepare("UPDATE evenement SET organisateur = :organisateur, categorie = :categorie, nom_evenement = :nom_evenement, date_debut = :date_debut, lieux = :lieux WHERE id = $id");
        echo"<pre>";
		print_r($update);
		echo"</pre>";
        $update->bindValue('categorie', implode("-",$categorie), PDO::PARAM_STR);
        $update->bindValue('nom_evenement', $evenement, PDO::PARAM_STR);
        $update->bindValue('date_debut', $dateEvent, PDO::PARAM_STR);
        $update->bindValue('lieux', $lieux, PDO::PARAM_STR);
        $update->bindValue('organisateur', $organisateur, PDO::PARAM_STR);
        
        $update->execute();

        $idEvent = $db->lastInsertId();

            // Generation Calendar ICS
        $event = new ICSGenerator($date_debut,$date_debut++,$evenement,$lieux,$id);
        $event->save();
        header('Location: /agendel/home.php#list_evenement');
    }

    
}
?>