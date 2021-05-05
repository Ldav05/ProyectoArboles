<?php 

	include('Nodos.php');


	class ArbolB{

		private $raiz;


		public function __construct(){
			$this->raiz = null;
		}


		public function LlenarR($nodo){
			$this->raiz = $nodo;
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

			if ($this->BuscarNodo($nodoP,$nodoP->GetId())) {
				if ($pos=="I") {
					$nodoP->SetLeft($nodo);
				}else{
					if ($pos=="D") {
						$nodoP->SetRight($nodo);
					}
				}
			}

		}




		public function ContarNodos($Nodo){
			if ($Nodo != null) {
				if ($Nodo->GetLeft() || $Nodo->GetRight()) {
					return (1+ $this->ContarNodos($Nodo->Left()) + $this->ContarNodos($Nodo->Right()));
				}else{
					return 1;
				}
			}else{
				return 0;
			}
		}



		

	}






?>