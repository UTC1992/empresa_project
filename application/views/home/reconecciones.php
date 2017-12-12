<br>
	<fieldset class="form-control">
		<legend class="form-control"><strong>RECONECCIONES MANUALES <br>
			Mediante Archivo CSV</strong></legend>
		<form class="" action='<?=base_url()?>Controller_Reconeccion/control' method='post' enctype="multipart/form-data">
			<div class="">
				<input class="btn btn-outline-primary" type='file' name='sel_file' style="margin-right: 5px;">
				<input class="btn btn-warning" type='submit' name='submit' value='Importar'>		
			</div>
		</form>
		<?php if($mensaje == "1") { ?>
			<label class="btn btn-success"><strong>Importación exitosa !</strong></label>
		<?php }?>
		<?php if($mensaje == "0") { ?>
			<label class="btn btn-danger"><strong>Archivo invalido !</strong></label>
		<?php } ?>
		<div class="">
			<a class="btn btn-outline-primary" href="<?= base_url()?>Controller_Reconeccion/vaciar_tbl_manual">
				Limpiar tabla</a>
		</div>
		<br>
		<?php if($mensaje == "2") { ?>
			<label class="btn btn-success"><strong>La tabla esta vacía !</strong></label>
		<?php }?>
		<div class="">
			<a class="btn btn-warning" href="<?= base_url()?>Controller_Reconeccion/buscar_medidor">Buscar por Medidor</a>
			<a class="btn btn-success" href="<?= base_url()?>Controller_Reconeccion/buscar_cuenta">Buscar por Cuenta</a>
		</div>
		<br>
		<div class="table-responsive">
			<table class="table table-bordered" style="font-family: calibri; font-size: 11pt;">
				<thead class="thead-inverse">
					<tr>
						<th>CÓDICO</th>
						<th>CUENTA</th>
						<th>MEDIDOR</th>
						<th>RUTA</th>
						<th>SECTOR</th>
						<th>NOMBRE</th>
						<th>REFERENCIA</th>
					</tr>
				</thead>
				<?php
				if($consulta != null) { 
					$num = 0;
					foreach ($consulta->result() as $row) { 	
				?>
					<tr>
						<td><?= $row->codigo ?></td>
						<td><?= $row->cuenta ?></td>
						<td><?= $row->medidor ?></td>
						<td><?= "".$row->ruta ?></td>
						<td><?= $row->sector ?></td>
						<td><?= $row->nombre ?></td>
						<td><?= $row->referencia ?></td>
					</tr>
					
				<?php $num += 1; 
					}
				?>
				<tr>
					<td colspan="7"><strong>TOTAL DE FILAS OBTENIDAS ==> <?= $num ?> </strong></td>
				</tr>
				<?php
				}
				?>
			</table>
		</div>

	</fieldset>
	<br>
	<fieldset class="form-control">
		<legend class="form-control"><strong>Busqueda por medidor o cuenta</strong></legend>
		<form class="" action='<?=base_url()?>Controller_Reconeccion/buscar_medidor' method='post' >
			<div class="input-group col-sm-5">
				<input class="form-control" type="text" name="medidor" placeholder="Medidor">	
				<input class="btn btn-success" type='submit' name='submit' value='Buscar'>		
			</div>
		</form>
		<form class="" action='<?=base_url()?>Controller_Reconeccion/buscar_cuenta' method='post' >
			<div class="input-group col-sm-5">
				<input class="form-control" type="text" name="cuenta" placeholder="Cuenta">	
				<input class="btn btn-success" type='submit' name='submit' value='Buscar'>		
			</div>
		</form>
	</fieldset>
</div>
