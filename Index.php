<?php 


	include('ArbolBinario.php');
    session_start();
    if (isset($_SESSION["Arbol"])==false) {
      $_SESSION["Arbol"] = new ArbolB();
    }

?>

<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Proyecto Arbol Binario</title>
</head>
<body>


	<div>
		<form action="post">
			<input type="text" name="Arbol" placeholder="Raiz Arbol">
			<input type="button" name="Crear_Arbol" value="Crear Arbol">
		</form>
	</div>
	
</body>
</html>