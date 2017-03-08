var countryApp = angular.module('App', []);
countryApp.controller('PlantaCtrl', function ($scope, $http) {
    $scope.asdd = "";
    $scope.tipos_productos = [{
            'id': 1,
            'nombre': 'Quimico'
        }, {
            'id': 2,
            'nombre': 'Organico'
        }];

    $scope.productos = [];
    $scope.plantas = [];
    $scope.lotes = [];
    $scope.m_tipos_productos
    $http.get('../Consultas/consulta_json.php?consulta=proximasAplicaciones').success(function (data) {
        $scope.aplicaciones = data;

    });
     $http.get('../Consultas/consulta_json.php?consulta=aplicacionesReagendadas').success(function (data) {
        $scope.aplicaciones_reagendadas = data;

    });
    
    $scope.m_tipos_productos
    $http.get('../Consultas/consulta_json.php?consulta=aplicacionesPasadas').success(function (data) {
        $scope.aplicaciones_pasadas = data;

    });
    
    $http.get('../../Includes/Productos/ORGANICO.PHP').success(function (data) {
        $scope.organico = data;

    });
    $http.get('../../Includes/Productos/QUIMICO.PHP').success(function (data) {
        $scope.quimico = data;
    });
    $http.get('../Consultas/consulta_json.php?consulta=plantasSiembras').success(function (data) {
            $scope.plantas = data;
    });
    $scope.cambiar_t_p = function () {
        if ($scope.m_tipos_productos == 1) {
            $scope.productos = $scope.quimico;

        } else {
            $scope.productos = $scope.organico;

        }
    };
    $scope.reagendar = function (efectuada) {
        if (efectuada == 0) {
            return true;
        } else {
            return false;
        }
    };
    $scope.agregar_p = function (id,cantidad) {
        if ($scope.productos.length == 0) {

            $http.get('../../Includes/Productos/PRODUCTO.PHP?id=' + id).success(function (data) {

                $scope.entrada = data;
                if ($scope.productos.length == 0) {
                    $scope.productos.push($scope.entrada);
                    $scope.selectedOption = $scope.entrada;
                    $scope.cambiar_unidades();
               
                    $scope.cantidad=cantidad;
                }
            });
        }
    };

    $scope.cambiar_plantas = function () {
        $http.get('../Consultas/consulta_json.php?consulta=siembrasActivas&id=' + $scope.m_lote.cod_lote).success(function (data) {

            $scope.plantas = data;


        });

    };
    
     $scope.cambiar_lotes = function () {
        $http.get('../Consultas/consulta_json.php?consulta=lotesActivos&id='+$scope.planta_sel).success(function (data) {
        $scope.lotes = data;

    });
    };
     $scope.cambiar_lotes2 = function (id) {
        $http.get('../Consultas/consulta_json.php?consulta=lotesActivos&id='+id).success(function (data) {
        $scope.lotes = data;

    });
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
    $scope.unidad_label = function (tipo_sl) {
        if (tipo_sl == "solido") {
            return $scope.unidad_sel_solido.label;
        } else {
            return $scope.unidad_sel_liquido.label;
        }
    };
    $scope.cargar = true;
    $scope.cargar2 = true;
    $scope.agregar_lote_planta = function (id_vinculacion, id_planta) {
      
        if ($scope.plantas.length >0 && $scope.cargar2) {
          
            
            for (i = 0; i < $scope.plantas.length; i++) {
              
                if ($scope.plantas[i].cod_planta === id_planta) {
                   
                   $scope.planta_sel=$scope.plantas[i];
                  $scope.cambiar_lotes2($scope.plantas[i].cod_planta);
                   break;
                }
               
            }
           
            $scope.cargar2 = false;
        }
   
        if ($scope.lotes.length >0 && $scope.cargar) {
          
           
            for (i = 0; i < $scope.lotes.length; i++) {
              
                if ($scope.lotes[i].id_vinculacion === id_vinculacion) {
                   $scope.m_lote=$scope.lotes[i];
                  
                   
                   break;
                }
               
            }
           
            $scope.cargar = false;
        }
    
     }
});

