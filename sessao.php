<?php    
if (realpath(__FILE__) === realpath($_SERVER['SCRIPT_FILENAME'])) header('Location: /orangeadex/casamentoemdetalhes'); 
//https://wp-mix.com/php-protect-include-files/	
	if(isset($_SESSION['email'])){
		$email=$_SESSION['email'];
		$result=$pdo->prepare("SELECT * FROM usuarios_cadastrados WHERE email=:email");
		$result->execute(array(":email"=>$email));
		$row=$result->fetch(PDO::FETCH_ASSOC);
		
		//O código abaixo serve para impedir que contas desativadas utilizem o serviço
		if($row['desativar'] == 1){
			session_destroy();
			echo "<script>alert('Esta conta foi fechada. Mas você pode solicitar sua reativação, se quiser. Entre em contato conosco para reativação. Obrigado.'); location.href = '/orangeadex/casamentoemdetalhes'</script>;";
		}
	}
?>