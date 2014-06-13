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
  if(isset($_POST["dataS"]) )
  {
	  $data=$_POST["dataS"];
  }
  else{
  	  date_default_timezone_set('America/Sao_Paulo');
	  $data=date('Y-m-d');
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
	<script src="js/jquery-1.8.3.js"></script>
	<script src="js/jquery-ui-1.9.2.custom.js"></script>
	
		
        <script>
	$(document).ready(function(){
		var cep ="";
		var num ="";
		var countCEP=0;
		var countF=0;
		 $(".desc").hide();
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
	<script>
    $(document).ready(function() {
     var x="";
     var d = new Date();

	var month = d.getMonth()+1;
	var day = d.getDate();

	var output = d.getFullYear() + '/' +
	    (month<10 ? '0' : '') + month + '/' +
	    (day<10 ? '0' : '') + day;
     $("#dataS").val(output);
     $( "#calendario" ).datepicker({
          inline: true,
          dateFormat: 'yy-mm-dd',
              dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
              dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
              dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
              monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
            constrainInput: true,
            minDate:'+0d',
            numberOfMonths: 1,
          altFormat: 'yy-mm-dd'


        });
      $( "#calendario" ).change(function(){
        
        $("#dataS").val($( "#calendario" ).val());
        
      });
      $("#carregaA").click(function(){
      	$("#form2").submit();
      })

    });
  </script>

    <script>

	$(document).ready(function(){
			
	  $("#txtDataI").change(function(){
		$("#txtDataF").val($(this).val());
	  });
	  
	  	
	  });
	  $(function () {
			var $radios = $('input:radio[name=rdoEndereco]');
			if($radios.is(':checked') == false) {
				$radios.filter('[value=0]').prop('checked', true);
				$("#txtCEP").prop('disabled', true);
				$("#txtEndereco").prop('disabled', true);
				$("#txtUF").prop('disabled', true);
				$("#txtBairro").prop('disabled', true);
				$("#txtCidade").prop('disabled', true);
				$("#txtNr").prop('disabled', true);

			}});
	   $("#txtCEP").change(function(){
		  $('input:radio[name=rdoEndereco]').each(function() {
                        //Verifica qual está selecionado
                        if ($(this).is(':checked'))
                            valor = parseInt($(this).val());
                    });
		  if($("#txtCEP").val()!="" && valor==1)
		  {
			  if($.trim($("#txtCEP").val())!= ""){
				$.getScript("cep.php?cep="+$("#txtCEP").val(), function(){
					
					$("#txtEndereco").val(unescape(resultadoCEP["logradouro"]));
					$("#txtUF").val(unescape(resultadoCEP["uf"]));
					$("#txtBairro").val(unescape(resultadoCEP["bairro"]));
					$("#txtCidade").val(unescape(resultadoCEP["cidade"]));
					
			});
		}
		  }
	   });
	   $('.rdoEndereco').change(function() {
                    var valor = "";
					
                    //Executa Loop entre todas as Radio buttons com o name de valor
                    $('input:radio[name=rdoEndereco]').each(function() {
                        //Verifica qual está selecionado
                        if ($(this).is(':checked'))
                            valor = parseInt($(this).val());
                    });
                    if(valor == 1)
					{
						
						$("#txtCEP").prop('disabled', false);
						$("#txtNr").prop('disabled', false);
						$("#txtEndereco").prop('disabled', false);
						$("#txtUF").prop('disabled', false);
						$("#txtBairro").prop('disabled', false);
						$("#txtCidade").prop('disabled', false);
						if(countCEP==0)
						{
							cep = $("#txtCEP").val();
							num = $("#txtNr").val();
						}
						$("#txtCEP").val('');
						$("#txtEndereco").val('');
						$("#txtUF").val('');
						$("#txtBairro").val('');
						$("#txtCidade").val('');
						$("#txtNr").val('');
						countCEP++;
					}
					else{
						$("#txtCEP").val(cep);
						$("#txtNr").val(num);
						$.getScript("cep.php?cep="+$("#txtCEP").val(), function(){
					
							$("#txtEndereco").val(unescape(resultadoCEP["logradouro"]));
							$("#txtUF").val(unescape(resultadoCEP["uf"]));
							$("#txtBairro").val(unescape(resultadoCEP["bairro"]));
							$("#txtCidade").val(unescape(resultadoCEP["cidade"]));
							
						});
						$("#txtCEP").prop('disabled', true);
						$("#txtEndereco").prop('disabled', true);
						$("#txtUF").prop('disabled', true);
						$("#txtBairro").prop('disabled', true);
						$("#txtCidade").prop('disabled', true);
						$("#txtNr").prop('disabled', true);
						
					}
                });
		$("#cmbUser").change(function(){
			var userArray = $("#cmbUser").val().split("##");
			$.getScript("data.php?cd="+userArray[0], function(){
							
				$("#txtCEP").val(unescape(resultadoCEP["cep"]));
				$("#txtEndereco").val(unescape(resultadoCEP["logradouro"]));
				$("#txtUF").val(unescape(resultadoCEP["uf"]));
				$("#txtBairro").val(unescape(resultadoCEP["bairro"]));
				$("#txtCidade").val(unescape(resultadoCEP["cidade"]));
				$("#txtNr").val(unescape(resultadoCEP["numero"]));
			});
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
            
                <?php if($typeU==1){?>
                    <a href="processo.php" class="link-menu" >
                    	<ul><img src="Images/ico/processo.png" alt="Home" class="ico-menu"> <p class="text-menu">Processos</p></ul>
                    </a>
                    
                    <a href="agenda.php" class="link-menu" id="home">
                   		<ul><img src="Images/ico/agenda.png" alt="Home" class="ico-menu"> <p class="text-menu">Agenda</p></ul>
                    </a>
                       
                    <a href="cliente.php" class="link-menu">
                    	<ul><img src="Images/ico/empresa2.png" alt="Home" class="ico-menu"> <p class="text-menu">Áreas de Atuação</p></ul>
                    </a>
                    
                    <a href="chat.php" class="link-menu" >
                    	<ul><img src="Images/ico/chat.png" alt="Home" class="ico-menu"> <p class="text-menu">Chat</p></ul>
                    </a>
                <?php 
            		}else if($typeU==2) 
            		{
            	?>
            		<a href="perfil.php" class="link-menu" >
                    	<ul><img src="Images/ico/home.png" alt="Home" class="ico-menu"> <p class="text-menu">Áreas de Atuação</p></ul>
                    </a>
               		
            		<a href="processo.php" class="link-menu" >
                    	<ul><img src="Images/ico/processo.png" alt="Home" class="ico-menu"> <p class="text-menu">Processos</p></ul>
                    </a>
                    
                    <a href="agenda.php" class="link-menu"id="home">
                   		<ul><img src="Images/ico/agenda.png" alt="Home" class="ico-menu"> <p class="text-menu">Agenda</p></ul>
                    </a>
                       
                    <a href="chat.php" class="link-menu">
                    	<ul><img src="Images/ico/chat.png" alt="Home" class="ico-menu"> <p class="text-menu">Chat</p></ul>
                    </a>
                <?php
            		}

                ?>
                
                 
            </nav>
        </aside>
<!--Fim Menu--> 

     <div id="caixaLogado">
        Ol&aacute; <?=$email ?> | <a href="sair.php">Sair</a>
    </div>

    <div id="areaCentral">
<div id="calendario"></div>

      <div class="divisoria"> </div>
      

      <h2 class="title">Agenda</h2>
      <div class="div-title"> </div>
       
       
       <!-- Cria Tabela de agenda-->

       <?php
	   
	   if($typeU==1){
		   ?>

           
			<div class="msg">
				<h5><?=$msg?></h5>
			</div>
		<div class='control-form-hide'>
		    <form class='form-horizontal-hide' role='form' method='post' action='adicionaragenda.php' id="form" name="form">
				<div class='form-group label-title'>
					<label for='titleForm' >Novo Evento</label>
					<input type="button" id="fecharform" name="fecharform" class="btn-close"value="X">
				</div>
				<div class='form-group'>
					<label for='inputUser' class='col-sm-3 control-label'>Usu&aacute;rio:</label>
					<div class='col-sm-7'>
						<select class='form-control' id='cmbUser' name='cmbUser'>
							<option value='0'>Selecione o Usuario</option>
								<?php
									$comando ="select user.cd_email_user, user.cd_user from advogado_user inner join user where advogado_user.cd_advogado=".$cd." and user.cd_user=advogado_user.cd_cliente order by cd_user ASC";
									$cSQL = seleciona($comando);
									$qtdLinhas = mysql_num_rows($cSQL);
									if ($qtdLinhas!=0)
									{
										while($dados=mysql_fetch_array($cSQL))
										{                 
											echo "<option value='".  $dados[1] ."'> Cod: " . $dados[1] ." - E-mail: ".$dados[0] . " </option>";
										}
									}
								?>

						</select>
					</div>
				</div>
						 
				<div class='form-group'>
					<label for='inputDataI' class='col-sm-3 control-label'>Data de Inicio:</label>
					<div class='col-sm-3 col-sm-corrige-4'>
						<input type='date' class='form-control' name='txtDataI' id='txtDataI' required placeholder='Data'>
					</div>
					<label for='inputTi' class='col-sm-3 control-label'>Hora de Inicio:</label>
					<div class='col-sm-1'>
						<input type='time' class='form-control' name='txtTimeI' id='txtTimeI' required placeholder='Hora' value="">
					</div>
				</div>
				<div class='form-group'>
					<label for='inputDataF' class='col-sm-3 control-label'>Data de Termino:</label>
					<div class='col-sm-3 col-sm-corrige-4'>
						<input type='date' class='form-control' name='txtDataF' id='txtDataF' required placeholder='Data'>
					</div>
					<label for='inputTF' class='col-sm-3 control-label'>Data de Termino:</label>
					<div class='col-sm-1'>
						<input type='time' class='form-control' name='txtTimeF' id='txtTimeF' required placeholder='Hora'>
					</div>
				</div>
				<div class='form-group'>
					<label for='inputLocal' class='col-sm-3 control-label'>Local:</label>
					<div class='col-sm-4'>
						<input type='radio' class='rdoEndereco' id='rdoEndereco' name='rdoEndereco' value='0' checked> Escrit&oacute;rio </input>
					</div>
					<div class='col-sm-3 col-sm-corrige-4'>
						<input type='radio' class='rdoEndereco' id='rdoEndereco' name='rdoEndereco' value='1'> Outro Endere&ccedil;o </input>
					</div>
				</div>
				<div class='form-group'>
					<label for='inputCEP' class='col-sm-3 control-label'>CEP:</label>
					<div class='col-sm-3 col-sm-corrige-4'>
						<input type='text' id='txtCEP' name='txtCEP' class="form-control" placeholder='CEP' value='' />
					</div>
					<label for='inputNumEnd' class='col-sm-2  control-label'>N&uacute;mero:</label>
					<div class='col-sm-2'>
						<input type='text' id='txtNr' name='txtNr' class="form-control" placeholder='N&uacute;mero' value='' />
					</div>
				</div>
				<div class='form-group'> 
					<label for='inputEndereco' class='col-sm-3 control-label'>Endere&ccedil;o:</label>
					<div class='col-sm-7 col-sm-7e'>
						<input type='text' id='txtEndereco' name='txtEndereco' class="form-control" placeholder='Endere&ccedil;o' value='' />
					</div>
				</div>
				<div class='form-group'>
					<label for='inputCEP' class='col-sm-3 control-label'>Bairro:</label>
					<div class='col-sm-2'>
						<input type='text' id='txtBairro' name='txtBairro' class="form-control" placeholder='Bairro' value='' />
					</div>
					<label for='inputCidade' class='col-sm-1 control-label'>Cidade:</label>
					<div class='col-sm-2 col-sm-corrige-6'>
						<input type='text' id='txtCidade' name='txtCidade' class="form-control" placeholder='Cidade' value='' />
					</div>
					<label for='inputUF' class='col-sm-1 control-label col-sm-corrige-'>UF:</label>
					<div class='col-sm-1'>
						<input type='text' id='txtUF' name='txtUF' class="form-control" placeholder='UF' value='' />
					</div>
				</div>
				<div class='form-group'>
					<label for='inputComplemento' class='col-sm-3 control-label'>Complemento Endere&ccedil;o:</label>
					<div class='col-sm-7'>
						<input type="text" id='txtComplemento' name='txtComplemento' class="form-control" placeholder='Complemento Endere&ccedil;o'/>
					</div>
				</div>
				<div class='form-group'>
					<label for='inputDesc' class='col-sm-3 control-label'>Informa&ccedil;&otilde;es do Evento:</label>
					<div class='col-sm-7'>
						<textarea id='txtInfo' name='txtInfo' class="form-control" placeholder='Informa&ccedil;&otilde;es Adicionais sobre o evento' rows="6" ></textarea>
					</div>
				</div>
				<div class='form-group'>
		          <div class='col-sm-3'>
		          </div>
		          <div class='col-sm-7'>
		            <button type='submit' class='btn-form-default'>Adicionar na Agenda</button>
		          </div>
		        </div>
	     	</form>
	 	</div>
     <?php
	   }
      ?>

     <!-- Datepicker -->
     
     <table class='agenda table'>
            	<?php
				  
				  // SELECIONA nr e rm da lista_turma onde a sg, ano e semestre forem iguais	  
				  $comando  = "select * from evento where dt_Inicio_evento = '".$data."' and (cd_cliente=".$cd." or cd_advogado=".$cd.")";
				  $comando .=" order by date_format(dt_inicio_evento,'%d') ASC;"; 
				  $cSQL = seleciona($comando);
                   $qtdLinhas = mysql_num_rows($cSQL);

                   if ($qtdLinhas!=0)
                   {
					  
					  echo "<thead><tr><th >Nome</th><th class='data'>Data</th></thead>";		
                      while($dados = mysql_fetch_array($cSQL))
                      {
						  if($typeU==1)
						  	$comando2  = "select nm_user from user where cd_user=".$dados[2];
						  else if($typeU==2)
						    $comando2  = "select nm_user from user where cd_user=".$dados[1];
						  $cSQL2 = seleciona($comando2);
						  while($e=mysql_fetch_array($cSQL2))
						  {
							  $nome2=$e[0];
						  }
						  
						  //Cria item na tabela com NR, RM e Nome
						  echo "<tr><td>".$nome2." </td><td class='data'>".date("d/m/Y",strtotime($dados[3]))." as ".$dados[4]."</td></tr>";  
						  echo "<tr><td colspan='2' >".$dados[5]."</td></tr>";
                      }
                   
                   desconecta();
				}
                ?> 
       </table>
     <input type="button" id="carregaA" name="carregaA" class="btn-agenda-default btn-carrega-agenda" value="Carregar Agenda">
     <?php if($typeU==1)
     {
     	echo '<input type="button" id="abrirform" name="abrirform" class="btn-agenda-default btn-new-agenda" value="Novo Evento">';
     }
 	 ?>
     </div>
     </main>
     <form role='form2' method='post' action='agenda.php' id="form2" name="form2">
 	 	<input type='hidden' id='dataS' name='dataS'>
 	 </form>
  </body>
</html>
