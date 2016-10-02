var countryApp = angular.module('App', []);
countryApp.controller('PlantaCtrl', function ($scope, $rootScope, $http) {
    $scope.asdd = "";
    $scope.tipos_productos = [{
            'id': 1,
            'nombre': 'Quimico'
        }, {
            'id': 2,
            'nombre': 'Organico'
        }];
    $rootScope.id_aplicacion;

    $scope.productos = [];


    $scope.m_tipos_productos
    $http.get('../../Includes/Productos/ORGANICO.PHP').success(function (data) {
        $scope.organico = data;

    });
    $http.get('../../Includes/Productos/QUIMICO.PHP').success(function (data) {
        $scope.quimico = data;
    });
    $scope.cambiar_t_p = function () {
        if ($scope.m_tipos_productos == 1) {
            $scope.productos = $scope.quimico;

        } else {
            $scope.productos = $scope.organico;

        }
    };
    $scope.agregar_p = function (id) {
        if ($scope.productos.length == 0) {

            $http.get('../../Includes/Productos/PRODUCTO.PHP?id=' + id).success(function (data) {

                $scope.entrada = data;
                if ($scope.productos.length == 0) {
                    $scope.productos.push($scope.entrada);
                    $scope.selectedOption = $scope.entrada;
                }
            });
        }
    };

});
