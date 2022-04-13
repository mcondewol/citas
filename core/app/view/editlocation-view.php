<?php 
  error_reporting(E_ALL);
  ini_set('display_errors', TRUE);
  ini_set('display_startup_errors', TRUE);

  $user = LocationData::getById($_GET["id"]);
  $departamentos = LocationData::getAll_departamentos();
  $municipios = LocationData::getAll_municipio();
  $muni = LocationData::getOne_municipio($user->id_municipio);
?>
<div class="row">
	<div class="col-md-12">

<div class="card">
  <div class="card-header" data-background-color="blue">
      <h4 class="title">Editar Ubicacion</h4>
  </div>
  <div class="card-content table-responsive">
		<form class="form-horizontal" method="post" id="addproduct" action="index.php?view=updatelocation" role="form">

<div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Ubicacion*</label>
    <div class="col-md-6">
      <input type="text" name="name" required class="form-control" value="<?php echo $user->name;?>" id="name" placeholder="Ubicacion">
    </div>
</div>

<div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Deparamento*</label>
    <div class="col-lg-6">
<select name="departamento_id" id="departamento_id" class="form-control" required>
<option value="">-- SELECCIONE --</option>
  <?php foreach($departamentos as $p):?>
    
    <option value="<?php echo $p->id; ?>" <?php if($muni->id_departamento==$p->id){ echo "selected"; }?>><?php echo $p->nombre; ?></option>      
  <?php endforeach; ?>
</select>
    </div>
</div>

  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Municipio*</label>
    <div class="col-md-6">
    <select name="municipio_id" id="municipio_id" class="form-control">
    <option value="">-- SELECCIONE --</option>      
    <?php foreach($municipios as $cat):?>
    <option value="<?php echo $cat->id; ?>" <?php if($user->id_municipio==$cat->id){ echo "selected"; }?>><?php echo $cat->nombre; ?></option>      
    <?php endforeach;?>
    </select>
    </div>
  </div>

 

  

  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
    <input type="hidden" name="user_id" value="<?php echo $user->id;?>">
      <button type="submit" class="btn btn-primary">Actualizar Ubicacion</button>
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