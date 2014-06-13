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
	$tipo = $_SESSION["tpLogado"];
  }


  $msg = "";

  if ( isset($_GET["msg"]))
  {
    $msg = $_GET["msg"];
  }

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nome do SITE</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/estilo.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
     <div id="caixaLogado">
        Olá <?=$nome ?> | <a href="sair.php">Sair</a>
     </div>

     <div id="areaCentral">
        <ul class="nav nav-pills">
          <li ><a href="inicial.php">Processos</a></li>
          <li><a href="agenda.php">Agenda</a></li>
          <?php if($tipo==1 || $tipo==0){?><li class="active"><a href="novoCliente.php">Novo Usuário</a></li><?php } ?>
        </ul>

       <h4>Mensagem:</h4>
       <hr class="divisoria" />
       <div id="msg">
         <h3><?=$msg?></h3>
       </div>
     </div>
  </body>
</html>