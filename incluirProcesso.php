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
  $classeP = $_POST["cmbClasse"];
  $estado = $_POST["cmbEstado"];
  $dataI = $_POST["txtDataI"];
  $dataF = "'".$_POST["txtDataF"]."'";
  $info = nl2br(htmlentities($_POST["txtInfo"], ENT_QUOTES, 'UTF-8'));
  $info="'".$info."'";
  $juiz="'".$_POST["txtJuiz"]."'";
  $segParte = $_POST["txt2Parte"];
  $vlP="".$_POST["txtPreco"]."";
  $reqs=$_POST["radioTreq"];
  if($info=="''")
    $info='NULL';
  if($dataF=="''")
    $dataF='NULL';
  if($juiz=="''")
    $juiz='NULL';
  if($vlP=="")
    $vlP='NULL';
	  

		$comando  = "Select cd_processo from processo";
		
		$cSQL = seleciona($comando);
		$qtdLinhas = mysql_num_rows($cSQL);
		if ($qtdLinhas!=0)
		{
		 $cd_processo=0;
		 while($dados = mysql_fetch_array($cSQL))
		 {
			$cd_processo++;
		 }
		 $cd_processo++;
		}
		else
		{
			$cd_processo= 1;
		}


      
        $comando2 ="insert into processo (cd_processo, cd_cliente, cd_advogado, cd_classe_processo, cd_estado_processo, dt_inicio_processo, ";
        $comando2.="ds_processo,ic_visualizada_sim_nao,nm_juiz_processo, nm_segunda_parte, dt_limite_processo, vl_processo, ";
        $comando2.="ic_requerente_sim_nao) values (".$cd_processo.", ".$user.", ".$cd.", ".$classeP.", ".$estado.", '".$dataI."', ".$info.", 0, ".$juiz.", ";
        $comando2.="'".$segParte."', ".$dataF.", '".$vlP."', ".$reqs.")";
		    echo $comando2;
        $cSQL = executa($comando2);
        header("Location:processo.php?msg=Processo adicionado com sucesso!");
      
  
  
?>