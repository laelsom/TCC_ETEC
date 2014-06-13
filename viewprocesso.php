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
  $msg = "";
  if ( isset($_GET["proc"]))
  {
    $cd_proc = $_GET["proc"];
  }
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
    
    <link rel="stylesheet" href="css/estilo.css"  type="text/css">
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <link href="css/tabela.css" rel="stylesheet" type="text/css">
    <link href="css/edit.css" rel="stylesheet" type="text/css">
    <link href="css/custom-theme/jquery-ui-1.9.2.custom.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,700italic' rel='stylesheet' type='text/css'>
    <style>
        .container-menu #home{background-image:url(Images/menu-bg-selected.jpg)};
        body{overflow:scroll;}
    </style>
    <script src="js/jquery-1.9.1.js"></script>
    <script src="js/script.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/jquery-ui-1.9.2.custom.js"></script>
    
    <script>
	$(document).ready(function(){
		var cep ="";
		var num ="";
		var countCEP=0;
		var countF=0;
	  $(".control-form-hide").css("display","none");
	  $("#abrirform").click(function(){
		  $(".control-form-hide").show();
	  	
	  });
    $("#fecharform").click(function(){
      $(".control-form-hide").hide();
      
    });
   $("#cmbUser2").change(function(){
    $("#form2").submit();
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










<!-- ..... -->














  <body style="overflow:auto; overflow-y:auto;">

<!-- Menu -->
  <aside class="menu">
            <nav class="container-menu">
            	<div id="logo-mini">
                	<img width="100%" src="Images/logo Y.png" alt="Cleide Pacheco Advocacia">
                </div>
                <?php if($typeU==1){?>
                    <a href="processo.php" class="link-menu" id="home">
                      <ul><img src="Images/ico/processo.png" alt="Home" class="ico-menu"> <p class="text-menu">Processos</p></ul>
                    </a>
                    
                    <a href="agenda.php" class="link-menu" id="sobre_mim">
                      <ul><img src="Images/ico/agenda.png" alt="Home" class="ico-menu"> <p class="text-menu">Agenda</p></ul>
                    </a>
                       
                    <a href="cliente.php" class="link-menu" id="a_atuacao">
                      <ul><img src="Images/ico/empresa2.png" alt="Home" class="ico-menu"> <p class="text-menu">Áreas de Atuação</p></ul>
                    </a>
                    
                    <a href="chat.php" class="link-menu" id="contato">
                      <ul><img src="Images/ico/chat.png" alt="Home" class="ico-menu"> <p class="text-menu">Chat</p></ul>
                    </a>
                <?php 
                }else if($typeU==2) 
                {
              ?>
                <a href="perfil.php" class="link-menu" id="a_atuacao">
                      <ul><img src="Images/ico/home.png" alt="Home" class="ico-menu"> <p class="text-menu">Áreas de Atuação</p></ul>
                    </a>
                  
                <a href="processo.php" class="link-menu" id="home">
                      <ul><img src="Images/ico/processo.png" alt="Home" class="ico-menu"> <p class="text-menu">Processos</p></ul>
                    </a>
                    
                    <a href="agenda.php" class="link-menu" id="sobre_mim">
                      <ul><img src="Images/ico/agenda.png" alt="Home" class="ico-menu"> <p class="text-menu">Agenda</p></ul>
                    </a>
                       
                    <a href="chat.php" class="link-menu" id="contato">
                      <ul><img src="Images/ico/chat.png" alt="Home" class="ico-menu"> <p class="text-menu">Chat</p></ul>
                    </a>
                <?php
                }

                ?>

                
            </nav>
        </aside>
<!--Fim Menu--> 




      <!-- info do user -->
    <div id="caixaLogado">
        Ol&aacute; <?=$email ?> | <a href="sair.php">Sair</a>
    </div>

    <div id="areaCentral">


      <div class="divisoria"> </div>
      

      <h2 class="title">Processos</h2>
      <div class="div-title"> </div>

        
         
       <!-- fim info user -->
       




















<!-- Cria Botão Novo processo se for adv-->

  <?php



    if($typeU==1){

  ?>
       
  <input type="button" id="abrirform" name="abrirform" class="btn-default"value="Novo Processo">
  <div class="msg">
      <h5><?=$msg?></h5>
  </div>
  <div class='control-form-hide'>
    <form class='form-horizontal-hide' role='form' method='post' action='incluirProcesso.php' id="form" name="form">
        <div class='form-group label-title'>
          <label for='titleForm' >Novo Processo</label>
          <input type="button" id="fecharform" name="fecharform" class="btn-close"value="X">
        </div>
        <div class='form-group'>
         <label for='inputUser' class='col-sm-3 control-label'>Usu&aacute;rio:</label>
           <div class='col-sm-7'>
              <select class='form-control' id='cmbUser' name='cmbUser'>
                  <option value='0'>Selecione o Usuario</option>
                      <?php
                        $comando ="select u.nm_user, u.cd_user, u.cd_cpf_user, u.cd_cnpj_user from advogado_user au inner join user u where au.cd_advogado = ".$cd." and u.cd_user = au.cd_cliente order by cd_user ASC";
                        $cSQL = seleciona($comando);
                        $qtdLinhas = mysql_num_rows($cSQL);
                        if ($qtdLinhas!=0)
                        {
                          while($dados=mysql_fetch_array($cSQL))
                          {                 
                            if($dados[3]!="" && $dados[2]=="")
                            {
                              echo "<option value='".  $dados[1] ."'>  " . $dados[3] ." -  ".$dados[0] . " </option>";
                            }
                            else if($dados[3]=="" && $dados[2]!="")
                            {
                              echo "<option value='".  $dados[1] ."'>  " . $dados[2] ." -  ".$dados[0] . " </option>";
                            }
                          }
                        }
                      ?>

              </select>
            </div>
        </div>
        <div class='form-group'>
          <label for='inputUser' class='col-sm-3 control-label'>Classe de Processo:</label>
            <div class='col-sm-7'>
              <select class='form-control' id='cmbClasse' name='cmbClasse'>
                  <option value='0'>Selecione o Tipo de Processo</option>
                      <?php
                        $comando ="select * from classe_processo order by nm_classe_processo ASC";
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
          <label for='inputUser' class='col-sm-3 control-label'>Estado do Processo:</label>
            <div class='col-sm-7'>
              <select class='form-control' id='cmbEstado' name='cmbEstado'>
                  <option value='NULL'>Selecione o Estado do Processo</option>
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
          <label for='inputDataI' class='col-sm-3 control-label'>Data de Inicio:</label>
            <div class='col-sm-3'>
              <input type='date' class='form-control' name='txtDataI' id='txtDataI' required placeholder='Data'>
            </div>
        </div>
        <div class='form-group'>
          <label for='inputDataF' class='col-sm-3 control-label'>Data de Termino:</label>
          <div class='col-sm-3'>
            <input type='date' class='form-control' name='txtDataF' id='txtDataF' placeholder='Data'>
          </div>
        </div>

        <div class='form-group'>
          <label for='inputDesc' class='col-sm-3 control-label'>Info:</label>
          <div class='col-sm-7'>
            <textarea id='txtInfo' name='txtInfo' class="form-control" placeholder='Informações Adicionais sobre o evento' rows="6" ></textarea>
          </div>
        </div>
        <div class='form-group '>
          <label for='inputAssunto' class='col-sm-3 control-label'>Assunto Processo:</label>
          <div class='col-sm-7'>
              <?php
                $comando ="select * from classe_processo order by nm_classe_processo ASC";
                $cSQL = seleciona($comando);
                $qtdLinhas = mysql_num_rows($cSQL);
                if ($qtdLinhas!=0)
                {
                  while($dados=mysql_fetch_array($cSQL))
                  {                 
                    echo "<input type='checkbox' name='classe_processe[]' id='classe_processo[]' value='".  $dados[0] ."'> ".$dados[1] . " <br />";
                  }
                }
              ?>
          </div>
        </div>
        <div class='form-group'>
          <label for='inputJuiz' class='col-sm-3 control-label'>Nome Juiz:</label>
          <div class='col-sm-7'>
            <input id='txtJuiz' name='txtJuiz' class="form-control" maxlength='100'>
          </div>
        </div>
        <div class='form-group'>
          <label for='input2Parte' class='col-sm-3 control-label'>Nome 2ª Parte:</label>
          <div class='col-sm-7'>
            <input id='txt2Parte' name='txt2Parte' class="form-control" maxlength='100' required >
          </div>
        </div>
        <div class='form-group'>
          <label for='inputPreco' class='col-sm-3 control-label'>Valor do Processo:</label>
          <div class='col-sm-7'>
            <input id='txtPreco' name='txtPreco' class="form-control" maxlength='100' >
          </div>
        </div>
        <div class='form-group'>
          <label for='inputPreco' class='col-sm-3 control-label'>Tipo de Cliente:</label>
          <div class='col-sm-7'>
            <input type="radio" name="radioTreq" value="1" checked='checked'> Requerente
            <input type="radio" name="radioTreq" value="0"> Requerido
          </div>
        </div>
        <div class='form-group'>
          <div class='col-sm-3'>
          </div>
          <div class='col-sm-7'>
            <button type='submit' class='btn btn-default'>Criar Processo</button>
          </div>
        </div>
    </form>
  </div>

  <?php
    }
  ?>

     <!-- Fim do btn do processo-->
     









<!--


     
      <form class='form-horizontal' role='form2' method='post' action='processo.php' id="form2" name="form2">
		   <div class='form-group'>
		   <label for='inputUser' class='col-sm-2 control-label'>Usu&aacute;rio:</label>
            <div class='col-sm-8'>
              <select class='form-control' id='cmbUser2' name='cmbUser2'>
                <option value='0'>Selecione o Usuario</option>
-->                <?php
/*

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
 */                  ?>
<!--              
              </select>
            </div>
         </div>
         </form>

 
         
         
     -->

     <table class="table">
            	<?php
				  
				  // SELECIONA nr e rm da lista_turma onde a sg, ano e semestre forem iguais	

				  if($cd != 0){  
				  $comando ="select p.cd_processo,(uc.nm_user) as nm_cliente, (ua.nm_user) as nm_advogado, p.cd_estado_processo, ";
          $comando.="cp.nm_classe_processo,p.nm_juiz_processo,p.vl_processo, p.ds_processo,p.nm_segunda_parte, p.ic_requerente_sim_nao from processo p ";
          $comando.="inner join user uc on uc.cd_user = p.cd_cliente inner join user ua on ua.cd_user = p.cd_advogado ";
          $comando.="inner join classe_processo cp on cp.cd_classe_processo = p.cd_classe_processo WHERE p.cd_processo = ".$cd_proc;

          $cSQL = seleciona($comando);

                   $qtdLinhas = mysql_num_rows($cSQL);
                   
                   if ($qtdLinhas!=0)
                   {
					  //Titulo da Tabela
  
                      while($dados = mysql_fetch_array($cSQL))
                      {
          						  //Cria item na tabela com NR, RM e Nome
                        $comando2 ="select ap.nm_assunto_processo from processo_assunto_processo pap "; 
                        $comando2.="inner join assunto_processo ap on ";
                        $comando2.="ap.cd_assunto_processo = pap.cd_assunto_processo WHERE pap.cd_processo =".$cd_proc;
                        $cSQL2 = seleciona($comando2);
                        $assunto="";
                        $i=1;
                        while($dados2 = mysql_fetch_array($cSQL2))
                        {
                          if($i==1){
                            $assunto.=$dados2[0];
                            $i++;
                          }
                          else{
                            $assunto.=" / ".$dados2[0];
                          }
                          
                        }
                        $vl=str_replace(".",",",$dados[6]);
                        echo "<tr><th colspan='2'>Dados do Processo: </th></tr>"; 
          						  echo "<tr><td>Código do Processo: </td><td >".$dados[0]."</td></tr>";  
                        echo "<tr><td>Classe: </td><td >".$dados[4]."</td></tr>";  
                        echo "<tr><td>Assunto: </td><td >".$assunto."</td></tr>";  
                        echo "<tr><td>Juiz: </td><td >".$dados[5]."</td></tr>";  
                        echo "<tr><td>Valor da ação: </td><td >R$ ".$vl."</td></tr>";  
                        echo "<tr><td>Outros dados: </td><td >".$dados[7]."</td></tr>";  

                        echo "<tr><th colspan='2'>Partes do Processo: </th></tr>"; 
                        if($dados[9]==1)
                        {
                          echo "<tr><td>Requerente: </td><td >".$dados[1]."</td></tr>";  
                          echo "<tr><td>Advogado: </td><td >".$dados[2]."</td></tr>";  
                          echo "<tr><td>Requerido: </td><td >".$dados[8]."</td></tr>";  
                        }
                        else
                        {
                          echo "<tr><td>Requerente: </td><td >".$dados[8]."</td></tr>";
                          echo "<tr><td>Requerido: </td><td >".$dados[1]."</td></tr>";   
                          echo "<tr><td>Advogado: </td><td >".$dados[2]."</td></tr>";  
                        }
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
