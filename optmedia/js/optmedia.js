//ABRE E FECHA MENUUUUUU**********
$(".menu-bto").click(function(){
	$(".menu-lateral").toggle("fast");
});


//==============LOGIN================
$("#submit-login").click(function(e){
	e.preventDefault();
	var formData = $("#login-form").serialize();
	$.ajax({
		url: 'http://aldeiadaserraconnect.com.br/app/aldeiaAppWebservice/login.php',
		type: 'post',
		crossDomain: true,
		data: formData,
		dataType: 'html',
		before: function(){
			$("#login-icon").show();
			$("#submit-login").hide();
		},
		success: function(data){
			if(data == 'ok'){
				var email = $("#login-email").val();
			    $("#login-icon").hide();
			    $("#submit-login").show();
				var criaStorage = localStorage.setItem('login', email);
				$("#login-form:input").val('');
				window.location.href="index.html";
			}else if(data == 'erro1'){
				$("#login-status").html('Este usuário não existe!');
				$("#login-status").show();	 
			}else if(data == 'erro2'){
				$("#login-status").html('Todos os campos devem ser preenchidos!');
				$("#login-status").show();	 
			}else{
				$("#login-status").html('Erro ao se conectar!');
				$("#login-status").show();
			}
			
		}
	});
	
	return false;
});


/*==============================VERIFICA SE ESTA ONLINE=============================*/
function verificaConectado(){
	var verificaStorage = localStorage.getItem('login');
	if(verificaStorage == null){
	   window.location.href="login.html";
	}
}

/*===============================LOGOUT======================================*/
function logout(){
	var pegaStorage = localStorage.removeItem('login');
	window.location.href="login.html";
}



/*====================PEGA CATEGORIAS=================*/
function pegaCategorias(){
	$.ajax({
		url: "http://aldeiadaserraconnect.com.br/app/aldeiaAppWebservice/pegaCategorias.php",
		type: "post",
		crossDomain: true,
		dataType: "json",
		success: function(dados){
			$("#recebeCategorias").empty();
			for(var i=0;dados.length>i; i++){
				$("#recebeCategorias").append('<a href="#" onClick="return goToSubcategoria('+dados[i].id+');"><div class="boxBTO"><div class="capsulaTitle"><div class="titleBTO">'+dados[i].title+'</div></div><div class="bgBTO"><img src="http://aldeiadaserraconnect.com.br/app/optmedia/images/categorias/'+dados[i].image+'" alt=""/></div></div></a>');
			}
		},
		error: function(dados){
			alert(dados);
		}
	})
}

/*===================CRIA LOCALSTORAGE PARA SUBCATEGORIAS===============*/
function goToSubcategoria(id){
	var subcategorias = localStorage.setItem('categoriaID', id);
	window.location.href="subcategoria.html";
}
function goToEmpresas(id){
	var subcategorias = localStorage.setItem('subcategoriaID', id);
	window.location.href="empresas.html";
}

/*====================PEGA SUBCATEGORIAS=================*/
function pegaSubCategorias(){
	var categoriaID = localStorage.getItem('categoriaID');
	$.ajax({
		url: "http://aldeiadaserraconnect.com.br/app/aldeiaAppWebservice/pegaSubCategorias.php",
		type: "post",
		crossDomain: true,
		dataType: "json",
		data: 'id='+categoriaID,
		success: function(dados){
			$("#recebeSubCategorias").empty();
			for(var i=0;dados.length>i; i++){
				$("#recebeSubCategorias").append('<a href="#" onClick="return goToEmpresas('+dados[i].id+');"><div class="boxBTO"><div class="capsulaTitle"><div class="titleBTO">'+dados[i].title+'</div></div><div class="bgBTO"><img src="http://aldeiadaserraconnect.com.br/app/optmedia/images/subcategorias/'+dados[i].image+'" alt=""/></div></div></a>');
			}
		},
		error: function(dados){
			alert(dados);
		}
	})
}


