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
  /*if(isset($_POST["cmbUser2"]) &&  $_POST["cmbUser2"] != "0" )
  {
    $user=$_POST["cmbUser2"];
  }
  else{
    $user=-1;
  }*/
  $msg = "";
  $orderby = "";
  $cat = "";
  $pesquisa = "";
  if ( isset($_GET["msg"]))
  {
    $msg = $_GET["msg"];
  }
  if ( isset($_GET["orderby"]))
  {
    $orderby = $_GET["orderby"];
    
  }
  if ( isset($_GET["cat"]) && isset($_GET["pesquisa"]))
  {
    $pesquisa = $_GET["pesquisa"];
    $cat = $_GET["cat"];    
  }
  switch ($orderby) {
      case 'cpf':
      default:
        $orderby="order by u.cd_cnpj_user ASC, u.cd_cpf_user ASC";
        break;
      case 'nm':
        $orderby="order by u.nm_user";
        break;
      case 'cnpj':
        $orderby="order by u.cd_cpf_user ASC, u.cd_cnpj_user DESC";
        break;
      default:
        $orderby=" ";
        break;
      
    }  
    switch ($cat) {
      case '0':
        $pesquisar="and u.cd_user like '%".$pesquisa."%' ";
        break;
      case '1':
        $pesquisar="and u.cd_cpf_user like '%".$pesquisa."%' ";
        break;
      case '2':
        $pesquisar="and u.cd_cnpj_user like '%".$pesquisa."%' ";
        break;
      case '3':
        $pesquisar="and u.nm_user like '%".$pesquisa."%' ";
        break;
      default:
        $pesquisar=" ";
        break;
    }
?>


