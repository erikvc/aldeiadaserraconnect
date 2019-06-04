<?php

header('Access-Control-Allow-Origin: *');
header("Content-type: application/json; charset=utf-8");
header('Content-Type: text/html; charset=utf-8');


require("conexaoPDO.php");

	$email = $_POST['email'];
	$password = $_POST['senha'];

	//$email = $_GET['email'];
	//$password = $_GET['password'];

	if(!empty($email)){
		$selectUser = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$password'";
		$runUser = mysqli_query($conexao, $selectUser) or die(mysqli_error($conexao));
		$verifica = mysqli_num_rows($runUser);
        if($verifica != 0){
			$dataAtual = date("Y-m-d");
			$SQLLastLogin = mysqli_query($conexao, "UPDATE usuarios SET lastLogin=NOW() WHERE email = '$email'");
            echo 'ok';
        }else{
            echo 'erro1'; //USER NOT EXIST!!!
        }
	}else{
		echo "erro2"; //EMAIL FIELD VAZIO!!!!!
	}


?>