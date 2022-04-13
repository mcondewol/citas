<?php 

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
session_start();

include '../core/app/DB/conf.php';


if(array_key_exists("opcion", $_POST)){

    $opcion = $_POST["opcion"];
    $data = array();
    if($opcion == 1){
        $query = "select M.id id_medico, concat(M.name,' ', M.lastname) medico, S.name especialidad, M.is_active estado
        from medic M
        INNER JOIN category S on M.category_id = S.id
        order by M.is_active;";
        $stmt = $dbhost->prepare($query);
        if($stmt->execute()){
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $acciones = "<a href='index.php?view=editmedic&id=".$row['id_medico']."' class='btn btn-warning btn-xs' rel='tooltip' title='Editar' class='btn btn-simple btn-warning btn-xs'><i class='fa fa-pencil'></i></a>
                            <a href='index.php?view=delmedic&id=".$row['id_medico']."' class='btn btn-danger btn-xs' rel='tooltip' title='Eliminar' class='btn-simple btn btn-danger btn-xs'><i class='fa fa-remove'></i></a>";
                $data[] = array(
                    "estado" => ($row["estado"] == 1)? "<i class='fa fa-info-circle' style='color:green;'> ACTIVO </i>" : "<i class='fa fa-exclamation-circle' style='color:red;'> INACTIVO </i>",
                    "doctor" => $row["medico"],
                    "especialidad" => $row["especialidad"],
                    "acciones" => $acciones
                );
            }     
        } 
    }else if($opcion == 2){
        $query = "SELECT id id_especialidad, name especialidad, fechaing, usering  FROM category;";
        $stmt = $dbhost->prepare($query);
        if($stmt->execute()){
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $acciones = "<a href='index.php?view=editcategory&id=".$row['id_especialidad']."' class='btn btn-warning btn-xs' rel='tooltip' title='Editar' class='btn btn-simple btn-warning btn-xs'><i class='fa fa-pencil'></i></a>
                            <a href='index.php?view=delcategory&id=".$row['id_especialidad']."' class='btn btn-danger btn-xs' rel='tooltip' title='Eliminar' class='btn-simple btn btn-danger btn-xs'><i class='fa fa-remove'></i></a>";

                $data[] = array(
                    "especialidad" => $row["especialidad"],
                    "acciones" => $acciones
                );
            }     
        } 
    }else if($opcion == 3){
        $query = "SELECT U.id, U.name nombre, M.nombre as municipio, D.nombre as departamento, U.fechamod, U.fechaing
        FROM location U
        INNER JOIN municipios M ON U.id_municipio = M.id
        INNER JOIN departamentos D ON M.id_departamento = D.id;";
        $stmt = $dbhost->prepare($query);
        if($stmt->execute()){
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $acciones = "<a href='index.php?view=editlocation&id=".$row['id']."' class='btn btn-warning btn-xs' rel='tooltip' title='Editar' class='btn btn-simple btn-warning btn-xs'><i class='fa fa-pencil'></i></a>
                            <a href='index.php?view=delocation&id=".$row['id']."' class='btn btn-danger btn-xs' rel='tooltip' title='Eliminar' class='btn-simple btn btn-danger btn-xs'><i class='fa fa-remove'></i></a>";
                $data[] = array(
                    "ubicacion" => $row["nombre"],
                    "municipio" => $row["municipio"],
                    "departamento" => $row["departamento"],
                    "acciones" => $acciones
                );
            }     
        }     
    }
    $response_data = array(
        "draw" => 1,
        "recordsTotal" => count($data),
        "recordsFiltered" => count($data),
        "data" => $data
    );
}else{
    $response_data = array(
        "draw" => 1,
        "recordsTotal" => null,
        "recordsFiltered" => null,
        "data" => []
    );
}

echo json_encode($response_data);

?>