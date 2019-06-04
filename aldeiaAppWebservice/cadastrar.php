<?php

header('Access-Control-Allow-Origin: *');
header("Content-type: application/json; charset=utf-8");
header('Content-Type: text/html; charset=utf-8');


require("conexaoPDO.php");

$nome = $_POST['nome'];
$sobrenome = $_POST['sobrenome'];
$email = $_POST['email'];
$password = $_POST['password'];

$sqlVerificaExiste = mysqli_num_rows(mysqli_query($conexao, "SELECT * FROM usuarios WHERE email = '$email'"));

if($sqlVerificaExiste == 0){
    $sqlCadastra = mysqli_query($conexao, "INSERT INTO usuarios (nome, sobrenome, email, senha, lastLogin)VALUES('$nome', '$sobrenome', '$email','$password', NOW())");
    echo 'ok';
}else{
    echo 'jaexiste';
}


?>