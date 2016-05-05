<?php
	//classe com os métodos relativos aos guardas que não estão declarados em CRUD e com a implementação dos métodos abstratos

	require_once('CRUD.php');

	class Guarda extends CRUD{

		protected $tabela = 'guardas';

		//variáveis que armazenarão os dados a serem inseridos.
		
		private $rg;
		private $nome;
		private $sexo;
		private $entrada;
		private $saida;
		private $senha;

		public function insert(){
			$sql 	= "INSERT INTO $this->tabela VALUES :rg,:nome,:sexo,:entrada,:saida,:senha";
			$stmt 	= BD::prepare($sql);
			//usa-se $this->rg e não $rg porque se está acessando uma variável global
			$stmt->bindParam(':rg', 	$this->rg);
			$stmt->bindParam(':nome', 	$this->nome);
			$stmt->bindParam(':sexo',	$this->sexo);
			$stmt->bindParam('entrada',	$this->entrada);
			$stmt->bindParam(':saida',	$this->saida);
			$stmt->bindParam(':senha',	$this->senha);

		}

		public function update(){
			$sql	 	= "UPDATE $this->tabela SET nome = :nome, sexo = :sexo, entra = :entrada, saida = :saida, senha =:senha WHERE rg = :rg";
			$stmt 		= BD::prepare($sql);

			$stmt->bindParam(':rg', 	$this->rg);
			$stmt->bindParam(':nome', 	$this->nome);
			$stmt->bindParam(':sexo',	$this->sexo);
			$stmt->bindParam('entrada',	$this->entrada);
			$stmt->bindParam(':saida',	$this->saida);
			$stmt->bindParam(':senha',	$this->senha);
		}

		//função que realiza o login do guarda no sistema. Possui um parâmetro senha, pois precisa comparar a string em texto plano com a senha criptografada no banco e a vriável global $senha, só recebe o valor já criptografado.

		public function login($senha){
			
			

			//chama a função "buscaRG" da classe mãe e armazena seu valor em uma variável
			$valor = parent::buscaRG($rg);
			//se a variável não estiver vazia, verifica se a senha em texto plano bate com a senha criptografada(hash) no banco
			if(!empty($valor)){
				$hash = $valor->senha;
				//função que compara a string em texto plano e a hash
				if(password_verify($senha,$hash)){
					//se os valores baterem, a função retorna o rg do guarda, que será passado para a próxima tela
					return $valor->rg;
				}
				else{
					return false;
				}
			}
			else{
				return false;
			}
		}

		//setters das variáveis globais. A classe não terá getters, pois, como se conecta com o banco, pega os valores direto dele

		public function setRg($rg){
			$this->rg = $rg;
		}

		public function setNome($nome){
			$this->nome = $nome;
		}

		public function setSexo($sexo){
			$this->sexo = $sexo;
		}

		public function setEntrada($entrada){
			$this->entrada = $entrada;
		}

		public function setSaida($saida){
			$this->saida = $saida;
		}

		public function setSenha($senha){
			//atribui à variável global "senha", o valor criptorafado da senha cadastrada pelo usuário
			$this->senha = password_hash($senha,PASSWORD_DEFAULT);
		}
	}
?>