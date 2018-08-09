<br>
		<fieldset class="form-control">
			<legend class="form-control">
				<strong>
					Importar consolidado diario formato CSV
				</strong>
			</legend>
			
			<form method="post" id="import_csv" enctype="multipart/form-data">
				<div class="">
					<input class="btn btn-outline-primary" type='file' id="csv_file" name='csv_file'
					 style="margin-right: 5px;" value="" accept=".csv">
					 <button type="submit" name="import_csv" class="btn btn-info" id="import_csv_btn">
					 Import CSV</button>
					 <input type="hidden" value='<?=base_url()?>' id="url">
				</div>
				<div class="" id="imported_csv_data">
				</div>
			</form>
			<?php if($mensaje == "1") { ?>
				<label class="btn btn-success"><strong>Importación exitosa !</strong></label>
			<?php }?>
			<?php if($mensaje == "0") { ?>
				<label class="btn btn-danger"><strong>Archivo invalido !</strong></label>
			<?php } ?>
			
			
		</fieldset>
		<br>

	</div>
</div>



<script src="<?= base_url() ?>public/js/jquery.js" type="text/javascript"></script>
<script src="<?= base_url() ?>public/js/jquery-subir-file.js" type="text/javascript"></script>


<!--
<script src="<?= base_url() ?>public/Modulos_AJS/AJS_Consultas/modulo.js" type="text/javascript"></script>
<script src="<?= base_url() ?>public/Modulos_AJS/AJS_Consultas/controller.js" type="text/javascript"></script>
-->
