<?php

include 'Nodos.php';

class ArbolB {

	private $raiz;

	public function __construct() {
		$this->raiz = null;
	}

	public function CrearArbol($nodo) {
		$this->raiz = $nodo;
	}

	public function GetRaiz() {
		return $this->raiz;
	}

	public function SetRaiz($status){
		$this->raiz = null;
	}

	public function BuscarNodo($nodo, $idNodo) {
		if ($nodo == null) {
			return null;
		} else {
			if ($nodo->GetId() == $idNodo) {
				return $nodo;
			} else {
				$right = $this->BuscarNodo($nodo->GetRight(), $idNodo);
				$left = $this->BuscarNodo($nodo->GetLeft(), $idNodo);

				if ($right != null) {
					return $right;
				} else {
					return $left;
				}
			}
		}
	}

	public function AgregarNodo($nodo, $pos, $nodoP) {
		$Dad = $this->BuscarNodo(self::GetRaiz(), $nodoP);
		$Son = $this->BuscarNodo(self::GetRaiz(), $nodo->GetId());
		if($Son == null){
			if ($Dad != null) {
				if ($pos == "I") {
					if($Dad->GetLeft() != null || $Dad->GetLeft() != null){
						$ante = $Dad->GetLeft();
						$Dad->SetLeft($nodo);
						$nodo->SetLeft($ante);
					}else{
						$Dad->SetLeft($nodo);
					}	
				} else {
					if ($pos == "D") {
						if($Dad->GetRight() != null || $Dad->GetRight() != null){
							$ante = $Dad->GetRight();
							$Dad->SetRight($nodo);
							$nodo->SetRight($ante);
						}else{
							$Dad->SetRight($nodo);
						}					
					}
				}
			} else {
				return "Nodo padre inexistente";
			}
		}else{
			return "Ya hay un nodo con este nombre, por favor intente con otro";
		}

	}

	public function EliminarNodo($nodo, $idNodo){
		if ($nodo != null) {
				if($nodo->GetId() == $idNodo && $nodo->GetRight() == null && $nodo->GetLeft() == null ){
					self::SetRaiz(null);
				}else{
					if($nodo->GetRight() != null) if (($nodo->GetRight())->GetId() == $idNodo && ($nodo->GetRight()->GetRight() == null && $nodo->GetRight()->GetLeft() == null)) {
						if($nodo->GetRight()->GetRight() != null && $nodo->GetRight()->GetLeft() != null){
							return "false";
						}else{
							return $nodo->SetRight(null);
						}
					}
					if($nodo->GetLeft() != null) if(($nodo->GetLeft())->GetId() == $idNodo && ($nodo->GetLeft()->GetRight() == null && $nodo->GetLeft()->GetLeft() == null)){
						if($nodo->GetLeft()->GetRight() != null && $nodo->GetLeft()->GetLeft() != null){
							return "false";
						}else{
							return $nodo->SetLeft(null);
						}
					}
			
					$right = $this->EliminarNodo($nodo->GetRight(), $idNodo);
					$left = $this->EliminarNodo($nodo->GetLeft(), $idNodo);
	
					if ($right != "false") {
						return $right;
					} else {
						return $left;
					}		
				}				
			} else {
			return "false";
			
			}
		}
	
	

	public function ContarNodos($Nodo) {
		if(self::GetRaiz() != null){
			if ($Nodo != null) {
				if ($Nodo->GetLeft() || $Nodo->GetRight()) {
					return (1 + $this->ContarNodos($Nodo->GetLeft()) + $this->ContarNodos($Nodo->GetRight()));
				} else {
					return 1;
				}
			} else {
				return 0;
			}
		}else{
			return "False";
		}
	}

	public function ContarNumerosPares($Nodo) {
		if(self::GetRaiz() != null){
			if ($Nodo != null) {
				if ($Nodo->GetLeft() || $Nodo->GetRight()) {
					if ($Nodo->GetId() % 2 == 0) {
						return (1 + $this->ContarNumerosPares($Nodo->GetLeft()) + $this->ContarNumerosPares($Nodo->GetRight()));
					} elseif ($Nodo->GetId() % 2 != 0) {
						return ($this->ContarNumerosPares($Nodo->GetLeft()) + $this->ContarNumerosPares($Nodo->GetRight()));
					}
	
				} else {
					if ($Nodo->GetId() % 2 == 0) {
						return 1;
					} elseif ($Nodo->GetId() % 2 != 0) {
						return 0;
					}
				}
			} else {
				return 0;
			}
		}else{
			return "False";
		}
	}

