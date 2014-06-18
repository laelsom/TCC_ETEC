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
  }


	$cliente = $_POST["meusclientes"];
	$x=0;
	foreach ($cliente as $clienteALT) {
		$comando="select * from advogado_user where cd_advogado = ".$cd." and cd_cliente=".$clienteALT;
		$cSQL = seleciona($comando);
		$qtdLinhas = mysql_num_rows($cSQL);
		if ($qtdLinhas==0)
		{
			$comando2="INSERT INTO advogado_user ( cd_advogado, cd_cliente) VALUES ( ".$cd.", ".$clienteALT.")";
			$cSQL2 = executa($comando2);
		}
		$x++;
	}
	for ($i=0; $i <$x ; $i++) { 
		if ($i==0) {
			$clienteALT=$cliente[$i];
		}
		else{
			$clienteALT.=", ".$cliente[$i];
		}
	}

	$comando3="select cd_cliente from advogado_user where cd_advogado=".$cd." and cd_cliente not in (".$clienteALT.")";
	$cSQL3 = seleciona($comando3);
	$qtdLinhas3 = mysql_num_rows($cSQL3);
	if ($qtdLinhas3!=0)
	{
		while ($dados = mysql_fetch_array($cSQL3)) {
			$comando4="delete from advogado_user where cd_cliente=".$dados[0]." and cd_advogado=".$cd;
			$cSQL4 = executa($comando4);
		}
	}
	header("Location:cliente.php?msg=Clientes atualizados com sucesso!");
  ?>