/*====================PEGA EMPRESAS=================*/
function pegaEmpresas(){
	var subcategoriaID = localStorage.getItem('subcategoriaID');
	var usuarioEmail = localStorage.getItem('login');
	$.ajax({
		url: "http://aldeiadaserraconnect.com.br/app/aldeiaAppWebservice/pegaEmpresas.php",
		type: "get",
		crossDomain: true,
		dataType: "json",
		data: 'id='+subcategoriaID+'&usuarioEmail='+usuarioEmail,
		success: function(dados){
			$("#recebeEmpresas").empty();
			for(var i=0;dados.length>i; i++){
				if(dados[i].favoritos == 0){
				   var active = '';
				}else{
					var active = 'active';
				}
				
				if(dados[i].notaMedia == '0'){
					 var estrelas = '<li><i class="fas fa-star"></i></li><li><i class="fas fa-star"></i></li><li><i class="fas fa-star"></i></li><li><i class="fas fa-star"></i></li><li><i class="fas fa-star"></i></li>';	
				}else if(dados[i].notaMedia <= '1'){
				  	 var estrelas = '<li class="active"><i class="fas fa-star"></i></li><li><i class="fas fa-star"></i></li><li><i class="fas fa-star"></i></li><li><i class="fas fa-star"></i></li><li><i class="fas fa-star"></i></li>';	 
				}else if(dados[i].notaMedia <= '2' && dados[i].notaMedia > '1'){
					 var estrelas = '<li class="active"><i class="fas fa-star"></i></li><li class="active"><i class="fas fa-star"></i></li><li><i class="fas fa-star"></i></li><li><i class="fas fa-star"></i></li><li><i class="fas fa-star"></i></li>';		 
				}else if(dados[i].notaMedia <= '3' && dados[i].notaMedia > '2'){
					 var estrelas = '<li class="active"><i class="fas fa-star"></i></li><li class="active"><i class="fas fa-star"></i></li><li class="active"><i class="fas fa-star"></i></li><li><i class="fas fa-star"></i></li><li><i class="fas fa-star"></i></li>';		 
				}else if(dados[i].notaMedia <= '4' && dados[i].notaMedia > '3'){
					 var estrelas = '<li class="active"><i class="fas fa-star"></i></li><li class="active"><i class="fas fa-star"></i></li><li class="active"><i class="fas fa-star"></i></li><li class="active"><i class="fas fa-star"></i></li><li><i class="fas fa-star"></i></li>';		 
				}else if(dados[i].notaMedia <= '5' && dados[i].notaMedia > '4'){
					 var estrelas = '<li class="active"><i class="fas fa-star"></i></li><li class="active"><i class="fas fa-star"></i></li><li class="active"><i class="fas fa-star"></i></li><li class="active"><i class="fas fa-star"></i></li><li class="active"><i class="fas fa-star"></i></li>';		 
				}
				
				if(dados[i].totalAvaliacao == '1'){
				   var plural = 'avaliação';
				}else{
				   var plural = 'avaliações';	
				}
				
				
				$("#recebeEmpresas").append('<div class="boxEmpresas">&nbsp;<div class="empresasHeart '+active+'"><a href="#" onClick="return favorito('+dados[i].id+');"><i class="fas fa-heart"></i></a></div><div class="empresasLogo"><a href="#" onClick="return goToEmpresa('+dados[i].statusPagamento+', '+dados[i].id+');"><img src="http://aldeiadaserraconnect.com.br/app/optmedia/images/empresas/'+dados[i].logo+'" width="84" height="84" alt=""/></a></div><div class="empresasTitle">'+dados[i].nome+'</div><div><div class="empresasBottom"><div><a href="#" onClick="return goToEmpresa('+dados[i].statusPagamento+', '+dados[i].id+');"><div class="empresasLeft"><div class="empresasLeftContent">CONTATO</div></div></a><div class="empresasRight"><div class="empresasRightStar"><ul>'+estrelas+'</ul></div><div class="empresasRightContent">'+dados[i].totalAvaliacao+' '+plural+'</div></div></div</div<div>&nbsp;</div></div></div>');
			}
		},
		error: function(dados){
			alert(dados);
		}
	})
}

