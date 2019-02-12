<?php
//error_reporting(E_ALL);
session_start();

include 'pg.inc.php';

//Si se ha rellenado anteriormente el formulario, comprobar lo datos
if(isset($_POST["nombre"])){
	  //Sentencia SQL a ejecutar
	  $sql = "select * from public.usuarios where nombre = '".
	  $_POST["nombre"].
	  "' AND contrasena =  '".
	  $_POST["pwd"]."'";
	
	$resultado = ejecutar_SQL($conexion, $sql);
	
	//Si hay filas, los datos de acceso eran correctos
	if(numero_filas($resultado) != 0){
	  //Obtener los datos del usuario logado
	  $fila = fila($resultado, 0);

	  //Almacenar su ID en los datos de la sesión
	  $_SESSION["usuario"] = $fila["id"];

	  //Dar la bienvenida
	  echo "<h3>Login OK</h3>
		Bienvenid@, " .$fila["descripcion"]. "<br>
		Pulse <a href='producto.php'>aqu&iacute;</a> para continuar.";


	}else{
	  echo "<h3>Login fallido</h3>";
	}
}

//Si no se ha iniciado la sesión, mostrar un formulario de login
if(! isset($_SESSION["usuario"])){
 print  '<form method="POST" action="login.php">
	    	<table border="1">
	 		<tr><td colspan="2">Introduzca sus datos de acceso</td></tr>
	 		<tr><td>Nombre:&nbsp;</td><td><input type="text" name="nombre" id="nombre"></td></tr>
	    	<tr><td>Clave:&nbsp;</td><td><input type="password" name="pwd" id="pwd"></td></tr>
	    	</table>
	    	<input type="submit" value="Enviar">
        </form>';
}

?>
	   

	
