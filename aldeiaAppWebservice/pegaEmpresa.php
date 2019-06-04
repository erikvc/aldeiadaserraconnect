<?php

header('Access-Control-Allow-Origin: *');
header("Content-type: application/json; charset=utf-8");
header('Content-Type: text/html; charset=utf-8');


require("conexaoPDO.php");
/*
$subcategoriaID = $_POST['id'];
$usuarioID = $_POST['usuarioID'];
*/

$empresa_id = $_GET['empresa_id'];


$sqlPegaMembers = mysqli_query($conexao, "SELECT * FROM empresas WHERE id = '$empresa_id'") or die(mysqli_error($conexao));

$array_retorno = array();

while($rows = mysqli_fetch_array($sqlPegaMembers)){
	
	$empresa_id = $rows['id'];
	
	//PEGA AVALIAÇÂO
	$sqlContagemNotas = mysqli_query($conexao, "SELECT SUM(nota) AS valor_soma FROM avaliacao WHERE empresa_id = '$empresa_id'");
	$sqlContagemArray = mysqli_fetch_assoc($sqlContagemNotas);
	$contagemNotas = $sqlContagemArray['valor_soma'];
	
	$sqlTotalVotadores = mysqli_num_rows(mysqli_query($conexao, "SELECT * FROM avaliacao WHERE empresa_id = '$empresa_id'"));
	
	
	if($contagemNotas != 0){
		$resultado =  $contagemNotas / $sqlTotalVotadores;
	}else{
		$resultado = 0;
	};

	
	$enviarArray['id'] = $rows['id'];
	$enviarArray['nome'] = $rows['nome'];
	$enviarArray['logo'] = $rows['logo'];
	$enviarArray['statusPagamento'] = $rows['statusPagamento'];
	$enviarArray['descricao'] = $rows['descricao'];	
	$enviarArray['endereco'] = $rows['endereco'];
	$enviarArray['telefone'] = $rows['telefone'];
	$enviarArray['celular'] = $rows['celular'];
	$enviarArray['website'] = $rows['website'];
	$enviarArray['emailContact'] = $rows['emailContact'];
	$enviarArray['facebook'] = $rows['facebook'];
	$enviarArray['instagram'] = $rows['instagram'];
	$enviarArray['notaMedia'] = $resultado;
	$enviarArray['totalAvaliacao'] = $sqlTotalVotadores;
		
	array_push($array_retorno, $enviarArray);
	
}


echo json_encode($array_retorno);
?>