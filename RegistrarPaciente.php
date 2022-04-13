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

<?php if(isset($_GET["view"]) && $_GET["view"]=="home"):?>
<link href='assets/fullcalendar/fullcalendar.min.css' rel='stylesheet' />
<link href='assets/fullcalendar/fullcalendar.print.css' rel='stylesheet' media='print' />
<script src='assets/fullcalendar/moment.min.js'></script>
<script src='assets/fullcalendar/fullcalendar.min.js'></script>    
<?php endif; ?>

</head>

<body>
<?php if(true):?>
  <div class="wrapper regustrarpaciente">

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
                  <li class="">
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
              <?php

?>

          <div class="row w-100 bgstyle01">

              <div class="col-md-12">
                  <div class="card">
                      <div class="card-header" data-background-color="blue">
                          <h4 class="title">Nuevo Paciente</h4>
                      </div>
                      <div class="card-content table-responsive">

                          <form class="form-horizontal" method="post" id="addproduct" action="core/app/view/addpacient-view.php" role="form">


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
                                  <label for="inputEmail1" class="col-lg-2 control-label">DPI*</label>
                                  <div class="col-md-6">
                                  <input type="text" name="DPI" class="form-control" id="phone1" placeholder="DPI">
                                  </div>
                              </div>

                              <div class="form-group">
                                  <label for="inputEmail1" class="col-lg-2 control-label">Contraseña</label>
                                  <div class="col-md-6">
                                      <input type="password" name="password" class="form-control" id="inputEmail1" placeholder="Contraseña">
                                  </div>
                              </div>

                              <div class="form-group">
                                  <div class="col-lg-offset-2 col-lg-10">
                                      <button type="submit" class="btn btn-primary">Agregar Paciente</button>
                                  </div>
                              </div>
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
