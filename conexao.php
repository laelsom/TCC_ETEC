<?php
	  function conecta($server, $user, $password, $database)
	  {
		  mysql_connect($server,$user,$password) 
		    or die("Erro de conexao com o Banco");
		  mysql_select_db($database);
		  //echo "conectou <br/>" ;
		  mysql_query("SET NAMES 'utf8'");
		  mysql_query('SET character_set_connection=utf8');
		  mysql_query('SET character_set_client=utf8');
		  mysql_query('SET character_set_results=utf8');
	  }

	  function desconecta()
	  {
        mysql_close();
        //echo "desconectou <br/>" ;
	  }

	  function seleciona($comando)
	  {
	  	conecta("localhost:3300", "root", "password", "banco");
	  	$cSQL = mysql_query($comando) or die("Erro na conexão. Tente novamente.");
	  	return $cSQL;
	  }

	  function executa($comando)
	  {
	  	conecta("localhost:3300", "root", "password", "banco");
	  	$cSQL = mysql_query($comando) or die("Erro na conexão. Tente novamente.");
	  	desconecta();
	  }
?>