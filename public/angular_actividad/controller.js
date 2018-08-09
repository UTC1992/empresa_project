app.controller('actividadCtrl', function($scope, $http, $location, $filter, NgTableParams) {
	
	$scope.mostrarTabla = true;
	$scope.notTotal = 0;
	$scope.cbTotal = 0;
	$scope.cpTotal = 0;
	$scope.rbTotal = 0;
	$scope.rpTotal = 0;

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
		$scope.mostrarTabla = false;
		$scope.cargando = true;
		$scope.notTotal = 0;
		$scope.cbTotal = 0;
		$scope.cpTotal = 0;
		$scope.rbTotal = 0;
		$scope.rpTotal = 0;

		$scope.getUrl = document.getElementById("urlContarActividades").value;
		$http({
			method: "post",
			url: $scope.getUrl,
			data: "fecha="+$scope.fechaConteo+"&sectorURoRU="+$scope.sectorURoRU,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}
		})
		.success(function(response){
			$scope.datos = response;
			//console.log(response);

			//se asigna la cantidad de registros obtenidos en la consulta
			$scope.cantidadSector = response.length;

			$scope.conteoTable = new NgTableParams(
				{
					count: 50,
					sorting: {
					id_con: 'asc'     // initial sorting
				}
				}, {
					counts: [50, 1000],
					getData: function (params) {
						$scope.data = params.filter() ? 
						$filter('filter')($scope.datos, params.filter()) : $scope.datos;
	
						var orderedData = params.sorting() ?
						$filter('orderBy')($scope.data, params.orderBy()) : $scope.datos;
	
						params.total(orderedData.length);
						$scope.data = orderedData.slice((params.page() - 1) * params.count(), params.page() * params.count());
						return $scope.data;
					}
					
				});
				$scope.mostrarTabla = true;
				$scope.cargando = false;
				
		}, function (error) {
			console.log(error);
		});

	}

	//suma de valores diarios de cada actividad
	$scope.setTotalUrbano = function(item){
        if (item){
			$scope.notTotal += parseInt(item.Notificacion);
			$scope.cbTotal += parseInt(item.Corte);
			$scope.cpTotal = 0;
			$scope.rbTotal += parseInt(item.Reconeccion);
			$scope.rpTotal = 0;
        }
	}
	
	$scope.setTotalRural = function(item){
        if (item){
            $scope.notTotal += parseInt(item.Notificacion);
			$scope.cbTotal = 0;
			$scope.cpTotal += parseInt(item.Corte);
			$scope.rbTotal = 0;
			$scope.rpTotal += parseInt(item.Reconeccion);
        }
    }

});
