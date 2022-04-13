<?php
/**
* BookMedik
* @author evilnapsis
* @url http://evilnapsis.com/about/
**/
session_start();
include '../model/PacientData.php';
include "../../autoload.php";


if(count($_POST)>0){
	$user = new PacientData();
	$user->name = $_POST["name"];
	$user->lastname = $_POST["lastname"];

	$user->gender = $_POST["gender"];
	$user->day_of_birth = $_POST["day_of_birth"];
	
	$user->DPI = $_POST["DPI"];
	

	$user->address = $_POST["address"];
	$user->email = $_POST["email"];
	$user->phone = $_POST["phone"];
    $user->password = sha1(md5($_POST["password"]));
	$user->add();

	Core::alert("¡Usuario Agreado Exitosamente!");
	Core::redir("/citas/index.php");

}


?>