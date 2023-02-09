<!-- CALL CONFIGURATIONS PHP -->
<?php
require_once 'bd/secure.php';
require_once 'bd/connexion.php';
require_once 'bd/parametre.php';
require_once 'inscription_config.php';
require_once 'bd/Member.php';
require_once 'fonction.php';
require_once 'contact_config.php';  
?>
<!DOCTYPE html>
<html lang='fr'>
<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.png" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- Script JS -->
    <script src="js/scripts.js"></script>
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    <!--FONT Text -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
    <link href="css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <!-- Graph JS library -->
    <script src="https://cdn.plot.ly/plotly-2.16.1.min.js"></script>
    <script src="js/graph.js"></script>
    <script src="plotly-2.16.1.min.js"></script>
    <!-- Canva JS library -->
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <!-- Toogle button -->
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script src="toggle-switch/toggle-switch.js"></script>
    <link href="toggle-switch/toggle-switch.css" rel="stylesheet" type="text/css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <!-- DataTable -->
    <script src="datatable/jquery-3.5.1.js"></script>
    <script src="datatable/jquery.dataTables.min.js"></script>
    <script src="datatable/dataTables.rowReorder.min.js"></script>
    <script src="datatable/dataTables.responsive.min.js"></script>
    <link href="datatable/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link href="datatable/rowReorder.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link href="datatable/responsive.dataTables.min.css" rel="stylesheet" type="text/css" />
    <!-- Toggle V2 -->
    <link href="toggle-switchV2/style.css" rel="stylesheet" type="text/css" >
    <script src="toggle-switchV2/script.js"></script>
    <!-- Sweet Alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.min.css" rel="stylesheet">

<!-- Script DataTable -->
<script>
$(document).ready(function (){
   var table = $('#tbl_events').DataTable({
        "ordering": false,
        scrollY: '400px',
        scrollCollapse: true,
        paging: false,
        responsive: true,
        dom: 'lrtip',
        'columnDefs': [{
            'targets': [],
            'render': function(data, type, row, meta){
               if(type === 'display'){
                    var api = new $.fn.dataTable.Api(meta.settings);
                    var $el = $('input, select, textarea', api.cell({ row: meta.row, column: meta.col }).node());
                    var $html = $(data).wrap('<div/>').parent();
                    if($el.prop('tagName') === 'INPUT'){
                        $('input', $html).attr('value', $el.val());
                    if($el.prop('checked')){
                        $('input', $html).attr('checked', 'checked');
                    }
                    } else if ($el.prop('tagName') === 'TEXTAREA'){
                        $('textarea', $html).html($el.val());
                    } else if ($el.prop('tagName') === 'SELECT'){
                        $('option:selected', $html).removeAttr('selected');
                        $('option', $html).filter(function(){
                        return ($(this).attr('value') === $el.val());
                        }).attr('selected', 'selected');
                    }
                    data = $html.html();
                }
               return data;
            }
        }],
        'responsive': true
    });
    $('#filter-categorie').on('change', function(){
       table.search(this.value).draw();   
    });
    $('#filter-mois').on('change', function(){
       table.search(this.value).draw();   
    });

    // Update original input/select on change in child row
    $('#tbl_events tbody').on('keyup change', '.child input, .child select, .child textarea', function(e){
        var $el = $(this);
        var rowIdx = $el.closest('ul').data('dtr-index');
        var colIdx = $el.closest('li').data('dtr-index');
        var cell = table.cell({ row: rowIdx, column: colIdx }).node();
        $('input, select, textarea', cell).val($el.val());
        if($el.is(':checked')){
          $('input', cell).prop('checked', true);
        } else {
          $('input', cell).removeProp('checked');
        }
    });
});
</script>
<title>Agendel</title>
</head>
<body id='page-top'>
<?php
$select = $db->prepare("SELECT * FROM user WHERE role = 'elu'");
$select->execute();
$data = $select->fetchAll(PDO::FETCH_ASSOC);
?><br><br>
<?php
$eluArray = array();
foreach($data as $key => $value){
    $v=array(
        "nom"=>$value['nom'],
        "prenom"=>$value['prenom']
    );
    $eluArray[$value['id']] = $v;
}
?>
<!-- Creation Navbar -->
<nav class='navbar navbar-expand-lg navbar-dark fixed-top' style="background-color: black;" id='mainNav'>
<?php if ($role == "elu") {
    echo " <div class='container'>";
} else if ($role == "admin") {
    echo " <div class='container-fluid'>";
}?>
<a class='navbar-brand' href='#page-top'>Agendel</a>
<button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#navbarResponsive' aria-controls='navbarResponsive' aria-expanded='false' aria-label='Toggle navigation'>
    Menu
