
<center>
<br>
<h1>Consolidado</h1>
<div>

	<div class="container">
		<div class="">
			<a class="btn btn-outline-info"  href="<?= base_url()?>Controller_Home/index">Inicio</a>
			<a class="btn btn-outline-info" href="<?= base_url()?>Controller_Consolidado/index">Consolidado</a>
		</div>
		<br>
		<fieldset class="form-control">
			<legend class="form-control"><strong>Importar consolidado CSV</strong></legend>
			<form class="" action='<?=base_url()?>Controller_Consolidado/control' method='post' enctype="multipart/form-data">
				<div class="">
					<input class="btn btn-outline-primary" type='file' name='sel_file' style="margin-right: 5px;">
					<input class="btn btn-warning" type='submit' name='submit' value='Subir'>		
				</div>
			</form>
			<?php if($mensaje == "1") { ?>
				<label class="btn btn-success"><strong>Importación exitosa !</strong></label>
			<?php }?>
			<?php if($mensaje == "0") { ?>
				<label class="btn btn-danger"><strong>Archivo invalido !</strong></label>
			<?php } ?>
			
			<?php if($mensaje == "2") { ?>
				<label class="btn btn-success"><strong>La tabla esta vacía !</strong></label>
			<?php }?>
			<form>
				<div class="input-group" style="width: 300px; ">
					<button type="submit" class="btn btn-warning">Buscar por fecha:</button>
					<input class="form-control" style="margin-left: 5px;"  type="text" placeholder="0000-00-00">
				</div>
			</form>
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

	</div>
</div>

<!--
<script src="<?= base_url() ?>public/Modulos_AJS/AJS_Consultas/modulo.js" type="text/javascript"></script>
<script src="<?= base_url() ?>public/Modulos_AJS/AJS_Consultas/controller.js" type="text/javascript"></script>
-->
