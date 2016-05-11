<?php

	//ATENÇÃO, ALTO NÍVEL DE GAMBIARRA. PROSSIGA POR SUA CONTA E RISCO.
	require_once('CRUD.php');
	require_once('visitante.php');

	date_default_timezone_set("America/Sao_Paulo"); //define a zona de tempo em que estamos trabalhando.
	
	class Visita extends CRUD{

		
		protected $tabela = 'visitas';
		
		private $numero;
		private $data;
		private $nomeVisitante;
		private $rgVisitante;
		private $rgGuarda;
		private $entrada;
		
		private $instituicao;
		private $observacao;

		//sem a hora de saída, pois a inserção é feita quando a visita chega no prédio
		public function insert(){
			 $this->data = date("d/m/y");
			 $visitante = new Visitante(); //objeto da classe "Visitante", para que possamos buscar pelo RG de uma visita e ver se o mesmo está cadastrado no sistema e, assim, puxar os dados que faltam.
			 $consultaVisitante = $visitante->buscaRG($this->rgVisitante);
			if(!empty($consultaVisitante)){	
				
				$this->nomeVisitante = $consultaVisitante->nome;
				$this->entrada = date('H:i');

				$sql = "INSERT INTO $this->tabela(data,nomeVisitante,rgVisitante,rgGuarda,entrada, saida, instituicao,observacao) VALUES (:data, :nomeVisitante, :rgVisitante, :rgGuarda, :entrada, :saida,  :instituicao, :observacao)";
			
				$stmt = BD::prepare($sql);
				$stmt->bindParam(':data',			$this->data);
				$stmt->bindParam(':nomeVisitante', 	$this->nomeVisitante);
				$stmt->bindParam(':rgVisitante',	$this->rgVisitante);
				$stmt->bindParam(':rgGuarda', 		$this->rgGuarda);
				$stmt->bindParam(':entrada',		$this->entrada);
				$stmt->bindParam(':saida',			'pendente');
				$stmt->bindParam(':instituicao',	$this->instituicao);
				$stmt->bindParam(':observacao',		$this->observacao);

			 	$stmt->execute();

			 	
				


				return true;
			}
			else{
				return false;
			}
		}

		//nessa classe específica, a função update servirá, apenas, para dizer em que horário a visita deixou o prédio. Caso o guarda queira alterar uma visita, deve excluí-la e fazê-la de novo.
		public function update(){
			$saida = date("H:i"); //pega a hora de acordo com a zona temporal definida

			//seta o numero da visita na variável global buscando por um registro que mostre o rgs de guarda e visitante iguais aos relacionados na visita e onde a saída ainda esteja vazia, indicando que a visita ainda não foi finalizada
			$sql = "SELECT * FROM $this->tabela WHERE rgGuarda = :rgGuarda AND rgVisitante = :rgVisitante AND saida = 'pendente'";

			$stmt = BD::prepare($sql);
			$stmt->bindParam(':rgGuarda',	$this->rgGuarda);
			$stmt->bindParam('rgVisitante',	$this->rgVisitante);

			$stmt->execute();

			$valor = $stmt->fetch();

			$this->numero = $valor->numero;

			$sql = "UPDATE $this->tabela SET saida = :saida WHERE numero = :numero";

			$stmt = BD::prepare($sql);
			$stmt->bindParam(':saida', 	$saida);
			$stmt->bindParam(':numero', $this->numero);

			$stmt->execute();
			
		}

		
		public function setRgGuarda($rgGuarda){
			$this->rgGuarda = $rgGuarda;
		}

		public function setRgVisitante($rgVisitante){
			$this->rgVisitante = $rgVisitante;
		}

		public function setInstituicao($instituicao){
			$this->instituicao = $instituicao;
		}

		public function setObservacao($observacao){
			$this->observacao = $observacao;
		}
		
	}



?>