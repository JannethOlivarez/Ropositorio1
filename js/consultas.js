
var countryApp = angular.module('App', []);
countryApp.controller('ConsultasCtrl', function ($scope, $rootScope, $http) {

    $scope.tabla1 = [];
    $scope.tabla2 = [];
    $scope.tabla4 = [];

    $scope.mostrar_aplicaciones = false;

    $http.get('../../Includes/Productos/ORGANICO.PHP').success(function (data) {
        $scope.organico = data;

    });
    $http.get('../../Includes/Productos/QUIMICO.PHP').success(function (data) {
        $scope.quimico = data;
    });

    $scope.consultar_aplicaion = function () {

        $scope.ur = 'consulta_json?id=' + $scope.plantaSelecionada + '&consulta=aplicacion';
        $http.get('consulta_json?id=' + $scope.plantaSelecionada + '&consulta=aplicacion').success(function (data) {
            $scope.tabla1 = data;

        });
        $scope.mostrar_aplicaciones = true;
        $scope.mostra_planta=false;
        $scope.mostrar_producto=true;
    };

    $scope.proximasAplicaciones = function () {
        $http.get('consulta_json?consulta=proximasAplicaciones').success(function (data) {
            $scope.tabla1 = data;

        });
        $scope.mostrar_aplicaciones = true;
        $scope.mostrar_proxima_semana = false;
        $scope.mostra_planta=true;
        $scope.mostrar_producto=true;
    };

    $scope.consultar_aplicacionp = function () {

        $scope.ur = 'consulta_json?id=' + $scope.productoSeleccionado + '&consulta=aplicacionprod';
        $http.get('consulta_json?id=' + $scope.productoSeleccionado + '&consulta=aplicacionprod').success(function (data) {
            $scope.tabla1 = data;

        });
        $scope.mostrar_aplicaciones = true;
        $scope.mostra_planta=true;
        $scope.mostrar_producto=false;
    };


    $scope.proximas_aplicaciones_proximo_mes = function () {
        $scope.ur = 'consulta_json?consulta=aplicacionFecha2';
        var dt = new Date();
        var primerDia = new Date(dt.getFullYear(), dt.getMonth()+1, 1);
        var ultimoDia = new Date(dt.getFullYear(), dt.getMonth() + 2, 0);
        $scope.ur += '&ini=' + primerDia.toLocaleDateString();
        $scope.ur += '&fin=' + ultimoDia.toLocaleDateString();
        $http.get($scope.ur).success(function (data) {
            $scope.tabla1 = data;
        });

        $scope.mostrar_aplicaciones = true;
        $scope.mostrar_proxima_semana = false;
    };
    
    $scope.proximas_aplicaciones_mes = function () {
        $scope.ur = 'consulta_json?consulta=aplicacionFecha2';
        var dt = new Date();
        var ultimoDia = new Date(dt.getFullYear(), dt.getMonth() + 1, 0);
        $scope.ur += '&ini=' + dt.toLocaleDateString();
        $scope.ur += '&fin=' + ultimoDia.toLocaleDateString();
        $http.get($scope.ur).success(function (data) {
            $scope.tabla1 = data;
        });

        $scope.mostrar_aplicaciones = true;
        $scope.mostrar_proxima_semana = false;
    };


    $scope.buscar_fechas = function () {

        $scope.ur = 'consulta_json?consulta=aplicacionFecha2';

        if ($scope.desde != null) {
            $scope.ur += '&ini=' + $scope.desde.toLocaleDateString();
        }
        if ($scope.hasta != null) {
            $scope.ur += '&fin=' + $scope.hasta.toLocaleDateString();
        }
        if ($scope.ur != 'consulta_json?consulta=aplicacionFecha2') {
            $http.get($scope.ur).success(function (data) {

                $scope.tabla1 = data;

            });
        }
        $scope.mostrar_aplicaciones = true;
        $scope.mostrar_proxima_semana = false;
        $scope.mostra_planta=true;
        $scope.mostrar_producto=true;
    };



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
        {id: 3, label: "gramos", conversion: 1 / 0.001},
        {id: 4, label: "kg", conversion: 1},
        {id: 5, label: "Oz", conversion: 35.274},
        {id: 6, label: "Lb", conversion: 2.20462},
        {id: 7, label: "Quintal", conversion: 100}
    ];
    $scope.unidad_sel_liquido = {id: 4, label: "litro", conversion: 1};
    $scope.unidad_sel_solido = {id: 4, label: "kg", conversion: 1};

    $scope.cambiar_unidades = function () {
        if ($scope.selectedOption.estado_sl == "liquido") {
            $scope.unidades = $scope.unidades_liquido;
            $scope.unidad_sel = {id: 4, label: "litro", conversion: 1};
        } else {
            $scope.unidades = $scope.unidades_solido;
            $scope.unidad_sel = {id: 4, label: "kg", conversion: 1};
        }
        $scope.cantidad = "";
    };
    $scope.cambiar_unidades_php = function (estado_sl) {
        if ($scope.unidades.length == 0) {
            if (estado_sl == "liquido") {
                $scope.unidades = $scope.unidades_liquido;
                $scope.unidad_sel = {id: 4, label: "litro", conversion: 1};
            } else {
                $scope.unidades = $scope.unidades_solido;
                $scope.unidad_sel = {id: 4, label: "kg", conversion: 1};
            }
        }
    };
    $scope.validar_cantidad = function () {
        if ($scope.cantidad <= 0 || $scope.cantidad > $scope.selectedOption.cantidad_prod * $scope.unidad_sel.conversion) {
            $scope.mensajecantidad = $scope.cantidad + " Cantidad Inválida";
            $scope.cantidad = "";
        } else {
            $scope.mensajecantidad = "";
        }
    };
    $scope.cantidad = function (tipo_sl, cantidadp) {
        if (tipo_sl == "solido") {
            return cantidadp * $scope.unidad_sel_solido.conversion;
        } else {
            return cantidadp * $scope.unidad_sel_liquido.conversion;
        }
    };
    $scope.edad= function (fecha){
        
        var fecha1 = moment(fecha);
        var now=moment();
        console.log(now.diff(fecha1, 'days'));
        return now.diff(fecha1, 'months',true);
    }
    $scope.unidad_label = function (tipo_sl) {
        if (tipo_sl == "solido") {
            return $scope.unidad_sel_solido.label;
        } else {
            return $scope.unidad_sel_liquido.label;
        }
    };


    $scope.aplicaciones_proxima_semana = function () {
        var dt = new Date();
        $scope.fecha = [];
        var options = {weekday: "long", year: "numeric", month: "long", day: "numeric"};
        var dayOfMonth = dt.getDate();
        dt.setDate(dayOfMonth + 1);
        var fechaString = dt.toLocaleDateString("es-ES", options);
        var fechaArray = fechaString.split(",");
        var contador = 0;

        var condition = false;
        while (fechaArray[0] !== "lunes") {
            dayOfMonth = dt.getDate();
            dt.setDate(dayOfMonth + 1);
            fechaString = dt.toLocaleDateString("es-ES", options);
            console.log(fechaString);
            fechaArray = fechaString.split(",");

        }

        for (i = 0; i < 7; i++) {
            var stringCorta = dt.toLocaleDateString();
            var arrayCorta = stringCorta.split("/");
            $scope.fecha.push({larga: dt.toLocaleDateString("es-ES", options)
                , corta: arrayCorta[2] + "-" + arrayCorta[1] + "-" + arrayCorta[0]});
            dayOfMonth = dt.getDate();
            if (i !== 6) {
                dt.setDate(dayOfMonth + 1);
            }
        }

        var fecha_ini = new Date();

        dayOfMonth = dt.getDate();
        fecha_ini.setDate(dayOfMonth - 6);

        $scope.ur = 'consulta_json?consulta=aplicacionFecha&ini=' + fecha_ini.toLocaleDateString() + '&fin=' + dt.toLocaleDateString();
        $http.get('consulta_json?consulta=aplicacionFecha&ini=' + fecha_ini.toLocaleDateString() + '&fin=' + dt.toLocaleDateString()).success(function (data) {
            $scope.tabla2 = data;

        });
        $scope.mostrar_aplicaciones = false;
        $scope.mostrar_proxima_semana = true;
    };
    $scope.aplicaciones_hoy = function () {
        var dt = new Date();
        $scope.fecha = [];
        var options = {weekday: "long", year: "numeric", month: "long", day: "numeric"};

        var stringCorta = dt.toLocaleDateString();
        var arrayCorta = stringCorta.split("/");
        $scope.fecha.push({larga: dt.toLocaleDateString("es-ES", options)
            , corta: arrayCorta[2] + "-" + arrayCorta[1] + "-" + arrayCorta[0]});

        $scope.ur = 'consulta_json?consulta=aplicacionFecha&ini=' + dt.toLocaleDateString() + '&fin=' + dt.toLocaleDateString();
        $http.get('consulta_json?consulta=aplicacionFecha&ini=' + dt.toLocaleDateString() + '&fin=' + dt.toLocaleDateString()).success(function (data) {
            $scope.tabla2 = data;

        });
        $scope.mostrar_aplicaciones = false;
        $scope.mostrar_proxima_semana = true;
    };
    
});