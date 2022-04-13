<?php

if(count($_POST)>0){
	$user = LocationData::getById($_POST["user_id"]);
	$user->name = $_POST["name"];
	$user->idubicacion = $_POST["municipio_id"];
	$user->iduser = $_SESSION['user_id'];
	$user->update();
print "<script>window.location='index.php?view=location';</script>";


}


?>