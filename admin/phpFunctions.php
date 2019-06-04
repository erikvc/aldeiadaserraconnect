<?php

require("conexaoPDO.php");

//VERIFICA SE ESTÁ LOGADO
session_start();
//$_SESSION['edu_email'] = 'erik@optmedia.net';
if(!isset($_SESSION['aldeia_email'])){
	header("location:login.php");
}
//*************************


//LOGOUT*************************************************

if(isset($_GET['logout']) && $_GET['logout'] == 'ok'):
        unset($_SESSION['aldeia_email']);
		session_destroy();
		header('location:login.php');
endif;

//LOGOUT*************************************************/

?>