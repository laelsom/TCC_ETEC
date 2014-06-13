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
  $user = $_POST["cmbUser"];
  $dataI = $_POST["txtDataI"];
  $dataF = $_POST["txtDataF"];
  $horaI = $_POST["txtTimeI"];
  $horaF= $_POST["txtTimeF"];
  $local=$_POST["rdoEndereco"];
  if(isset($local) || $local !=1)
  {
	  $comando  = "Select cd_CEP, cd_numero_end, ds_complemento_end from user where cd_user=".$user;
	  $cSQL = seleciona($comando);
	  $dados = mysql_fetch_array($cSQL);
	  $CEP=$dados[0]; 
      $nrEnd=$dados[1];
      $compeEnd="'".$dados[2]."'";
  }
  else{
	  $CEP=$_POST["txtCEP"];  
	  $nrEnd=$_POST["txtNr"];
	  $compeEnd="'".$_POST["txtComplemento"]."'";
  }
  $info="'".$_POST["txtInfo"]."'";
  if($compeEnd=="''")
  	$compeEnd='NULL';
  if($info=="''")
  	$info='NULL';
	  

		$comando  = "Select cd_evento from evento";
		
		$cSQL = seleciona($comando);
		$qtdLinhas = mysql_num_rows($cSQL);
		if ($qtdLinhas!=0)
		{
		 $cd_user=0;
		 while($dados = mysql_fetch_array($cSQL))
		 {
			$cd_user++;
		 }
		 $cd_user++;
		}
		else
		{
			$cd_user= 1;
		}

      
        $comando ="insert into evento values ( $cd_user,$cd, $user ,'$dataI' ,'$horaI ', $info, '$dataF','$horaF','$CEP', $local, '$nrEnd', $compeEnd)";
		echo $comando;
        $cSQL = executa($comando);
        header("Location:agenda.php?msg=Evento criado com sucesso!");
      
  
  
?>