/*====================PEGA EMPRESAS FAVORITOS=================*/
function pegaFavoritos(){
	var usuarioEmail = localStorage.getItem('login');
	//alert(usuarioEmail);
	$.ajax({
		url: "http://aldeiadaserraconnect.com.br/app/aldeiaAppWebservice/pegaFavoritos.php",
		type: "get",
		crossDomain: true,
		dataType: "json",
		data: 'usuarioEmail='+usuarioEmail,
		success: function(dados){
			$("#recebeFavoritos").empty();
			for(var i=0;dados.length>i; i++){
				if(dados[i].favoritos == '0'){
				   var active = '';
				}else{
					var active = 'active';
				}
				
				if(dados[i].notaMedia == '0'){
					 var estrelas = '<li><i class="fas fa-star"></i></li><li><i class="fas fa-star"></i></li><li><i class="fas fa-star"></i></li><li><i class="fas fa-star"></i></li><li><i class="fas fa-star"></i></li>';	
				}else if(dados[i].notaMedia <= '1'){
				  	 var estrelas = '<li class="active"><i class="fas fa-star"></i></li><li><i class="fas fa-star"></i></li><li><i class="fas fa-star"></i></li><li><i class="fas fa-star"></i></li><li><i class="fas fa-star"></i></li>';	 
				}else if(dados[i].notaMedia <= '2' && dados[i].notaMedia > '1'){
					 var estrelas = '<li class="active"><i class="fas fa-star"></i></li><li class="active"><i class="fas fa-star"></i></li><li><i class="fas fa-star"></i></li><li><i class="fas fa-star"></i></li><li><i class="fas fa-star"></i></li>';		 
				}else if(dados[i].notaMedia <= '3' && dados[i].notaMedia > '2'){
					 var estrelas = '<li class="active"><i class="fas fa-star"></i></li><li class="active"><i class="fas fa-star"></i></li><li class="active"><i class="fas fa-star"></i></li><li><i class="fas fa-star"></i></li><li><i class="fas fa-star"></i></li>';		 
				}else if(dados[i].notaMedia <= '4' && dados[i].notaMedia > '3'){
					 var estrelas = '<li class="active"><i class="fas fa-star"></i></li><li class="active"><i class="fas fa-star"></i></li><li class="active"><i class="fas fa-star"></i></li><li class="active"><i class="fas fa-star"></i></li><li><i class="fas fa-star"></i></li>';		 
				}else if(dados[i].notaMedia <= '5' && dados[i].notaMedia > '4'){
					 var estrelas = '<li class="active"><i class="fas fa-star"></i></li><li class="active"><i class="fas fa-star"></i></li><li class="active"><i class="fas fa-star"></i></li><li class="active"><i class="fas fa-star"></i></li><li class="active"><i class="fas fa-star"></i></li>';		 
				}
				
				if(dados[i].totalAvaliacao == '1'){
				   var plural = 'avaliação';
				}else{
				   var plural = 'avaliações';	
				}
				
				
				$("#recebeFavoritos").append('<div class="boxEmpresas">&nbsp;<div class="empresasHeart '+active+'"><a href="#" onClick="return favorito('+dados[i].id+');"><i class="fas fa-heart"></i></a></div><div class="empresasLogo"><a href="#" onClick="return goToEmpresa('+dados[i].statusPagamento+', '+dados[i].id+');"><img src="http://aldeiadaserraconnect.com.br/app/optmedia/images/empresas/'+dados[i].logo+'" width="84" height="84" alt=""/></a></div><div class="empresasTitle">'+dados[i].nome+'</div><div><div class="empresasBottom"><div><a href="#" onClick="return goToEmpresa('+dados[i].statusPagamento+', '+dados[i].id+');"><div class="empresasLeft"><div class="empresasLeftContent">CONTATO</div></div></a><div class="empresasRight"><div class="empresasRightStar"><ul>'+estrelas+'</ul></div><div class="empresasRightContent">'+dados[i].totalAvaliacao+' '+plural+'</div></div></div</div<div>&nbsp;</div></div></div>');
			}
		},
		error: function(dados){
			alert(dados);
		}
	})
}



