<?php

if(isset($_POST['acao'])){
    require("conexaoPDO.php");

	$email = $_POST['email'];
	$password = $_POST['password'];

	//$email = $_GET['email'];
	//$password = $_GET['password'];

	if(!empty($email)){
		//$email = mysql_real_escape_string($conexao, $_POST['email']);
	//$password = mysql_real_escape_string($conexao, $_POST['password']);
	$selectUser = "SELECT * FROM admin WHERE email = '$email' AND password = '$password'";
	$runUser = mysqli_query($conexao, $selectUser) or die(mysqli_error($conexao));
	$verifica = mysqli_num_rows($runUser);
        if($verifica != 0){
            session_start();
            $_SESSION['aldeia_email'] = $email;
			header("location:index.php");
        }else{
            echo '<script>alert("Este Usuario não Existe!")</script>'; //USER NOT EXIST!!!
        }
	}else{
		echo '<script>alert("Email ou Senha inválidos!")</script>';
		echo '<script>history.back()</script>';
		exit;
	}
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">	
<title>Painel de Controle</title>


	<!--OPTMEDIA CALLS-->
	<link href="css/style.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="../optmedia/js/jquery-3.3.1.min.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    
    
</head>

<body class="optmedia-font">
    <div class="login-box">
        <form action="" method="post">
            <input type="email" name="email" placeholder="email">
            <input type="password" name="password" placeholder="senha">
            <input type="hidden" name="acao" value="login">
            <input style="cursor: pointer;" type="submit" value="ENTRAR">
        </form>
    </div>
</body>
</html>