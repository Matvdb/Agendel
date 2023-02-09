<?php

// lance les classes de PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
// path du dossier PHPMailer % fichier d'envoi du mail
require '../includeBiblio/PHPMailer/src/Exception.php';
require '../includeBiblio/PHPMailer/src/PHPMailer.php';
require '../includeBiblio/PHPMailer/src/SMTP.php';

function sendmail($objet, $contenu, $destinataire, $piece_jointe) {  
// on crée une nouvelle instance de la classe
$mail = new PHPMailer(true);
  // puis on l’exécute avec un 'try/catch' qui teste les erreurs d'envoi
  try {
    /* DONNEES SERVEUR */
    #####################
    $mail->setLanguage('fr', 'PHPMailer/language/');   // pour avoir les messages d'erreur en FR
    //$mail->SMTPDebug = 0;            // en production (sinon "2")
    $mail->SMTPDebug = 2;            // décommenter en mode débug
    $mail->isSMTP();   
                                                         // envoi avec le SMTP du serveur
    $mail->Host       = 'mail.ville-arras.fr';  // serveur SMTP
	$mail->Host       = '192.168.10.206';  // serveur SMTP
                           
    //$mail->SMTPAuth   = true;                                            // le serveur SMTP nécessite une authentification ("false" sinon)
    //$mail->Username   = 'information@mairie-beaurains.fr';  
    //$mail->Password   = ''; 

    $mail->SMTPAutoTLS = false;
    $mail->SMTPSecure = false;     // encodage des données TLS (ou juste 'tls') > "Aucun chiffrement des données"; sinon PHPMailer::ENCRYPTION_SMTPS (ou juste 'ssl')
    $mail->Port       = 2526;                                                               // port TCP (ou 25, ou ssl 465..tls 587.)

    /* DONNEES DESTINATAIRES */
    ##########################
    $mail->setFrom('information@mairie-beaurains.fr', 'No-Reply');
    //$mail->setFrom('informatique@cu-arras.org', 'No-Reply');  //adresse de l'expéditeur (pas d'accents)
    $mail->addAddress($destinataire, '');        // Adresse du destinataire (le nom est facultatif)
    // $mail->addReplyTo('moi@mon_domaine.fr', 'son nom');     // réponse à un autre que l'expéditeur (le nom est facultatif)
    // $mail->addCC('cc@example.com');            // Cc (copie) : autant d'adresse que souhaité = Cc (le nom est facultatif)
    // $mail->addBCC('bcc@example.com');          // Cci (Copie cachée) :  : autant d'adresse que souhaité = Cci (le nom est facultatif)




    /* CONTENU DE L'EMAIL*/
    ##########################
    $mail->isHTML(true);                                      // email au format HTML
    $mail->Subject = utf8_decode($objet);      // Objet du message (éviter les accents là, sauf si utf8_encode)
    $mail->Body    = $contenu;          // corps du message en HTML - Mettre des slashes si apostrophes
    $mail->AltBody = 'Contenu au format texte pour les clients e-mails qiui ne le supportent pas'; // ajout facultatif de texte sans balises HTML (format texte)

    /* PIECES JOINTES */
    ##########################
	//$mail->addAttachment('../mailV2/'.$piece_jointe);         // Pièces jointes en gardant le nom du serveur
	    // $mail->addAttachment('../dossier/fichier.zip');         // Pièces jointes en gardant le nom du fichier sur le serveur
    // $mail->addAttachment('../dossier/fichier.zip', 'nouveau_nom.zip');    // Ou : pièce jointe + nouveau nom
	// $mail->addAttachment('../fic/'.$piece_jointe, 'new.jpg');      // Pièce jointe avec un nouveau nom

    $mail->send();
    echo 'Message envoyé.';
  
  }
  // si le try ne marche pas > exception ici
  catch (Exception $e) {
    echo "Le Message n'a pas été envoyé. Mailer Error: {$mail->ErrorInfo}"; // Affiche l'erreur concernée le cas échéant
  }  
} // fin de la fonction sendmail



$destinataire = "b.delevaque@mairie-beaurains.fr";
  $objet = "#AGENDEL - Nouveaux évènements ";
  $contenu = "<br />Contenu du message";
  $contenu .= "<br /><br />Date du message : ".date("d/m/Y");
  $piece_jointe = "courrier.pdf";


sendmail($objet, $contenu, $destinataire, $piece_jointe);


?>