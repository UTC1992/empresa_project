<br>
<div ng-app="actividadApp">
	<div ng-controller="actividadCtrl">
		<div>
			<fieldset class="form-control">
				<legend class="form-control"><strong>Buscar actividades diarias</strong></legend>
				<!--url para realizar la consulta-->
				<input type="hidden" id="urlConsultarActividades" 
				value="<?=base_url()?>Controller_Consolidado/getDataJsonActDiarias">
				<!--formulario para ingresar fecha y codigo de actividad-->
				<form class="col-sm-12" name="fActividad"  ng-submit="consultarActividades()">
					<div class="form-control col-sm-5" style="margin-bottom: 5px;">
						<label>Ingrese la fecha:</label>
						<input class="form-control" name="fecha" ng-model="fecha" type="text" placeholder="0000-00-00" 
						style="margin-bottom: 5px;" required>
						<select class="form-control" name="actividad" ng-model="actividad" style="text-align: center;" required>
							<option value="">Seleccionar</option>
							<option value="010">010</option>
							<option value="030">030</option>
							<option value="040">040</option>
						</select>
					</div>
					<button type="submit" class="btn btn-warning">Buscar</button>
				</form>
			</fieldset>
		</div>
		<br>
		<div class="">
			<label class="label">Cantidad de actividades:</label>
			<input type="text" class="form-control col-sm-2" value="" ng-model="cantidadAct" readonly>
			<br>
			<fieldset class="form-control">
				<div class="table-responsive">
					<table class="table table-bordered table-condensed table-striped table-sm" 
						ng-table="actividadesTable" show-filter="true" style="font-family: calibri; font-size: 12pt;">
						<tbody>
							<tr ng-repeat="act in $data">
								<td data-title="'N°'" >{{ $index +1 }}</td>
								<td data-title="'Cliente'" filter="{n9cocl: 'text'}">{{ act.n9cocl }}</td>
								<td data-title="'Cuenta'" filter="{n9cocu: 'text'}">{{ act.n9cocu }}</td>
								<td data-title="'Medidor'" filter="{n9meco: 'text'}">{{ act.n9meco }}</td>
								<td data-title="'Ruta'" filter="{n9coru: 'text'}">'{{ act.n9coru }}</td>
								<td data-title="'Sector'" filter="{n9cose: 'text'}"  sortable="'n9cose'" >'{{ act.n9cose }} </td>
								<td data-title="'Nombre'" filter="{n9nomb: 'text'}">{{ act.n9nomb }}</td>
								<td data-title="'Referencia'" filter="{n9refe: 'text'}">{{ act.n9refe }}</td>
							</tr>
						</tbody>
					</table>
				</div>
			</fieldset>
		</div>
		<br>
		<div>
			<fieldset class="form-control">
				<legend class="form-control"><strong>Conteo por sector (URBANO y RURAL)</strong></legend>
				<!--url para realizar la consulta-->
				<input type="hidden" id="urlContarActividades" 
				value="<?=base_url()?>Controller_Consolidado/getContarActividades">
				<!--formulario para ingresar fecha y codigo de actividad-->
				<form class="col-sm-12" name="fContarSector" >
					<div class="form-control col-sm-5" style="margin-bottom: 5px;">
						<label>Ingrese la fecha:</label>
						<input class="form-control" name="fecha" ng-model="fechaConteo" type="text" placeholder="0000-00-00" 
						style="margin-bottom: 5px;" required>
						<select class="form-control" name="sectorURoRU" ng-model="sectorURoRU"
						 style="text-align: center;" ng-change="contarActividades();" required>
							<option value="">Seleccionar</option>
							<option value="URBANO">URBANO</option>
							<option value="RURAL">RURAL</option>
						</select>
					</div>
					<!--<button type="submit" class="btn btn-warning">Buscar</button>-->
				</form>
			</fieldset>
		</div>
		<br>
		<div class="">
			<fieldset class="form-control" >
				<div ng-if="mostrarTabla">
					<label class="label">Cantidad de Sectores:</label>
					<input type="text" class="form-control col-sm-2" value="" ng-model="cantidadSector" readonly>
					<br>
					<div class="table-responsive" >
						<table  class="table table-bordered table-condensed table-striped table-sm" 
							ng-table="conteoTable" show-filter="true" style="font-family: calibri; font-size: 12pt;">
							<tbody ng-if="sectorURoRU == 'URBANO' ">
								<tr ng-repeat="a in $data" ng-init="setTotalUrbano(a)" >
									<td data-title="'Sector'" filter="{n9cose: 'text'}" sortable="'n9cose'" >'{{ a.n9cose }}</td>
									<td data-title="'Noticiaciones'" filter="{Notificacion: 'text'}">{{ a.Notificacion }}</td>
									<td data-title="'CB'" filter="{Corte: 'text'}">{{ a.Corte }}</td>
									<td data-title="'CP'" filter="{Corte: 'text'}">0</td>
									<td data-title="'RB'" filter="{Reconeccion: 'text'}">{{ a.Reconeccion }}</td>
									<td data-title="'RP'" filter="{Reconeccion: 'text'}">0</td>
										
								</tr>
								
							</tbody>

							<tbody  ng-if="sectorURoRU == 'RURAL' " >
									<tr ng-repeat="a in $data"  ng-init="setTotalRural(a)">
										<td data-title="'Sector'" filter="{n9cose: 'text'}" sortable="'n9cose'" >'{{ a.n9cose }}</td>
										<td data-title="'Noticiaciones'" filter="{Notificacion: 'text'}">{{ a.Notificacion }}</td>
										<td data-title="'CB'" filter="{Corte: 'text'}">0</td>
										<td data-title="'CP'" filter="{Corte: 'text'}">{{ a.Corte }}</td>
										<td data-title="'RB'" filter="{Reconeccion: 'text'}">0</td>
										<td data-title="'RP'" filter="{Reconeccion: 'text'}">{{ a.Reconeccion }}</td>
										
									</tr>
								</tbody>
						</table>
						
					</div>
				</div>
				<div>
					<img ng-if="cargando" src="<?= base_url() ?>public/img/cargandoAngular.gif" >
				</div>
			</fieldset>
			<br>
			<div class="table-responsive">
				<table class="table table-bordered table-condensed table-striped table-sm">
					<tr>
						<th rowspan="3" >
							<div class="texto-vertical-2">
								TOTAL DIARIO
							</div>
							
						</th>
						<th rowspan="3" >
							<div ng-if="sectorURoRU == 'URBANO' " class="texto-vertical-2">
								URBANO
							</div>
							<div ng-if="sectorURoRU == 'RURAL' " class="texto-vertical-2">
								RURAL
							</div>
							
						</th>
						<th colspan="5"><center>Actividades</center></th>
					</tr>
					<tr>
						<th>NOT</th>
						<th>CB</th>
						<th>CP</th>
						<th>RB</th>
						<th>RP</th>
					</tr>
					<tr>
						<td>{{ notTotal }}</td>
						<td>{{ cbTotal }}</td>
						<td>{{ cpTotal }}</td>
						<td>{{ rbTotal }}</td>
						<td>{{ rpTotal }}</td>
					</tr>
				</table>
			</div>

		</div>
	</div>
