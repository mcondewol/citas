<?php
/**
* BookMedik
* @author evilnapsis
* @url http://evilnapsis.com/about/
**/

if(count($_POST)>0){
	$user = new MedicData();
	$category_id = "NULL";
	if($_POST["category_id"]!=""){
        $category_id = $_POST["category_id"];
    }
	$user->name = $_POST["name"];
	$user->category_id = $category_id;
	$user->lastname = $_POST["lastname"];
	$user->address = $_POST["address"];
	$user->email = $_POST["email"];
	$user->phone = $_POST["phone"];
	$user->idubicacion = $_POST["idubicacion"];
    $esemanaLista = "";
	foreach ($_POST['esemana'] as $dia){
		$esemanaLista .= $dia.',';
    }
	$user->esemana = substr( $esemanaLista,0,-1);
	$user->time_hi_esemana = $_POST["week_start"];
	$user->time_hf_esemana = $_POST["week_end"];
    $fsemanaLista = "";
	foreach ($_POST['fsemana'] as $dia){
		$fsemanaLista .= $dia.',';
    }
	$user->fsemana = substr($fsemanaLista,0,-1);
	$user->time_hi_fsemana = $_POST["weekend_start"];
	$user->time_hf_fsemana = $_POST["weekend_end"];
	$user->add();

print "<script>window.location='index.php?view=medics';</script>";


}


?>