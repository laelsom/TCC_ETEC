<?php
  $rm = $_POST["txtRM"];
  $senha = $_POST["txtSenha"];

  include_once("conexao.php");

  $comando ="select * from user where cd_email_user ='" . $rm . "' and cd_senha_user='" .md5( $senha) . "'";
  $cSQL = seleciona($comando);
  $qtdLinhas = mysql_num_rows($cSQL);

  if ($qtdLinhas!=0)
  {
  	$dados = mysql_fetch_array($cSQL);
		session_start("login");
		$_SESSION["rmLogado"] = $dados["cd_user"];
		$_SESSION["nmLogado"] = $dados["cd_email_user"];
		$_SESSION["tpLogado"] = $dados["cd_tipo_user"];
		if($dados["cd_tipo_user"]==1)
		{
			Header("Location:processo.php");
			desconecta();
		}
		else
		{
			Header("Location:processo.php");
			desconecta();
		}
  }
  else
  {
  	desconecta();
  	Header("Location:index.php?e=1");
  }
  

?>