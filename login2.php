<?php
session_start();

include 'pg.inc.php';

// Si se ha rellenado anteriormente el formulario, comprobar los datos
if(isset($_POST["nombre"])){
	
// Sentencia SQL a ejecutar
$sql = "select trim(contrasena) pwd, id, \"descripcion\" from public.usuarios where nombre = '".
	$_POST["nombre"]."'";
$resultado = ejecutar_SQL($conexion, $sql);

// En principio, se da la contraseña por no válida
$error = true;
// Si hay filas, existe la cuenta de usuario
if(numero_filas($resultado != 0)){
	// Comprobar contraseña
	$fila = fila($resultado, 0);

	if($fila["pwd"]==$_POST["pwd"]){
		// Almacenar su ID en los datos de la sesión
		$_SESSION["usuario"] = $fila["id"];

		//Todo OK
		$error = false;
		//Dar la bienvenida
		echo "<h3>Login OK<h3>
			Bienvenid@, ".$fila["desc"]."<br>
			Pulse <a href='producto.php'>aqu&iacute;</a> para continuar.";
	}

}
if($error){
	echo "<h3>Login fallido</h3>";
}
}

// Si no se ha iniciado la sesión, mostrar un formulario de logon
if(! isset($_SESSION["usuario"])){
	print '<form method="POST" action="login2.php">
		<table border="1">
		<tr><td colspan="2">Introduzca sus datos de acceso</td></tr>
		<tr><td>Nombre:&nbsp;</td><td><input type="text" name="nombre" id="nombre"></td></tr>
		<tr><td>Clave:&nbsp;</td><td><input type="password" name="pwd" id="pwd"></td></tr>
		</table>
		<input type="submit" value="Enviar">
	</form>';
}

?>