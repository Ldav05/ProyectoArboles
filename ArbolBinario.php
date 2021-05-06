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


		public function RecorridoPreOrden($Nodo){
			if($Nodo != null){
				return $Nodo->GetId()." - ";
				RecorridoPreOrden($Nodo->GetLeft());
				RecorridoPreOrden($Nodo->GetRight());
			}
		}



		

	}






?>