<?php
	require_once("classes/guarda.php");

	$acao = $_POST['acao'];

	if($acao == 'cadastrar'){
		$nome 		= $_POST['nomeGuarda'];
		$rg 		= $_POST['rgGuarda'];
		$senha 		= $_POST['senhaGuarda'];
		$entrada 	= $_POST['entradaGuarda'];
		$saida 		= $_POST['saidaGuarda'];
		$sexo 		= $_POST['sexoGuarda'];

		$guarda = new Guarda();

		$guarda->setNome($nome);
		$guarda->setRg($rg);
		$guarda->setSenha($senha);
		$guarda->setEntrada($entrada);
		$guarda->setSaida($saida);
		$guarda->setSexo($sexo);

		$guarda->insert();

	}

?>