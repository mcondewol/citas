<?php
/**
* BookMedik
* @author evilnapsis
**/
session_start();

if(count($_POST)>0){
	$user = new CategoryData();
	$user->name = $_POST["name"];
	$user->iduser = $_SESSION['user_id'];
	$user->add();

print "<script>window.location='index.php?view=categories';</script>";


}


?>