		<br>
		<fieldset class="form-control">
			<legend class="form-control"><strong>Buscar actividades diarias</strong></legend>
			
			
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
