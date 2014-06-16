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
  if(isset($_POST["cmbUser2"]) &&  $_POST["cmbUser2"] != "0" )
  {
	  $user=$_POST["cmbUser2"];
  }
  else{
	  $user=-1;
  }
  $msg = "";

  if ( isset($_GET["msg"]))
  {
    $msg = $_GET["msg"];
  }
  
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="iso-8859-1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nome do SITE</title>

    <!-- Bootstrap -->
    
    <link rel="stylesheet" href="css/estilo.css"  type="text/css">
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <link href="css/tabela.css" rel="stylesheet" type="text/css">
    <link href="css/edit.css" rel="stylesheet" type="text/css">
    <link href="css/custom-theme/jquery-ui-1.9.2.custom.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,700italic' rel='stylesheet' type='text/css'>
    <style>
        .container-menu #home{background-image:url(Images/menu-bg-selected.jpg)};
        body{overflow:scroll;}
    </style>
    <script src="js/jquery-1.9.1.js"></script>
    <script src="js/script.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/jquery-ui-1.9.2.custom.js"></script>
    
    
    <script>
      $(document).ready(function(){
        $("#enviamsg").click(function(){
        var x=<?php echo $cd?>;
        var y=$("#cduser").val();
        var z=$("#txtInfo").val();
        $("#txtInfo").val("");
        $.ajax({
                            type:"post",
                            url:"novamsg.php",
                            data:"cdr="+x+"&cdd="+y+"&msg="+z,
                            success:function(data){}

                        });
              return false;
        });

      });
      var iduser2='';
      var refreshIntervalId;
		
		  function replaceAll(find, replace,str) {     var re = new RegExp(find, 'g');      str = str.replace(re, replace);      return str; } 
		
      function keyEnterPressed(e){
      if(e.keyCode=='13'){$("#enviamsg").click();}
      }
      function carregarchat(iduser){
              if (iduser!=iduser2) {
                clearInterval(refreshIntervalId);
                iduser2=iduser;
                $("#chatdiv").html('');
                $("#txtInfo").val("");
              };
              $("#cduser").val(iduser);
              $("#chatdiv").html('');
              var q="<?php echo $cd?>";
              var f="";
              $.getScript("carregachat.php?cdr="+q+"&cdd="+iduser, function(){
                    
                    var c=unescape(chat["chat"]);
                    f=replaceAll(" &lt; ","<",c);
                    f=replaceAll(" &gt; ",">",f);
                    $("#chatdiv").prepend(f);
                    refreshIntervalId=    window.setInterval(function(){

              var ff="";
              $.getScript("carregachat.php?cdr="+q+"&cdd="+iduser, function(){
                    
                    var cc=unescape(chat["chat"]);
                    ff=replaceAll(" &lt; ","<",cc);
                    ff=replaceAll(" &gt; ",">",ff);
                    if(f!=ff)
                    {
                      $("#chatdiv").html('');
                      $("#chatdiv").prepend(ff);
                      f=ff;
                    }
                    
                });},1000);
              });
              
              
                
             };
	</script>
    <script type="text/javascript"> 

function stopRKey(evt) { 
  var evt = (evt) ? evt : ((event) ? event : null); 
  var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null); 
  if ((evt.keyCode == 13) && (node.type=="text"))  {return false;} 
} 

document.onkeypress = stopRKey; 

