//configuracion de rutas 
app.config(function($routeProvider) {
    var urlConsultar = $('#urlConsultarCurso').val();
    $routeProvider
    .when("/", {
        templateUrl : urlConsultar,
        controller : "cursoCtrl"
    })
    .otherwise({
        redirectTo: '/'
    });;
});
