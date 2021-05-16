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
	<link rel="stylesheet" href="Interfaz.css">
    <script type="text/javascript" src="vis/dist/vis.js"></script>
	
    <title>Proyecto Arbol Binario</title>

    <style type="text/css">
	
        #Arbol {
            width: 400px;
            height: 460px;
			left: 600px; top: 130px;
            border: 1px solid lightgray;
            border-radius: 15px;
            margin-left: 100px;
            position: absolute;
            background: #ffffff6c;
			border-color:  #4caf99;
        }
    </style>
</head>

<body>

    <header>
        <h1 id="title1"><center>Arbol Binario</center></h1>
        <hr id="hr1">
		<hr id="hr2">

    </header>
    <div>
	<h3 id="tittle0">Vista Previa</h1>
        <h3 id="title2">Crear arbol</h3>
        <form class="Arbol" action="Index.php" method="post">
            <input id="TextRaizArbol" type="number" name="Raiz" placeholder="Raiz Arbol" required>
            <input id="BotonCrearArbol" type="submit" name="Crear_Arbol" value="Crear Arbol">
		</form>
		<form class="Hijo" action="Index.php" method="post">
            <input id="TextNombrePadre" type="number" name="Dad" placeholder="Nombre padre" required>
            <input id="Izquierda" type="radio" name="Ubication" value="I" required><label id="TextIzquierda" for="Left">Izquierda</label>
            <input id="Derecha" type="radio" name="Ubication" value="D" required><label id="TextDerecha" for="Right">Derecha</label>
            <input id="TextNombreHijo" type="number" name="Son" placeholder="Nombre hijo" required>
            <input id="BotonCrearHijo" type="submit" name="Crear_Hijo" value="Crear Hijo">
		</form>
		<form class="Eliminar" action="Index.php" method="post">
			<input id="TextNombreNodo" type="number" name="SonNodo" placeholder="Nombre Nodo"required>
			<input id="BotonEliminarNodo" type="submit" name="EliminarNodo" value="Eliminar Nodo">
		</form>	
		<form class="Arbol1" action="Index.php" method="post">
            <input id="ContarNodos" type="submit" name="Contar" value="Contar Nodos">
			<input id="ContarNumPares" type="submit" name="ContarPares" value="Contar Nodos Pares">
			<input id="ArbolCompleto" type="submit" name="ArbolCompleto" value="¿Arbol Completo?">
			<input id="RecorridoPreorden" type="submit" name="RecorridoPreorden" value="Recorrido Pre-Orden">
			<input id="RecorridoPosorden" type="submit" name="RecorridoPosorden" value="Recorrido Pos-Orden">
			<input id="RecorridoEnorden" type="submit" name="RecorridoEnorden" value="Recorrido En-Orden">
			<input id="VerNodosHojas" type="submit" name="VerNodosHojas" value="Ver Nodos Hojas">
			<input id="Altura" type="submit" name="Altura" value="Calcular Altura">
		</form>
		<form class="Nivel" action="Index.php" method="post">
			<input id="TextNivel" type="number" name="Nivel" placeholder="Numero Nivel" required>
			<input id="RecorridoPorNivel" type="submit" name="RecorridoPorNivel" value="Recorrido Por Nivel">
		</form>
			
    
    </div>


    <div id="Arbol"></div>

	<?php

if (isset($_POST["Raiz"]) && isset($_POST["Crear_Arbol"]) != null) {
	if (empty($_POST["Raiz"])) {
		echo "<script type='text/javascript'>alert('Campo vacío');</script>";
	} else {
		$Tree = new Nodo($_POST["Raiz"]);
		$_SESSION["Arbol"]->CrearArbol($Tree);
	}
}

if (isset($_POST["Dad"]) && isset($_POST["Son"]) && isset($_POST["Ubication"]) != null && isset($_POST["Crear_Hijo"]) != null) {
	$Son = new Nodo($_POST["Son"]);
	$msj = $_SESSION["Arbol"]->AgregarNodo($Son, $_POST["Ubication"], $_POST["Dad"]);
	if($msj != null) echo "<script type='text/javascript'>alert('$msj');</script>";
}



if (isset($_POST["Contar"]) != null) {
	$nodo = $_SESSION["Arbol"]->GetRaiz();
	$mj = $_SESSION["Arbol"]->ContarNodos($nodo);
	if ($mj >= 0 && $mj != "False" )echo "<script type='text/javascript'>alert('Numero de nodos: $mj');</script>";
	if($mj == "False" ) echo "<script type='text/javascript'>alert('Debe primero crear un árbol');</script>";
}

