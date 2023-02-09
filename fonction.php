<?php
// Retourner le nb de clé d'un tableau

function countCle($array){
    $count = 0;
    foreach($array as $key => $value){
        $count++;
    }
    return $count;
}

function countPresent($array){
    $count = 0;
    foreach($array as $key => $value){
        if($value['p'] !=null){
            $count++;
        }
    }
    return $count;
}


function progressBar($array){
    $countCle = 0;
    foreach($array as $key => $value){
        $countCle++;
    }

    $countPresent = 0;
	$countAbsent = 0;
    foreach($array as $key => $value){
        if($value['p'] =='1'){
            $countPresent++;
        }elseif($value['p'] =='0'){
            $countAbsent++;
        }
    }
	$countRepond=$countPresent+$countAbsent;

	$progressValue=($countRepond*100)/$countCle;
	$progressPresent=($countPresent*100)/$countCle;
	$progressAbsent=($countAbsent*100)/$countCle;
	
	if($progressValue==100){
		$color="bg-success";
	}elseif($progressValue>50){
		$color="";
	}elseif($progressValue<25){
		$color="bg-warning";
	}elseif($progressValue<50){
		$color="bg-danger";
	}

$progressBar='
<div class="progress">
  <div class="progress-bar progress-bar-striped bg-danger" role="progressbar" style="width: '.$progressAbsent.'%" aria-valuenow="'.$progressAbsent.'" aria-valuemin="0" aria-valuemax="100">'.$countAbsent.'/'.$countCle.'</div>
  <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: '.$progressPresent.'%" aria-valuenow="'.$progressPresent.'" aria-valuemin="0" aria-valuemax="100">'.$countPresent.'/'.$countCle.'</div>

</div>
';

	return $progressBar;

}

function error($err)
{
    switch ($err) {
        case '0':
            $err = "Veuillez choisir entre GM et BE.";
            break;
        case '1':
            $err = "Veuillez choisir un groupe.";
            break;
        case '2':
            $err = "Veuillez inscrire une date.";
            break;
        case '3':
            $err = "Veuillez inscrire un lieux.";
            break;
        case '4':
            $err = "Veuillez inscrire un nom d'évènement.";
            break;
    }
    return $err;
}
?>