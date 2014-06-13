function validaCampos(rm, senha)
{
	if (rm.value == "")
	{
		//alert('RM está vazio! Digite-o!!!');
		document.getElementById("lblErro").innerHTML = "Login está vazio!";
		
	}
	else
	{
		if (senha.value == "")
		{
			//alert('Senha vazia! Impossivel entrar');
			document.getElementById("lblErro").innerHTML = "Senha vazia! Impossivel entrar";
		}
		else
		{
			document.formulariozinho.submit();
		}
	}
}