</div>	
<br>
<br>
<br>


<style>
	.texto-vertical-2 {
		color: blue;
		font-size: 20pt;
		writing-mode: vertical-lr;
		transform: rotate(180deg);
	}
</style>

<script src="<?= base_url() ?>public/angular_js/angular.js" type="text/javascript"></script>
<script type="text/javascript" language="javascript" src="<?= base_url() ?>public/angular_actividad/model.js"></script>
<script type="text/javascript" language="javascript" src="<?= base_url() ?>public/angular_actividad/controller.js"></script>
<script type="text/javascript" language="javascript" src="<?= base_url() ?>public/angular_js/ng-table.min.js"></script>
<link href="<?= base_url() ?>public/angular_js/ng-table.min.css" rel="stylesheet">
<script type="text/javascript" language="javascript" src="<?= base_url() ?>public/angular_js/angular-animate1.5.5.js"></script>


<script type="text/javascript">
	function mostrarCantidadFilas(){
		var cantidad = document.getElementById("cantidadFilas").innerHTML;
		document.getElementById("cantidadAlInicio").value = cantidad;
	}
</script>
<!--
	SELECT  n9cono, n9cose, COUNT(n9cose) 
	FROM tbl_consolidado
	WHERE n9feco = '20180706' 
	and n9cono = '040'
	GROUP by n9cose
	HAVING COUNT(n9cose)>0
	ORDER BY n9cono ASC

	//obtener el sector y sus not, sus cor y sus rec

	SELECT  n9cose, (SELECT COUNT(n9cose)
				FROM tbl_consolidado
				WHERE n9feco = '20180725' 
				and n9cose = 'IFR'
    			and n9cono = '010') as Notificacion,
                (SELECT COUNT(n9cose)
				FROM tbl_consolidado
				WHERE n9feco = '20180725' 
				and n9cose = 'IFR'
    			and n9cono = '030') as Corte,
                (SELECT COUNT(n9cose)
				FROM tbl_consolidado
				WHERE n9feco = '20180725' 
				and n9cose = 'IFR'
    			and n9cono = '040') as Rec
	FROM tbl_consolidado
    WHERE n9feco = '20180725'
    and n9cose = 'IFR'
	GROUP by n9cose
	HAVING COUNT(n9cose)>0
	ORDER BY n9cose ASC

-->
