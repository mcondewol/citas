<?php
    session_start();
    $pacients = PacientData::getAll();
    $medics = MedicData::getAll();

    $statuses = StatusData::getAll();
    $payments = PaymentData::getAll();
    $medics = MedicData::getAll();
    $categories = CategoryData::getAll();
    $locations = LocationData::getAll();
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.css">
<link href="assets/css/material-dashboard.css" rel="stylesheet"/>
<?php if(true):?>
  <div class="wrapper">

      <div class="sidebar" data-color="blue">
      <div class="logo">
        <a href="./" class="simple-text">
          <img src="img/Logo-aprofam.png" class="img-fluid main-logo" alt="APROFAM">
        </a>
      </div>

      <div class="sidebar-wrapper">
              <ul class="nav">
                 
                  <li>
                  <a href="./AgendarCitaNo.php">
                      <i class="fa fa-calendar"></i>
                      <p>Citas- No</p>
                  </a>
                  </li>
              </ul>
        </div>
      </div>

      <div class="main-panel">
      <nav class="navbar navbar-transparent navbar-absolute">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="./"><b>Sistema de Citas Medicas</b></a>
          </div>
          <div class="collapse navbar-collapse">
          </div>
        </div>
      </nav>

      <div class="content">
      <?php

?>

<div class="row">
<div class="col-md-10">
    <div class="card">
        <div class="card-header" data-background-color="blue"><h4>Nueva Cita</h4></div>
        <div class="card-content table-responsive">
            <form class="form-horizontal" role="form" method="post" action="core/app/action/guestaddress-action.php">

                <div class="form-group">
                    <label for="inputEmail1" class="col-lg-2 control-label">Nombre*</label>
                    <div class="col-md-6">
                        <input type="text" name="name" required class="form-control" id="name" placeholder="Nombre">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail1" class="col-lg-2 control-label">Apellido*</label>
                    <div class="col-md-6">
                        <input type="text" name="lastname"  class="form-control" id="lastname" placeholder="Apellido">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail1" class="col-lg-2 control-label">Genero*</label>
                    <div class="col-md-6">
                        <label class="checkbox-inline">
                            <input type="radio" id="inlineCheckbox1" name="gender" required value="h"> Hombre
                        </label>
                        <label class="checkbox-inline">
                            <input type="radio" id="inlineCheckbox2" name="gender" required value="m"> Mujer
                        </label>
                        <label class="checkbox-inline">
                            <input type="radio" id="inlineCheckbox3" name="gender" required value="o"> Otro
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputEmail1" class="col-lg-2 control-label">Fecha de Nacimiento</label>
                    <div class="col-md-6">
                        <input type="date" name="day_of_birth" class="form-control"  id="address1" placeholder="Fecha de Nacimiento">
                    </div>
                </div>


                <div class="form-group">
                    <label for="inputEmail1" class="col-lg-2 control-label">Direccion*</label>
                    <div class="col-md-6">
                        <input type="text" name="address" class="form-control"  id="address1" placeholder="Direccion">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail1" class="col-lg-2 control-label">Email*</label>
                    <div class="col-md-6">
                        <input type="text" name="email" class="form-control" id="email1" placeholder="Email">
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputEmail1" class="col-lg-2 control-label">Telefono*</label>
                    <div class="col-md-6">
                        <input type="text" name="phone" class="form-control" id="phone1" placeholder="Telefono">
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputEmail1" class="col-lg-2 control-label">Area*</label>
                    <div class="col-md-6">
                        <select name="category_id" id="category_id" class="form-control">
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
                    <label for="inputEmail1" class="col-lg-2 control-label">Medico</label>
                    <div class="col-lg-6">
                        <select name="medic_id" id="medic_id" class="form-control" required>
                            <option value="">-- SELECCIONE --</option>
                            <?php foreach($medics as $p):?>
                                <option value="<?php echo $p->id; ?>"><?php echo $p->id." - ".$p->name." ".$p->lastname; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail1" class="col-lg-2 control-label"></label>
                    <div class="col-lg-6">
                        <table class="table table-bordered border-primary hidden" id="table_schedule_week">
                            <caption>Horario entre semana</caption>
                            <thead>
                            <tr>
                                <th scope="col">Dias</th>
                                <th scope="col">Horario</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>--</td>
                                <td>--</td>
                            </tr>
                            </tbody>
                        </table>
                        <table class="table table-bordered border-primary hidden" id="table_schedule_weekend">
                            <caption>Horario fin de semana</caption>
                            <thead>
                            <tr>
                                <th scope="col">Dias</th>
                                <th scope="col">Horario</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>--</td>
                                <td>--</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="form-group">
                    <label for="date" class="col-lg-2 control-label">Fecha</label>
                    <div class="col-lg-10">
                        <div class='input-group date' id='date_time'>
                            <input type='hidden' class="form-control" name="date_time"/>
                            <span class="input-group-addon">
                              <span class="glyphicon glyphicon-calendar"></span>
                          </span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-10">
                        <button type="submit" class="btn btn-default">Agregar Cita</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
      <div class="container-fluid">

        </div>
      </div>

    </div>
  </div>
<?php else:?>
 

<?php endif;?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment-with-locales.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>

<script>

$('#date_time').datetimepicker({
            inline: true,
            sideBySide: true,
            locale: 'es-ES'
});

  $('#idubicacion').on('change', function(){
      let ubicacion_id = this.value;
      let especialidad_id = $("#category_id").val();
      $.ajax({
      type: "POST",
      url: "core/app/model/MedicA.php",
      data:{ubicacion_id, especialidad_id},
      success: function(result){
        $("#medic_id").html(result);
      }
      });
  });

  $('#medic_id').on('change', function(){
      const medic_id = this.value;
      const tdWeek = document.querySelectorAll('#table_schedule_week tbody tr td');
      const tableWeek = document.querySelector('#table_schedule_week');

      const tableWeekend = document.querySelector('#table_schedule_weekend');
      const tdWeekend = document.querySelectorAll('#table_schedule_weekend tbody tr td');

      $.ajax({
          type: "POST",
          url: "core/app/model/ajaxScheduleMedic.php",
          data:{medic_id},
          success: function(result){
              const {esemana, week_start, week_end, fsemana, weekend_start, weekend_end} = JSON.parse(result)

              tdWeek[0].textContent = esemana;
              tdWeek[1].textContent = `${week_start} a ${week_end}`;
              tableWeek.classList.remove('hidden');

              if(fsemana != ''){
                  tdWeekend[0].textContent = fsemana;
                  tdWeekend[1].textContent = `${weekend_start} a ${weekend_end}`;
                  tableWeekend.classList.remove('hidden');
              }else{
                  tableWeekend.classList.add('hidden');
              }
          }
      });

  });
  </script>

<script>
    $(function () {
        
    });
</script>