<div class="row">
	<div class="col-md-12">
<div class="btn-group pull-right">
<!--<div class="btn-group pull-right">
  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
    <i class="fa fa-download"></i> Descargar <span class="caret"></span>
  </button>
  <ul class="dropdown-menu" role="menu">
    <li><a href="report/clients-word.php">Word 2007 (.docx)</a></li>
  </ul>
</div>
-->
</div>
<div class="card">
  <div class="card-header" data-background-color="blue">
      <h4 class="title">Pacientes</h4>
  </div>
  <div class="card-content table-responsive">
	<a href="index.php?view=newpacient" class="btn btn-default"><i class='fa fa-male'></i> Nuevo Paciente</a>
		<?php

		$users = PacientData::getAll();
		if(count($users)>0){
			// si hay usuarios
			?>

			<table class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>Nombre completo</th>
                        <th>Direccion</th>
                        <th>Email</th>
                        <th>Telefono</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach($users as $user){
                        ?>
                        <tr>
                        <td><?php echo $user->name." ".$user->lastname; ?></td>
                        <td><?php echo $user->address; ?></td>
                        <td><?php echo $user->email; ?></td>
                        <td><?php echo $user->phone; ?></td>
                        <td style="width:280px;">
                            <a href="index.php?view=pacienthistory&id=<?php echo $user->id;?>" title="Historial" class="btn btn-success btn-xs"><i class="fa fa-history"></i></a>
                            <a href="index.php?view=editpacient&id=<?php echo $user->id;?>" title="Editar" class="btn btn-warning btn-xs"><i class='fa fa-pencil'></i></a>
                            <a href="index.php?view=delpacient&id=<?php echo $user->id;?>" title="Borrar" class="btn btn-danger btn-xs"><i class='fa fa-remove'></i></a>
                        </td>
                        </tr>
                        <?php

                    }
                    ?>
                </tbody>
			</table>
			</div>
			</div>
			<?php



		}else{
			echo "<p class='alert alert-danger'>No hay pacientes</p>";
		}


		?>


	</div>
</div>


