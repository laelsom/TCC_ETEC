<?php 
  session_start("login");
  if ($_SESSION["rmLogado"] == "")
  {
    Header("Location:index.php");
  }
  else
  {
    $email = $_SESSION["rmLogado"];
    $nome = $_SESSION["nmLogado"];
	$typeU = $_SESSION["tpLogado"];
  }
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="iso-8859-1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nome do SITE</title>

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
    <script src="js/jquery-1.9.1.js"></script>
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
	$(document).ready(function(){
		
	$("input").blur(function(){
		if($(this).attr("placeholder")=="(00)0000-0000" || $(this).attr("placeholder")=="(00)00000-0000" || $(this).attr("placeholder")=="Complemento Endereço")
		{}
		else{
     if($(this).val() == "" )
         {
             $(this).css({"border-color" : "#F00", "padding": "10px"});
         }
		 else{
			  $(this).css({"border-color" : "#ddd", "padding": "10px"});
		 }
		}
    });
	})

	</script>
    

    
    
  </head>
  <body style="overflow:auto; overflow-y:auto;">
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
     <div id="caixaLogado">
        Ol&aacute; <?=$nome ?> | <a href="sair.php">Sair</a>
     </div>

     <div id="areaCentral">
        

     <h2>Novo Usuario</h2>
     <h4>Preencha os dados abaixo:</h4>
     <hr class="divisoria" />
     <div id="form2">
       <form class="form-horizontal" role="form" method="post" action="incluirCliente.php">
       
       <div class="form-group">
            <label for="inputNome" class="col-sm-2 control-label" >Nome Completo:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="txtNome" name="txtNome" required placeholder="Nome Completo">
            </div>
       </div>
       <div class="form-group">
            <label for="inputCPF" class="col-sm-2 control-label">CPF:</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" id="txtCPF" name="txtCPF" required placeholder="CPF" onBlur="ValidarCPF(form.txtCPF);" onKeyPress="MascaraCPF(form.txtCPF);" maxlength="14">
            </div>
            <label for="inputNascimento" class="col-sm-3 control-label">Data de Nasc.:</label>
            <div class="col-sm-4">
              <input type="date" class="form-control" name="txtData" id="txtData" required placeholder="Data de Nascimento">
            </div>            
       </div>

       <div class="form-group">
            <label for="inputEmail" class="col-sm-2 control-label">E-mail:</label>
            <div class="col-sm-10">
              <input type="email" class="form-control" id="txtEmail" name="txtEmail" required placeholder="Email">
            </div>
       </div>
       
       <div class="form-group">
            <label for="inputConfEmail" class="col-sm-2 control-label">Confirma&ccedil;&atilde;o de E-mail:</label>
            <div class="col-sm-10">
              <input type="email" class="form-control" id="txtConfEmail" name="txtConfEmail" required placeholder="Confirmação de Email">
            </div>
       </div>
 
       <div class="form-group">
            <label for="inputSenha" class="col-sm-2 control-label">Senha:</label>
            <div class="col-sm-10">
              <input type="password" class="form-control" id="txtSenha" name="txtSenha" required placeholder="Senha">
            </div>
       </div>

       <div class="form-group">
            <label for="inputConfSenha" class="col-sm-2 control-label">Confirma&ccedil;&atilde;o de Senha:</label>
            <div class="col-sm-10">
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
            <div class="col-sm-6">
              <input type="text" class="form-control" id="txtEndereco" name="txtEndereco" placeholder="Endereço" disabled>
            </div>
            <label for="inputNum" class="col-sm-2 control-label">N&uacute;mero</label>
            <div class="col-sm-2">
              <input type="text" class="form-control" id="txtNum" name="txtNum" required placeholder="Número">
            </div>
       </div>
       <div class="form-group">
            <label for="inputComplemento" class="col-sm-2 control-label">Complemento Endere&ccedil;o</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="txtComplemento" name="txtComplemento" placeholder="Complemento Endereço" >
            </div>
       </div>
       <div class="form-group">
            <label for="inputBairro" class="col-sm-2 control-label">Bairro</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" id="txtBairro" name="txtBairro" placeholder="Bairro" disabled>
            </div>
            <label for="inputCidade" class="col-sm-1 control-label">Cidade</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" id="txtCidade" name="txtCidade" placeholder="Cidade" disabled>
            </div>
            <label for="inputUF" class="col-sm-1 control-label">UF</label>
            <div class="col-sm-2">
              <input type="text" class="form-control" id="txtUF" name="txtUF" placeholder="UF" disabled>
            </div>
       </div>
       
       
       <div class="form-group">
            <label for="inputTelRes" class="col-sm-2 control-label tel">Telefone Residencial</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="txtTelRes" name="txtTelRes" maxlength="14" placeholder="(00)0000-0000" onKeyPress="MascaraTelefone(form.txtTelRes);" onBlur="ValidaTelefone(form.txtTelRes);">
            </div>
       </div>
       
       <div class="form-group">
            <label for="inputTelCom" class="col-sm-2 control-label tel">Telefone Comercial</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="txtTelCom" name="txtTelCom"  maxlength="14" placeholder="(00)0000-0000" onKeyPress="MascaraTelefone(form.txtTelCom);" onBlur="ValidaTelefone(form.txtTelCom);">            </div>
       </div>
       
       <div class="form-group">
            <label for="inputCelPrinc" class="col-sm-2 control-label cel">Celular Principal</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="txtCelPrinc" name="txtCelPrinc" maxlength="15" placeholder="(00)00000-0000" onKeyPress="MascaraCelular(form.txtCelPrinc);" onBlur="ValidaCelular(form.txtCelPrinc);">
            </div>
       </div>
       
       <div class="form-group">
              <label for="inputCelSec" class="col-sm-2 control-label cel">Celular Secund&aacute;rio</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="txtCelSec" name="txtCelSec" maxlength="15" placeholder="(00)00000-0000" onKeyPress="MascaraCelular(form.txtCelSec);" onBlur="ValidaCelular(form.txtCelSec);">
            </div>
       </div>
       <div class="form-group">
			<label for="inputTipoUser" class="col-sm-2 control-label">Tipo Usu&aacute;rio</label>
            <div class="col-sm-7">
              <select class="form-control" id="txtTipoU" name="txtTipoU">
              	<option value="3">Visitante</option>
                <?php
				if($typeU==1 || $typeU == 0)
					echo "<option value='2' selected >Cliente</option>";
				if($typeU==0)
                	echo "<option value='1'>Advogado</option>";
			    ?>
                
              </select>
            </div>
            <div class="col-sm-3">
            	<input type="submit" value="Cadastrar" class="btn btn-default col-sm-12" id="cadastrar_botao">
            </div>
       </div>
       </form>
      </div>
     </div>
     </main>
  </body>
</html>