/*====================PEGA EMPRESA=================*/
function pegaEmpresa(){
	var empresaID = localStorage.getItem('empresaID');
	$.ajax({
		url: "http://aldeiadaserraconnect.com.br/app/aldeiaAppWebservice/pegaEmpresa.php",
		type: "get",
		crossDomain: true,
		dataType: "json",
		data: 'empresa_id='+empresaID,
		success: function(dados){
			
			pegaComentarios(empresaID);
			
			$(".empresaHeaderLogo").html('<img src="http://aldeiadaserraconnect.com.br/app/optmedia/images/empresas/'+dados[0].logo+'" width="84" height="84" alt=""/>');
			$(".empresaDescription").html('<p>'+dados[0].descricao+'</p>');
			$("#empresaEndereco").html('<div class="empresaTableCell1">'+dados[0].endereco+'</div>');
			$(".empresaHeaderTitle").html('<p>'+dados[0].nome+'</p>');
			$("#empresaTelefone").html('<a href="tel:'+dados[0].telefone+'"><div class="empresaTableCell2"><i class="fas fa-phone-volume"></i>&nbsp;'+dados[0].telefone+'</div></a>');
			$("#empresaCelular").html('<a href="tel:'+dados[0].celular+'"><div class="empresaTableCell2"><i class="fas fa-mobile-alt"></i>&nbsp;'+dados[0].celular+'</div></a>');
			$("#empresaWebsite").html('<a href="'+dados[0].website+'"><div class="empresaTableCell2"><i class="fas fa-desktop"></i>&nbsp;Website</div></a>');
			$("#empresaEmail").html('<a href="mailto:'+dados[0].emailContact+'"><div class="empresaTableCell2"><i class="far fa-envelope"></i>&nbsp;E-mail</div></a>');
			$("#empresaFacebook").html('<a href="'+dados[0].facebook+'"><div class="empresaTableCell2"><i class="fab fa-facebook-f"></i>&nbsp;Facebook</div></a>');
			$("#empresaInstagram").html('<a href="'+dados[0].instagram+'"><div class="empresaTableCell2"><i class="fab fa-instagram"></i>&nbsp;Instagram</div></a>');
			
			$("#empresaAvaliacao").html('<a href="#" onClick="return abreAvaliacao('+dados[0].id+');"><div class="empresaTableCell1"><span style="font-size: 14px; font-weight: bold;">DEIXE SUA AVALIAÇÃO</span></div></a>');
			
			if(dados[0].notaMedia == '0'){
					 var estrelas = '<li><i class="fas fa-star"></i></li><li><i class="fas fa-star"></i></li><li><i class="fas fa-star"></i></li><li><i class="fas fa-star"></i></li><li><i class="fas fa-star"></i></li><li><span style="color: #000000;">&nbsp;('+dados[0].notaMedia+')</span></li>';	
				}else if(dados[0].notaMedia <= '1'){
				  	 var estrelas = '<li class="active"><i class="fas fa-star"></i></li><li><i class="fas fa-star"></i></li><li><i class="fas fa-star"></i></li><li><i class="fas fa-star"></i></li><li><i class="fas fa-star"></i></li><li><span style="color: #000000;">&nbsp;('+dados[0].notaMedia+')</span></li>';	 
				}else if(dados[0].notaMedia <= '2' && dados[0].notaMedia > '1'){
					 var estrelas = '<li class="active"><i class="fas fa-star"></i></li><li class="active"><i class="fas fa-star"></i></li><li><i class="fas fa-star"></i></li><li><i class="fas fa-star"></i></li><li><i class="fas fa-star"></i></li><li><span style="color: #000000;">&nbsp;('+dados[0].notaMedia+')</span></li>';		 
				}else if(dados[0].notaMedia <= '3' && dados[0].notaMedia > '2'){
					 var estrelas = '<li class="active"><i class="fas fa-star"></i></li><li class="active"><i class="fas fa-star"></i></li><li class="active"><i class="fas fa-star"></i></li><li><i class="fas fa-star"></i></li><li><i class="fas fa-star"></i></li><li><span style="color: #000000;">&nbsp;('+dados[0].notaMedia+')</span></li>';		 
				}else if(dados[0].notaMedia <= '4' && dados[0].notaMedia > '3'){
					 var estrelas = '<li class="active"><i class="fas fa-star"></i></li><li class="active"><i class="fas fa-star"></i></li><li class="active"><i class="fas fa-star"></i></li><li class="active"><i class="fas fa-star"></i></li><li><i class="fas fa-star"></i></li><li><span style="color: #000000;">&nbsp;('+dados[0].notaMedia+')</span></li>';		 
				}else if(dados[0].notaMedia <= '5' && dados[0].notaMedia > '4'){
					 var estrelas = '<li class="active"><i class="fas fa-star"></i></li><li class="active"><i class="fas fa-star"></i></li><li class="active"><i class="fas fa-star"></i></li><li class="active"><i class="fas fa-star"></i></li><li class="active"><i class="fas fa-star"></i></li><li><span style="color: #000000;">&nbsp;('+dados[0].notaMedia+')</span></li>';		 
				}
			
				if(dados[0].totalAvaliacao == '1'){
				   var plural = 'avaliação';
				}else{
				   var plural = 'avaliações';	
				}
			
			$("#recebeEstrelas").html(estrelas);
			$("#recebeTotalAvaliacao").html(dados[0].totalAvaliacao+'&nbsp;'+plural);
			
			
		},
		error: function(dados){
			alert('error');
		}
	})
}


