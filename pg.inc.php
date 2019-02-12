<?php
//Abrir una conexión con al Base de Datos
function conectar($host, $db, $usuario, $contrasena){
	return pg_connect("host=$host dbname=$db user=$usuario password=$contrasena");
}

//Cerrar una conexión
function cerrar_conexion($conexion){
	pg_close($conexion);
}

//Ejecutar una consulta SQL sobre una conexión
function ejecutar_SQL($conexion, $cadena){
	return pg_exec($conexion, $cadena);
}

//Obtener el número de filas de un resultado
function numero_filas($resultado){
	return pg_numrows($resultado);
}

//Obtiene la fila númeri $i de un resultado
//Para obtener un campo se usa la sintaxis $fila_obtenida["nombre-de-la-columna"]
function fila($resultado, $i){
	return pg_fetch_array($resultado, $i);
}

$conexion = conectar('localhost','almacen','postgres','postgres');

?>
