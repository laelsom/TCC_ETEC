<?php
 // extrai os dados do post
 $cd_r=$_GET["cdr"];
 $cd_d=$_GET["cdd"]; 
 include_once("conexao.php");
   //Comando SELECT turmas no Banco
   
   $comando ="select cd_remetente, cd_destinatario, DATE_FORMAT(dt_mensagem, '%d/%m/%Y'), DATE_FORMAT(hr_mensagem, '%H:%i'), ds_mensagem from(select * from mensagem where (cd_remetente=".$cd_r." and cd_destinatario=".$cd_d.")||(cd_remetente=".$cd_d." and cd_destinatario=".$cd_r.") order by dt_mensagem DESC, hr_mensagem DESC  limit 0,50) as r order by r.dt_mensagem Asc, r.hr_mensagem asc ";
   $cSQL = seleciona($comando);
   $qtdLinhas = mysql_num_rows($cSQL);
   $d;
   $qt=0;
   $z="";
   if ($qtdLinhas!=0)
   {
	  while($dados = mysql_fetch_array($cSQL))
	  {
		  if(!isset($d)){
			$d=$dados[2];
			$z.= " &lt; div id='pdata' &gt; ".$d." &lt; /div &gt;  &lt; div id='plinha' &gt; &lt; /div &gt; "; 
		  }
		  if($dados[2] != $d){
			$d=$dados[2];
			$z.= " &lt; div id='pdata' &gt; ".$dados[2]." &lt; /div &gt;     &lt; div id='plinha' &gt; &lt; /div &gt; ";  
		  }
			if($dados[0]==$cd_r)
			{
				$z.= " &lt; div id='premet' &gt; ".$dados[4]." &lt; /div &gt;  &lt; div id='plinha' &gt; &lt; /div &gt;  ";
			}
			else if($dados[0]==$cd_d)
			{
				$z.= " &lt; div id='pdest' &gt; ".$dados[4]." &lt; /div &gt;  &lt; div id='plinha' &gt; &lt; /div &gt;  ";
			}
			$qt++;
			if($qt==$qtdLinhas && $dados[0]==$cd_d)
			{
				$z.= " &lt; div id='pdataF' &gt; Enviado às ".$dados[3]." &lt; /div &gt;   &lt; div id='plinha' &gt; &lt; /div &gt; ";
			}
	  }
 		
	  echo 'var chat= { "chat" : "'.$z.'"}';
   }
   desconecta();
?>