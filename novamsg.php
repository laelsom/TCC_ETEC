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
  $cd_r = $_POST["cdr"];
  $cd_d= $_POST["cdd"];
  $msg = $_POST["msg"];
  $dt = date("Y-m-d");  
  $hr = date("H:i:s");   	  

		$comando  = "insert into mensagem values(".$cd_r.",".$cd_d.",'".$dt."','".$hr."','".$msg."')";
		echo $comando;
        $cSQL = executa($comando);
  
  
?>