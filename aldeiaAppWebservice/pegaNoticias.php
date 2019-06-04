<?php

header('Access-Control-Allow-Origin: *');
header("Content-type: application/json; charset=utf-8");
header('Content-Type: text/html; charset=utf-8');


require("conexaoPDO.php");



$sqlPegaMembers = mysqli_query($conexao, "SELECT * FROM noticias") or die(mysqli_error($conexao));


$array_retorno = array();

while($rows = mysqli_fetch_array($sqlPegaMembers)){

	//echo $rows['imagem'];
	$enviarArray['id'] = $rows['id'];
	$enviarArray['titulo'] = $rows['titulo'];
	$enviarArray['dataInserido'] = date("d M Y", strtotime($rows['dataInserido']));
	$enviarArray['texto'] = $rows['texto'];
	$enviarArray['imagem'] = $rows['imagem'];
		
	array_push($array_retorno, $enviarArray);
	
}


echo json_encode($array_retorno);
?>