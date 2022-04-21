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
                      <a href="index.php?view=login">
                          <i class="fa fa-user"></i>
                          <p>Login</p>
                      </a> 
                  </li>
                  <li class="">
                      <a href="index.php?view=newpacient">
                          <i class="fa fa-user-plus"></i>
                          <p>Registro</p>
                      </a>
                  </li>
                  <li class="">
                        <a href="index.php?view=citasno">
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
                                  <div class="col-md-6" id="dpiValidation">
                                  <input type="text" name="DPI" class="form-control" id="dpi" placeholder="DPI">
                                  
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


<script>
    $('#dpi').on('change', function(){
        let dpi = this.value;
        const dpiValidation = document.querySelector('#dpiValidation');
        $.ajax({
            type: "POST",
            url: "core/app/model/checkDPI.php",
            data:{dpi,},
            success: function(result){
                let boolDpi = result;
                if (boolDpi) {
                    let span = '<span class="danger">*Este DPI ya existe</span>';
                    dpiValidation.innerHTML += span;
                }
            }
        });
    });
</script>