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
    <script type="text/javascript" src="vis/dist/vis.js"></script>
    <title>Proyecto Arbol Binario</title>

    <style type="text/css">
        #Arbol {
            width: 400px;
            height: 345px;
            border: 1px solid lightgray;
            border-radius: 15px;
            margin-left: 100px;
            position: relative;
            background: #ffffff6c;
        }
    </style>
</head>

<body>

    <header>
        <h1>Arbol Binario</h1>
        <hr>

    </header>
    <div>
        <h3>Crear arbol</h3>
        <form class="Arbol" action="Index.php" method="post">
            <input class="item" type="number" name="Raiz" placeholder="Raiz Arbol">
            <input class="Boton" type="submit" name="Crear_Arbol" value="Crear Arbol"><br><br>
            <input class="item" type="number" name="Dad" placeholder="Nombre padre">
            <input type="radio" name="Ubication" value="I"><label for="Left">Izquierda</label>
            <input type="radio" name="Ubication" value="D"><label for="Right">Derecha</label>
            <input class="item" type="number" name="Son" placeholder="Nombre hijo">
            <input class="Boton" type="submit" name="Crear_Hijo" value="Crear Hijo"><br><br>
            <input class="Boton" type="submit" name="Contar" value="Contar Nodos"><br><br>
        </form>
    </div>


    <div id="Arbol"></div>

    	
    	<script type="text/javascript">


	    	var nodos = new vis.DataSet([
	        	<?php
	        		$_SESSION["Arbol"]->RecorridoPreOrden($_SESSION["Arbol"]->GetRaiz());
	        	?>
	        ]);


	        var aristas = new vis.DataSet([
        		<?php
                
              		$_SESSION["Arbol"]->MostrarArista($_SESSION["Arbol"]->GetRaiz());
        		?>
        	]);


		    var contenedor = document.getElementById("Arbol");

		    var opciones = {
		        edges:{
		            arrows:{
		                to:{
		                    enabled:true
		                }
		            }
		        }/*,
		        configure:{
		            enabled:true,
		            container:undefined,
		            showButton:true
		        }*/
		    };

		    var datos = {
		        nodes: nodos,
		        edges: aristas
		    };


		    var grafo = new vis.Network(contenedor,datos,opciones);


    	</script>

</body>

</html>

<?php

if (isset($_POST["Raiz"]) && isset($_POST["Crear_Arbol"]) != null) {
	if (empty($_POST["Raiz"])) {
		echo "<script type='text/javascript'>alert('Campo vacío');</script>";
	} else {
		$Tree = new Nodo($_POST["Raiz"]);
		$_SESSION["Arbol"]->CrearArbol($Tree);
		echo "<script type='text/javascript'>alert('Arbol creado correctamente');</script>";
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
	echo "<script type='text/javascript'>alert('el numero de nodos que hay es de $mj');</script>";
}

?>