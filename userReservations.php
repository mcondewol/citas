<?php
include "core/autoload.php";

include 'core/app/model/MedicData.php';
include 'core/app/model/CategoryData.php';
include 'core/app/model/LocationData.php';
include 'core/app/model/UserData.php';
session_start();

$medics = MedicData::getAll();
$categories = CategoryData::getAll();
$locations = LocationData::getAll();
?>

<!doctype html>
<html lang="en">
<head>  
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

  <title>APROFAM - Dashboard</title>

  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/css/material-dashboard.css" rel="stylesheet"/>
    <link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet" />
  <script src="assets/js/jquery.min.js" type="text/javascript"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.css">
<link href="assets/css/material-dashboard.css" rel="stylesheet"/>
<?php if(isset($_GET["view"]) && $_GET["view"]=="home"):?>
<link href='assets/fullcalendar/fullcalendar.min.css' rel='stylesheet' />
<link href='assets/fullcalendar/fullcalendar.print.css' rel='stylesheet' media='print' />
<script src='assets/fullcalendar/moment.min.js'></script>
<script src='assets/fullcalendar/fullcalendar.min.js'></script>    
<?php endif; ?> 

</head>

<body>
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
                      <a href="./AgendarCita.php">
                          <i class="fa fa-calendar"></i>
                          <p>Citas</p>
                      </a>
                  </li>
                  <li>
                      <a href="./userReservations.php">
                        <i class="fa fa-support"></i>
                          <p>Reservaciónes</p>
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
            <ul class="nav navbar-nav navbar-right">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-user"></i>
                </a>
                <ul class="dropdown-menu">
                <li><a href=""><?php echo $_SESSION['email']; ?></a></li>
                  <li><a href="logout.php">Salir</a></li>
                </ul>
              </li>
            </ul>
<!--
            <form class="navbar-form navbar-right" role="search">
              <div class="form-group  is-empty">
                <input type="text" class="form-control" placeholder="Search">
                <span class="material-input"></span>
              </div>
              <button type="submit" class="btn btn-white btn-round btn-just-icon">
                <i class="fa fa-search"></i><div class="ripple-container"></div>
              </button>
            </form>
            -->
          </div>
        </div>
      </nav>

      <div class="content">
      <?php

?>

<div class="row">
<div class="col-md-10">
    <div class="card">
        <div class="card-header" data-background-color="blue"><h4>Reservaciones</h4></div>
        <div class="card-content table-responsive">    
            <table class="table table-striped">
                <tr>
                    <th>Paciente</th>
                    <th>Médico</th>
                    <th>Fecha</th>
                </tr> 

                <?php 
                    $userId = intval($_SESSION['user_id']); 
                    $base = new Database();
                    $con = $base->connect();
                    //$sql = "select * from pacient where (id= \"".$userId."\" )";
                    $sql = "
                            SELECT
                            r.id AS 'reservation_id', 
                            p.name AS 'pacient_name',
                            p.`lastname` AS 'pacient_lastname',
                            m.`name` AS 'medic_name',
                            m.`lastname` AS 'medic_lastname',
                            r.`date_at` AS 'reservation_date'
                        FROM
                            reservation r
                            INNER JOIN pacient p
                            ON p.id = r.`pacient_id`
                            INNER JOIN medic m
                            ON m.id = r.`medic_id`
                        WHERE r.`pacient_id` = $userId;
                    ";
                    $query = $con->query($sql);

                    while($r = $query->fetch_array()){
                        $pacient_name = $r['pacient_name'];
                        $pacient_lastname = $r['pacient_lastname'];
                        $medic_name = $r['medic_name'];
                        $medic_lastname = $r['medic_lastname'];
                        $reservation_date = $r['reservation_date'];
                    
                     
                ?>
                
                    <tr>
                        <td> <?php echo $pacient_name . " " . $pacient_lastname;  ?> </td>
                        <td> <?php echo $medic_name . " " . $medic_lastname;  ?> </td>
                        <td> <?php echo $reservation_date ?> </td>
                    </tr>
                <?php  } ?>

            </table>
        </div>
    </div>
</div>
</div>
      <div class="container-fluid">

</div>
      </div>

      <footer class="footer">
        <div class="container-fluid">
          <nav class="pull-left">
            <ul>
              
        <!--
              <li>
                <a href="#">
                  Company
                </a>
              </li>
              <li>
                <a href="#">
                  Portfolio
                </a>
              </li>
              <li>
                <a href="#">
                   Blog
                </a>
              </li>
          -->
            </ul>
          </nav>
          
        </div>
      </footer>
    </div>
  </div>
<?php else:?>
 

<?php endif;?>
</body>

  <!--   Core JS Files   -->
  <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
  <script src="assets/js/material.min.js" type="text/javascript"></script>

  <!--  Charts Plugin -->
  <script src="assets/js/chartist.min.js"></script>

  <!--  Notifications Plugin    -->
  <script src="assets/js/bootstrap-notify.js"></script>

  <!--  Google Maps Plugin    -->
  <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>

  <!-- Material Dashboard javascript methods -->
  <script src="assets/js/material-dashboard.js"></script>

  <!-- Material Dashboard DEMO methods, don't include it in your project! -->
  <script src="assets/js/demo.js"></script>

  <script type="text/javascript">
      $(document).ready(function(){

      // Javascript method's body can be found in assets/js/demos.js
          demo.initDashboardPageCharts();

      });
  </script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment-with-locales.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
<script>
    $(function () {
        $('#date_time').datetimepicker({
            inline: true,
            sideBySide: true,
            locale: 'es-ES'
        });
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
</html>
