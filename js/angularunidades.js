var countryApp = angular.module('App', []);
countryApp.controller('ProductoCtrl', function ($scope, $rootScope, $http) {
    $scope.unidades = [];
    $scope.unidades_liquido = [
        {id: 1, label: "ml", conversion: 1 / 0.001},
        {id: 2, label: "cl", conversion: 1 / 0.01},
        {id: 3, label: "dl", conversion: 1 / 0.1},
        {id: 4, label: "litro", conversion: 1},
        {id: 5, label: "galon", conversion: 0.264172}
    ];
    $scope.unidades_solido = [
        {id: 0, label: "mg", conversion: 1 / 0.000001},
        {id: 1, label: "cg", conversion: 1 / 0.00001},
        {id: 2, label: "dg", conversion: 1 / 0.0001},
        {id: 3, label: "gramo", conversion: 1 / 0.001},
        {id: 4, label: "kg", conversion: 1},
        {id: 5, label: "Oz", conversion: 35.274},
        {id: 6, label: "Lb", conversion: 2.20462},
        {id: 7, label: "Quintal", conversion: 100}
    ];
    $scope.unidad_sel_liquido = {id: 4, label: "litro", conversion: 1};
    $scope.unidad_sel_solido = {id: 4, label: "kg", conversion: 1};

    $http.get('../../Includes/Productos/ORGANICO.PHP').success(function (data) {
        $scope.organico = data;

    });
     $http.get('../Consultas/consulta_json.php?consulta=siembrasActivas').success(function (data) {
        $scope.siembras = data;

    });
    $http.get('../../Includes/Productos/QUIMICO.PHP').success(function (data) {
        $scope.quimico = data;
    });

    $scope.cantidad = function (tipo_sl, cantidadp) {
        if (tipo_sl == "solido") {
            return cantidadp * $scope.unidad_sel_solido.conversion;
        } else {
            return cantidadp * $scope.unidad_sel_liquido.conversion;
        }
    };
    $scope.unidad_label = function (tipo_sl) {
        if (tipo_sl == "solido") {
            return $scope.unidad_sel_solido.label;
        } else {
            return $scope.unidad_sel_liquido.label;
        }
    };
    $scope.cambiar_unidades = function (vari) {
        if (vari == 1) {
            $scope.unidades = $scope.unidades_liquido;
            $scope.unidad_sel = {id: 4, label: "litro", conversion: 1};
        } else {
            $scope.unidades = $scope.unidades_solido;
            $scope.unidad_sel = {id: 4, label: "kg", conversion: 1};
        }

    };
});