	public function VisualizarNodo($Nodo) {
		if ($Nodo != null) {
			$msj = $Nodo->GetId();
			if($msj == self::GetRaiz()->GetId()){
				echo "{id: '$msj' , label: '$msj', shape: 'circularImage', image:'seed.jpg'},";
			}elseif($Nodo->GetLeft() ==null && $Nodo->GetRight()==null){
				echo "{id: '$msj' , label: '$msj', shape: 'circularImage', image:'hoja.jpg'},";
			}else{
				echo "{id: '$msj' , label: '$msj', shape: 'circularImage', image:'fruit.jpg'},";
			}	
			$this->VisualizarNodo($Nodo->GetLeft());
			$this->VisualizarNodo($Nodo->GetRight());
		}
	}

	public function VisualizarArista($Nodo) {
		if ($Nodo != null) {
			$id = $Nodo->GetId();

			if ($Nodo->GetLeft() != null) {
				$des = $Nodo->GetLeft()->GetId();
				echo "{from: '$id', to: '$des', color:{color:'brown'}},";
			}

			if ($Nodo->GetRight() != null) {
				$des = $Nodo->GetRight()->GetId();
				echo "{from: '$id', to: '$des', color:{color:'brown'}},";
			}

			$this->VisualizarArista($Nodo->GetLeft());
			$this->VisualizarArista($Nodo->GetRight());

		}
	}

	public function RecorridoPreOrden($Nodo) {
			if ($Nodo != null) {
				echo $Nodo->GetId() . "->";
				$this->RecorridoPreOrden($Nodo->GetLeft());
				$this->RecorridoPreOrden($Nodo->GetRight());
			}else{		
			if(self::GetRaiz() == null)echo "False";	
			return "False";
		}
	}

	public function RecorridoInOrden($Nodo) {
			if ($Nodo != null) {
				$this->RecorridoInOrden($Nodo->GetLeft());
				echo $Nodo->GetId() . "->";
				$this->RecorridoInOrden($Nodo->GetRight());
			}else{
			if(self::GetRaiz() == null)echo "False";
			return "False";
		}
	}
	

	public function RecorridoPosOrden($Nodo) {
			if ($Nodo != null) {
				$this->RecorridoPosOrden($Nodo->GetLeft());
				$this->RecorridoPosOrden($Nodo->GetRight());
				echo $Nodo->GetId() . "->";
			}else{
			if(self::GetRaiz() == null)echo "False";
			return "False";
		}
	}

	public function RecorridoPorNivel($nivel, $Nodo, $count = 1) {
		if(self::GetRaiz() != null){
			if ($Nodo != null) {
				if ($Nodo->GetLeft() || $Nodo->GetRight()) {
					if ($count == $nivel) {
						echo $Nodo->GetId() . "->";
						return (1 + $this->RecorridoPorNivel($nivel, $Nodo->GetLeft(), $count + 1) + $this->RecorridoPorNivel($nivel, $Nodo->GetRight(), $count + 1));
					} else {
						return ($this->RecorridoPorNivel($nivel, $Nodo->GetLeft(), $count + 1) + $this->RecorridoPorNivel($nivel, $Nodo->GetRight(), $count + 1));
					}
	
				} else {
					if ($count == $nivel && $Nodo != null) {
						echo $Nodo->GetId() . "->";
						return 1;
					} else {
						return 0;
					}
	
				}
			} else {
				return 0;
			}
		}else{
			return "False";
		}
	}

	public function Altura($Nodo, $Count = 0) {
		if(self::GetRaiz() != null){
			if ($Nodo != null) {
				if ($Nodo->GetLeft() || $Nodo->GetRight()) {
					$Count = max($this->Altura($Nodo->GetLeft()), $this->Altura($Nodo->GetRight()));
				}
				return $Count+1;	
			}else{
				return 0;
			}
	
		}else{
			return "False";
		}
	}

	public function NodosHijos($Nodo){
		if(self::GetRaiz() != null){
			$cont = null;
		if ($Nodo != null) {
			if (($Nodo->GetLeft() == null ) && ($Nodo->GetRight() == null)) {
				$id = $Nodo->GetId();
				echo $cont = "->".$id.$cont;
			}
			$this->NodosHijos($Nodo->GetLeft());
			$this->NodosHijos($Nodo->GetRight());
		} else {
			return 0;
		}
		}else{
			return "False";
		}
	}
   
	public function ArbolCompleto($Nodo){
		if(self::GetRaiz() != null){
			if($Nodo != null){
				if($Nodo->GetLeft() || $Nodo->GetRight()){
					if (($Nodo->GetLeft() == null ) xor ($Nodo->GetRight() == null)){
						echo "1+";
					}
					$this->ArbolCompleto($Nodo->GetLeft());
					$this->ArbolCompleto($Nodo->GetRight());
					
				}else{
					echo "0";
					return false;
				}
			 }else{
				 return false;
			 }
		}else{
			return "'False'";
		}
   }

   
}
	

?>