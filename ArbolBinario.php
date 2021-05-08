<?php 

	include('Nodos.php');


	class ArbolB{

		private $raiz;


		public function __construct(){
			$this->raiz = null;
		}


		public function CrearArbol($nodo){
			$this->raiz = $nodo;
		}

		public function GetRaiz(){
			return $this->raiz;
		}

		public function BuscarNodo($nodo,$idNodo){
			if ($nodo==null) {
				return null;
			}else{
				if ($nodo->GetId()==$idNodo) {
					return $nodo;
				}else{
					$right = $this->BuscarNodo($nodo->GetRight(),$idNodo);
					$left = $this->BuscarNodo($nodo->GetLeft(),$idNodo);

					if ($right != null) {
						return $right;
					}else{
						return $left;
					}
				}
			}
		}


		public function AgregarNodo($nodo,$pos,$nodoP){

			$Dad = $this->BuscarNodo(self::GetRaiz(),$nodoP);
			if ($Dad != null) {
				if ($pos=="I") {
					$Dad->SetLeft($nodo);
				}else{
					if ($pos=="D") {
						$Dad->SetRight($nodo);
					}
				}
			}else{
				return "Nodo padre inexistente";
			}

		}




		public function ContarNodos($Nodo){
			if ($Nodo != null) {
				if ($Nodo->GetLeft() || $Nodo->GetRight()) {
					return (1+ $this->ContarNodos($Nodo->GetLeft()) + $this->ContarNodos($Nodo->GetRight()));
				}else{
					return 1;
				}
			}else{
				return 0;
			}
		}

		public function ContarNumerosPares($Nodo){
			if ($Nodo != null) {
				if ($Nodo->GetLeft() || $Nodo->GetRight()) {
					if($Nodo->GetId()%2==0){
						return (1+$this->ContarNumerosPares($Nodo->GetLeft()) + $this->ContarNumerosPares($Nodo->GetRight()));
					}elseif($Nodo->GetId()%2!=0){
						return ($this->ContarNumerosPares($Nodo->GetLeft()) + $this->ContarNumerosPares($Nodo->GetRight()));
					}
					
				}else{
					if($Nodo->GetId()%2==0){
						return 1;
					}elseif($Nodo->GetId()%2!=0){
						return 0;
					}
				}
			}else{
				return 0;
			}
		}
	


		public function VisualizarNodo($Nodo){
			if($Nodo != null){
				$msj = $Nodo->GetId();
		        echo "{id: '$msj' , label: '$msj'},";
				$this->VisualizarNodo($Nodo->GetLeft());
				$this->VisualizarNodo($Nodo->GetRight());
			}
		}

		public function VisualizarArista($Nodo){
			if ($Nodo!=null) {
				$id = $Nodo->GetId();

				if ($Nodo->GetLeft() != null) {
					$des = $Nodo->GetLeft()->GetId();
					echo "{from: '$id', to: '$des'},";
				}

				if ($Nodo->GetRight() != null) {
					$des = $Nodo->GetRight()->GetId();
					echo "{from: '$id', to: '$des'},";
				}

				$this->VisualizarArista($Nodo->GetLeft());
				$this->VisualizarArista($Nodo->GetRight());

			}
		}

		public function RecorridoPreOrden($Nodo){
			if($Nodo != null){
				echo $Nodo->GetId()." ";  
				$this->RecorridoPreOrden($Nodo->GetLeft());
				$this->RecorridoPreOrden($Nodo->GetRight());
			}
		}

		public function RecorridoInOrden($Nodo){
			if($Nodo != null){
				$this->RecorridoInOrden($Nodo->GetLeft());
				echo $Nodo->GetId()." "; 
				$this->RecorridoInOrden($Nodo->GetRight());
			}
		}

		public function RecorridoPosOrden($Nodo){
			if($Nodo != null){
				$this->RecorridoPosOrden($Nodo->GetLeft());
				$this->RecorridoPosOrden($Nodo->GetRight());
				echo $Nodo;
			}
		}

	}






?>