<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="iso-8859-1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nome do SITE</title>


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
    <script src="js/validador.js"></script>
    <script>
	function getCEP(){
		if($.trim($("#txtCEP").val())!= ""){
			var cep = $("#txtCEP").val();
			exp = /\.|\-/g;
			cep = cep.toString().replace( exp, "" ); 
			alert (cep);
			$.getScript("cep.php?cep="+cep, function(){
				$("#txtEndereco").val(unescape(resultadoCEP["logradouro"]));
				$("#txtUF").val(unescape(resultadoCEP["uf"]));
				$("#txtBairro").val(unescape(resultadoCEP["bairro"]));
				$("#txtCidade").val(unescape(resultadoCEP["cidade"]));
			});
		}
	}
  function enviarclientes(){
    $(".chkd").prop("disabled", false);
  }
	$(document).ready(function(){
    
		
	$("input").blur(function(){
		if($(this).attr("placeholder")=="(00)0000-0000" || $(this).attr("placeholder")=="(00)00000-0000" || $(this).attr("placeholder")=="Complemento Endereço")
		{}
		else{
     if($(this).val() == "" )
         {
             $(this).css({"border-color" : "#F00"});
         }
		 else{
			  $(this).css({"border-color" : "#ddd"});
		 }
		}
    });
	})

	</script>
  <script>
  $(document).ready(function(){
    $(".control-form-hide").css("display","none");
    $(".abrirform:eq(0)").click(function(){
      $(".control-form-hide:eq(0)").show();
      
    });
    $(".fecharform:eq(0)").click(function(){
      $(".control-form-hide:eq(0)").hide();
      
    });
    $(".abrirform:eq(1)").click(function(){
      $(".control-form-hide:eq(1)").show();
      
    });
    $(".fecharform:eq(1)").click(function(){
      $(".control-form-hide:eq(1)").hide();
      
    });
  });
  </script>
       
  </head>


 <body style="overflow:auto; overflow-y:auto;">
    <div id="fundo"></div>
    <div id="areaCentral2"></div>
       <aside class="menu">
                  <nav class="container-menu">
                    <div id="logo-mini">
                        <img width="100%" src="Images/logo Y.png" alt="Cleide Pacheco Advocacia">
                      </div>
                      <?php if($typeU==1){?>
                          <a href="processo.php" class="link-menu" >
                            <ul><img src="Images/ico/processo.png" alt="Home" class="ico-menu"> <p class="text-menu">Processos</p></ul>
                          </a>
                          
                          <a href="agenda.php" class="link-menu" >
                            <ul><img src="Images/ico/agenda.png" alt="Home" class="ico-menu"> <p class="text-menu">Agenda</p></ul>
                          </a>
                             
                          <a href="cliente.php" class="link-menu" id="home">
                            <ul><img src="Images/ico/empresa2.png" alt="Home" class="ico-menu"> <p class="text-menu">Clientes</p></ul>
                          </a>
                          
                          <a href="chat.php" class="link-menu" >
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

    <div id="areaCentral">
    <!-- info do user -->
      <div id="caixaLogado">
        Ol&aacute; <?=$email ?> | <a href="sair.php">Sair</a>
      </div>



      <div class="divisoria"> </div>
      <h2 class="title">Clientes</h2>
      <div class="div-title"> </div>

            
             
           <!-- fim info user -->
      <?php
        if($typeU==1){
      ?>
       
      <input type="button" name="abrirform" class="btn-default abrirform" value="Novo Cliente">
      <div class="msg">
          <h5><?php echo $msg ?></h5>
      </div>
      <div class='control-form-hide'>
          <div class='form-horizontal-hide'>
            <div class='form-group label-title'>
                <label for='titleForm' >Novo Cliente</label>
                <input type="button"  name="fecharform" class="btn-close fecharform"value="X">
            </div>
            <div class='form-horizontal-control'>

              <form class='form' role='form' method='post' action='incluirCliente.php' id="form" name="form">
                                
                 
                 <div class="form-group">
                      <label for="inputNome" class="col-sm-2 control-label" >Nome Completo:</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" id="txtNome" name="txtNome" required placeholder="Nome Completo">
                      </div>
                 </div>
                 <div class="form-group">
                      <label for="inputCPF" class="col-sm-2 control-label">CPF:</label>
                      <div class="col-sm-3">
                        <input type="text" class="form-control" id="txtCPF" name="txtCPF" required placeholder="CPF" onBlur="ValidarCPF(form.txtCPF);" onKeyPress="MascaraCPF(form.txtCPF);" maxlength="14">
                      </div>
                      <label for="inputNascimento" class="col-sm-2 control-label">Data de Nasc.:</label>
                      <div class="col-sm-3">
                        <input type="date" class="form-control" name="txtData" id="txtData" required placeholder="Data de Nascimento">
                      </div>            
                 </div>

                 <div class="form-group">
                      <label for="inputEmail" class="col-sm-2 control-label">E-mail:</label>
                      <div class="col-sm-8">
                        <input type="email" class="form-control" id="txtEmail" name="txtEmail" required placeholder="Email">
                      </div>
                 </div>
                 
                 <div class="form-group">
                      <label for="inputConfEmail" class="col-sm-2 control-label">Confirma&ccedil;&atilde;o de E-mail:</label>
                      <div class="col-sm-8">
                        <input type="email" class="form-control" id="txtConfEmail" name="txtConfEmail" required placeholder="Confirmação de Email">
                      </div>
                 </div>
           
                 <div class="form-group">
                      <label for="inputSenha" class="col-sm-2 control-label">Senha:</label>
                      <div class="col-sm-8">
                        <input type="password" class="form-control" id="txtSenha" name="txtSenha" required placeholder="Senha">
                      </div>
                 </div>

                 <div class="form-group">
                      <label for="inputConfSenha" class="col-sm-2 control-label">Confirma&ccedil;&atilde;o de Senha:</label>
                      <div class="col-sm-8">
                        <input type="password" class="form-control" id="txtConfSenha" name="txtConfSenha" required placeholder="Confirmação de Senha">
                      </div>
                 </div>
                 
                 <!-- TIPO USUARIO  - - Fazer com PHP - - TIPO USUARIO -->
                 <!-- CNA ADVOGADO  - - Fazer com PHP - - CNA ADVOGADO -->
                 
                 <div class="form-group">
                      <label for="inputCEP" class="col-sm-2 control-label">CEP</label>
                      <div class="col-sm-4">
                        <input type="text" class="form-control" id="txtCEP" name="txtCEP" required placeholder="CEP" onChange="getCEP();" onKeyPress="MascaraCep(form.txtCEP);" maxlength"10" onBlur="ValidaCep(form.txtCEP)">
                      </div>
                      <a href="http://www.buscacep.correios.com.br/servicos/dnec/menuAction.do?Metodo=menuEndereco" target="_blank"><label for="inputNum" class="col-sm-2 control-label">Buscar CEP</label></a>
                      
                 </div>       
                 <div class="form-group">
                      <label for="inputEndereco" class="col-sm-2 control-label">Endere&ccedil;o</label>
                      <div class="col-sm-5">
                        <input type="text" class="form-control" id="txtEndereco" name="txtEndereco" placeholder="Endereço" disabled>
                      </div>
                      <label for="inputNum" class="col-sm-1 control-label">N&uacute;mero</label>
                      <div class="col-sm-2">
                        <input type="text" class="form-control" id="txtNum" name="txtNum" required placeholder="Número">
                      </div>
                 </div>
                 <div class="form-group">
                      <label for="inputComplemento" class="col-sm-2 control-label">Complemento Endere&ccedil;o</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" id="txtComplemento" name="txtComplemento" placeholder="Complemento Endereço" >
                      </div>
                 </div>
                 <div class="form-group">
                      <label for="inputBairro" class="col-sm-2 control-label">Bairro</label>
                      <div class="col-sm-2">
                        <input type="text" class="form-control" id="txtBairro" name="txtBairro" placeholder="Bairro" disabled>
                      </div>
                      <label for="inputCidade" class="col-sm-1 control-label">Cidade</label>
                      <div class="col-sm-2">
                        <input type="text" class="form-control" id="txtCidade" name="txtCidade" placeholder="Cidade" disabled>
                      </div>
                      <label for="inputUF" class="col-sm-1 control-label">UF</label>
                      <div class="col-sm-2">
                        <input type="text" class="form-control" id="txtUF" name="txtUF" placeholder="UF" disabled>
                      </div>
                 </div>
                 
                 
                 <div class="form-group">
                      <label for="inputTelRes" class="col-sm-2 control-label tel">Telefone Residencial</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" id="txtTelRes" name="txtTelRes" maxlength="14" placeholder="(00)0000-0000" onKeyPress="MascaraTelefone(form.txtTelRes);" onBlur="ValidaTelefone(form.txtTelRes);">
                      </div>
                 </div>
                 
                 <div class="form-group">
                      <label for="inputTelCom" class="col-sm-2 control-label tel">Telefone Comercial</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" id="txtTelCom" name="txtTelCom"  maxlength="14" placeholder="(00)0000-0000" onKeyPress="MascaraTelefone(form.txtTelCom);" onBlur="ValidaTelefone(form.txtTelCom);">            </div>
                 </div>
                 
                 <div class="form-group">
                      <label for="inputCelPrinc" class="col-sm-2 control-label cel">Celular Principal</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" id="txtCelPrinc" name="txtCelPrinc" maxlength="15" placeholder="(00)00000-0000" onKeyPress="MascaraCelular(form.txtCelPrinc);" onBlur="ValidaCelular(form.txtCelPrinc);">
                      </div>
                 </div>
                 
                 <div class="form-group">
                        <label for="inputCelSec" class="col-sm-2 control-label cel">Celular Secund&aacute;rio</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" id="txtCelSec" name="txtCelSec" maxlength="15" placeholder="(00)00000-0000" onKeyPress="MascaraCelular(form.txtCelSec);" onBlur="ValidaCelular(form.txtCelSec);">
                      </div>
                 </div>
                 <div class="form-group">
                      <div class="col-sm-2">
                      </div>
                      <div class="col-sm-3">
                        <input type="submit" value="Cadastrar" class="btn btn-default" id="cadastrar_botao">
                      </div>
                 </div>
              </form>
          </div>
        </div>
      </div>



      <input type="button" name="abrirform" class="btn-default abrirform" value="Nova Empresa">
      <div class="msg">
          <h5><?echo $msg ?></h5>
      </div>
      <div class='control-form-hide'>
          <div class='form-horizontal-hide'>
            <div class='form-group label-title'>
                <label for='titleForm' >Nova Empresa</label>
                <input type="button"  name="fecharform" class="btn-close fecharform"value="X">
            </div>
            <div class='form-horizontal-control'>

              <form class='form' role='form' method='post' action='incluirCliente.php' id="form" name="form">
                                
                 
                 <div class="form-group">
                      <label for="inputNome" class="col-sm-2 control-label" >Nome Completo:</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" id="txtNome" name="txtNome" required placeholder="Nome Completo">
                      </div>
                 </div>
                 <div class="form-group">
                      <label for="inputCPF" class="col-sm-2 control-label">CPF:</label>
                      <div class="col-sm-3">
                        <input type="text" class="form-control" id="txtCPF" name="txtCPF" required placeholder="CPF" onBlur="ValidarCPF(form.txtCPF);" onKeyPress="MascaraCPF(form.txtCPF);" maxlength="14">
                      </div>
                      <label for="inputNascimento" class="col-sm-2 control-label">Data de Nasc.:</label>
                      <div class="col-sm-3">
                        <input type="date" class="form-control" name="txtData" id="txtData" required placeholder="Data de Nascimento">
                      </div>            
                 </div>

                 <div class="form-group">
                      <label for="inputEmail" class="col-sm-2 control-label">E-mail:</label>
                      <div class="col-sm-8">
                        <input type="email" class="form-control" id="txtEmail" name="txtEmail" required placeholder="Email">
                      </div>
                 </div>
                 
                 <div class="form-group">
                      <label for="inputConfEmail" class="col-sm-2 control-label">Confirma&ccedil;&atilde;o de E-mail:</label>
                      <div class="col-sm-8">
                        <input type="email" class="form-control" id="txtConfEmail" name="txtConfEmail" required placeholder="Confirmação de Email">
                      </div>
                 </div>
           
                 <div class="form-group">
                      <label for="inputSenha" class="col-sm-2 control-label">Senha:</label>
                      <div class="col-sm-8">
                        <input type="password" class="form-control" id="txtSenha" name="txtSenha" required placeholder="Senha">
                      </div>
                 </div>

                 <div class="form-group">
                      <label for="inputConfSenha" class="col-sm-2 control-label">Confirma&ccedil;&atilde;o de Senha:</label>
                      <div class="col-sm-8">
                        <input type="password" class="form-control" id="txtConfSenha" name="txtConfSenha" required placeholder="Confirmação de Senha">
                      </div>
                 </div>
                 
                 <!-- TIPO USUARIO  - - Fazer com PHP - - TIPO USUARIO -->
                 <!-- CNA ADVOGADO  - - Fazer com PHP - - CNA ADVOGADO -->
                 
                 <div class="form-group">
                      <label for="inputCEP" class="col-sm-2 control-label">CEP</label>
                      <div class="col-sm-4">
                        <input type="text" class="form-control" id="txtCEP" name="txtCEP" required placeholder="CEP" onChange="getCEP();" onKeyPress="MascaraCep(form.txtCEP);" maxlength"10" onBlur="ValidaCep(form.txtCEP)">
                      </div>
                      <a href="http://www.buscacep.correios.com.br/servicos/dnec/menuAction.do?Metodo=menuEndereco" target="_blank"><label for="inputNum" class="col-sm-2 control-label">Buscar CEP</label></a>
                      
                 </div>       
                 <div class="form-group">
                      <label for="inputEndereco" class="col-sm-2 control-label">Endere&ccedil;o</label>
                      <div class="col-sm-5">
                        <input type="text" class="form-control" id="txtEndereco" name="txtEndereco" placeholder="Endereço" disabled>
                      </div>
                      <label for="inputNum" class="col-sm-1 control-label">N&uacute;mero</label>
                      <div class="col-sm-2">
                        <input type="text" class="form-control" id="txtNum" name="txtNum" required placeholder="Número">
                      </div>
                 </div>
                 <div class="form-group">
                      <label for="inputComplemento" class="col-sm-2 control-label">Complemento Endere&ccedil;o</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" id="txtComplemento" name="txtComplemento" placeholder="Complemento Endereço" >
                      </div>
                 </div>
                 <div class="form-group">
                      <label for="inputBairro" class="col-sm-2 control-label">Bairro</label>
                      <div class="col-sm-2">
                        <input type="text" class="form-control" id="txtBairro" name="txtBairro" placeholder="Bairro" disabled>
                      </div>
                      <label for="inputCidade" class="col-sm-1 control-label">Cidade</label>
                      <div class="col-sm-2">
                        <input type="text" class="form-control" id="txtCidade" name="txtCidade" placeholder="Cidade" disabled>
                      </div>
                      <label for="inputUF" class="col-sm-1 control-label">UF</label>
                      <div class="col-sm-2">
                        <input type="text" class="form-control" id="txtUF" name="txtUF" placeholder="UF" disabled>
                      </div>
                 </div>
                 
                 
                 <div class="form-group">
                      <label for="inputTelRes" class="col-sm-2 control-label tel">Telefone Residencial</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" id="txtTelRes" name="txtTelRes" maxlength="14" placeholder="(00)0000-0000" onKeyPress="MascaraTelefone(form.txtTelRes);" onBlur="ValidaTelefone(form.txtTelRes);">
                      </div>
                 </div>
                 
                 <div class="form-group">
                      <label for="inputTelCom" class="col-sm-2 control-label tel">Telefone Comercial</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" id="txtTelCom" name="txtTelCom"  maxlength="14" placeholder="(00)0000-0000" onKeyPress="MascaraTelefone(form.txtTelCom);" onBlur="ValidaTelefone(form.txtTelCom);">            </div>
                 </div>
                 
                 <div class="form-group">
                      <label for="inputCelPrinc" class="col-sm-2 control-label cel">Celular Principal</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" id="txtCelPrinc" name="txtCelPrinc" maxlength="15" placeholder="(00)00000-0000" onKeyPress="MascaraCelular(form.txtCelPrinc);" onBlur="ValidaCelular(form.txtCelPrinc);">
                      </div>
                 </div>
                 
                 <div class="form-group">
                        <label for="inputCelSec" class="col-sm-2 control-label cel">Celular Secund&aacute;rio</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" id="txtCelSec" name="txtCelSec" maxlength="15" placeholder="(00)00000-0000" onKeyPress="MascaraCelular(form.txtCelSec);" onBlur="ValidaCelular(form.txtCelSec);">
                      </div>
                 </div>
                 <div class="form-group">
                      <div class="col-sm-2">
                      </div>
                      <div class="col-sm-3">
                        <input type="submit" value="Cadastrar" class="btn btn-default" id="cadastrar_botao">
                      </div>
                 </div>
              </form>
          </div>
        </div>
      </div>


      <?php
        }
      ?>
      <form id="pesquisarq">
        <label id="pesq">PESQUISAR POR:</label>
        <select id="cat" name="cat" style="width:150px; float:left; margin-left:13px; margin-top:7px;">
          <option value='0'>C&oacute;digo</option>
          <option value='1'>CPF</option>
          <option value='2'>CNPJ</option>
          <option value='3'>Classe Processo</option>
        </select> 
        <input type="text" id="pesquisa" name="pesquisa" style="width:140px; margin-top:0px; float:left; margin-top:7px; margin-left:5px;">
        <input type="submit"  class="btn-default btn-pesquisa" value="Pesquisar">
      </form>
      <form id="clientes" role='form' method='post' action='atualizacliente.php' name="clientes">

      <table class="table">
              <?php
          
          // SELECIONA nr e rm da lista_turma onde a sg, ano e semestre forem iguais  




          if($cd != 0){  
          if($typeU==1){
            $comando = "select u.nm_user, u.cd_cnpj_user, u.cd_cpf_user, u.cd_user from user u where cd_tipo_user=2 ".$pesquisar." ".$orderby;
          }
          $cSQL = seleciona($comando);
                   $qtdLinhas = mysql_num_rows($cSQL);
                   
                   if ($qtdLinhas!=0)
                   {
            //Titulo da Tabela
                    if($typeU==1)
                       echo "<thead><tr>    <th><a href='?orderby=cpf'>CPF</a></th>      <th class='codigo'><a href='?orderby=cnpj'>CNPJ</a></th>    <th class='cliente'><a href='?orderby=nm'>Nome do Usu&aacute;rio</a></th>    <th class='btn'><input type='submit' value='Atualizar Clientes' class='btn-form-default-out' onClick='enviarclientes();'>  </th>     </tr></thead>";    
                    while($dados = mysql_fetch_array($cSQL))
                      {
                        $comando2="select * from advogado_user where cd_advogado = ".$cd." and cd_cliente=".$dados[3];
                        $cSQL2 = seleciona($comando2);
                        $qtdLinhas2 = mysql_num_rows($cSQL2);
                        if ($qtdLinhas2!=0)
                        {
                            $comando3="select * from processo where cd_advogado = ".$cd." and cd_cliente=".$dados[3];
                            $cSQL3 = seleciona($comando3);
                            $qtdLinhas3 = mysql_num_rows($cSQL3);
                            if ($qtdLinhas3!=0)
                            {
                                if($dados[1] == "")
                                {
                                  echo "<tr><td class='codigo'>".$dados[2]."</td> <td class='codigo'> </td> <td >".$dados[0]."</td> <td class='btn'><input type='checkbox' class='checkboxBTN chkd' checked disabled name='meusclientes[]' value=".$dados[3]."> </td></tr>";  
                                }
                                else{
                                  echo "<tr><td class='codigo'> </td> <td class='codigo'> ".$dados[1]."</td> <td >".$dados[0]."</td> <td class='btn'><input type='checkbox' class='checkboxBTN chkd' checked disabled  name='meusclientes[]' value=".$dados[3]."> </td></tr>"; 
                                }
                            }
                            else{
                                if($dados[1] == "")
                                {
                                  echo "<tr><td class='codigo'>".$dados[2]."</td> <td class='codigo'> </td> <td >".$dados[0]."</td> <td class='btn'><input type='checkbox' class='checkboxBTN' checked name='meusclientes[]' value=".$dados[3]."> </td></tr>";  
                                }
                                else{
                                  echo "<tr><td class='codigo'> </td> <td class='codigo'> ".$dados[1]."</td> <td >".$dados[0]."</td> <td class='btn'><input type='checkbox' class='checkboxBTN' checked name='meusclientes[]' value=".$dados[3]."> </td></tr>"; 
                                }

                            }
                        }
                        else{
                            if($dados[1] == "")
                            {
                              echo "<tr><td class='codigo'>".$dados[2]."</td> <td class='codigo'> </td> <td >".$dados[0]."</td> <td class='btn'><input type='checkbox' class='checkboxBTN' name='meusclientes[]' value=".$dados[3]."> </td></tr>";  
                            }
                            else{
                              echo "<tr><td class='codigo'> </td> <td class='codigo'> ".$dados[1]."</td> <td >".$dados[0]."</td> <td class='btn'><input type='checkbox' class='checkboxBTN' name='meusclientes[]' value=".$dados[3]."> </td></tr>"; 
                            }

                        }
                      }
                   
                   desconecta();
        }
          }

                ?>    

       </table>
       
     </form>

    </div>

  </body>
</html>