<i class='fas fa-bars ms-1'></i>
</button>
<div class='collapse navbar-collapse' id='navbarResponsive'>
    <ul class='navbar-nav text-uppercase ms-auto py-4 py-lg-0'>
        <?php
        $reponse = $db->query('SELECT * FROM evenement ORDER BY date_debut');
            $countNa = 0;
        while ($donnees = $reponse->fetch(PDO::FETCH_ASSOC)) // Renvoit les valeurs de la bdd
        {
            $liste = unserialize(base64_decode($donnees['liste']));
            if (array_key_exists($id, $liste)) {
                if ($liste[$id]['p'] == null) {
                    $countNa++; // Initialise le Compteur
                }
            }
        }
		if($countNa>0){
		$newsEvents='<span class="top-0 start-100 translate-middle badge rounded-pill bg-danger">'.$countNa.'</span>';
		}else{$newsEvents=null;}
		
        ?>
        <div class="row">
            <div class="col">
                <li class='nav-item' id="vue"><a class='nav-link' href='#list_evenement'>Liste évènements <?php if ($role == "elu") { echo $newsEvents; }?></a></li>
            </div>
        </div>
        <?php if($role=="admin" || $role == "superAdmin"){echo"<li class='nav-item'><a class='nav-link' href='#ajout_evenement'>Ajouter un évènement</a></li>";}?>
        <?php if($role == "superAdmin"){echo"<li class='nav-item'><a class='nav-link' href='#inscription_elu'>Inscription elu</a></li>";}?>
        <?php if($role=="admin" || $role == "superAdmin"){?> <li class='nav-item'><a class='nav-link' href='#stat'>Statistiques</a></li><?php } ?>
        <li class='nav-item'><a class='nav-link' href='#A_propos'>A propos</a></li>
        <li class='nav-item'><a class='nav-link' href='#contact'>Contact</a></li>
        <li class='nav-item' ><a class='nav-link' style="color: yellow;" href='#profil'><i class="bi bi-person-circle"></i></a></li>
        <li class='nav-item'><a class='nav-link text-warning' href="bd/deconnexion.php">Se déconnecter <i class="bi bi-x-circle-fill"></i></a></li>
    </ul>
</div>
</nav>
<!-- Bienvenue -->
<header class='masthead' id="header">
    <div class='container'>
        <div class='masthead-subheading'>
            <strong>Bonjour <?php echo $civilite." ".$nom." ".$prenom;?></strong> 
		</div><br>
        <div class='masthead-subheading'>Bienvenue sur Agendel !</div>
        <div class='masthead-heading text-uppercase'><!-- Expliquez le concept --></div>
        <a class='btn btn-primary btn-xl text-uppercase' href='#A_propos'>En savoir plus</a>
        </div>
