<?php 

		

		class Nodo{

			private $Id;
			private $Left;
			private $Right;


			public function __construct($i){
				$this->$Id = $i;
				$this->$Left = null;
				$this->$Right = null;
			}

			public function GetId(){
				return $this->Id;
			}

			public function GetLeft(){
				return $this->Left;
			}

			public function GetRight(){
				return $this->Right;
			}

			public function SetId($i){
				$this->Id = $i;
			}

			public function SetLeft($iz){
				$this->Left = $iz;
			}

			public function SetRight($dc){
				$this->Right = $dc;
			}

		}



?>