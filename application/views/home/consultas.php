		<br>
		<fieldset class="form-control">
			<legend class="form-control"><strong>Buscar actividades diarias</strong></legend>
			
			
			<?php if($mensaje == "2") { ?>
				<label class="btn btn-success"><strong>La tabla esta vacía !</strong></label>
			<?php }?>
			<form class="col-sm-12" action='<?=base_url()?>Controller_Consolidado/consultarActDiarias' method='post'>
				
				<div class="form-control col-sm-5" style="margin-bottom: 5px;">
					<label>Ingrese la fecha:</label>
					<input class="form-control" name="fecha" type="text" placeholder="0000-00-00" style="margin-bottom: 5px;">
					<select class="form-control" name="actividad" style="text-align: center;">
						<option>Seleccionar</option>
						<option>10</option>
						<option>30</option>
						<option>40</option>
					</select>
				</div>
				<button type="submit" class="btn btn-warning">Buscar</button>
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
							<td><?= $row->n9cocl ?></td>
							<td><?= $row->n9cocu ?></td>
							<td><?= $row->n9meco ?></td>
							<td><?= "'".$row->n9coru ?></td>
							<td><?= $row->n9cose ?></td>
							<td><?= $row->n9nomb ?></td>
							<td><?= $row->n9refe ?></td>
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
