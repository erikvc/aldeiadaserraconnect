<?php
	require('phpFunctions.php');
    
    if(isset($_POST['acao'])){
		
		$empresa_id = $_POST['empresa_id'];
        
        $tiposPermitidos= array('gif', 'jpeg', 'jpg', 'png');
		$images    = $_FILES['imagem']['name'];
		$imagesType    = $_FILES['imagem']['type'];
		$rand	   = rand();
		$errorUpload = 'N';
		
		if (array_search($imagesType, $tiposPermitidos) != false) {
                echo '<script>alert("File Not Allowed!")</script>';
			}
			else{
				$images = str_replace("'", "", $images);
				$imgFileName = $rand.$images;
				$path 		 = '../optmedia/images/cardapio/'.$imgFileName;

				move_uploaded_file($_FILES['imagem']['tmp_name'], $path);
                
				
				$sqlPegaTasks = mysqli_query($conexao, "INSERT INTO cardapio (imagem, empresa_id)VALUES('$imgFileName', '$empresa_id')") or die(mysqli_error($conexao));
				
				echo '<script>window.location.href="cardapio.php"</script>';
			}

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

    <!--<h4 class="margin"><a href="noewCategoria.php">Criar Nova Categoria</a></h4>-->
    
<div class="row optmedia-conteudo">   
    <div>
        <form action="" method="post" enctype="multipart/form-data">
		   <div class="form-group">
              <label for="sel1">Empresas:</label>
              <select class="form-control" name="empresa_id" id="sel1">
                  <?php 
                    $sqlPegaCategorias = mysqli_query($conexao, "SELECT * FROM cardapio_empresa");
                    while($rowsCategorias=mysqli_fetch_array($sqlPegaCategorias)){
                  ?>
                <option value="<?php echo $rowsCategorias['id']; ?>"><?php echo $rowsCategorias['nome']; ?></option>
                  <?php } ?>
              </select>
          </div>	
          <div class="form-group">
            <label for="imagem">Imagem</label>
            <input type="file" name="imagem" class="form-control" id="exampleInputPassword1">
          </div>
            <input type="hidden" name="acao" value="ok">
          <button type="submit" class="btn btn-primary">Criar Cardapio</button>
        </form>
    </div>
</div>     
</section>    
</body>
</html>