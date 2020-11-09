<?php
if (realpath(__FILE__) === realpath($_SERVER['SCRIPT_FILENAME'])) header('Location: '.$urlHost); 
//https://wp-mix.com/php-protect-include-files/	
	if(isset($_SESSION['email'])){
		$email=$_SESSION['email'];
		$result=$pdo->prepare("SELECT * FROM usuarios_cadastrados WHERE email=:email");
		$result->execute(array(":email"=>$email));
		$row=$result->fetch(PDO::FETCH_ASSOC);
		
		//O código abaixo serve para impedir que contas desativadas utilizem o serviço
		if($row['desativar'] == 1){
			session_destroy();
			echo "<script>alert('Esta conta foi fechada. Mas você pode solicitar sua reativação, se quiser. Entre em contato conosco para reativação. Obrigado.'); location.href = '$urlHost'</script>;";
		}
	}

	//A variável $urlHost funciona mais ou menos como uma variável global que armazena o valor da URL host ou domínio. Então para que não haja necessidade de ficar alterando o domínio ou URL a todo momento, é que foi criada esta variável.
	if($_SERVER['HTTP_HOST'] == "localhost" || $_SERVER['HTTP_HOST'] == "127.0.0.1"){
		$url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		$urlHost = explode("/", $url);
		$urlHost = "/".$urlHost[1];
	}else{
		$urlHost = "http://".$_SERVER['HTTP_HOST'];
	}
?>