<?php

header('Access-Control-Allow-Origin: *');
header("Content-type: application/json; charset=utf-8");
header('Content-Type: text/html; charset=utf-8');


require("conexaoPDO.php");

$empresa_id = $_GET['empresa_id'];
$usuarioEmail = $_GET['usuarioEmail'];
$nota = $_GET['nota'];
$comentario = $_GET['comentario'];

$sqlPegaUsuarioinfo = mysqli_fetch_assoc(mysqli_query($conexao, "SELECT * FROM usuarios WHERE email = '$usuarioEmail'"));
$usuario_id = $sqlPegaUsuarioinfo['id'];



$sqlVerificaNota = mysqli_query($conexao, "SELECT * FROM avaliacao WHERE usuario_id = '$usuario_id' AND empresa_id = '$empresa_id'");

$contagem = mysqli_num_rows($sqlVerificaNota);

if($contagem == 0){
	$sqlInsereAvaliacao = mysqli_query($conexao, "INSERT INTO avaliacao (empresa_id, usuario_id, comentario, nota, creation_date)VALUES('$empresa_id', '$usuario_id', '$comentario', '$nota', NOW())") or die(mysqli_error($conexao));
	echo 'ok';
}else{
	echo 'erro';
}


?>