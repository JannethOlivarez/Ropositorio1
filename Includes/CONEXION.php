<?php
require("CONSTANTES.php");
$var_mysqli = new mysqli(DB_SERVIDOR,DB_USUARIO,DB_PASS,DB_NOMBRE);
if ($var_mysqli->connect_errno) {//Si la sentencia tiene error es decir si la vsriasble no ay
    echo "Fallo al contenctar a MySQL: (" . $var_mysqli->connect_errno . ") " . $var_mysqli->connect_error;
}
?>
