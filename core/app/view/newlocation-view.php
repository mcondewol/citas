<?php
$departamentos = LocationData::getAll_departamentos();

?>
<div class="row">
	<div class="col-md-12">
<div class="card">
  <div class="card-header" data-background-color="blue">
      <h4 class="title">Nueva Ubicacion</h4>
  </div>
  <div class="card-content table-responsive">

		<form class="form-horizontal" method="post" id="addlocation" action="index.php?view=addlocation" role="form">


  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Ubicacion*</label>
    <div class="col-md-6">
      <input type="text" name="name" required class="form-control" id="name" placeholder="Ubicacion">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Deparamento*</label>
    <div class="col-lg-10">
<select name="departamento_id" id="departamento_id" class="form-control" required>
<option value="">-- SELECCIONE --</option>
  <?php foreach($departamentos as $p):?>
    <option value="<?php echo $p->id; ?>"><?php echo $p->id." - ".$p->nombre; ?></option>
  <?php endforeach; ?>
</select>
    </div>
  </div>
  <div class="form-group">
    <label for="municipio_id" class="col-lg-2 control-label">Municipio*</label>
    <div class="col-lg-10">
<select name="municipio_id" id="municipio_id" class="form-control" required>
<option value="">-- SELECCIONE --</option>
</select>
    </div>
  </div>
  

  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
      <button type="submit" class="btn btn-primary">Agregar Ubicacion</button>
    </div>
  </div>
</form>
</div>
</div>
	</div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script>
$('#departamento_id').on('change', function(){
    var ubicacion_id = this.value;
    $.ajax({
    type: "POST",
    url: "../Citas_Aprofam/core/app/model/municipio.php",
    data:'ubicacion_id='+ubicacion_id,
    success: function(result){
    $("#municipio_id").html(result);
    }
    });
});
</script>
