<?php

header('Access-Control-Allow-Origin: *');
header("Content-type: application/json; charset=utf-8");
header('Content-Type: text/html; charset=utf-8');


require("conexaoPDO.php");

$categoriaID = $_POST['id'];

$sqlPegaMembers = mysqli_query($conexao, "SELECT * FROM subcategorias WHERE categoria_id = '$categoriaID' ORDER BY title") or die(mysqli_error($conexao));

$array_retorno = array();

while($rows = mysqli_fetch_array($sqlPegaMembers)){
	$enviarArray['id'] = $rows['id'];
	$enviarArray['title'] = $rows['title'];
	$enviarArray['image'] = $rows['image'];
	
	array_push($array_retorno, $enviarArray);
	
}


echo json_encode($array_retorno);
?>