if (isset($_POST["ContarPares"]) != null) {
	$nodo = $_SESSION["Arbol"]->GetRaiz();
	$mj = $_SESSION["Arbol"]->ContarNumerosPares($nodo);
	if (($mj >= 0 || $nodo->GetId()%2!=0)&& $mj != False )echo "<script type='text/javascript'>alert('Numero de nodos pares: $mj');</script>";
	if($mj == False) echo "<script type='text/javascript'>alert('Debe primero crear un árbol');</script>";
}

if (isset($_POST["Altura"]) != null) {
	$nodo = $_SESSION["Arbol"]->GetRaiz();
	$mj = $_SESSION["Arbol"]->Altura($nodo);
	if ($mj >= 0&& $mj != "False" ) echo "<script type='text/javascript'>alert('Altura: $mj');</script>";
	if($mj == "False" ) echo "<script type='text/javascript'>alert('Debe primero crear un árbol');</script>";
}


?>
<script type="text/javascript" name="EliminarNodo">
var msj = "<?php 
if(isset($_POST["EliminarNodo"]) != null && isset($_POST["SonNodo"])){
	$nodo = $_SESSION["Arbol"]->GetRaiz();
	$mj = $_SESSION["Arbol"]->EliminarNodo($nodo,$_POST["SonNodo"] );
	echo $mj;
}
?>";

 if (msj == "false"){ 
	 alert("El nodo no puede eliminarse (no es un nodo hoja o no existe)");
	}

</script>

    	
    	<script type="text/javascript">


	    	var nodos = new vis.DataSet([
	        	<?php
	        		$_SESSION["Arbol"]->VisualizarNodo($_SESSION["Arbol"]->GetRaiz());
	        	?>
	        ]);


	        var aristas = new vis.DataSet([
        		<?php
                
              		$_SESSION["Arbol"]->VisualizarArista($_SESSION["Arbol"]->GetRaiz());
        		?>
        	]);


		    var contenedor = document.getElementById("Arbol");

			var opciones = {
					layout: {
						hierarchical: {
							direction: "UD",
							sortMethod: "directed",
						},
					},
					nodes: {
          
         		 borderWidth: 0		
        },
					edges: {
						arrows: "to"
					},
				};

		    var datos = {
		        nodes: nodos,
		        edges: aristas
		    };


		    var grafo = new vis.Network(contenedor,datos,opciones);


    	</script>

</body>

</html>




<script type="text/javascript" name="Recorridos">
var ms = "<?php 

if(isset($_POST["RecorridoPreorden"]) != null){
	$_SESSION["Arbol"]->RecorridoPreOrden($_SESSION["Arbol"]->GetRaiz());	
}elseif(isset($_POST["RecorridoEnorden"]) != null ){
	$_SESSION["Arbol"]->RecorridoInOrden($_SESSION["Arbol"]->GetRaiz());
}elseif(isset($_POST["RecorridoPosorden"]) != null ){
	$_SESSION["Arbol"]->RecorridoPosOrden($_SESSION["Arbol"]->GetRaiz());
}elseif(isset($_POST["RecorridoPorNivel"]) != null && isset($_POST["Nivel"])){
	$nodo = $_SESSION["Arbol"]->GetRaiz();
	$mj = $_SESSION["Arbol"]->RecorridoPorNivel($_POST["Nivel"], $nodo);
	echo " (N° nodos: ".$mj.")";
}elseif (isset($_POST["VerNodosHojas"]) != null) {
	$msj = $_SESSION["Arbol"]->NodosHijos($_SESSION["Arbol"]->GetRaiz());
	echo $msj;
}

?>";
if(ms != "" && ms != "False"){
	alert(ms);
}
if(ms == "False"){
	alert("Debe primero crear un árbol");
}

</script>

<script type="text/javascript" name="ArbolCompleto">
var msj = <?php 
if (isset($_POST["ArbolCompleto"]) != null){
	$nodo = $_SESSION["Arbol"]->GetRaiz();
	$_SESSION["Arbol"]->ArbolCompleto($nodo);
	
}
?>;
if(msj == 0) msj = alert("Árbol completo");
if(msj > 0) msj = alert("Árbol incompleto, faltan "+msj+" nodos");
if(msj == "false") alert("Debe primero crear un árbol") ;


</script>