/*====================GOTOAVALIACAO=================*/
function abreAvaliacao(id){
	
	var abreAvaliacao = localStorage.setItem('avaliacaoID', id);
	    window.location.href="avaliacao.html";
}


/*====================GOTOEMPRESAS=================*/
function goToEmpresa(statusPagamento, id){
	
	var statusPagamentoStorage = localStorage.setItem('empresaID', id);
	if(statusPagamento == '1'){
	    window.location.href="empresa.html";
	}else if(statusPagamento == '0'){
		window.location.href="empresaSimples.html";		 
	}
}
	   


/*====================SETA FAVORITOS======================*/
function favorito(id){
	var usuarioEmail = localStorage.getItem('login');
	$.ajax({
		url: "http://aldeiadaserraconnect.com.br/app/aldeiaAppWebservice/favorito.php",
		type: "get",
		crossDomain: true,
		data: 'empresa_id='+id+'&usuario_email='+usuarioEmail,
		success: function(dados){
			pegaEmpresas();
		},
		error: function(dados){
			alert('error');
		}
	})
	
	return false;
}



/*=====================Pega AVALIACAO===================*/
function pegaAvaliacao(){
	var avaliacaoID = localStorage.getItem('avaliacaoID');
	$.ajax({
		url: "http://aldeiadaserraconnect.com.br/app/aldeiaAppWebservice/pegaEmpresa.php",
		type: "get",
		crossDomain: true,
		data: 'empresa_id='+avaliacaoID,
		success: function(dados){
			$(".avaliacaoEmpresaNome").html(dados[0].nome);
		},
		error: function(dados){
			alert('error');
		}
	})
	
	return false;
}


/*=====================SETA FAVORITO===============*/
function setFavorito(number){
	
	$("#avaliacaoNota").val(number);
	
	if(number == '1'){
	    $("#avaliacaoEstrela1").addClass('active');
		$("#avaliacaoEstrela2").removeClass('active');
		$("#avaliacaoEstrela3").removeClass('active');
		$("#avaliacaoEstrela4").removeClass('active');
		$("#avaliacaoEstrela5").removeClass('active');
	}else if(number == '2'){
		$("#avaliacaoEstrela1").addClass('active');
		$("#avaliacaoEstrela2").addClass('active');
		$("#avaliacaoEstrela3").removeClass('active');
		$("#avaliacaoEstrela4").removeClass('active');
		$("#avaliacaoEstrela5").removeClass('active');	 
	}else if(number == '3'){
		$("#avaliacaoEstrela1").addClass('active');
		$("#avaliacaoEstrela2").addClass('active');
		$("#avaliacaoEstrela3").addClass('active');
		$("#avaliacaoEstrela4").removeClass('active');
		$("#avaliacaoEstrela5").removeClass('active');	 
	}else if(number == '4'){
		$("#avaliacaoEstrela1").addClass('active');
		$("#avaliacaoEstrela2").addClass('active');
		$("#avaliacaoEstrela3").addClass('active');
		$("#avaliacaoEstrela4").addClass('active');
		$("#avaliacaoEstrela5").removeClass('active');	 
	}else if(number == '5'){
		$("#avaliacaoEstrela1").addClass('active');
		$("#avaliacaoEstrela2").addClass('active');
		$("#avaliacaoEstrela3").addClass('active');
		$("#avaliacaoEstrela4").addClass('active');
		$("#avaliacaoEstrela5").addClass('active');	 
	}
	
	return false;
}


