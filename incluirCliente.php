<?php
session_start("login");
  if ($_SESSION["rmLogado"] == "")
  {
    Header("Location:index.php");
  }
  else
  {
    $cd = $_SESSION["rmLogado"];
  }
  $nome = $_POST["txtNome"];
  $email = $_POST["txtEmail"];
  $senha = $_POST["txtSenha"];
  $dtNasc = $_POST["txtData"];
  $cpf= $_POST["txtCPF"];
  $CEP=$_POST["txtCEP"];
  $tipoU=$_POST["txtTipoU"];
  $nrEnd=$_POST["txtNum"];
  $telCom="'".$_POST["txtTelCom"]."'";
  $celSec="'".$_POST["txtCelSec"]."'";
  $telRes="'".$_POST["txtTelRes"]."'";
  $celPrinc="'".$_POST["txtCelPrinc"]."'";
  $compeEnd="'".$_POST["txtComplemento"]."'";
  if($compeEnd=="''")
  	$compeEnd='NULL';
  if($telCom=="''")
  	$telCom='NULL';
  if($telRes=="''")
  	$telRes='NULL';
  if($celPrinc=="''")
  	$celPrinc='NULL';
  if($celSec=="''")
  	$celSec='NULL';
  
  $cpf=str_replace("-","",$cpf);
  $cpf=str_replace(".","",$cpf);
  $CEP=str_replace("-","",$CEP);
  $CEP=str_replace(".","",$CEP);
  $telRes=str_replace("-","",$telRes);
  $telRes=str_replace(".","",$telRes);
  $telRes=str_replace("(","",$telRes);
  $telRes=str_replace(")","",$telRes);
  $telRes=str_replace(" ","",$telRes);
  $telCom=str_replace("-","",$telCom);
  $telCom=str_replace(".","",$telCom);
  $telCom=str_replace("(","",$telCom);
  $telCom=str_replace(")","",$telCom);
  $telCom=str_replace(" ","",$telCom);
  $celPrinc=str_replace("-","",$celPrinc);
  $celPrinc=str_replace(".","",$celPrinc);
  $celPrinc=str_replace("(","",$celPrinc);
  $celPrinc=str_replace(")","",$celPrinc);
  $celPrinc=str_replace(" ","",$celPrinc);
  $celSec=str_replace("-","",$celSec);
  $celSec=str_replace(".","",$celSec);
  $celSec=str_replace("(","",$celSec);
  $celSec=str_replace(")","",$celSec);
  $celSec=str_replace(" ","",$celSec);
      
	  echo $cpf;
	  echo $CEP;
	  include_once("conexao.php");

		$comando  = "Select cd_user from user";
		
		$cSQL = seleciona($comando);
		$qtdLinhas = mysql_num_rows($cSQL);
		$q=array();
		$z=0;
    $i=0;
		if ($qtdLinhas!=0)
		{
		 $cd_user=0;
		 while($dados = mysql_fetch_array($cSQL))
		 {
			 $q[$i]=$dados[0];
			$cd_user++;
			$i++;
		 }
		 $cd_user++;
		 while(in_array($cd_user, $q)) { 
			$cd_user++;
		 }
		}
		else
		{
			$cd_user= 1;
		}
		
		
$comando="insert into user (cd_user,cd_tipo_user,cd_cep, cd_numero_end,nm_user, cd_email_user, cd_senha_user, dt_nascimento_user, ";
  $comando.="ds_complemento_end, cd_cpf_user, cd_cnpj_user, cd_oab_user, cd_telefone_residencial_user, cd_telefone_comercial_user, cd_celular_principal_user, ";
  $comando.="cd_celular_secundario_user) values ( $cd_user, $tipoU, $CEP ,'$nrEnd','$nome' ,'$email ', '".md5($senha)."', '$dtNasc', ";
  $comando.="$compeEnd,'$cpf',NULL,NULL,$telRes,$telCom,$celPrinc,$celSec)";
      
        
		echo $comando;
        $cSQL = executa($comando);
    $comando ="insert into advogado_user (cd_cliente, cd_advogado) values ($cd_user,$cd)";
      echo $comando;
        $cSQL = executa($comando);
        header("Location:processo.php?msg=Cliente adicionado com sucesso!");
  
  
?>