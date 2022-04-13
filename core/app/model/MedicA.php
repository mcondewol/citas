<?php
    session_start();
    include '../DB/conf.php';
    $ubicacion_id = $_POST["ubicacion_id"];
    $especialidad_id = $_POST["especialidad_id"];
    if ($ubicacion_id != '') {
        $query = "SELECT id, concat(name,' ',lastname) nombre
                FROM bookmedik.medic G 
                where category_id =" . $especialidad_id . " and location_id =". $ubicacion_id . ";";
        $stmt = $dbhost->prepare($query); 
        if($stmt->execute()){
            if($stmt->rowCount() > 0){
                $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $response = "<option value=''>-- SELECCIONE --</option>";
                foreach($row as $key => $value){
                    $response .= "<option value={$value['id']}>".$value['nombre']."</option>";
                }
                echo $response;
            }else{
                echo "<option>NO HAY MEDICOS</option>";
            }
        }
        
    }
?>