<?php
  function daysSelected($days){
      $week = ["lunes","martes","miercoles","jueves","viernes"];
      $weekend = ["sabado","domingo"];

      if (array_search($days[0], $weekend) === false){
          // entre semana
          $noSelectedKeys = array_keys(array_diff($week, $days));
          foreach ($noSelectedKeys as $key=>$value){
              $week[$value] = NULL;
          }
          return $week;

      }else {
          // fin de semana
          $noSelectedKeys = array_keys(array_diff($weekend, $days));
          foreach ($noSelectedKeys as $key=>$value){
              $weekend[$value] = NULL;
          }
          return $weekend;
      }
  }

  error_reporting(E_ALL);
  ini_set('display_errors', TRUE);
  ini_set('display_startup_errors', TRUE);

  $user = MedicData::getById($_GET["id"]);
  $scheduleMedic = ScheduleData::getById($_GET["id"]);

  $categories = CategoryData::getAll();
  $locations = LocationData::getAll();

  // array de dias seleccionados
  $daysWeek = daysSelected(explode(",", $scheduleMedic->esemana));
  $dayWeekend = daysSelected(explode(",", $scheduleMedic->fsemana));
?>
<div class="row">
	<div class="col-md-12">

<div class="card">
  <div class="card-header" data-background-color="blue">
      <h4 class="title">Editar Medico</h4>
  </div>
  <div class="card-content table-responsive">
		<form class="form-horizontal" method="post" id="addproduct" action="index.php?view=updatemedic" role="form">


  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Area*</label>
    <div class="col-md-6">
    <select name="category_id" id="category_id" class="form-control">
        <option value="">-- SELECCIONE --</option>
        <?php foreach($categories as $cat):?>
        <option value="<?php echo $cat->id; ?>" <?php if($user->category_id==$cat->id){ echo "selected"; }?>><?php echo $cat->name; ?></option>
        <?php endforeach;?>
    </select>
    </div>
  </div>

  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Ubicacion*</label>
    <div class="col-md-6">
    <select name="location_id" id="location_id" class="form-control">
        <option value="">-- SELECCIONE --</option>
        <?php foreach($locations as $cat):?>
        <option value="<?php echo $cat->id; ?>" <?php if($user->location_id==$cat->id){ echo "selected"; }?>><?php echo $cat->name; ?></option>
        <?php endforeach;?>
    </select>
    </div>
  </div>

 

  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Nombre*</label>
    <div class="col-md-6">
      <input type="text" name="name" value="<?php echo $user->name;?>" class="form-control" id="name" placeholder="Nombre">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Apellido*</label>
    <div class="col-md-6">
      <input type="text" name="lastname" value="<?php echo $user->lastname;?>" required class="form-control" id="lastname" placeholder="Apellido">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Direccion*</label>
    <div class="col-md-6">
      <input type="text" name="address" value="<?php echo $user->address;?>" class="form-control" required id="username" placeholder="Direccion">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Email*</label>
    <div class="col-md-6">
      <input type="text" name="email" value="<?php echo $user->email;?>" class="form-control" id="email" placeholder="Email">
    </div>
  </div>

  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Telefono</label>
    <div class="col-md-6">
      <input type="text" name="phone"  value="<?php echo $user->phone;?>"  class="form-control" id="inputEmail1" placeholder="Telefono">
    </div>
  </div>
    <div class="form-group">
        <hr>
        <h4 class="text-center">Horarios Lunes a Viernes</h4>
    </div>
    <div class="form-group">
        <label for="inputEmail1" class="col-lg-2 control-label">Días Entre Semana*</label>
        <div class="col-md-8">
            <label class="checkbox-inline">
                <input type="checkbox" id="esemana[]" name="esemana[]" value="lunes" <?php if(isset($daysWeek[0])){ echo "checked";}?>> Lunes
            </label>
            <label class="checkbox-inline">
                <input type="checkbox" id="esemana[]" name="esemana[]" value="martes" <?php if(isset($daysWeek[1])){ echo "checked";}?>> Martes
            </label>
            <label class="checkbox-inline">
                <input type="checkbox" id="esemana[]" name="esemana[]" value="miercoles" <?php if(isset($daysWeek[2])){ echo "checked";}?>> Miercoles
            </label>
            <label class="checkbox-inline">
                <input type="checkbox" id="esemana[]" name="esemana[]" value="jueves" <?php if(isset($daysWeek[3])){ echo "checked";}?>> Jueves
            </label>
            <label class="checkbox-inline">
                <input type="checkbox" id="esemana[]" name="esemana[]" value="viernes" <?php if(isset($daysWeek[4])){ echo "checked";}?>> Viernes
            </label>
        </div>
    </div>

    <div class="form-group">
        <label for="inputsweekdays" class="col-lg-2 control-label">Hora Ingreso</label>
        <div class="col-lg-2">
            <input type="time" name="week_start" required class="form-control" id="inputsweekdays" placeholder="Hora" value="<?php if(isset($scheduleMedic->week_start)){echo $scheduleMedic->week_start;}?>">
        </div>
        <label for="inputeweekdays" class="col-lg-2 control-label">Hora Salida</label>
        <div class="col-lg-2">
            <input type="time" name="week_end" required class="form-control" id="inputeweekdays" placeholder="Hora" value="<?php if(isset($scheduleMedic->week_end)){echo $scheduleMedic->week_end;}?>">
        </div>
    </div>

    <div class="form-group">
        <hr>
        <h4 class="text-center">Horarios Sabado y Domingo</h4>
    </div>

    <div class="form-group">
        <label for="inputEmail1" class="col-lg-2 control-label">Días Fin de Semana*</label>
        <div class="col-md-8">
            <label class="checkbox-inline">
                <input type="checkbox" id="fsemana[]" name="fsemana[]" value="sabado" <?php if(isset($dayWeekend[0])){ echo "checked";}?>> Sabado
            </label>
            <label class="checkbox-inline">
                <input type="checkbox" id="fsemana[]" name="fsemana[]" value="domingo" <?php if(isset($dayWeekend[1])){ echo "checked";}?>> Domingo
            </label>
        </div>
    </div>

    <div class="form-group">
        <label for="inputsweekends" class="col-lg-2 control-label">Hora Ingreso</label>
        <div class="col-lg-2">
            <input type="time" name="weekend_start" required class="form-control" id="inputsweekends" placeholder="Hora" value="<?php if(isset($scheduleMedic->weekend_start)){echo $scheduleMedic->weekend_start;}?>">
        </div>
        <label for="inputeweekend" class="col-lg-2 control-label">Hora Salida</label>
        <div class="col-lg-2">
            <input type="time" name="weekend_end" required class="form-control" id="inputeweekend" placeholder="Hora" value="<?php if(isset($scheduleMedic->weekend_end)){echo $scheduleMedic->weekend_end;}?>">
        </div>
    </div>

  <div class="form-group">
        <label for="inputEmail1" class="col-lg-2 control-label" >Esta activo</label>
        <div class="col-md-6">
            <div class="checkbox">
                <label>
                  <input type="checkbox" name="is_active" id="is_active" <?php if($user->is_active){ echo "checked";}?>>
                </label>
          </div>
        </div>
  </div>

  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
    <input type="hidden" name="user_id" value="<?php echo $user->id;?>">
      <button type="submit" class="btn btn-primary">Actualizar Medico</button>
    </div>
  </div>
</form>
</div>
</div>
	</div>
</div>
