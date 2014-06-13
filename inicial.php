<?php 
include_once("conexao.php");
  session_start("login");
  if ($_SESSION["rmLogado"] == "")
  {
    Header("Location:index.php");
  }
  else
  {
    $cd = $_SESSION["rmLogado"];
    $email = $_SESSION["nmLogado"];
	$typeU = $_SESSION["tpLogado"];
  }
  if(isset($_POST["cmbUser2"]) &&  $_POST["cmbUser2"] != "0" )
  {
	  $user=$_POST["cmbUser2"];
  }
  else{
	  $user=-1;
  }
  $msg = "";

  if ( isset($_GET["msg"]))
  {
    $msg = $_GET["msg"];
  }
  
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="iso-8859-1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nome do SITE</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" type="text/css" href="css/estilo.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/style.css" rel="stylesheet" type="text/css">
	<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,700italic' rel='stylesheet' type='text/css'>
	<style>
		.container-menu #home{background-image:url(Images/menu-bg-selected.jpg)};
	</style>
    <script src="js/script.js"></script>
	<script src="js/jquery.js" type="text/javascript"></script>

	<script type="text/javascript">	
    </script>
    <script src="js/jquery-1.9.1.js"></script>
    
    
    
    <script>
	$(document).ready(function(){
		var cep ="";
		var num ="";
		var countCEP=0;
		var countF=0;
	  $("#form").css("display","none");
	  $("#abrirform").click(function(){
		  $("#form").toggle();
	  	
	  });
	});
	</script>
    
    

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body style="overflow:auto; overflow-y:auto;">
  <aside class="menu">
            <nav class="container-menu">
            	<div id="logo-mini">
                	<img width="100%" src="Images/logo Y.png" alt="Cleide Pacheco Advocacia">
                </div>
            
                <?php if($typeU==1 || $typeU==2){?>
                    <a href="inicial.php" class="link-menu" id="home">
                      <ul><img src="Images/index_selected.png" alt="Home" class="ico-menu"> <p class="text-menu">Home</p></ul>
                    </a>
                    
                    <a href="agenda.php" class="link-menu" id="sobre_mim">
                      <ul><img src="Images/quem_sou.png" alt="Home" class="ico-menu"> <p class="text-menu">Sobre Mim</p></ul>
                    </a>
                       
                    <a href="processo.php" class="link-menu" id="a_atuacao">
                      <ul><img src="Images/a_atuacao.png" alt="Home" class="ico-menu"> <p class="text-menu">Áreas de Atuação</p></ul>
                    </a>
                    
                    <a href="chat.php" class="link-menu" id="contato">
                      <ul><img src="Images/contato.png" alt="Home" class="ico-menu"> <p class="text-menu">Contato</p></ul>
                    </a>
                <?php } ?>
                                
                
            </nav>
        </aside>