/*============================ENVIA AVALIAÇÂO===========================*/
$("#avaliacaoEnviaBTO").click(function(e){
	e.preventDefault();
	var comentario = $("#avaliacaoComentario").val();
	var nota = $("#avaliacaoNota").val();
	var empresaID = localStorage.getItem('avaliacaoID');
	var usuarioEmail = localStorage.getItem('login');
	$.ajax({
		url: "http://aldeiadaserraconnect.com.br/app/aldeiaAppWebservice/enviaAvaliacao.php",
		type: "get",
		crossDomain: true,
		data: 'empresa_id='+empresaID+'&usuarioEmail='+usuarioEmail+'&nota='+nota+'&comentario='+comentario,
		success: function(dados){
			if(dados == 'erro'){
			    alert('Você ja avaliou!');
				window.history.back();
			}else if(dados == 'ok'){
				window.history.back();
			}
			
		},
		error: function(dados){
			alert('error');
		}
	})
	
	return false;
});



/*========================================PEGA COMENTARIOS==============================*/
function pegaComentarios(empresa_id){
	//var empresaID = localStorage.getItem('avaliacaoID');
	$.ajax({
		url: "http://aldeiadaserraconnect.com.br/app/aldeiaAppWebservice/pegaComentarios.php",
		type: "get",
		crossDomain: true,
		data: 'empresa_id='+empresa_id,
		dataType: 'json',
		success: function(comentarios){
			
			for(var i=0;comentarios.length>i; i++){
				
				if(comentarios[i].nota == '1'){
				   var estrelas = '<li class="active"><i class="fas fa-star"></i></li><li><i class="fas fa-star"></i></li><li><i class="fas fa-star"></i></li><li><i class="fas fa-star"></i></li><li><i class="fas fa-star"></i></li>';
				}else if(comentarios[i].nota == '2'){
					 var estrelas = '<li class="active"><i class="fas fa-star"></i></li><li class="active"><i class="fas fa-star"></i></li><li><i class="fas fa-star"></i></li><li><i class="fas fa-star"></i></li><li><i class="fas fa-star"></i></li>';		 
				}else if(comentarios[i].nota == '3'){
					 var estrelas = '<li class="active"><i class="fas fa-star"></i></li><li class="active"><i class="fas fa-star"></i></li><li><i class="fas fa-star"></i></li><li><i class="fas fa-star"></i></li><li><i class="fas fa-star"></i></li>';		 
				}else if(comentarios[i].nota == '4'){
					 var estrelas = '<li class="active"><i class="fas fa-star"></i></li><li class="active"><i class="fas fa-star"></i></li><li class="active"><i class="fas fa-star"></i></li><li class="active"><i class="fas fa-star"></i></li><li><i class="fas fa-star"></i></li>';		 
				}else if(comentarios[i].nota == '5'){
					 var estrelas = '<li class="active"><i class="fas fa-star"></i></li><li class="active"><i class="fas fa-star"></i></li><li><i class="fas fa-star"></i></li><li><i class="fas fa-star"></i></li><li><i class="fas fa-star"></i></li>';		 
				}
				
				$("#recebeComentarios").append('<div class="empresaAvaliacaoBox"><div class="empresaAvaliacaoMsg"><p>'+comentarios[i].comentario+'</p></div><div class="empresaAvaliacaoName">'+comentarios[i].usuarioNome+'&nbsp;'+comentarios[i].usuarioSobrenome+'</div><div class="empresaAvaliacaoStars"><ul>'+estrelas+'</ul></div></div>');
			}
		},
	})
	
	return false;
}


/*===========================PEGA OFERTAS========================*/
function pegaOfertas(){
	$.ajax({
		url: "http://aldeiadaserraconnect.com.br/app/aldeiaAppWebservice/pegaOfertas.php",
		type: "get",
		crossDomain: true,
		dataType: 'json',
		success: function(dados){
			$("#recebeOfertas").empty();
			for(var i=0;dados.length>i; i++){
			   $("#recebeOfertas").append('<div class="ofertas-item"><div><p>'+dados[i].texto+'</p></div><img src="http://aldeiadaserraconnect.com.br/app/optmedia/images/ofertas/'+dados[i].imagem+'" alt=""/></div>');
			}
		},
		error: function(dados){
			alert('error');
		}
	})
}

/*===========================PEGA CUPOM========================*/
function pegaCupons(){
	$.ajax({
		url: "http://aldeiadaserraconnect.com.br/app/aldeiaAppWebservice/pegaCupons.php",
		type: "get",
		crossDomain: true,
		dataType: 'json',
		success: function(dados){
			$("#recebeCupons").empty();
			for(var i=0;dados.length>i; i++){
			   $("#recebeCupons").append('<div class="ofertas-item"><img src="http://aldeiadaserraconnect.com.br/app/optmedia/images/cupons/'+dados[i].imagem+'" alt=""/></div>');
			}
		},
		error: function(dados){
			alert('error');
		}
	})
}

