
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
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header" data-background-color="blue">
                <h4>Nueva Cita</h4>
            </div>
            <div class="card-content table-responsive">
                <form class="form-horizontal" role="form" method="post" action="core/app/action/addres-action.php">
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment-with-locales.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
<script>
    $('#date_time').datetimepicker({
        inline: true,
        sideBySide: true,
        locale: 'es-GT'
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