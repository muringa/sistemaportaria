<?php
	require_once('CRUD.php');

	class Visitante extends CRUD{
		protected $tabela = 'visitantes';

		private $rg;
		private $nome;
		private $sexo;
		private $telefone;
		private $empresa;

		public function insert(){
			$sql = "INSERT INTO $this->tabela VALUES :rg, :nome, :sexo, :telefone, :empresa";

			$stmt = BD::prepare($sql);
			$stmt->bindParam(':rg', 		$this->rg);
			$stmt->bindParam(':nome', 		$this->nome);
			$stmt->bindParam(':sexo', 		$this->sexo;
			$stmt->bindParam(':telefone', 	$this->telefone);
			$stmt->bindParam(':empresa', 	$this->empresa);
		}

		public function update(){
			$sql = "UPDATE $this->tabela SET nome = :nome, sexo = :sexo, telefone = :telefone, empresa = :empresa WHERE rg = :rg ";

			$stmt = BD::prepare($sql);
			$stmt->bindParam(':rg',		 	$this->rg);
			$stmt->bindParam(':nome', 		$this->nome);
			$stmt->bindParam(':sexo', 		$this->sexo;
			$stmt->bindParam(':telefone',	$this->telefone);
			$stmt->bindParam(':empresa',	$this->empresa);
		}

		public function setRG($rg){
			$this->rg = $rg;
		}

		public function setNome($nome){
			$this->nome = $nome;
		}

		public function setSexo($sexo){
			$this->sexo = $sexo;
		}

		public function setTelefone($telefone){
			$this->telefone = $telefone;
		}

		public function setEmpresa($empresa){
			$this->empresa = $empresa;
		}

	}
?>