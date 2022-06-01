<?php
$host="localhost";
$usuario="root";
$clave="";
$db="escuela";

$conexion = new mySqli($host,$usuario,$clave,$db);

if (!$conexion) {
    echo "Error en la conexion";
}

?>