/*===========================PEGA CARDAPIO========================*/
function pegaCardapio(){
	$.ajax({
		url: "http://aldeiadaserraconnect.com.br/app/aldeiaAppWebservice/pegaCardapio.php",
		type: "get",
		crossDomain: true,
		dataType: 'json',
		success: function(dados){
			$("#recebeCardapio").empty();
			for(var i=0;dados.length>i; i++){
			   $("#recebeCardapio").append('<div class="ofertas-item"><img src="http://aldeiadaserraconnect.com.br/app/optmedia/images/cardapio/'+dados[i].imagem+'" alt=""/></div>');
			}
		},
		error: function(dados){
			alert('error');
		}
	})
}

/*===========================PEGA Agenda========================*/
function pegaAgenda(){
	$.ajax({
		url: "http://aldeiadaserraconnect.com.br/app/aldeiaAppWebservice/pegaAgenda.php",
		type: "get",
		crossDomain: true,
		dataType: 'json',
		success: function(dados){
			$("#recebeAgenda").empty();
			for(var i=0;dados.length>i; i++){
                $("#recebeAgenda").append('<div class="ofertas-item"><div><p>'+dados[i].texto+'</p></div><img src="http://aldeiadaserraconnect.com.br/app/optmedia/images/ofertas/'+dados[i].imagem+'" alt=""/></div>');
			}
		},
		error: function(dados){
			alert('error');
		}
	})
}
	


/*===========================PEGA Noticias========================*/
function pegaNoticias(){
	$.ajax({
		url: "http://aldeiadaserraconnect.com.br/app/aldeiaAppWebservice/pegaNoticias.php",
		type: "get",
		crossDomain: true,
		dataType: 'json',
		success: function(dados){
			$("#recebeNoticias").empty();
			for(var i=0;dados.length>i; i++){
			   $("#recebeNoticias").append('<div class="ofertas-item"><img src="http://aldeiadaserraconnect.com.br/app/optmedia/images/noticias/'+dados[i].imagem+'" alt=""/><p class="noticias-title">'+dados[i].titulo+'</p><p class="noticias-data">'+dados[i].dataInserido+'</p><p class="noticias-texto">'+dados[i].texto+'</p></div>');
			}
		},
		error: function(dados){
			alert('error');
		}
	})
}


/*=================BOTÃO VOLTAR DO TOPO==============*/
$("#top-back").click(function(){
	window.history.back();
});



/*=============================SEARCH===============================*/
$("#search").keyup(function(){
	//alert('esfesfesf');
	$("#conteudo-search").show('fast');
	var search = $("#search").val();
	$.ajax({
		url: "http://aldeiadaserraconnect.com.br/app/aldeiaAppWebservice/search.php",
		type: "get",
		crossDomain: true,
		dataType: 'json',
		data: 'word='+search,
		success: function(dados){
			$("#recebeSearch").empty();
			for(var i=0;dados.length>i; i++){
			   $("#recebeSearch").append('<li><a href="#" onClick="return goToEmpresa('+dados[i].statusPagamento+', '+dados[i].id+');">'+dados[i].nome+'</a><div style="font-size: 12px;">categoria: '+dados[i].categoria+'</div></li>');
			}
		},
		error: function(dados){
			alert('error');
		}
	})
});

/*================================FECHA SEARCH======================*/
$("#fecha-search").click(function(){
	$("#conteudo-search").hide('fast');
	var search = $("#search").val('');
});


