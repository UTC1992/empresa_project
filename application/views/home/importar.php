<br>
		<fieldset class="form-control">
			<legend class="form-control"><strong>Importar consolidado diario formato CSV</strong></legend>
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
			
			
		</fieldset>
		<br>

	</div>
</div>

<!--
<script src="<?= base_url() ?>public/Modulos_AJS/AJS_Consultas/modulo.js" type="text/javascript"></script>
<script src="<?= base_url() ?>public/Modulos_AJS/AJS_Consultas/controller.js" type="text/javascript"></script>
-->
