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


$sqlPegaAvaliacao = mysqli_query($conexao, "SELECT * FROM avaliacao WHERE empresa_id = '$empresa_id'") or die(mysqli_error($conexao));

$array_retorno = array();

while($rows = mysqli_fetch_array($sqlPegaAvaliacao)){
	
	$usuario_id = $rows['usuario_id'];
	
	$sqlPegaFavoritos = mysqli_fetch_assoc(mysqli_query($conexao, "SELECT * FROM usuarios WHERE id = '$usuario_id'")) or die(mysqli_error($conexao));
	
	$enviarArray['id'] = $rows['id'];
	$enviarArray['comentario'] = $rows['comentario'];
	$enviarArray['nota'] = $rows['nota'];
	$enviarArray['usuarioNome'] = $sqlPegaFavoritos['nome'];
	$enviarArray['usuarioSobrenome'] = $sqlPegaFavoritos['sobrenome'];
	
	array_push($array_retorno, $enviarArray);
	
}


echo json_encode($array_retorno);
?>