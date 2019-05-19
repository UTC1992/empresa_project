<br>
		<fieldset class="form-control">
			<legend class="form-control">
				<strong>
					Importar consolidado diario formato CSV
				</strong>
			</legend>
			<div id="mensaje" class="alert alert-info">
			</div>
			<div id="error" class="alert alert-danger">
			</div>
			<form method="post" id="import_csv"  enctype="multipart/form-data">
				<div class="">
					<input class="btn btn-outline-primary" type='file' id="file_consolidado" name='file_consolidado'
					 style="margin-right: 5px;" value="" accept=".xlsx">
					 <button type="submit" name="import_csv_btn" class="btn btn-info" id="import_csv_btn">
					 Importar file</button>
					 <input type="hidden" value='<?=base_url()?>' id="url">
				</div>
				<div class="" id="imported_csv_data">
				</div>
			</form>
			
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
