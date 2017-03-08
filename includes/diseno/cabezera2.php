<?php
$cabezera2 = '<thead class="thead-default">
                <tr>
                    <th>N° Lote</th>  
                    <th>PLANTA</th>
                    <th>TRATAMIENTO</th>
                    <th>TIPO DE PRODUCTO</th>  
                    <th>PRODUCTO</th> 
                    <th colspan="2">CANTIDAD APLICADA
                    <br>
                    <select name="unidad" id="unidad"    ng-options="unidad as unidad.label for unidad in unidades_liquido track by unidad.id"
                        ng-model="unidad_sel_liquido" required> 
                    </select>  
                    <br>
                    <select name="unidad" id="unidad"    ng-options="unidad as unidad.label for unidad in unidades_solido track by unidad.id"
                        ng-model="unidad_sel_solido" required> 
                    </select> 
                    </th> 
                    <th>PROXIMA APLICACION</th> 
                    </tr>   
            </thead>'
        ;?>
     
<?php
$cabezeraL = '<thead class="thead-default">
                <tr>
                    <th>N° Lote</th>  
                    <th>PLANTA</th>
                    <th>TRATAMIENTO</th>
                    <th>TIPO DE PRODUCTO</th>  
                    <th>PRODUCTO</th> 
                    <th colspan="2">CANTIDAD APLICADA
                    <br>
                    <select name="unidad" id="unidad"    ng-options="unidad as unidad.label for unidad in unidades_liquido track by unidad.id"
                        ng-model="unidad_sel_liquido" required> 
                    </select>  
                    <br>
                    <select name="unidad" id="unidad"    ng-options="unidad as unidad.label for unidad in unidades_solido track by unidad.id"
                        ng-model="unidad_sel_solido" required> 
                    </select> 
                    </th> 
                    <th>PROXIMA APLICACION</th> 
                    </tr>   
            </thead>'
        ;?>