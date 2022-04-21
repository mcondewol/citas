<?php
    session_start();
    include '../DB/conf.php';
    $dpi = $_POST["dpi"];
    if ($dpi != '') {
        $query = "SELECT id FROM pacient WHERE dpi = " . $dpi . ";";
        $stmt = $dbhost->prepare($query); 
        if($stmt->execute()){
            if($stmt->rowCount() > 0){
                $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach($row as $key => $value){
                    $response = $value['id'];
                }
                echo true; 
            }else{
                echo "<option>NO HAY MEDICOS</option>";
            }
        }
        
    }
?>