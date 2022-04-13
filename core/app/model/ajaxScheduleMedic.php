<?php
session_start();
include '../DB/conf.php';
$idMedic = $_POST["medic_id"];
if (isset($idMedic)) {
    $query = "SELECT esemana, TIME_FORMAT(week_start,'%h:%i %p') as week_start, TIME_FORMAT(week_end,'%h:%i %p') as week_end, fsemana, TIME_FORMAT(weekend_start,'%h:%i %p') as weekend_start, TIME_FORMAT(weekend_end,'%h:%i %p') as weekend_end FROM medic_schedule WHERE medic_id = {$idMedic}";
    $statement = $dbhost->prepare($query);
    $statement->execute();
    $results = $statement->fetch(PDO::FETCH_ASSOC);

    echo json_encode($results);
}
