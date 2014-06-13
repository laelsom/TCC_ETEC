<?php
 // extrai os dados do post
 $cd=$_GET["cd"]; 
 include_once("conexao.php");
   //Comando SELECT turmas no Banco
   $comando ="select user.cd_CEP, user.cd_numero_end, cep.nm_logradouro, cep.nm_bairro, cep.nm_cidade, cep.sg_estado from user inner join cep where user.cd_user=".$cd." and cep.cd_cep=user.cd_cep"; 
   $cSQL = seleciona($comando);
   $qtdLinhas = mysql_num_rows($cSQL);

   if ($qtdLinhas!=0)
   {
	  while($dados = mysql_fetch_array($cSQL))
	  {
		  // Adiciona Items no Select
		  
		  echo "var resultadoCEP = { 'uf' : '".$dados[5]."', 'cidade' : '".$dados[4]."', 'bairro' : '".$dados[3]."', 'numero' : '".$dados[1]."', 'logradouro' : '".$dados[2]."', 'cep' : '".$dados[0]."','resultado' : '1', 'resultado_txt' : 'sucesso%20-%20cep%20completo' }";
	  }
   }
   desconecta();
?>