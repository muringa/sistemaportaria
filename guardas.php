<?php
	require_once("classes/guarda.php");

	$acao = $_POST['acao'];
	$guarda = new Guarda();
	if($acao == 'cadastrar'){
		$nome 		= $_POST['nomeGuarda'];
		$rg 		= $_POST['rgGuarda'];
		$senha 		= $_POST['senhaGuarda'];
		$entrada 	= $_POST['entradaGuarda'];
		$saida 		= $_POST['saidaGuarda'];
		$sexo 		= $_POST['sexoGuarda'];

		

		$guarda->setNome($nome);
		$guarda->setRg($rg);
		$guarda->setSenha($senha);
		$guarda->setEntrada($entrada);
		$guarda->setSaida($saida);
		$guarda->setSexo($sexo);

		$guarda->insert();

	}
	else if($acao == 'listar'){
		
?>
	<div class="panel panel-default">
	  <!-- Default panel contents -->
	  <div class="panel-heading">Lista de Guardas</div>

	  <!-- Table -->
	  <table class="table">
	    <tr>
	    	<th>RG</th>
	    	<th>Nome</th>
	    	<th>Sexo</th>
	    	<th>Entrada</th>
	    	<th>Saída</th>
	    	<th>Excluir</th>
	    </tr>
	   	<?php
	   		foreach($guarda->buscaGeral() as $valor){
	   	?>
	   		<tr>
	   			<td><?php echo $valor->rg;?></td>
	   			<td><?php echo $valor->nome;?></td>
	   			<td><?php echo $valor->sexo;?></td>
	   			<td><?php echo $valor->entrada;?></td>
	   			<td><?php echo $valor->saida;?></td>
	   			<td><label for="<?php echo $valor->rg;?>" class="glyphicon glyphicon-remove"><button id="<?php echo $valor->rg;?>" style="display: none;" class="excluir"></button></label></td>
	   		</tr>

	   	<?php
	   		}
	   	?>
	   </table>
	</div>
<?php
		
	}

	else if($acao == 'excluir'){
		$rg = $_POST['rg'];
		
		$guarda->deletaRG($rg);

	?>
	<div class="panel panel-default">
	  <!-- Default panel contents -->
	  <div class="panel-heading">Lista de Guardas</div>

	  <!-- Table -->
	  <table class="table">
	    <tr>
	    	<th>RG</th>
	    	<th>Nome</th>
	    	<th>Sexo</th>
	    	<th>Entrada</th>
	    	<th>Saída</th>
	    	<th>Excluir</th>
	    </tr>
	   	<?php
	   		foreach($guarda->buscaGeral() as $valor){
	   	?>
	   		<tr>
	   			<td><?php echo $valor->rg;?></td>
	   			<td><?php echo $valor->nome;?></td>
	   			<td><?php echo $valor->sexo;?></td>
	   			<td><?php echo $valor->entrada;?></td>
	   			<td><?php echo $valor->saida;?></td>
	   			<td><label for="<?php echo $valor->rg;?>" class="glyphicon glyphicon-remove"><button id="<?php echo $valor->rg;?>" style="display: none;" class="excluir"></button></label></td>
	   		</tr>

	   	<?php
	   		}
	   	?>
	   </table>
	</div>
	
	<?php	
	}

?>