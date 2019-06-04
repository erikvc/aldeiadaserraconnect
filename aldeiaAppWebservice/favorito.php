<?php

header('Access-Control-Allow-Origin: *');
header("Content-type: application/json; charset=utf-8");
header('Content-Type: text/html; charset=utf-8');


require("conexaoPDO.php");

$empresaID = $_GET['empresa_id'];
$usuarioEmail = $_GET['usuario_email'];

$sqlPegaUsuarioinfo = mysqli_fetch_assoc(mysqli_query($conexao, "SELECT * FROM usuarios WHERE email = '$usuarioEmail'"));

$usuarioID = $sqlPegaUsuarioinfo['id'];

$sqlVerificaExiste = mysqli_query($conexao, "SELECT * FROM favoritos WHERE usuario_id = '$usuarioID' AND empresa_id = '$empresaID'");
$contagem = mysqli_num_rows($sqlVerificaExiste);

if($contagem == 0){
	$sqlInsereFavorito = mysqli_query($conexao, "INSERT INTO favoritos (usuario_id, empresa_id)VALUES('$usuarioID', '$empresaID')");
}else{
	$sqlDeleteFavorito = mysqli_query($conexao, "DELETE FROM favoritos WHERE usuario_id = '$usuarioID' AND empresa_id = '$empresaID'");
}


?>