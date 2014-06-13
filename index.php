<?php
  // Destroi Sessão toda vez que entra na tela de login
  session_start("login");
  if ( isset($_SESSION["rmLogado"]) )
  {
   session_destroy();
  }

  // Se existe erro exibe msg de erro abaixo do form

  $erro = "Preencha os dados para entrar:";
  
  if ( isset($_GET["e"]))
  {
    switch ($_GET["e"])
    {
      case "1": $erro = "Usuário e/ou Senha Inválida"; break;
      default : $erro = "Preencha os dados para entrar:";  break;
    }
  }

?>
<head>
<html lang="pt-br">
  <head>
    <meta charset="iso-8859-1">
<title>Untitled Document</title> 
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/estilo.css">
    <link href="css/style.css" rel="stylesheet" type="text/css">
	<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,700italic' rel='stylesheet' type='text/css'>
	<style>
		.container-menu #home{background-image:url(Images/menu-bg-selected.jpg)};
	</style>
    <script src="js/script.js"></script>
	<script src="js/jquery.js" type="text/javascript"></script>
    <script src="js/bootstrap.min.js"></script>
	<script type="text/javascript">	
    </script>


</head>

<body>
	<main>
<!--Inicio Menu-->    
        <aside class="menu">
            <nav class="container-menu">
            	<div id="logo-mini">
                	<img width="100%" src="Images/logo Y.png" alt="Cleide Pacheco Advocacia">
                </div>
            
                <a href="index.php" class="link-menu" id="home">
                	<ul><img src="Images/ico/home.png" alt="Home" class="ico-menu"> <p class="text-menu">Home</p></ul>
                </a>
                
                <a href="empresa.php" class="link-menu" id="sobre_mim">
               		<ul><img src="Images/ico/empresa2.png" alt="Home" class="ico-menu"> <p class="text-menu">Sobre Mim</p></ul>
                    </a>
                    
                <a href="atuacao.php" class="link-menu" id="a_atuacao">
                	<ul><img src="Images/ico/atuacao.png" alt="Home" class="ico-menu"> <p class="text-menu">&Aacute;reas de Atua&ccedil;&atilde;o</p></ul>
                </a>
                
                <a href="contato.php" class="link-menu" id="contato">
                	<ul><img src="Images/ico/contato.png" alt="Home" class="ico-menu"> <p class="text-menu">Contato</p></ul>
                </a>
                
                
                
  
                
                
            </nav>
        </aside>
<!--Fim Menu-->        
<!--Inicio Conteudo Principal-->        
       <!--<article class="logo-article">
        <img src="Images/logo.png" alt="Cleide Pacheco Advocacia" id="logo">
        </article>-->
        <article class="slide-article" id="slide1">
        	<img src="Images/slide1.jpg" alt="Image 1" id="img1"  class="img-slide">
        </article>

 
    
    
		<article class="article" id="articleLogin">
    
        <div id="form1">
            <h3>&nbsp;</h3>
           <h5 for="erro" id="lblErro" name="lblErro" ><?/*=$erro*/ ?></h5>
        
            <form class="form-horizontal" id="formulariozinho" name="formulariozinho" role="form" method="post" action="verifica_login.php">
                <div class="form-group">
                	<label for="inputRM" class="col-sm-2 control-label">Login:</label>
                    <div class="col-sm-8">
                    	<input type="text" class="form-control" id="txtRM" name="txtRM" placeholder="Login">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Senha:</label>
                    <div class="col-sm-8">
                    	<input type="password" class="form-control" id="txtSenha" name="txtSenha" placeholder="Senha">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-5 control-label">Esqueceu a senha?</label>
                    <div class=" col-sm-5">
                    	<button type="button" class="btn-default-index" onClick="validaCampos(txtRM, txtSenha);">Entrar</button>
                    </div>
                </div>
                
                
            </form>
        
        </div>
		</article>

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    
<!--Fim Conteudo Principal-->         
    </main>
  <body>
  

