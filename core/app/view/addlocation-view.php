<?php
/**
* BookMedik
* @author evilnapsis
**/
if(count($_POST)>0){
	$user = new LocationData();
	$user->name = $_POST["name"];
	$user->idubicacion = $_POST["municipio_id"];
	$user->iduser = $_SESSION['user_id'];
	$user->add();

print "<script>window.location='index.php?view=location';</script>";


}


?>