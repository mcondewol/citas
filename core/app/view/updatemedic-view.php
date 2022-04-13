<?php

if(count($_POST)>0){
	$user = MedicData::getById($_POST["user_id"]);
    $schedule = ScheduleData::getById($_POST["user_id"]);
	
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
    $user->location_id =  $_POST["location_id"];

    $schedule->medic_id = $_POST["user_id"];
    $schedule->esemana = implode(",", $_POST["esemana"]);
    $schedule->fsemana = implode(",", $_POST["fsemana"]);
    $schedule->week_start = $_POST["week_start"];
    $schedule->week_end = $_POST["week_end"];
    $schedule->weekend_start = $_POST["weekend_start"];
    $schedule->weekend_end = $_POST["weekend_end"];


    $schedule->update();
    $user->update();


print "<script>window.location='index.php?view=medics';</script>";


}


?>