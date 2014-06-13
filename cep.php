<?php
$cep=$_GET["cep"];

include_once("conexao.php");
   //Comando SELECT turmas no Banco
   $comando ="select * FROM cep where cd_cep=".$cep; 
   $cSQL = seleciona($comando);
   $qtdLinhas = mysql_num_rows($cSQL);

   if ($qtdLinhas!=0)
   {
	  while($dados = mysql_fetch_array($cSQL))
	  {
		  // Adiciona Items no Select
		  
		  echo "var resultadoCEP = { 'uf' : '".$dados[4]."', 'cidade' : '".$dados[3]."', 'bairro' : '".$dados[2]."', 'tipo_logradouro' : 'Avenida', 'logradouro' : '".$dados[1]."', 'resultado' : '1', 'resultado_txt' : 'sucesso%20-%20cep%20completo' }";
	  }
   }
   desconecta();

?>
