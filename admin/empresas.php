<?php
	require('phpFunctions.php');
    if(isset($_GET['delEmpresa'])){
        $categoriaID = $_GET['delEmpresa'];
        $delImage = $_GET['delImage']; 
        $sqlDeletaCategoria = mysqli_query($conexao, "DELETE FROM empresas WHERE id = '$categoriaID'");
        $removeTemp = unlink('../optmedia/images/empresas/'.$delImage);
        echo '<script>window.location.href="empresas.php"</script>';
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

    <h4 class="margin"><a href="newEmpresa.php">Criar Nova Empresa</a></h4>
    
<div class="row" style="padding: 20px;">   
<table class="table table-bordered">
  <thead>
    <tr>
        <th width="834" bgcolor="#F1F1F1" scope="col">nome</th>
        <th width="107" align="center" valign="middle" bgcolor="#F1F1F1" scope="col">logo</th>
        <th width="107" align="center" valign="middle" bgcolor="#F1F1F1" scope="col">Subcategoria</th>    
        <th width="134" align="center" valign="middle" bgcolor="#F1F1F1" scope="col">Status Pagamento </th>
        <th width="134" align="center" valign="middle" bgcolor="#F1F1F1" scope="col">Descrição </th>
        <th width="134" align="center" valign="middle" bgcolor="#F1F1F1" scope="col">Endereço </th>
        <th width="134" align="center" valign="middle" bgcolor="#F1F1F1" scope="col">Telefone </th>
        <th width="134" align="center" valign="middle" bgcolor="#F1F1F1" scope="col">Celular </th>
        <th width="134" align="center" valign="middle" bgcolor="#F1F1F1" scope="col">Website </th>
        <th width="134" align="center" valign="middle" bgcolor="#F1F1F1" scope="col">Email </th>
        <th width="134" align="center" valign="middle" bgcolor="#F1F1F1" scope="col">Facebook </th>
        <th width="134" align="center" valign="middle" bgcolor="#F1F1F1" scope="col">Instagram </th>
        <th width="134" align="center" valign="middle" bgcolor="#F1F1F1" scope="col">Ferramentas </th>
    </tr>
  </thead>
  <tbody>
      <?php
        $sqlPegaEmpresas = mysqli_query($conexao, "SELECT * FROM empresas");  
        while($rowsCategorias = mysqli_fetch_array($sqlPegaEmpresas)){
            
            $categoria_id = $rowsCategorias['subcategoria_id'];
            $sqlPegaSubCategorias = mysqli_fetch_assoc(mysqli_query($conexao, "SELECT * FROM subcategorias WHERE id = '$categoria_id'"));
            
      ?>
    <tr>
      <th bgcolor="#F7F7F7" scope="row"><?php echo $rowsCategorias['nome']; ?></th>
      <td align="center" valign="middle" bgcolor="#F7F7F7"><img src="../optmedia/images/empresas/<?php echo $rowsCategorias['logo']; ?>" width="84" height="84" alt=""/></td>  
        
      <td bgcolor="#F7F7F7"><?php echo $sqlPegaSubCategorias['title']; ?></td>
        
        <td align="center" valign="middle" bgcolor="#F7F7F7"><?php echo $rowsCategorias['statusPagamento']; ?></td> 
      <td align="center" valign="middle" bgcolor="#F7F7F7"><?php echo $rowsCategorias['descricao']; ?></td>    
      <td align="center" valign="middle" bgcolor="#F7F7F7"><?php echo $rowsCategorias['endereco']; ?></td>
        <td align="center" valign="middle" bgcolor="#F7F7F7"><?php echo $rowsCategorias['telefone']; ?></td>
        <td align="center" valign="middle" bgcolor="#F7F7F7"><?php echo $rowsCategorias['celular']; ?></td>
        <td align="center" valign="middle" bgcolor="#F7F7F7"><?php echo $rowsCategorias['website']; ?></td>
        <td align="center" valign="middle" bgcolor="#F7F7F7"><?php echo $rowsCategorias['emailContact']; ?></td>
        <td align="center" valign="middle" bgcolor="#F7F7F7"><?php echo $rowsCategorias['facebook']; ?></td>
        <td align="center" valign="middle" bgcolor="#F7F7F7"><?php echo $rowsCategorias['instagram']; ?></td>
      <td align="center" valign="middle" bgcolor="#F7F7F7"><a href="#">editar</a> | <a href="?delEmpresa=<?php echo $rowsCategorias['id']; ?>&delImage=<?php echo $rowsCategorias['logo']; ?>">deletar</a></td>
    </tr>
      <?php } ?>
  </tbody>
</table>
</div>     
</section>    
</body>
</html>