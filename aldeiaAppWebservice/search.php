<?php

header('Access-Control-Allow-Origin: *');
header("Content-type: application/json; charset=utf-8");
header('Content-Type: text/html; charset=utf-8');


require("conexaoPDO.php");

$valor = $_GET['word'];

$sqlPegaMembers = mysqli_query($conexao, "SELECT * FROM empresas WHERE nome LIKE '%$valor%'") or die(mysqli_error($conexao));


$array_retorno = array();

while($rows = mysqli_fetch_array($sqlPegaMembers)){

	$subcategoriaID = $rows['subcategoria_id'];
	$pegaSubcategoria = mysqli_fetch_assoc(mysqli_query($conexao, "SELECT * FROM subcategorias WHERE id = '$subcategoriaID'"));
	
	$categoriaID = $pegaSubcategoria['categoria_id'];
	$pegaSubcategoria = mysqli_fetch_assoc(mysqli_query($conexao, "SELECT * FROM categorias WHERE id = '$categoriaID'"));	
	
	$enviarArray['id'] = $rows['id'];
	$enviarArray['nome'] = $rows['nome'];
	$enviarArray['statusPagamento'] = $rows['statusPagamento'];
	$enviarArray['categoria'] = $pegaSubcategoria['title'];
		
	array_push($array_retorno, $enviarArray);
	
}


echo json_encode($array_retorno);
?>