<?php

//**EXEMPLO DE FUNCIONAMENTO*** $Connection = new mysqli( 'localhost', 'usuario', 'senha', 'nome_da_db' );

$conexao = mysqli_connect("aldeiaconnect.mysql.dbaas.com.br", "aldeiaconnect", "Password1234", "aldeiaconnect");

if(mysqli_connect_errno()){
	echo 'Erro na conexão:'.mysqli_connect_errno();
}

?>