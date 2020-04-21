<?php
if (realpath(__FILE__) === realpath($_SERVER['SCRIPT_FILENAME'])) header('Location: /orangeadex/casamentoemdetalhes'); 
//Para configuração do localhost SMTP ou envio de emails, utilize este método: https://respostas.guj.com.br/36158-configuar-php-para-enviar-email-no-windows e altere as configurações de php.ini

//https://wp-mix.com/php-protect-include-files/

//Isto é para a recuperação de senha
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
//include "config.php";
if(isset($_POST['send'])){
	$emailpost = filter_input(INPUT_POST, 'email2');
		
	$fetchemail = $pdo->prepare("SELECT * FROM usuarios_cadastrados WHERE email = ?");
	$fetchemail->execute(array($emailpost));
	$rowemail = $fetchemail->fetch(PDO::FETCH_ASSOC);
	$num1 = $fetchemail->fetchAll();
	$countemail = $fetchemail->rowCount();//$count = count($row);
	
	/*$stmt2 = $pdo->prepare("SELECT * FROM usuarios_cadastrados WHERE  email = ?");
	$stmt2->execute(array($emailpost));
	$row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
	$num2 = $stmt2->fetchAll();
	$count2 = $stmt2->rowCount();//$count2 = count($row2);
	*/
	
	$firstname = $rowemail['nomeprincipal'];
	$lastname = $rowemail['sobrenome'];
	$senha = $rowemail['senha'];
	$nomedeusuario = $rowemail['nomedeusuario'];
	$email = $rowemail['email'];
	//$reset_senha_code = $row['reset_senha_code'];
	$id = $rowemail['id'];
	
	$code = substr(md5(uniqid(mt_rand(), true)) , 0, 8);
	/*$firstname1 = $row2['firstname'];
	$lastname1 = $row2['lastname'];
	$senha1 = $row2['senha'];
	$email1 = $row2['email'];
	*/
	
	 //echo $count ."<br>";
	 /*echo $count2 . "<br>";*/
	
	if ( $countemail == 1) {
	$insert_code = $pdo->prepare("UPDATE usuarios_cadastrados SET resetar_codigo_senha = ? WHERE id = ?");
	$insert_code->execute(array($code, $id));
	// Vamos enviar um email para o usuário!
	$subject = "Recuperação de Senha - Casamento em Detalhes";
	$message = "Caro amigo $firstname $lastname,
Pelo visto, me parece que você solicitou a recuperação de sua senha pelo site /orangeadex/casamentoemdetalhes.

Sugiro que clique no link abaixo e siga as instruções:
/orangeadex/casamentoemdetalhes/recuperarsenha.php?codigo=$code

Este é o seu nome de usuário: $nomedeusuario

Agradecemos muito o seu retorno!
Do Webmaster

Nota: Caso a pessoa que solicitou tal alteração não seja você, sugiro que nos relate isto enviando um email pelo link /orangeadex/casamentoemdetalhes/contato.php ou clicando no ícone do chat amarelo que se encontra no canto inferior direito do site.
Este email foi gerado automaticamente. Peço o favor de não responder ao mesmo. Sua mensagem não será lida. Contudo, entre em contato, usando os veículos supracitados.";
	
	mail($email, $subject, $message, "From: CASAMENTO EM DETALHES<suporte@orangeadex.tk>\nX-Mailer: PHP/" . phpversion());
	  
	$followinstructions = true;
	  
	} elseif (empty($emailpost)){
		$emptyfield = true;
	} elseif ($countemail == 0){
		$incorrectemail = true;
	}else{
		$incorrectemail = true;
	}	
}

//----------------------------------------------------------------------------------------------------------------------

if(isset($_POST['send1'])){
	$senha1 = filter_input(INPUT_POST, 'senha1');
	$senha2 = filter_input(INPUT_POST, 'senha2');
	
	$fetchresetcode = $pdo->prepare("SELECT * FROM usuarios_cadastrados WHERE reset_senha_code = ?");
	$fetchresetcode->execute(array($reset_code));
	$rowsenha = $fetchresetcode->fetch();
	$countsenha = $fetchresetcode->rowCount();
	$email = $rowsenha['email'];
	$user_id = $rowsenha['id'];
	$firstname = $rowsenha['firstname'];
	$lastname = $rowsenha['surname'];
	//$row = $stmt->fetch(PDO::FETCH_ASSOC);
	//$num1 = $stmt->fetchAll();
	//$count = $stmt->rowCount();
	$errsenha = array();
	if (empty($senha1))  {
		$errsenha[] = "*Campo vazio. Crie uma senha.";
	}else{
		if ($senha1 !== $senha2) {
			$errsenha[] = "*As senhas não batem ou um dos campos se encontra vazio.";
		}
	}
			 
	if (empty($senha2))  {
		$errsenha[] = "*Confirme a senha.";
	}
	
	if($countsenha == 0){
		$errsenha[] = "Opa, tá tentando fazer o quê, amigo? Ha.";
	}
	
	if(!$errsenha){
		$resetsenha = $pdo->prepare("UPDATE usuarios_cadastrados SET senha = ? WHERE resetar_codigo_senha = ?");
		$resetsenha->execute(array($senha1, $reset_code));
		
		// Vamos enviar o email para o usuário!
		$subject = "Acesso recuperado com sucesso - Casamento em Detalhes";
		$message = "Caro amigo $firstname $lastname,
Agora que o seu acesso foi recuperado, só entrar no site /orangeadex/casamentoemdetalhes, e efetuar o login normalmente utilizando a nova informação. E por favor, vê se não esquece mais essa senha, haha.

Agradecemos a preferência! Aprecie o nosso conteúdo.
Do Webmaster

Nota: Caso a pessoa que solicitou tal alteração não seja você, sugiro que nos relate isto enviando um email pelo link /orangeadex/casamentoemdetalhes/contato.php ou clicando no ícone do chat amarelo que se encontra no canto inferior direito do site.
Este email foi gerado automaticamente. Peço o favor de não responder ao mesmo. Sua mensagem não será lida. Contudo, entre em contato, usando os veículos supracitados.";
		
		mail($email, $subject, $message, "From: CASAMENTO EM DETALHES<suporte@orangeadex.tk>\nX-Mailer: PHP/" . phpversion());
		
		//echo '<div style="color:red; position:absolute; margin-top:80px; margin-left:auto; margin-right:auto; left:0; right:0;"><font size=2 face=Verdana, Arial, Helvetica, sans-serif>You can log in now normally.</font></div>';
		//---------------------------------------------------------------
		//Agora vamos desativar este código de recuperação!
		$reset_code2 = "";
		$deletecode = $pdo->prepare("UPDATE usuarios_cadastrados SET resetar_codigo_senha = ? WHERE id = ?");
		$deletecode->execute(array($reset_code2, $user_id));
		
		echo '<script>alert("Ótimo! Agora você pode efetuar o login. Você será redirecionado para a página de login"); location.href = "/orangeadex/casamentoemdetalhes/login.php";</script>';
	}else{
		$validationmessages = true;
	}
}
?>