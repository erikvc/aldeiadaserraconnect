<?php
	require('phpFunctions.php');
    if(isset($_GET['delEmpresa'])){
        $categoriaID = $_GET['delEmpresa'];
        $delImage = $_GET['delImage']; 
        $sqlDeletaCategoria = mysqli_query($conexao, "DELETE FROM cardapio_empresa WHERE id = '$categoriaID'");
        $removeTemp = unlink('../optmedia/images/cardapio/'.$delImage);
        echo '<script>window.location.href="cardapio_empresas.php"</script>';
    }
?>
<!doctype html>
<html class="optmedia-font">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">	
<title>Aldeia da Serra Connect - Painel de Controle</title>

<!--BOOTSTRAP-->	
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css?family=Raleway:400,500,500i,700,800i" rel="stylesheet">

	<!--OPTMEDIA CALLS-->
	<link href="css/style.css" rel="stylesheet" type="text/css">
	<link href="../optmedia/css/reset.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="../optmedia/js/jquery-3.3.1.min.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function () {
    $('.navbar-light .dmenu').hover(function () {
            $(this).find('.sm-menu').first().stop(true, true).slideDown(150);
        }, function () {
            $(this).find('.sm-menu').first().stop(true, true).slideUp(105)
        });
    });
    </script>
	
</head>

<body class="font">

    <?php require('header.php') ?>
    
    
<section class="container-fluid">

    <h4 class="margin"><a href="newEmpresaCardapio.php">Criar Nova Empresa</a></h4>
    
<div class="row" style="padding: 20px;">   
<table class="table table-bordered">
  <thead>
    <tr>
        <th width="834" bgcolor="#F1F1F1" scope="col">nome</th>
        <th width="107" align="center" valign="middle" bgcolor="#F1F1F1" scope="col">logo</th>
        <th width="134" align="center" valign="middle" bgcolor="#F1F1F1" scope="col">Ferramentas </th>
    </tr>
  </thead>
  <tbody>
      <?php
        $sqlPegaEmpresas = mysqli_query($conexao, "SELECT * FROM cardapio_empresa");  
        while($rowsCategorias = mysqli_fetch_array($sqlPegaEmpresas)){
      ?>
    <tr>
      <td bgcolor="#F7F7F7" scope="row"><?php echo $rowsCategorias['nome']; ?></td>
      <td align="center" valign="middle" bgcolor="#F7F7F7"><img src="../optmedia/images/cardapio/<?php echo $rowsCategorias['logo']; ?>" width="84" height="84" alt=""/></td>  
        
      <td align="center" valign="middle" bgcolor="#F7F7F7"><a href="cardapio.php?id=<?php echo $rowsCategorias['id']; ?>">visualizar cardapios</a> | <a href="#">editar</a> | <a href="?delEmpresa=<?php echo $rowsCategorias['id']; ?>&delImage=<?php echo $rowsCategorias['logo']; ?>">deletar</a></td>
    </tr>
      <?php } ?>
  </tbody>
</table>
</div>     
</section>    
</body>
</html>