</header>
<!-- Liste des évènements -->
<section class='page-section bg-light' id='list_evenement'>
    <div class='container text-center'>
        <h1>Liste des évènements</h1><br>
    </div><br>
    <?php
    $reponse = $db->query('SELECT * FROM evenement INNER JOIN categorie ON id_categ=categorie ORDER BY date_debut');
    ?>
    <div class='container'>
        <div class="row">
		    <div class="col-3">
		        <label for="annees">Catégories</label>
		        <select name="filter-categorie" id="filter-categorie">
                <option value=""> -- </option>
                <?php
                $selectCategorie = $db->query('SELECT * FROM categorie');
                while ($categorie = $selectCategorie->fetch(PDO::FETCH_ASSOC)){
                    echo '<option value="'.$categorie['nom_categ'].'">'.$categorie['nom_categ'].'</option>';
                }?>
                </select>
		    </div>
			<div class="col-3">
			    <label for="mois">Mois</label>
			    <select name="filter-mois" id="filter-mois">
			        <option value=""> -- </option>
			        <option value="/01/">Janvier</option>
			        <option value="/02/">Février</option>
			        <option value="/03/">Mars</option>
		            <option value="/04/">Avril</option>
		            <option value="/05/">Mai</option>
		            <option value="/06/">Juin</option>
		            <option value="/07/">Juillet</option>
		            <option value="/08/">Août</option>
		            <option value="/09/">Septembre</option>
	                <option value="/10/">Octobre</option>
		            <option value="/11/">Novembre</option>
		            <option value="/12/">Décembre</option>
		        </select>
		    </div>
        </div>
        <form action='evenement_config.php' method='POST'>
            <table id="tbl_events" class="display nowrap" style='width:100%'>
            <thead>
	            <tr>
	                <th class="thliste" style="width: 10%;">N°</th>
                    <th style="width: 10%;">Date/Horaire début</th>
                    <th style="width: 10%;">Réponses</th>
                    <th>Titre</th>
                    <th>Lieux</th>
                    <th>Catégorie</th>
                    <th>Organisateur</th>
                    <?php 
                    if($role == "elu"){
                        echo "<th >Commentaire</th>";
                        echo "<th>.ics</th>";
                        echo "<th>presentielCollation</th>";
                    }
                    ?>
	            </tr>
            </thead>
            <tdbody>
            <?php
            $countNa = 0;
            while($donnees = $reponse->fetch(PDO::FETCH_ASSOC)) // Renvoit les valeurs de la bdd
            {          
            $liste = unserialize(base64_decode($donnees['liste'])); // Converti le tableau encoder en String
			if ($role == "admin" || $role == "superAdmin") { // Affiche le contenu ci-dessous si admin/superAdmin
			    echo '<tr>';
				echo '<td class="tdliste">' . $donnees['id'] . '</td>';
                echo '<td >' . datetimeFR($donnees['date_debut']) . '</td>';
            ?>
            <td>
                <div class="container text-center">
                <?php
                echo progressBar($liste);
                ?>
                </div>
                <div class="container text-center" >
                    <!-- Button Infos Icon -->
                    <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#detailsModal<?php echo $donnees['id']; ?>">
                    <i class="fa-solid fa-circle-info"></i>
                    </button>
                    <!-- Modal Info -->
                    <div class="modal fade" id="detailsModal<?php echo $donnees['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-dialog-centered">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Détails de l'évènement n°<?php echo $donnees['id'];?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        <div class="row">
                                            <div class="col">
                                                <p></p>
                                            </div>
                                            <div class="col">
                                                <p>Nom</p>
                                            </div>
                                            <div class="col">
                                                <p>Présentiel</p>
                                            </div>
                                            <div class="col">
                                                <p>Commentaire</p>
                                            </div>
                                        </div>
                                        <?php
                                        foreach ($liste as $key => $value) {
                                            switch($value['p']){
                                                case '0':
                                                    $present = '<i class="fa-solid fa-thumbs-down" style="color: red;" ></i>';
                                                    break;
                                                case '1':
                                                    $present = '<i class="fa-solid fa-thumbs-up" style="color: green;" ></i>';
                                                    break;
                                                case '':
                                                    $present = '<i class="fa-regular fa-circle-question"></i>';
                                                    break;
                                                default:
                                                    $present = '';     
                                            }
                                            echo '<br>';
                                            echo '<div class="row bg-light">';
                                            echo '<div class="col">'.$key.'</div>';
                                            echo "<div class='col'>".$eluArray[$key]["nom"]." ".$eluArray[$key]["prenom"]."</div>";
                                            echo '<div class="col">'.$present.'</div>';
                                            echo '<div class="col">'.$value['c'].'</div>';
                                            echo '</div>';
                                        }
                                        ;?>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                        </div>
                        </div>
                    </div>
                    </div>

                    <button type="button" class="btn" name="btnEditEvent[<?php $donnees['id']?>[]">
                        <i class="bi bi-pencil-square" data-bs-toggle="modal" data-bs-target="#modalEditEvent<?php echo $donnees['id'] ?>"></i>
                    </button>
                    <?php if($role == "superAdmin"){
                        ?>
                        <!-- Button Icon Delete -->
                        <button type="button" class="btn" name="btnDeleteEvent<?php echo $donnees['id']; ?>[]" data-bs-toggle="modal" data-bs-target="#modalDeleteEvent<?php echo $donnees['id'] ?>">
                        <i class="bi bi-trash3-fill" ></i>
                        </button>
                        <!-- Modal Delete Event -->
                        <div class="modal fade" id="modalDeleteEvent<?php echo $donnees['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-xl">
                            <div class="modal-content">
                            <div class="modal-header float-right">
                                <h5 class="modal-title" id="modalSuppEvent">Supprimer l'évènement n° <?php echo $donnees['id'];?></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="container text-center">
                                    <h5>Voulez-vous vraiment supprimer cet évènement ?</h5>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                <button type="submit" class="btn btn-primary" name="btnSuppEvent" data-bs-dismiss="modal" value="<?php echo $donnees['id']; ?>">Confirmez</button>
                            </div>
                            </div>
                        </div>
                        </div>
                        <?php
                    } ?>
                </div>
            </td>
            <?php
			echo '<td >' . $donnees['nom_evenement'] . '</td>';
			echo '<td >' . $donnees['lieux'] . '</td>';
            echo '<td class="tdliste">' . $donnees['nom_categ'] . '</td>';
            echo '<td class="tdliste">' .  $donnees['organisateur'] . '</td>';?>
            <!-- MODAL EDIT event -->
            <div class="modal fade" id="modalEditEvent<?php echo $donnees['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xl">
                    <div class="modal-content">
                        <div class="modal-header float-right">
                            <h5 class="modal-title" id="modalEditEvent">Modifier l'évènement n° <?php echo $donnees['id'];?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form  action="evenement_config.php" method="post">
                                <div class="container text-center">
                                    <h5>Veuillez modifier cet évènement</h5><br>
                                    <label for='exampleFormControlInput1' class='form-label'>Date début</label><br>
                                    <input id='date' type='datetime-local' name='date_debut' value="<?php echo $donnees['date_debut']; ?>" ><br><br>
                                    <div class='row'>
                                        <div class='col' style="text-align: left;" >
                                            <label for='exampleFormControlInput1' class='form-label'>Catégorie</label><br>
                                            <select name="categorie[]" id="categorie[]">
                                            <?php
                                            echo'<option value="'.$donnees['id_categ'].'">'.$donnees['nom_categ'].'</option>';
                                            $selectCategorie = $db->query('SELECT * FROM categorie');
                                            while ($categorie = $selectCategorie->fetch(PDO::FETCH_ASSOC)){
                                                echo '<option value="'.$categorie['id_categ'].'">'.$categorie['nom_categ'].'</option>';
                                            }
                                            ?>
                                            </select>
                                        </div>
                                        <div class='col' style="text-align: left;" >
                                            <label for='exampleFormControlInput1' class='form-label'>Evenement</label>
                                            <input type='text' class='form-control' id='nom' name='nom_evenement' placeholder='Nom évènement' value='<?php echo $donnees['nom_evenement']; ?>' />
                                            </div>
                                        <div class='col' style="text-align: left;" >
                                            <label for='exampleFormControlInput1' class='form-label'>Lieux</label>
                                            <input type='text' class='form-control' id='lieux' name='lieux' placeholder='Lieux évènement' value='<?php echo $donnees['lieux']; ?>' />
                                        </div>
                                        <div class='col' style="text-align: left;" >
                                            <label for='exampleFormControlInput1' class='form-label'>Organisateur</label>
                                            <input type='text' class='form-control' id='organisateur' name='organisateur' placeholder='organisateur évènement' value='<?php echo $donnees['organisateur']; ?>' />
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                            <!-- Button EDIT event -->
                            <button type="submit" class="btn btn-primary" name="btnEditEvent" data-bs-dismiss="modal" value="<?php echo $donnees['id']; ?>">Confirmez</button>
                        </div>
        </form>
    </div>
    </div>
    <?php                     						
	}elseif ($role == "elu"){ // Affiche le tableau si elu
		if (array_key_exists($id,$liste)){ // Applique les conditions si key exist
            if ($liste[$id]['p'] == null) {
                $countNa++;
            }
            $radioPresentOui = "";
            $radioPresentNa = "checked";
            $radioPresentNon = "";
            switch ($liste[$id]['p']) {
                case '0':
                    $radioPresentNon = "checked";
                    $radioPresentNa = "";
                    $badge = null;
                    $icsUrl= null;
                    break;
                case '1':
                    $radioPresentOui = "checked";
                    $radioPresentNa = "";
                    $badge = null;                        
					$icsUrl='<a href=saved-ics/'.$donnees['id'].'.ics><i class="fa-solid fa-calendar-plus"></i></a>';   
                    break;
                default:
                    $radioPresentOui = "";
                    $radioPresentNa = "checked";
                    $radioPresentNon = "";
				    $badge='<span class="position-absolute translate-middle p-2 bg-danger border border-light rounded-circle">
					<span class="visually-hidden">New alerts</span>
					</span>';
                    $icsUrl = null;
            }
            $commentaire = $liste[$id]['c'];
            $dt = new DateTime($donnees['date_debut']);
            $date = $dt->format('Y-m-d');
            $heure = $dt->format('H:i:s');
            echo '<tr>';
            echo '<td class="tdliste">' . $donnees['id'] . $badge . '</td>';
            echo '<td >' . dateFR($date).'<br>'.$heure . '</td>';
            ?>
            <td class="tdliste" style="width: 20%;" >
                <div class="switch-toggle switch-3 switch-candy"  >
                    <input class="toggle-yes" id="present[<?php echo $donnees['id']; ?>][]" name="present[<?php echo $donnees['id']; ?>][]" value="1" type="radio" <?php echo $radioPresentOui; ?> />
                    <label for="present[<?php echo $donnees['id']; ?>][]" onclick="">Oui</label>
                    <input class="toggle-unset" id="na[<?php echo $donnees['id']; ?>][]" name="present[<?php echo $donnees['id']; ?>][]" value="" type="radio" disabled <?php echo $radioPresentNa; ?> />
                    <label for="na[<?php echo $donnees['id']; ?>][]" class="disabled" onclick="">&nbsp;</label>
                    <input class="toggle-no" id="absent[<?php echo $donnees['id']; ?>][]" name="present[<?php echo $donnees['id']; ?>][]" value="0" type="radio" <?php echo $radioPresentNon; ?> />
                    <label for="absent[<?php echo $donnees['id']; ?>][]" onclick="">Non</label>
                    <a></a>
                </div>
            </td>
            <?php
            echo '<td >' . $donnees['nom_evenement'] . '</td>';
            echo '<td >' . $donnees['lieux'] . '</td>';
            echo '<td class="tdliste">' . $donnees['nom_categ'] . '</td>';
            echo '<td >'  . $donnees['organisateur'] . '</td>';
            ?>
            <td>
                <textarea id="com[<?php echo $donnees['id'];?>][]" name="com[<?php echo $donnees['id'];?>][C]" row="3" cols="30"> <?php echo $commentaire; ?></textarea>
            </td>
            <?php
            echo '<td class="tdliste">' . $icsUrl . '</td>';

            /* SWITCH CHECKBOX PRESENTIEL COLLATION */
            if (isset($liste[$id]['col'])) {
                switch ($liste[$id]['col']) {
                    case '0':
                        $pCollation = "";
                        break;
                    case '1':
                        $pCollation = "checked";
                        break;
                    default:
                        $pCollation = null;


                }
            } else{
                $pCollation = null;
            }
          
            
            /* CHECKBOX PRESENTIEL COLLATION */
            echo '<td class="tdliste">
                <input type="hidden" id="presentielCollation[' . $donnees['id'] . '][]" name="presentielCollation[' . $donnees['id'] . '][col]" value="0">
                <input type="checkbox" id="presentielCollation[' . $donnees['id'] . '][]" name="presentielCollation[' . $donnees['id'] . '][col]" value="1" ' . $pCollation . '>
            </td></tr>';
        }
    }
    $pdo = null;
}?> <!-- if array key exist -->
    </tdbody>
