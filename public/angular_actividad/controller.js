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
			$scope.datos1 = response[0];
			$scope.datos2 = response[1];
			console.log("URBANO");
			console.log(response[0]);
			console.log("RURAL");
			console.log(response[1]);

			//se asigna la cantidad de registros obtenidos en la consulta
			$scope.cantidadSector1 = response[0].length;
			$scope.cantidadSector2 = response[1].length;

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
				
				$scope.mostrarTablas = true;
				$scope.cargando = false;
				
		}, function (error) {
			console.log(error);
		});

	}

	//suma de valores diarios de cada actividad
	$scope.setTotalUrbano = function(item){
        if (item){
			$scope.notTotal1 += parseInt(item.Notificacion);
			$scope.cbTotal1 += parseInt(item.Corte);
			$scope.cpTotal1 = 0;
			$scope.rbTotal1 += parseInt(item.Reconeccion);
			$scope.rpTotal1 = 0;
        }
	}
	
	$scope.setTotalRural = function(item){
        if (item){
            $scope.notTotal2 += parseInt(item.Notificacion);
			$scope.cbTotal2 = 0;
			$scope.cpTotal2 += parseInt(item.Corte);
			$scope.rbTotal2 = 0;
			$scope.rpTotal2 += parseInt(item.Reconeccion);
        }
    }

});