</script>
    

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body style="overflow:auto; overflow-y:auto;">
    <div id="fundo"></div>
    <div id="areaCentral2"></div>

  <aside class="menu">
            <nav class="container-menu">
            	<div id="logo-mini">
                	<img width="100%" src="Images/logo Y.png" alt="Cleide Pacheco Advocacia">
                </div>
            
                <?php if($typeU==1){?>
                    <a href="processo.php" class="link-menu" >
                      <ul><img src="Images/ico/processo.png" alt="Home" class="ico-menu"> <p class="text-menu">Processos</p></ul>
                    </a>
                    
                    <a href="agenda.php" class="link-menu" >
                      <ul><img src="Images/ico/agenda.png" alt="Home" class="ico-menu"> <p class="text-menu">Agenda</p></ul>
                    </a>
                       
                    <a href="cliente.php" class="link-menu" >
                      <ul><img src="Images/ico/empresa2.png" alt="Home" class="ico-menu"> <p class="text-menu">Áreas de Atuação</p></ul>
                    </a>
                    
                    <a href="chat.php" class="link-menu" id="home">
                      <ul><img src="Images/ico/chat.png" alt="Home" class="ico-menu"> <p class="text-menu">Chat</p></ul>
                    </a>
                <?php 
                }else if($typeU==2) 
                {
              ?>
                <a href="perfil.php" class="link-menu" >
                      <ul><img src="Images/ico/home.png" alt="Home" class="ico-menu"> <p class="text-menu">Áreas de Atuação</p></ul>
                    </a>
                  
                <a href="processo.php" class="link-menu" >
                      <ul><img src="Images/ico/processo.png" alt="Home" class="ico-menu"> <p class="text-menu">Processos</p></ul>
                    </a>
                    
                    <a href="agenda.php" class="link-menu" >
                      <ul><img src="Images/ico/agenda.png" alt="Home" class="ico-menu"> <p class="text-menu">Agenda</p></ul>
                    </a>
                       
                    <a href="chat.php" class="link-menu" id="home">
                      <ul><img src="Images/ico/chat.png" alt="Home" class="ico-menu"> <p class="text-menu">Chat</p></ul>
                    </a>
                <?php
                }

                ?>

                
            </nav>
        </aside>
<!--Fim Menu--> 

<div id="areaCentral">
     <div id="caixaLogado">
        Ol&aacute; <?=$email ?> | <a href="sair.php">Sair</a>
    </div>


      <div class="divisoria"> </div>
      

      <h2 class="title">Mensagens</h2>
      <div class="div-title"> </div>
        
        
       <div id="msg">
         <h5><?=$msg?></h5>
       </div>
       
       <!-- Cria Tabela de agenda-->
      <?php

        if($typeU==1 || $typeU==2){
      ?>
        <form class='form-horizontal' role='form' method='post' id="form" name="form">
            <div class='form-group'>
              <div class='list-chat'>
                    <?php
                        if($typeU==1 ){
                           $comando ="select user.nm_user, user.cd_user from advogado_user inner join user where advogado_user.cd_advogado=".$cd." and user.cd_user=advogado_user.cd_cliente order by cd_user ASC";
                        }else if($typeU==2){
                            $comando ="select user.nm_user, user.cd_user from advogado_user inner join user where advogado_user.cd_cliente=".$cd." and user.cd_user=advogado_user.cd_advogado order by cd_user ASC";
                        }
                        $cSQL = seleciona($comando);
                        $qtdLinhas = mysql_num_rows($cSQL);

                        if ($qtdLinhas!=0)
                        {
                            while($dados=mysql_fetch_array($cSQL))
                            { 
                              ?>             
                                <input type="button" onClick="carregarchat(this.id);" id="<?=$dados[1] ?>" class="user-chat" value=" <?=$dados[0]?>">
                              <?php
                            }
                        }
                    ?>

              </div>
            </div>
            <div class='form-group'>
              <div class='col-sm-8 ' >
                <div class='form-control ' id="chatdiv">
                </div>
              </div>
            </div>
            <input type='hidden' id='cduser' name='cduser' value=''>
            <div class='form-group'>
              <div class='col-sm-6'>
                <input type="text" id='txtInfo' name='txtInfo' class="form-control" placeholder='Digite aqui sua mensagem' maxlength="350" onkeypress="keyEnterPressed(event);" />
              </div>
              <div class='col-sm-2'>                
                <button type='button' class='btn btn-default-chat' id="enviamsg">Enviar</button>
              </div>
            </div>
        </form>
      <?php
        }
      ?>
      
     
     </div>
     </main>
  </body>
</html>
