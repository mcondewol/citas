<?php
$categories = CategoryData::getAll();
$locations = LocationData::getAll();
?>
<div class="row">
	<div class="col-md-12">

<div class="card">
  <div class="card-header" data-background-color="blue">
      <h4 class="title">Nuevo Medico</h4>
  </div>
  <div class="card-content table-responsive">
		<form class="form-horizontal" method="post" id="addproduct" action="index.php?view=addmedic" role="form">

  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Area*</label>
    <div class="col-md-6">
    <select name="category_id" class="form-control">
    <option value="">-- SELECCIONE --</option>      
    <?php foreach($categories as $cat):?>
    <option value="<?php echo $cat->id; ?>"><?php echo $cat->name; ?></option>      
    <?php endforeach;?>
    </select>
    </div>
  </div>

  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Ubicacion*</label>
    <div class="col-md-6">
    <select name="idubicacion" id="idubicacion" class="form-control">
    <option value="">-- SELECCIONE --</option>      
    <?php foreach($locations as $cat):?>
    <option value="<?php echo $cat->id; ?>"><?php echo $cat->name; ?></option>      
    <?php endforeach;?>
    </select>
    </div>
  </div>

  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Nombre*</label>
    <div class="col-md-6">
      <input type="text" name="name" class="form-control" id="name" placeholder="Nombre">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Apellido*</label>
    <div class="col-md-6">
      <input type="text" name="lastname" required class="form-control" id="lastname" placeholder="Apellido">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Direccion*</label>
    <div class="col-md-6">
      <input type="text" name="address" class="form-control"  id="address" placeholder="Direccion">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Email*</label>
    <div class="col-md-6">
      <input type="text" name="email" class="form-control" id="email" placeholder="Email">
    </div>
  </div>

  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Telefono*</label>
    <div class="col-md-6">
      <input type="text" name="phone" class="form-control" id="phone" placeholder="Telefono">
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
        <input type="checkbox" id="esemana[]" name="esemana[]" value="lunes"> Lunes
      </label>
      <label class="checkbox-inline">
        <input type="checkbox" id="esemana[]" name="esemana[]" value="martes"> Martes
      </label>
      <label class="checkbox-inline">
        <input type="checkbox" id="esemana[]" name="esemana[]" value="miercoles"> Miercoles
      </label>
      <label class="checkbox-inline">
        <input type="checkbox" id="esemana[]" name="esemana[]" value="jueves"> Jueves
      </label>
      <label class="checkbox-inline">
        <input type="checkbox" id="esemana[]" name="esemana[]" value="viernes"> Viernes
      </label>
    </div>
  </div>

  <div class="form-group">
    <label for="inputsweekdays" class="col-lg-2 control-label">Hora Ingreso</label>
    <div class="col-lg-2">
      <input type="time" name="week_start" required class="form-control" id="week_start" placeholder="Fecha">
    </div>
    <label for="inputeweekdays" class="col-lg-2 control-label">Hora Salida</label>
    <div class="col-lg-2">
      <input type="time" name="week_end" required class="form-control" id="week_end" placeholder="Hora">
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
      <input type="checkbox" id="fsemana[]" name="fsemana[]" value="sabado"> Sabado
    </label>
    <label class="checkbox-inline">
      <input type="checkbox" id="fsemana[]" name="fsemana[]" value="domingo"> Domingo
    </label>
  </div>
</div>

<div class="form-group">
    <label for="inputsweekends" class="col-lg-2 control-label">Hora Ingreso</label>
    <div class="col-lg-2">
      <input type="time" name="weekend_start" required class="form-control" id="weekend_start" placeholder="Fecha">
    </div>
    <label for="inputeweekend" class="col-lg-2 control-label">Hora Salida</label>
    <div class="col-lg-2">
      <input type="time" name="weekend_end" required class="form-control" id="weekend_end" placeholder="Hora">
    </div>
  </div>
  
  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
      <button type="submit" class="btn btn-primary">Agregar Medico</button>
    </div>
  </div>
</form>
</div>
</div>
	</div>
</div>