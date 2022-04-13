<?php
    session_start();
    include '../DB/conf.php';
    $ubicacion_id = $_POST["ubicacion_id"];
    if ($ubicacion_id != '') {
        $query = "SELECT *
                FROM bookmedik.municipios G 
                where id_departamento =" . $ubicacion_id . ";";
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
                echo "<option>NO HAY CATEGORIAS</option>";
            }
        }
        
    }
?>