<!--Fim Menu--> 
     <div id="caixaLogado">
        Ol&aacute; <?=$email ?> | <a href="sair.php">Sair</a>
     </div>

     <div id="areaCentral">
        
        
        <hr class="divisoria" />
      <h2>Processos</h2>
      <div class="div-title"> </div>
       <div id="msg">
         <h5><?=$msg?></h5>
       </div>
       
       <!-- Cria Tabela de agenda-->
       <?php
	   
	   if($typeU==1){
		   ?>
           <input type="button" id="abrirform" name="abrirform" value="Novo Processo">
           <form class='form-horizontal' role='form' method='post' action='incluirProcesso.php' id="form" name="form">
		   <div class='form-group'>
		   <label for='inputUser' class='col-sm-2 control-label'>Usu&aacute;rio:</label>
            <div class='col-sm-8'>
              <select class='form-control' id='cmbUser' name='cmbUser'>
                <option value='0'>Selecione o Usuario</option>
                <?php
           $comando ="select user.nm_user, user.cd_user, user.cd_cpf_user from advogado_user inner join user where advogado_user.cd_advogado=".$cd." and user.cd_user=advogado_user.cd_cliente order by cd_user ASC";
		   echo $comando;
                   $cSQL = seleciona($comando);
                   $qtdLinhas = mysql_num_rows($cSQL);

                   if ($qtdLinhas!=0)
                   {
					   while($dados=mysql_fetch_array($cSQL))
					   {                 
                          echo "<option value='".  $dados[1] ."'>  " . $dados[2] ." -  ".$dados[0] . " </option>";
					   }
                   }
                   ?>
               
              </select>
            </div>
         </div>
          <div class='form-group'>
		   <label for='inputUser' class='col-sm-2 control-label'>Tipo de Processo:</label>
            <div class='col-sm-8'>
              <select class='form-control' id='cmbTipo' name='cmbTipo'>
                <option value='0'>Selecione o Tipo de Processo</option>
                <?php
           $comando ="select * from tipo_processo order by nm_tipo_processo ASC";
                   $cSQL = seleciona($comando);
                   $qtdLinhas = mysql_num_rows($cSQL);

                   if ($qtdLinhas!=0)
                   {
					   while($dados=mysql_fetch_array($cSQL))
					   {                 
                          echo "<option value='".  $dados[0] ."'> ".$dados[1] . " </option>";
					   }
                   }
                   ?>
               
              </select>
            </div>
         </div>
         <div class='form-group'>
		   <label for='inputUser' class='col-sm-2 control-label'>Estado do Processo:</label>
            <div class='col-sm-8'>
              <select class='form-control' id='cmbEstado' name='cmbEstado'>
                <option value='0'>Selecione o Estado do Processo</option>
                <?php
           $comando ="select * from estado_processo order by nm_estado_processo ASC";
                   $cSQL = seleciona($comando);
                   $qtdLinhas = mysql_num_rows($cSQL);

                   if ($qtdLinhas!=0)
                   {
					   while($dados=mysql_fetch_array($cSQL))
					   {                 
                          echo "<option value='".  $dados[0] ."'> ".$dados[1] . " </option>";
					   }
                   }
                   ?>
               
              </select>
            </div>
         </div>
		 
		 <div class='form-group'>
			 <label for='inputDataI' class='col-sm-2 control-label'>Data de Inicio:</label>
				<div class='col-sm-3'>
				  <input type='date' class='form-control' name='txtDataI' id='txtDataI' required placeholder='Data'>
				</div>
         </div>
		 <div class='form-group'>
			 <label for='inputDataF' class='col-sm-2 control-label'>Data de Termino:</label>
				<div class='col-sm-3'>
				  <input type='date' class='form-control' name='txtDataF' id='txtDataF' placeholder='Data'>
				  </div>
         </div>
		
         <div class='form-group'>
         <label for='inputDesc' class='col-sm-2 control-label'>Info:</label>
				<div class='col-sm-8'>
					<textarea id='txtInfo' name='txtInfo' class="form-control" placeholder='Informações Adicionais sobre o evento' rows="6" ></textarea>
				</div>
         </div>
         <div class='form-group'>
            <div class='col-sm-offset-2 col-sm-10'>
              <button type='submit' class='btn btn-default'>Adicionar na Agenda</button>
            </div>
          </div>
     </form>
     <?php
	   }
      ?>
      <form class='form-horizontal' role='form2' method='post' action='inicial.php' id="form2" name="form2">
		   <div class='form-group'>
		   <label for='inputUser' class='col-sm-2 control-label'>Usu&aacute;rio:</label>
            <div class='col-sm-8'>
              <select class='form-control' id='cmbUser2' name='cmbUser2'>
                <option value='0'>Selecione o Usuario</option>
                <?php
				if($typeU==1){
           $comando ="select user.nm_user, user.cd_user, user.cd_cpf_user from advogado_user inner join user where advogado_user.cd_advogado=".$cd." and user.cd_user=advogado_user.cd_cliente order by cd_user ASC";}
		   		else if ($typeU==2)
				{
					$comando ="select user.nm_user, user.cd_user, user.cd_cpf_user from advogado_user inner join user where advogado_user.cd_cliente=".$cd." and user.cd_user=advogado_user.cd_advogado order by cd_user ASC";
				}
                   $cSQL = seleciona($comando);
                   $qtdLinhas = mysql_num_rows($cSQL);

                   if ($qtdLinhas!=0)
                   {
					   while($dados=mysql_fetch_array($cSQL))
					   {    
					  	  if($typeU==1)
						  	echo "<option value='".  $dados[1] ."'>  " . $dados[2] ." -  ".$dados[0] . " </option>";
						  else if($typeU==2)      
                          	echo "<option value='".  $dados[1] ."'>  Adv. ".$dados[0] . " </option>";
					   }
                   }
                   ?>
               
              </select>
            </div>
         </div>
         </form>
         
         <script>
	 $("#cmbUser2").change(function(){
	 	$("#form2").submit();
	 });
	 </script>
     
     <table class="table-striped table-bordered table table-condensed">
            	<?php
				  
				  // SELECIONA nr e rm da lista_turma onde a sg, ano e semestre forem iguais	
				  if($user != -1){  
				  if($typeU==1){
				  	$comando  = "select * from processo where cd_cliente=".$user;
				  }
				  else if ($typeU==2){
				  	$comando  = "select * from processo where cd_advogado=".$user;					  
				  }
				  $cSQL = seleciona($comando);
                   $qtdLinhas = mysql_num_rows($cSQL);

                   if ($qtdLinhas!=0)
                   {
					  //Titulo da Tabela
					  echo "<caption> Notícias </caption>";
					  echo "<thead><tr><th class='col-sm-2'>Nome</th><th class='col-sm-2'>Data</th><th class='col-sm-2'>Tipo</th><th class='col-sm-2'>Estado</th><th>Local</th></tr></thead>";		
                      while($dados = mysql_fetch_array($cSQL))
                      {
						  if($typeU==1)
						  	$comando2  = "select nm_user from user where cd_user=".$dados[1];
						  else if($typeU==2)
						    $comando2  = "select nm_user from user where cd_user=".$dados[2];
						  $cSQL2 = seleciona($comando2);
						  while($e=mysql_fetch_array($cSQL2))
						  {
							  $nome2=$e[0];
						  }
						  //Cria item na tabela com NR, RM e Nome
						  echo "<tr ><td class='col-sm-2'>".$nome2." </td><td class='col-sm-2'>".$dados[5]."</td><td>".$dados[3]."</td><td>".$dados[4]."</td><td>".$dados[6]."</td></tr>";  
                      }
                   
                   desconecta();
				}
				  }
                ?> 
       </table>
      
     
     </div>
     </main>
  </body>
</html>