</table>
<?php
if($role == "elu"){    
    echo "<div class='container-sm text-center'>";
    echo "<button type='submit' class='btn btn-primary mb-3' name='btnValider'>Valider</button>";
    echo "</div>";
}
?>
    </div>
  </form>
</section>
<!--Section Ajout Evenements -->
<?php if($role=="admin" || $role == "superAdmin"){
    /* if(isset($_GET) && !empty($_GET)){
        $id = $_GET['id'];
        $select = $db->query("SELECT * FROM evenement WHERE id = $id");
        $data = $select->fetch(PDO::FETCH_ASSOC);
        $lieux = $data['lieux'];
        $date = $data['date_debut'];
		$evenement = $data['nom_evenement'];
        $organisateur = $data['organisateur'];
		$liste = unserialize(base64_decode($data['liste']));
    } else {
        $lieux = null;
        $date = null;
		$evenement = null;
		$liste = null;
        $organisateur = null;
    } */
?>
<section class='page-section' id='ajout_evenement'>
    <div class='container text-center'>
        <h1>Ajouter un évènement</h1>
    </div><br>
    <form action='evenement_config.php' method='POST'>
        <div class='container text-center'>
            <div id='date-event'>
                <label for='exampleFormControlInput1' class='form-label'>Date début</label>
                <input id='date-event' style="width: 30%;" type='datetime-local' name='date_debut' value="" >
            </div><br>
            <div class="form-group">
                <div class="row" style="width: 60%;align-items: center;position: relative; left: 20%;" >
                    <div class="col-sm">
                        <label for='exampleFormControlInput1' class='form-label'>Catégorie</label><br>  
                        <select name="categorie[]" style="width: 60%;" id="categorie[]"  >
                            <option value=""> -- </option>
                            <?php
                            $reponse = $db->query('SELECT * FROM categorie');
                            while ($categorie = $reponse->fetch(PDO::FETCH_ASSOC)){
                                echo '<option value="'.$categorie['id_categ'].'">'.$categorie['nom_categ'].'</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-sm">
                        <label for="exampleInputEmail1">Organisateur</label>
                        <input type="text" class="form-control" id='idEvent' name='organisateur' placeholder='Organisateur évènement' value=''>
                    </div>
                </div><br>
                <div class="row" style="width: 60%;align-items: center;position: relative; left: 20%;" > 
                    <div class="col-sm">
                        <label for="exampleInputEmail1">Nom évènement</label>
                        <input type="text" class="form-control" id='idEvent' name='nom_evenement' placeholder='Nom évènement' value=''>
                    </div>
                    <div class="col-sm" >
                        <label for="exampleInputEmail1">Lieux</label>
                        <input type="text"  class="form-control" id='idEvent' name='lieux' placeholder='Lieux évènement' value=''>
                    </div>
                </div>
            </div>  
        </div>
        <div class='mb-3'>
            <div class='row'>
                <div class="container text-center">
                <?php 
                echo "<div class='m-4'>
                    <div class='btn-group'>";?>
                    <?php
                    $reponse = $db->query("SELECT * FROM liste");
                    $donnees = $reponse->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($donnees as $key => $value) {
                        if ($donnees[$key]['id'] == 1) {
                            $btn = "btn btn-outline-success";
                        } else if($donnees[$key]['id'] == 2){
                            $btn = "btn btn-outline-danger";
                        } else if($donnees[$key]['id'] == 3){
                            $btn = "btn btn-outline-info";
                        }
                        echo "<input type='checkbox' class='btn-check' name='list[]' id='" . $donnees[$key]['id'] . "' value='" . $donnees[$key]['id'] . "'>
                        <label class='$btn' for='" . $donnees[$key]['id'] . "'>" . $donnees[$key]['avis'] . "</label>";
                    }?>
                </div>
            </div>
        </div>
        <?php
        if (isset($_GET) && !empty($_GET)) {
            $err = error($_GET['err']);
            //echo '<p class="text-danger text-center">'.$err.'</p>';
            $title="Erreur SQL !";
			$text="Contacter votre administrateur.";?>
            <script type='text/javascript'>Swal.fire({
                icon: 'error',
                title: "Erreur d'ajout",
                text: '<?php echo $err; ?>',
                focusConfirm: true,
                showConfirmButton: true,
            })</script><?php
        } else {
            echo '';
        }
        ?>
        
    </div>
    <?php
    echo "<div class='col-auto container text-center' >
            <button type='submit' class='btn btn-primary mb-3' name='btnAjtEvenement'>Valider</button>
          </div>";}?>
    </form>
    </div>
</section>  
<!-- Fin Section Ajout Evenements -->
<!-- Section inscription Elus -->
<?php if($role == "superAdmin"){
echo"<section class='page-section bg-light' id='inscription_elu'>
        <form action='inscription_config.php' method='POST'>
            <div class='container'>
                <div class='text-center'>
                    <h2 class='section-heading text-uppercase'>Inscription elu</h2>
                    <h3 class='section-subheading text-muted'>Création des comptes élus.</h3>
                </div>
                <div class='container'>
                    <div class='modal' tabindex='-1' id='msgTxtEnvoi'>
                        <div class='modal-dialog'>
                            <div class='modal-content'>
                                <div class='modal-header'>
                                    <h5 class='modal-title'>Inscription</h5>
                                    <a href='#inscription_elu'><button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button></a>
                                </div>
                                <div class='modal-body'>
                                <p>Vous êtes désormais inscris.</p>
                                </div>
                                <div class='modal-footer'>
                                    <a href='#inscription_elu'><button type='button' class='btn btn-primary' data-bs-dismiss='modal'>Continuer la naviguation</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class='mb-3'>
                        <label for='exampleFormControlInput1' class='form-label'>Adresse mail</label>
                        <div class='input-group flex-nowrap'>
                            <span class='input-group-text' id='addon-wrapping'>@</span>
                            <input type='text' class='form-control' placeholder='e-mail' name='email' aria-label='Adresse e-mail' aria-describedby='addon-wrapping'>
                        </div>
                    </div>
                    <div class='mb-3'>
                        <label for='exampleFormControlInput1' class='form-label'>Mot de passe</label>
                        <input type='password' class='form-control' name='password' id='password' placeholder='Votre mot de passe'>
                    </div>
                    <div class='mb-3' id='nom_prenom'>
                        <label for='exampleFormControlInput1' class='form-label'>Nom</label>
                        <input type='text' class='form-control' id='nom' name='nom' placeholder='Nom'>
                        <br>
                        <label for='exampleFormControlInput1' class='form-label'>Prénom</label>
                        <input type='text' class='form-control' id='prenom' name='prenom' placeholder='Prénom'>
                    </div>
                    <div class='row'>
                        <div class='col' >
                            <label for='exampleFormControlTextarea1' class='form-label'>Civilité</label><br>
                            <input type='checkbox' id='checkMr' name='civilite[]' value='Mr.'>
                            <label for='scales'>Mr.</label>
                            <input type='checkbox' id='checkMme' name='civilite[]' value='Mme'>
                            <label for='scales'>Mme</label>
                        </div>
                        <div class='col'>
                            <input type='text' name='role' id='elu' value='elu' hidden>
                        </div>
                        <div class='col'>
                            <label for='exampleFormControlInput1' class='form-label'>Tel</label>
                            <input type='text' class='form-control' id='tel' name='tel' placeholder='Numéro de tel'>
                        </div>
                    </div>    
                </div><br>
                <div class='col-auto' id='button' onclick='boutonEnvoi()'>
                    <button type='submit' class='btn btn-primary mb-3' name='btInscrire'>S'inscrire</button>
                </div>
            </div>
        </form>
    </section>";}?> 
<!-- Fin Section Inscription Elus -->
<?php
if($role == "admin" || $role == "superAdmin"){
    if ($role == "admin") {
        $color = "bg-white";
    } else {
    $color = "";
    }
?>
<!-- Début section statistiques -->
<section class='page-section <?php echo $color;?>' id='stat'>
    <div class="container text-center">
        <h2 class='section-heading text-uppercase'>Statistiques</h2><br>
        <h3 class='section-subheading text-muted'>Statistiques de présentiels des élus selon les évènements.</h3>
    </div><br>
    <div class="row">
        <div class="col">
            <div class="container" id="graph" style="height: 450px; width: 80%;"> <!-- CALCUL PRESENTIEL -->
                <?php
                $select = $db->query("SELECT liste FROM evenement");
                $liste = $select->fetchAll(PDO::FETCH_ASSOC);
                foreach($liste as $key =>$value){
                    $value = unserialize(base64_decode($value['liste']));
                    $eluAbsent[$key] = 0;
                    $eluPresent[$key] = 0;
                    $eluNA[$key] = 0;
                    $elu[$key] = 0;
                    foreach($value as $keyElu => $vElu){
                        $elu[$key]++;
                        if ($vElu['p'] == '0') {
                            $eluAbsent[$key]++;
                        }
                        if ($vElu['p'] == '1') {
                            $eluPresent[$key]++;
                        }
                        if($vElu['p'] == null){
                            $eluNA[$key]++;
                        }
                    }
                }
                $selectNbEvent = $db->query("SELECT COUNT(nom_evenement) FROM evenement");
                $nbEvent = $selectNbEvent->fetch(PDO::FETCH_COLUMN);
                $nbEluPresent = array_sum($eluPresent);
                echo $nbEluPresent;
                $nbEluAbsent = array_sum($eluAbsent);
                echo $nbEluAbsent;
                $nbEluNA = array_sum($eluNA);
                echo $nbEluNA;
                $nbElu = array_sum($elu);
                echo $nbElu;
                ?>    
                <script> /* GRAPHIQUE PRESENTIEL PAR EVENEMENT */
                window.onload = function () {
                    var chart = new CanvasJS.Chart("graph", {
                        animationEnabled: true,
                        title:{
                            text: "Répartition présentiel",
                            horizontalAlign: "left"
                        },
                        data: [{
                            type: "doughnut",
                            startAngle: 60,
                            indexLabelFontSize: 17,
                            indexLabel: "{label} - #percent%",
                            toolTipContent: "<b>{label}:</b> {y} (#percent%)",
                            dataPoints: [
                                { y: <?php echo $nbEluPresent; ?>, label: "Elus présents" },
                                { y: <?php echo $nbEluAbsent; ?>, label: "Elus absents" },
                                { y: <?php echo $nbEluNA; ?>, label: "Elus non-votés"},
                            ]
                        }]
                    });
                    chart.render();
                }
                </script> <!-- FIN GRAPHIQUE PRESENTIEL PAR EVENEMENT -->
            </div>
        </div>
        <div class="col">
            <div class="container" id="graph2" style="height: 450px; width: 80%;"><!-- CALCUL PRESENTIEL PAR CATEGORIE -->
                <?php
                $select = $db->query("SELECT categorie FROM evenement");
                $cat = $select->fetchAll(PDO::FETCH_ASSOC);
                foreach($cat as $key =>$value){
                    $cat1[$key] = 0;
                    $cat2[$key] = 0;
                    $cat3[$key] = 0;
                    $cat4[$key] = 0;
                    $elu[$key] = 0;
                    if ($value['categorie'] == '1') {
                        $cat1[$key]++;
                    }
                    if ($value['categorie'] == '2') {
                        $cat2[$key]++;
                    }
                    if ($value['categorie'] == '3') {
                        $cat3[$key]++;
                    }
                    if ($value['categorie'] == '4') {
                        $cat4[$key]++;
                    }   
                }
                $selectNbCat = $db->query("SELECT COUNT(categorie) FROM evenement");
                $nvCatego = $selectNbCat->fetch(PDO::FETCH_COLUMN);
                $nbEluCatego1 = array_sum($cat1);
                echo $nbEluCatego1;
                $nbEluCatego2 = array_sum($cat2);
                echo $nbEluCatego2;
                $nbEluCatego3 = array_sum($cat3);
                echo $nbEluCatego3;
                $nbEluCatego4 = array_sum($cat4);
                echo $nbEluCatego4;
                ?>
                <script> /* GRAPHIQUE PRESENTIEL PAR CATEGORIE */
                var chart = new CanvasJS.Chart("graph2", {
                    animationEnabled: true,
                    title: {
                        text: "Répartition par catégories",
                        horizontalAlign: "right"
                    },
                    data: [{
                        type: "pie",
                        startAngle: 240,
                        indexLabelFontSize: 17,
                        indexLabel: "{label} - #percent%",
                        toolTipContent: "<b>{label}:</b> {y} (#percent%)",
                        dataPoints: [
                            { y: <?php echo $nbEluCatego1; ?>, label: "Catégorie 1" },
                            { y: <?php echo $nbEluCatego2; ?>, label: "Catégorie 2" },
                            { y: <?php echo $nbEluCatego3; ?>, label: "Catégorie 3"},
                            { y: <?php echo $nbEluCatego4; ?>, label: "Catégorie 4"},
                        ]
                    }]
                });
                chart.render();
                </script><!-- FIN GRAPHIQUE PRESENTIEL PAR CATEGORIE -->
            </div>
        </div>
    </div>
</section>
<?php } ?><!-- Fin section statistiques -->
<!-- Section A propos -->
<section class='page-section bg-white' id='A_propos'>
    <div class='container'>
        <div class='text-center'>
            <h2 class='section-heading text-uppercase'>A propos</h2>
            <h3 class='section-subheading text-muted'>A quoi sert Agendel ?</h3>
        </div>
        <div class='row text-center' id="row_apropos">
            <div class='col-md-4'>
                <span class='fa-stack fa-4x'>
                    <i class='fas fa-circle fa-stack-2x text-primary'></i>
                    <i class='fas fa-calendar-alt fa-stack-1x fa-inverse'></i>
                </span>
                <h4 class='my-3'>Gestion des événements</h4>
                <p class='text-muted'>AGENDEL est un logiciel de gestions des événements de la ville de Beaurains.</p>
            </div>
            <div class='col-md-4'>
                <span class='fa-stack fa-4x'>
                    <i class='fas fa-circle fa-stack-2x text-primary'></i>
                    <i class='fas fa-bell fa-stack-1x fa-inverse'></i>
                </span>
                <h4 class='my-3'>Invitations</h4>
                <p class='text-muted'>Invitations aux événements et manifestations de la ville de Beaurains.</p>
            </div>
            <div class='col-md-4'>
                <span class='fa-stack fa-4x'>
                    <i class='fas fa-circle fa-stack-2x text-primary'></i>
                    <i class='fas fa-shield fa-stack-1x fa-inverse'></i>
                </span>
                <h4 class='my-3'>Données stockées et sécurisées</h4>
                <p class='text-muted'>RGPD.</p>
            </div>
        </div>
    </div>
</section>
<!-- Section (contact) -->
<section class='page-section' id='contact'>
    <div class='container'>
        <div class='text-center'>
            <h2 class='section-heading text-uppercase'>Contactez-nous</h2>
            <h3 class='section-subheading text-muted'>Nous sommes à l'écoute de vos besoins.</h3>
        </div>
        <form id='contactForm' action='contact_config.php' method='POST'>
            <div class='row align-items-stretch mb-5'>
                <div class='col-md-6'>
                    <div class='form-group'>
                        <input class='form-control' id='nom' name='nom' type='text' placeholder='Votre nom' data-sb-validations='required' value='<?php echo $nom;?>' />
                        <div class='invalid-feedback' data-sb-feedback='name:required'>Votre nom est primordiale.</div>
                    </div>
                    <div class='form-group'>
                        <input class='form-control' id='email' name='email' type='email' placeholder='Votre e-mail' data-sb-validations='required,email' value='<?php echo $email;?>' />
                        <div class='invalid-feedback' data-sb-feedback='email:required'>Votre e-mail est primordiale.</div>
                        <div class='invalid-feedback' data-sb-feedback='email:email'>Adresse e-mail non-valide</div>
                    </div>
                </div>
                <div class='col-md-6'>
                    <div class='form-group form-group-textarea mb-md-0'>
                        <textarea class='form-control' id='message' name='message' placeholder='Votre message, vos besoins...' data-sb-validations='required'></textarea>
                        <div class='invalid-feedback' data-sb-feedback='message:required'>La description de votre attente est primordiale.</div>
                    </div>
                </div>
            </div>
            <div class='d-none' id='submitSuccessMessage'>
                <div class='text-center text-white mb-3'>
                    <div class='fw-bolder'>Votre demande a bien été envoyé !</div><br />
                </div>
            </div>
            <div class='d-none' id='submitErrorMessage'><div class='text-center text-danger mb-3'>Error sending message!</div></div>
            <div class='text-center'><button class='btn btn-primary btn-xl text-uppercase' id='submitButton' name='btnContact' type='submit'>Envoyer</button></div>
        </form>
    </div>
</section>
<!-- Début section profil -->
<section class='page-section' id='profil' >
    <div class='container text-center'>
        <h1>Profil</h1>
    </div><br>
    <div class="container" style="background-color: white;" >
		<form id='contactForm' action='contact_config.php' method='POST'>
			<div class="row">
				<div class="col text-center">
					<p>Civilité : <strong><?php echo $civilite?></strong></p>
					<p>Nom : <strong><?php echo $nom;?></strong></p>
					<p>Prénom : <strong><?php echo $prenom;?></strong></p>
					<p>Rôle : <strong><?php echo $role;?></strong></p>
					<p>Adresse email : <strong><?php echo $email;?></strong></p>
					<p>Mot de passe : <input type="password" id="pwd1" name="pwd1" value="" /></p>
                    <?php
                    if (isset($_GET) && !empty($_GET)) {
                        $erreur = $_GET['erreur'];
                        if ($url = "/agendel/home.php#profil?erreur=0") {
                            echo '<p class="text-danger">'.$erreur.'</p>';
                        }
                    } else {
                        echo '';
                    }
                    ?>
					<p>Confirmez le mot de passe : <input type="password" id="pwd2" name="pwd2" value="" placeholder="Saisissez le à nouveau" /></p><br>
					<?php
                    if (isset($_GET) && !empty($_GET)) {
                        $erreur = $_GET['erreur'];
                        if ($url = "/agendel/home.php#profil?erreur=0") {
                            echo '<p class="text-danger">'.$erreur.'</p>';
                        }
                    } else {
                        echo '';
                    }
                    ?>
                    <div class='text-center'><button class='btn btn-primary' id='submitButton' name='btnProfil' type='submit'>Envoyer</button></div><br>
                    <?php
                    /* if (isset($_GET) && !empty($_GET)) {
                        print_r($_GET);
                        $erreur = $_GET['erreur'];
                    } else if(empty($_GET)) {
                        echo "Erreur de récupération";
                    } */
                    ?>
                </div>
			</div>
		</form>
    </div>
</section>
<!-- Fin section profil -->
<footer class='footer py-4'>
    <div class='container'>
        <div class='row align-items-center'>
            <div class='col-lg-4 text-lg-start'>Copyright &copy; Mairie de Beaurains</div>
            <div class='col-lg-4 my-3 my-lg-0'>
                <a class='btn btn-dark btn-social mx-2' href='https://www.facebook.com/VilledeBeaurains/' target="_blank" aria-label='Twitter'><i class='fab fa-facebook-f'></i></a>
                <a class='btn btn-dark btn-social mx-2' href='https://www.mairie-beaurains.fr' target="_blank" aria-label='Facebook'><i class='bi bi-globe'></i></a>
            </div>
            <div class='col-lg-4 text-lg-end'>
                <a class='link-dark text-decoration-none me-3' href='#!'>.</a>
                <a class='link-dark text-decoration-none' href='#!'>.</a>
            </div>
        </div>
    </div>   
</footer>
<div class='modal' tabindex='-1' id='popupElu'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h5 class='modal-title'>Modal title</h5>
                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
            </div>
            <div class='modal-body'>
                <p>extcfyvgbhnj,k;lljbhgvfccfgh</p>
            </div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                <button type='button' class='btn btn-primary'>Save changes</button>
            </div>
        </div>
    </div>
</div>
</body>
</html>

