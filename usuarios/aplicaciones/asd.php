<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.10/angular.min.js"></script>
    <title>Select dependientes</title>
</head>
<body ng-app="selects">
    <script>
        var selects = angular.module('selects', []);
        selects.controller('UbicacionCtrl', ['$scope', function($scope) {
            $scope.ubicacion = {
                'Dtto. Capital': {'Libertador': ['La Vega', 'Antimano']},
                'Miranda': {      'Plaza': ['Guarenas'],'Zamora': ['Guatire']
                }
            };
            
            $scope.ubicacion = {
                'Dtto. Capital': {'Libertador': ['La Vega', 'Antimano']},
                'Miranda': {      'Plaza': ['Guarenas'],'Zamora': ['Guatire']
                }
            };
        }]);
    </script>
    <div ng-controller="UbicacionCtrl" >
        {{ubicacion}}
        <select ng-model="model_estado" ng-options="estado for (estado, municipios) in ubicacion">
            <option value="">- Seleccione -</option>
        </select>
        <select ng-model="model_municipio" ng-disabled="!model_estado" ng-options="municipio for (municipio, parroquias) in model_estado">
            <option value="">- Seleccione -</option>
        </select>
        <select ng-model="model_parroquia" ng-disabled="!model_estado || !model_municipio" ng-options="parroquia for parroquia in model_municipio">
            <option value="">- Seleccione -</option>
        </select>
    </div>
</body>
</html>