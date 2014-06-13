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
  }
  if(isset($_GET["id"]) && isset($_GET["e"])){
	  $id=$_GET["id"];
	  $editor=$_GET["e"];
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
          <li class="active"><a href="#">Home</a></li>
          <li><a href="#">Cursos</a></li>
          <li><a href="#">Professores</a></li>
          <li><a href="#">Turmas</a></li>
          <li><a href="novoAluno.php">Novo Aluno</a></li>
          <li><a href="associarTurma.php">Associar na Turma</a></li>
          <li><a href="listaTurma.php">Lista da Turma</a></li>
        </ul>
        
        
        <hr class="divisoria" />
      <!-- Cria Tabela para listar alunos-->
      <table class="table-striped table-bordered table table-condensed">
            	<?php
				  include_once("conexao.php");
				  // SELECIONA nr e rm da lista_turma onde a sg, ano e semestre forem iguais	  
				  if(isset($id)&&isset($editor))
				  {
					$comando  = "select * from noticia where cd_noticia = ".$id." and cd_editor_user = ".$editor;
					$comando .=" order by cd_nr_views ASC;"; 
					$cSQL = seleciona($comando);
					$qtdLinhas = mysql_num_rows($cSQL);

					 if ($qtdLinhas!=0)
					 {
						 while($dados = mysql_fetch_array($cSQL))
						{
							$data=explode("-",$dados[4]);
							$cmd2="select nm_user from user where cd_user =".$dados[1];
							$cSQL2=seleciona($cmd2);
							$qtdLinhas2 = mysql_num_rows($cSQL2);

							 if ($qtdLinhas2!=0)
							 {
								 while($nome2 = mysql_fetch_array($cSQL2))
								{
									echo "<h1>".$dados[2]."</h1>";
									echo "<h5>".$data[2]."/".$data[1]."/".$data[0]."    Por: ".$nome2[0]."</h5>";
									echo "<h4>".$dados[5]."</h4>";	
									echo"";
									echo"";
									echo "<div class='areaCentral'>".$dados[3]."</div>";
								}
							 }
						}
					 
					 desconecta();
				  	 }
				  }
				  else
				  {
					$comando  = "select * from noticia where dt_criacao_noticia = '2014-05-16'";
					$comando .=" order by cd_nr_views ASC;"; 
					$cSQL = seleciona($comando);
					 $qtdLinhas = mysql_num_rows($cSQL);
  
					 if ($qtdLinhas!=0)
					 {
						//Titulo da Tabela
						echo "<caption> Notícias </caption>";
						echo "<thead><tr><th class='col-sm-2'>Data</th><th class='col-sm-2'>Título</th><th>SubT</th></tr></thead>";		
						while($dados = mysql_fetch_array($cSQL))
						{
							//Cria item na tabela com NR, RM e Nome
							echo "<tr ><td class='col-sm-2'>".$dados[4]." </td><td class='col-sm-2'><a href='noticia.php?id=".$dados[0]."&e=".$dados[1]."'>".$dados[2]."</a></td><td>".$dados[5]."</td></tr>";  
						}
					 
					 desconecta();
				  }  
				  }
                ?> 
       </table>
        
     </div>
  </body>
</html>
