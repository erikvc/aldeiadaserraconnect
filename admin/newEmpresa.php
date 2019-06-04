<?php
	require('phpFunctions.php');
    
    if(isset($_POST['acao'])){
        $nome = $_POST['nome'];
        $subcategoria_id = $_POST['subcategoria_id'];
        $statuspagamento = $_POST['statuspagamento'];
        $descricao = $_POST['descricao'];
        $endereco = $_POST['endereco'];
        $telefone = $_POST['telefone'];
        $celular = $_POST['celular'];
        $website = $_POST['website'];
        $email = $_POST['email'];
        $facebook = $_POST['facebook'];
        $instagram = $_POST['instagram'];
        
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
				$path 		 = '../optmedia/images/empresas/'.$imgFileName;

				move_uploaded_file($_FILES['imagem']['tmp_name'], $path);
                
				
				$sqlPegaTasks = mysqli_query($conexao, "INSERT INTO empresas (nome, logo, subcategoria_id, statusPagamento, descricao, endereco, telefone, celular, website, emailContact, facebook, instagram)VALUES('$nome', '$imgFileName', '$subcategoria_id', '$statuspagamento', '$descricao', '$endereco', '$telefone', '$celular', '$website', '$email', '$facebook', '$instagram')") or die(mysqli_error($conexao));
				
				echo '<script>window.location.href="empresas.php"</script>';
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
            <label for="exampleInputEmail1">Nome</label>
            <input type="text" class="form-control" required name="nome" aria-describedby="Nome" >
          </div>
          <div class="form-group">
            <label for="imagem">Imagem</label>
            <input type="file" name="imagem" required class="form-control" id="exampleInputPassword1">
          </div>
          <div class="form-group">
              <label for="sel1">Subcategorias:</label>
              <select class="form-control" name="subcategoria_id" id="sel1">
                  <?php 
                    $sqlPegaCategorias = mysqli_query($conexao, "SELECT * FROM subcategorias");
                    while($rowsCategorias=mysqli_fetch_array($sqlPegaCategorias)){
                  ?>
                <option value="<?php echo $rowsCategorias['id']; ?>"><?php echo $rowsCategorias['title']; ?></option>
                  <?php } ?>
              </select>
          </div> 
            <div style="margin: 20px 0px 5px 0px;">Status Pagamento</div>
            <div class="form-group">
                <div class="form-check-inline">
                  <label class="form-check-label">
                    <input type="radio" value="1" class="form-check-input" name="statuspagamento">Pagante
                  </label>
                </div>
                <div class="form-check-inline">
                  <label class="form-check-label">
                    <input type="radio" value="0" checked class="form-check-input" name="statuspagamento">Não Pagante
                  </label>
                </div> 
            </div> 
            <div class="form-group">
              <label for="comment">Descrição:</label>
              <textarea class="form-control" rows="5" name="descricao" id="comment"></textarea>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Endereço</label>
              <input type="text" class="form-control" name="endereco" aria-describedby="endereco" >
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Telefone</label>
              <input type="tel" class="form-control" name="telefone" aria-describedby="telefone" >
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Celular</label>
              <input type="tel" class="form-control" name="celular" aria-describedby="celular" >
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Website</label>
              <input type="text" class="form-control" name="website" aria-describedby="website" >
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Email</label>
              <input type="email" class="form-control" required name="email" aria-describedby="email" >
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Facebook</label>
              <input type="text" class="form-control" name="facebook" aria-describedby="facebook" >
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Instagram</label>
              <input type="text" class="form-control" name="instagram" aria-describedby="instagram" >
            </div>
            <input type="hidden" name="acao" value="ok">
          <button type="submit" class="btn btn-primary">Criar Empresa</button>
        </form>
    </div>
</div>     
</section>    
</body>
</html>