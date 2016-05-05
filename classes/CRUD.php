<?php
	require_once('BD.php');//carrega o arquivo com a classe de conexão

	//classe com métodos Create Read Update Delete padrões para serem usados pelas outras classes. Extende a classe de conexão
	abstract class CRUD extends BD{

		protected $tabela; //variável que vai armazenar a tabela do banco de dados em que as operações ocorrerão

		//funções abstratas, pois, sua implementação é obrigatória nas classes filhas, porém, depende muito das necessidades das classes filhas

		abstract public function insert();
		abstract public function update();

		//funções não abstratas, pois sua implementação não varia nas classes filhas

		//função que busca por um determinado item nas tabelas onde a PK é o RG
		public function buscaRG($rg){
			$sql = "SELECT * FROM $this->tabela WHERE rg = :rg"; //consulta SQL
			$stmt = BD::prepare($sql);// chama o método estático da classe BD que prepara a consulta para ser enviada ao banco
			$stmt->bindParam(':rg',$rg);//substitui o trecho ':rg' da consulta pelo valor do parâmetro RG passado pelo usuário
			$stmt->execute();//executa a consulta SQL
			return $stmt->fetch();//retorna o resultado da consulta de acordo com o método de retorno definido na classe BD			
		}

		//função que busca por um determinado item nas tabelas onde a PK é ID. É a mesma coisa que a de cima.
		public function buscaID($id){
			$sql = "SELECT * FROM $this->tabela WHERE id = :id"; //consulta SQL
			$stmt = BD::prepare($sql);// chama o método estático da classe BD que prepara a consulta para ser enviada ao banco
			$stmt->bindParam(':id',$id);//substitui o trecho 'id' da consulta pelo valor do parâmetro RG passado pelo usuário
			$stmt->execute();//executa a consulta SQL
			return $stmt->fetch();//retorna o resultado da consulta de acordo com o método de retorno definido na classe BD	

		}

		//f~unção que busca todos os itens de uma determinada tabela
		public function buscaGeral(){
			$sql = "SELECT * FROM $this->tabela";
			$stmt = BD::prepare($sql);
			$stmt->execute();
			return $stmt->fetchAll();//como a busca pode retornar mais de um resultado, usa-se fetchAll ao invés de fetch
		}

		//função que deleta um item específico das tabelas onde a PK é RG
		public function deletaRG($rg){
			$sql = "DELETE FROM $this->tabela WHERE rg = :rg";
			$stmt = BD::prepare($sql);
			$stmt->bindParam(':rg',$rg);
			return $stmt->execute();//como essa consulta não  retorna nada, não se associa um método de retorno a ela
		}

		//função que deleta um item específico das tabelas onde a PK é ID

		public function deletaID($id){
			$sql = "DELETE FROM $this->tabela WHERE id = :id";
			$stmt = BD::prepare($sql);
			$stmt->bindParam(':id',$id);
			return $stmt->execute();
		}
	}
?>