/*===========================CADASTRAR=======================*/
$("#formCadastrar").submit(function(e){
        e.preventDefault();
        var nome = $("#nome").val();
        var sobrenome = $("#sobrenome").val();
        var email = $("#email").val();
        var password = $("#password").val();
        var vpassword = $("#vpassword").val();
        function apagaMsg(){
            setTimeout(function(){
                $("#errorMsg").hide();
            }, 3000);
        }
        if(password != vpassword){
            $("#errorMsg").show();
            $("#errorMsg").css('background-color', '#BF4749');
            $("#errorMsg").html('Verifique sua senha!');
            apagaMsg();
        }else{
            $.ajax({
               url: 'http://aldeiadaserraconnect.com.br/app/aldeiaAppWebservice/cadastrar.php',
                data: 'nome='+nome+'&sobrenome='+sobrenome+'&email='+email+'&password='+password,
                type: 'post',
                crossDomain: true,
                success: function(dados){
                    if(dados == 'ok'){
                        $("#errorMsg").show();
                        $("#errorMsg").css('background-color', '#8afa8d');
                        $("#errorMsg").html('Cadastrado com sucesso!');
                        apagaMsg();
                    }else if(dados == 'jaexiste'){
                        $("#errorMsg").show();
                        $("#errorMsg").css('background-color', '#BF4749');
                        $("#errorMsg").html('Este Usuário ja Existe!');
                        apagaMsg();
                    }else{
                        alert('Ocorreu um Erro!');
                        apagaMsg();
                    }
                    
                }
            });
        }
    });

/*********************************PEGA BANNERS HOME**************************/

function pegaBannersHome(){
    $.ajax({
        url: 'http://aldeiadaserraconnect.com.br/app/aldeiaAppWebservice/pegaBannerHome.php',
        type: 'post',
        crossDomain: true,
        dataType: 'json',
        success: function(dados){
            var active = 0;
            for(var i=0;dados.length>i;i++){
                var valorIndicador = 0;
                if(active == 0){
                    var setActive = 'active';
                    active++;
                }else{
                    var setActive = '';
                }
                $("#recebeIndicador").append('<li data-target="#carouselExampleIndicators" data-slide-to="'+valorIndicador+'" class="'+setActive+'"></li>');
                valorIndicador++;
                $("#recebeBanners").append('<div class="carousel-item '+setActive+'"><img class="d-block w-100" src="http://aldeiadaserraconnect.com.br/app/slide/img/bannersHome/'+dados[i].imagem+'" alt="Second slide"></div>');
            }
            
        },
        error: function(dados){
            alert(dados);
        }
    })
}

/*********************************PEGA BANNERS EMPRESA**************************/

function pegaBannersEmpresa(empresa_id){
    $.ajax({
        url: 'http://aldeiadaserraconnect.com.br/app/aldeiaAppWebservice/pegaBannerEmpresa.php',
        type: 'get',
        data: 'empresa_id='+empresa_id,
        crossDomain: true,
        dataType: 'json',
        success: function(dados){
            var active = 0;
            for(var i=0;dados.length>i;i++){
                var valorIndicador = 0;
                if(active == 0){
                    var setActive = 'active';
                    active++;
                }else{
                    var setActive = '';
                }
                $("#recebeIndicadorEmpresa").append('<li data-target="#carouselExampleIndicators" data-slide-to="'+valorIndicador+'" class="'+setActive+'"></li>');
                valorIndicador++;
                $("#recebeBannersEmpresa").append('<div class="carousel-item '+setActive+'"><img class="d-block w-100" src="http://aldeiadaserraconnect.com.br/app/slide/img/bannersEmpresas/'+dados[i].imagem+'" alt=""></div>');
            }
            
        },
        error: function(dados){
            alert(dados);
        }
    })
}

/*********************************PEGA BANNERS SUBCATEGORIA**************************/

function pegaBannersSubcategoria(categoria_id){
    $.ajax({
        url: 'http://aldeiadaserraconnect.com.br/app/aldeiaAppWebservice/pegaBannerSubcategoria.php',
        type: 'get',
        data: 'categoria_id='+categoria_id,
        crossDomain: true,
        dataType: 'json',
        success: function(dados){
            var active = 0;
            for(var i=0;dados.length>i;i++){
                var valorIndicador = 0;
                if(active == 0){
                    var setActive = 'active';
                    active++;
                }else{
                    var setActive = '';
                }
                $("#recebeIndicadorSubcategoria").append('<li data-target="#carouselExampleIndicators" data-slide-to="'+valorIndicador+'" class="'+setActive+'"></li>');
                valorIndicador++;
                $("#recebeBannersSubcategoria").append('<div class="carousel-item '+setActive+'"><img class="d-block w-100" src="http://aldeiadaserraconnect.com.br/app/slide/img/bannersCategorias/'+dados[i].imagem+'" alt="Second slide"></div>');
            }
            
        },
        error: function(dados){
            alert(dados);
        }
    })
}
	   