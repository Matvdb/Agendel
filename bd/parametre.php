<?php
    $config['serveur']='localhost';
    $config['login'] = 'admin';
    $config['mdp'] ='01032003';
    $config['bd'] = 'agendel';



//DateTime FR
function datetimeFR($var){// yyyy-mm-dd 00:00:00 vers dd/mm/yyyy 00:00:00
	if(!empty($var)){
	list($date, $time) = explode(" ", $var);
	list($year, $month, $day) = explode("-", $date);
	list($hour, $min, $sec) = explode(":", $time);
	$var = "$day/$month/$year $time";
	return $var;
	}else{
		$var="";
		return $var;
	}		
}
function dateFR($var){// yyyy-mm-dd 00:00:00 vers dd/mm/yyyy 00:00:00
	if(!empty($var)){
	list($year, $month, $day) = explode("-", $var);
	$var = "$day/$month/$year";
	return $var;
	}else{
		$var="";
		return $var;
	}		
}

?>