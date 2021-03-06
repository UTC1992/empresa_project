app.controller('actividadCtrl', function($scope, $http, $location, $filter, NgTableParams) {
	
	$scope.mostrarTablas = true;
	$scope.notTotal1 = 0;
	$scope.cbTotal1 = 0;
	$scope.cpTotal1 = 0;
	$scope.rbTotal1 = 0;
	$scope.rpTotal1 = 0;

	$scope.notTotal2 = 0;
	$scope.cbTotal2 = 0;
	$scope.cpTotal2 = 0;
	$scope.rbTotal2 = 0;
	$scope.rpTotal2 = 0;
	
	//arrays para las tablas de conteo de urbano y rural
	$scope.datos1 = [];
	$scope.datos2 = [];
	$scope.datos3 = [];
	$scope.datos4 = [];

	$scope.diasSelect = [];
	$scope.mesesSelect = [];
	$scope.aniosSelect = [];
	llenarDias();
	llenarMeses();
	llenarAnios();

	function llenarAnios() {
		let contador = 0;
		for (let i = 2019; i < 2100; i++) {
			$scope.aniosSelect[contador] = {anio: i};
			contador += 1;
		}
	}

	function llenarDias() {
		for (let i = 0; i < 31; i++) {
			if(i < 9){
				$scope.diasSelect[i] = {dia: '0'+(i+1)};
			} else {
				$scope.diasSelect[i] = {dia: i+1};
			}
			
		}
	}

	function llenarMeses() {
		for (let i = 0; i < 12; i++) {
			if(i < 9){
				$scope.mesesSelect[i] = {mes: '0'+(i+1)};
			} else {
				$scope.mesesSelect[i] = {mes: i+1};
			}
			
		}
	}

	// funcion para consultar las actividades segun los datos enviados
    $scope.consultarActividades = function () {
        $scope.url = document.getElementById("urlConsultarActividades").value;
        $http({
            method: "post",
            url: $scope.url,
            data: "fecha="+$scope.fecha+"&actividad="+$scope.actividad,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
		})
		.success(function(response){
			//se asigna las respuesta
			$scope.actividades = response;
			
			//se asigna la cantidad de registros obtenidos en la consulta
			$scope.cantidadAct = response.length;

			$scope.actividadesTable = new NgTableParams(
				{
					count: 5,
					sorting: {
					id_con: 'asc'     // initial sorting
				}
				}, {
					counts: [5, 10, 20, 50, 1000],
					getData: function (params) {
						$scope.dataAsig = params.filter() ? 
						$filter('filter')($scope.actividades, params.filter()) : $scope.actividades;
	
						var orderedData = params.sorting() ?
						$filter('orderBy')($scope.dataAsig, params.orderBy()) : $scope.actividades;
	
						params.total(orderedData.length);
						$scope.dataAsig = orderedData.slice((params.page() - 1) * params.count(), params.page() * params.count());
						return $scope.dataAsig;
					}
					
				});
		}, function (error) {
			console.log(error);
		});
	}
	
	$scope.contarActividades = function (){
		$scope.mostrarTablas = false;
		$scope.cargando = true;
		
		$scope.notTotal1 = 0;
		$scope.cbTotal1 = 0;
		$scope.cpTotal1 = 0;
		$scope.rbTotal1 = 0;
		$scope.rpTotal1 = 0;

		$scope.notTotal2 = 0;
		$scope.cbTotal2 = 0;
		$scope.cpTotal2 = 0;
		$scope.rbTotal2 = 0;
		$scope.rpTotal2 = 0;

		$scope.getUrl = document.getElementById("urlContarActividades").value;
		$http({
			method: "post",
			url: $scope.getUrl,
			data: "fecha="+$scope.fechaConteo,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}
		})
		.success(function(response){
			//console.log(response);
			$scope.datos1 = [];
			$scope.datos2 = [];
			

			/*console.log("==========> BORNERA");
			console.log("URBANO");
			console.log(response[0]);
			console.log("RURAL");
			console.log(response[1]);
			console.log("=========> POSTE");
			console.log("RURAL");
			console.log(response[2]);
			console.log("RURAL");
			console.log(response[3]);
			*/

			$scope.crearArrayActividadesURB(response[0],response[1]);
			$scope.crearArrayActividadesRUR(response[2],response[3]);

			//se asigna la cantidad de registros obtenidos en la consulta
			$scope.cantidadSector1 = response[0].length;
			$scope.cantidadSector2 = response[2].length;

			$scope.cantidadSector3 = $scope.datos3.length;
			$scope.cantidadSector4 = $scope.datos4.length;

			$scope.conteoTable1 = new NgTableParams(
				{
					count: 50,
					sorting: {
					id_con: 'asc'     // initial sorting
				}
				}, {
					counts: [50, 1000],
					getData: function (params) {
						$scope.data = params.filter() ? 
						$filter('filter')($scope.datos1, params.filter()) : $scope.datos1;
	
						var orderedData = params.sorting() ?
						$filter('orderBy')($scope.data, params.orderBy()) : $scope.datos1;
	
						params.total(orderedData.length);
						$scope.data = orderedData.slice((params.page() - 1) * params.count(), params.page() * params.count());
						return $scope.data;
					}
					
				});

			$scope.conteoTable2 = new NgTableParams(
				{
					count: 50,
					sorting: {
					id_con: 'asc'     // initial sorting
				}
				}, {
					counts: [50, 1000],
					getData: function (params) {
						$scope.data = params.filter() ? 
						$filter('filter')($scope.datos2, params.filter()) : $scope.datos2;
	
						var orderedData = params.sorting() ?
						$filter('orderBy')($scope.data, params.orderBy()) : $scope.datos2;
	
						params.total(orderedData.length);
						$scope.data = orderedData.slice((params.page() - 1) * params.count(), params.page() * params.count());
						return $scope.data;
					}
					
				});

			$scope.conteoTable3 = new NgTableParams(
				{
					count: 50,
					sorting: {
					id_con: 'asc'     // initial sorting
				}
				}, {
					counts: [50, 1000],
					getData: function (params) {
						$scope.data = params.filter() ? 
						$filter('filter')($scope.datos3, params.filter()) : $scope.datos3;
	
						var orderedData = params.sorting() ?
						$filter('orderBy')($scope.data, params.orderBy()) : $scope.datos3;
	
						params.total(orderedData.length);
						$scope.data = orderedData.slice((params.page() - 1) * params.count(), params.page() * params.count());
						return $scope.data;
					}
					
				});

			$scope.conteoTable4 = new NgTableParams(
				{
					count: 50,
					sorting: {
					id_con: 'asc'     // initial sorting
				}
				}, {
					counts: [50, 1000],
					getData: function (params) {
						$scope.data = params.filter() ? 
						$filter('filter')($scope.datos4, params.filter()) : $scope.datos4;
	
						var orderedData = params.sorting() ?
						$filter('orderBy')($scope.data, params.orderBy()) : $scope.datos4;
	
						params.total(orderedData.length);
						$scope.data = orderedData.slice((params.page() - 1) * params.count(), params.page() * params.count());
						return $scope.data;
					}
					
				});
			
			$scope.mostrarTablas = true;
			$scope.cargando = false;
				
		}, function (error) {
			console.log(error);
		});

	}

	$scope.crearArrayActividadesURB = function(array1, array2){
		var datosURB = new Array();
		var datosURB2 = new Array();
		var con1 = 0;
		var con2 = 0;
		for (let i = 0; i < array1.length; i++) {
			if(parseInt(array1[i]['n9coag']) == 1 
			|| parseInt(array1[i]['n9coag']) == 2
			|| parseInt(array1[i]['n9coag']) == 3
			|| parseInt(array1[i]['n9coag']) == 4
			|| parseInt(array1[i]['n9coag']) == 5){
				var datosBP1 = {
					"AGENCIA"	:	parseInt(array1[i]['n9coag']),
					"SECTOR"	:	array1[i]['n9cose'],
					"NOT"		:	parseInt(array1[i]['Notificacion']),
					"CB"		: 	parseInt(array1[i]['Corte']),
					"CP"		: 	parseInt(array2[i]['Corte']),
					"RB"		: 	parseInt(array1[i]['Reconeccion']),
					"RP"		:	parseInt(array2[i]['Reconeccion'])
				};
				datosURB[con1] = datosBP1;
				con1++;
			}
			if(parseInt(array1[i]['n9coag']) == 6 
					|| parseInt(array1[i]['n9coag']) == 95
					|| parseInt(array1[i]['n9coag']) == 7) {
				var datosBP1 = {
					"AGENCIA"	:	parseInt(array1[i]['n9coag']),
					"SECTOR"	:	array1[i]['n9cose'],
					"NOT"		:	parseInt(array1[i]['Notificacion']),
					"CB"		: 	parseInt(array1[i]['Corte']),
					"CP"		: 	parseInt(array2[i]['Corte']),
					"RB"		: 	parseInt(array1[i]['Reconeccion']),
					"RP"		:	parseInt(array2[i]['Reconeccion'])
				};
				datosURB2[con2] = datosBP1;
				con2++;
			}
			
		}
		$scope.datos1 = datosURB;
		$scope.datos3 = datosURB2;
		console.log('datos de URBANO');
		console.log($scope.datos1);
		console.log($scope.datos3);
	}

	$scope.crearArrayActividadesRUR = function(array1, array2){
		var datosURB = new Array();
		var datosURB2 = new Array();
		var con1 = 0;
		var con2 = 0;
		for (let i = 0; i < array1.length; i++) {
			if(parseInt(array1[i]['n9coag']) == 1 
			|| parseInt(array1[i]['n9coag']) == 2
			|| parseInt(array1[i]['n9coag']) == 3
			|| parseInt(array1[i]['n9coag']) == 4
			|| parseInt(array1[i]['n9coag']) == 5){
				var datosBP1 = {
					"AGENCIA"	:	parseInt(array1[i]['n9coag']),
					"SECTOR"	:	array1[i]['n9cose'],
					"NOT"		:	parseInt(array1[i]['Notificacion']),
					"CB"		: 	parseInt(array1[i]['Corte']),
					"CP"		: 	parseInt(array2[i]['Corte']),
					"RB"		: 	parseInt(array1[i]['Reconeccion']),
					"RP"		:	parseInt(array2[i]['Reconeccion'])
				};
				datosURB[con1] = datosBP1;
				con1++;
			}
			if(parseInt(array1[i]['n9coag']) == 6 
					|| parseInt(array1[i]['n9coag']) == 95
					|| parseInt(array1[i]['n9coag']) == 7){
				var datosBP1 = {
					"AGENCIA"	:	parseInt(array1[i]['n9coag']),
					"SECTOR"	:	array1[i]['n9cose'],
					"NOT"		:	parseInt(array1[i]['Notificacion']),
					"CB"		: 	parseInt(array1[i]['Corte']),
					"CP"		: 	parseInt(array2[i]['Corte']),
					"RB"		: 	parseInt(array1[i]['Reconeccion']),
					"RP"		:	parseInt(array2[i]['Reconeccion'])
				};
				datosURB2[con2] = datosBP1;
				con2++;
			}
			
		}
		$scope.datos2 = datosURB;
		$scope.datos4 = datosURB2;
		console.log('datos de RURAL');
		console.log($scope.datos2);
		console.log($scope.datos4);
	}

	//suma de valores diarios de cada actividad
	$scope.setTotalUrbano = function(item){
        if (item){
			$scope.notTotal1 += parseInt(item.NOT);
			$scope.cbTotal1 += parseInt(item.CB);
			$scope.cpTotal1 += parseInt(item.CP);
			$scope.rbTotal1 += parseInt(item.RB);
			$scope.rpTotal1 += parseInt(item.RP);
        }
	}
	
	$scope.setTotalRural = function(item){
        if (item){
            $scope.notTotal2 += parseInt(item.NOT);
			$scope.cbTotal2 += parseInt(item.CB);
			$scope.cpTotal2 += parseInt(item.CP);
			$scope.rbTotal2 += parseInt(item.RB);
			$scope.rpTotal2 += parseInt(item.RP);
        }
    }

});
