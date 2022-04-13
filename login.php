<?php
include "core/autoload.php";
include 'core/app/model/PacientData.php';
$pacient = PacientData::getAll();

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
    <link href="assets/css/style.css" rel="stylesheet" />
    <link href="assets/css/material-dashboard.css" rel="stylesheet"/>
    <link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">

<?php if(isset($_GET["view"]) && $_GET["view"]=="home"):?>
<link href='assets/fullcalendar/fullcalendar.min.css' rel='stylesheet' />
<link href='assets/fullcalendar/fullcalendar.print.css' rel='stylesheet' media='print' />
<script src='assets/fullcalendar/moment.min.js'></script>
<script src='assets/fullcalendar/fullcalendar.min.js'></script>    
<?php endif; ?>

</head>

<body>
<?php if(true):?>
  <div class="wrapper login-page">

      <div class="sidebar" data-color="blue">
      <div class="logo">
        <a href="./" class="simple-text">
          <img src="img/Logo-aprofam.png" class="img-fluid main-logo" alt="APROFAM">
        </a>
      </div>

      <div class="sidebar-wrapper">
              <ul class="nav">
                  <li class="">
                      <a href="./login.php">
                          <i class="fa fa-user"></i>
                          <p>Login</p>
                      </a>
                  </li>
                  <li class="">
                      <a href="./RegistrarPaciente.php">
                          <i class="fa fa-user-plus"></i>
                          <p>Registro</p>
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
            <!-- <ul class="nav navbar-nav navbar-right">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-user"></i>
                </a>
                <ul class="dropdown-menu">
                  <li><a href="logout.php">Salir</a></li>
                </ul>
              </li>
            </ul> -->
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
          <div class="row w-100 bgstyle01">
              <div class="col-md-12">
                  <div class="card">
                      <div class="card-header" data-background-color="blue">
                          <h4 class="title">Acceder a Citas Aprofam</h4>
                      </div>
                      <div class="card-content table-responsive">

                        <form accept-charset="UTF-8" role="form" method="post" action="core/app/view/processlogin-view.php" >
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Usuario" name="mail" type="text">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Contraseña" name="password" type="password" value="">
                                </div>
                                <input class="btn btn-primary btn-block" type="submit" value="Iniciar Sesion"> 
                                <a href="./RegistrarPaciente.php"> Nuevo Registro </a>
                            </fieldset>
                        </form>
                          
                      </div>
                  </div> 
              </div>
          </div>
<?php else:?>
 

<?php endif;?>
<script src="assets/js/jquery.min.js" type="text/javascript"></script>
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
</body>
</html>
