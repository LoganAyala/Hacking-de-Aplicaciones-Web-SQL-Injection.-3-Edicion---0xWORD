<?php
//-----------------------Encabezado donde se muestra el nombre de usuario-----------
session_start();

include 'pg.inc.php'; //Funciones de operaciones con la base de datos

if (isset($_SESSION["usuario"])){
	//Obtener el nombre del usuario
	$sql = "select * from public.usuarios where id=".$_SESSION["usuario"];
	$resultado = ejecutar_SQL($conexion,$sql);
	$fila = fila($resultado,0);
	$usuario = $fila["descripcion"];
	
	//Mostrar un indicador del usuario logado
	echo '<table border="1" width="100%">
			<tr width="100%"><td>
			HA INICIADO SESSION COMO: '.$usuario.'</td></tr></table><br>';
}
else{
	//Si no está logado, redirigir a logon
	header('Location: login.php');
}
//-----------------------------------------------------------------------------------


//----------------------Sección para la búsqueda de productos------------------------

//Si se indicó el producto, buscarlo
if(isset($_GET["id"])){
	$sql = "select * from public.productos where id = '".$_GET["id"]."'";
	$resultado = ejecutar_SQL($conexion,$sql);
	
	if(numero_filas($resultado) == 0){
		echo "Referencia no encontrada";
	}
	else{
		$fila = fila($resultado,0);
		echo "<h3>Datos sobre el producto:</h3>";
		echo "<table border=1>";
		echo "<tr><td>Referencia</td><td>Nombre</td><td>Precio</td></tr>";
		echo "<tr><td>".$fila["referencia"].'</td><td>'.$fila["nombre"].'</td><td>'.$fila["precio"].'</td></tr>';
		echo "</table>";
	}
}

//Mostrar formulario "Buscar"
echo '<h3>Buscar Producto</h3>
		<form method="GET" action="producto.php">
		Buscar: <input type="text" id="id" name="id">
		<input type="submit" value="Buscar">
		</form>';
?>