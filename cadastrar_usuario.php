<?php
if (realpath(__FILE__) === realpath($_SERVER['SCRIPT_FILENAME'])) header('Location: /orangeadex/casamentoemdetalhes'); 
//https://wp-mix.com/php-protect-include-files/
if(isset($_POST['submit'])){
	//require "config.php"; 
    
    $email = filter_input(INPUT_POST, 'email');
	$senha = filter_input(INPUT_POST, 'senha');
	$confirmarsenha = filter_input(INPUT_POST, 'confirmarsenha');
	$nomeprincipal = filter_input(INPUT_POST, 'nomeprincipal');
	$sobrenome = filter_input(INPUT_POST, 'sobrenome');
	$nomedeusuario = filter_input(INPUT_POST, 'nomedeusuario');
	$sexo = filter_input(INPUT_POST, 'sexo');
	$datadenascimento = filter_input(INPUT_POST, 'datadenascimento');
	//$fone = filter_input(INPUT_POST, 'fone');
	//$endereco = filter_input(INPUT_POST, 'endereco');
	//$cidade = filter_input(INPUT_POST, 'city');
	//$estado = filter_input(INPUT_POST, 'state');
	//$pais = filter_input(INPUT_POST, 'country');
    $cliente = filter_input(INPUT_POST, 'usuariotipo');
	//$promocode = filter_input(INPUT_POST, 'promocode');
	//$ordercode = filter_input(INPUT_POST, 'ordercode');
	$checkbox = filter_input(INPUT_POST, 'checkbox');
	//Let's get the user ip when registering
	$ip_usuario = getenv('HTTP_CLIENT_IP')?:
	getenv('HTTP_X_FORWARDED_FOR')?:
	getenv('HTTP_X_FORWARDED')?:
	getenv('HTTP_FORWARDED_FOR')?:
	getenv('HTTP_FORWARDED')?:
	getenv('REMOTE_ADDR');	
		
	$codigo = substr(md5(uniqid(mt_rand(), true)) , 0, 8);
    $codigodeindicacao = substr(md5(uniqid(mt_rand(), true)) , 0, 10);
	$fotohistoria = "default.jpg";
	$fotoinicio = "default.jpg";
$nossahistoria = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur consectetur aliquam ligula, vitae elementum nisi sollicitudin non. Praesent nunc justo, auctor bibendum dictum sit amet, tempus sed nulla. Nam ac dui pellentesque, euismod sapien consectetur, feugiat ante. Nam risus nibh, dapibus ut gravida id, accumsan at enim. Sed sit amet hendrerit lacus. Vestibulum eget libero sagittis, mollis magna quis, consectetur mi. In vulputate rutrum fermentum. Duis convallis enim at sollicitudin efficitur. In eu velit vel enim tempor accumsan sed et neque. Nullam varius malesuada magna, a convallis mi sodales et. Pellentesque a dolor efficitur, euismod est sed, congue mi. Cras tristique augue sapien, a iaculis nisi elementum quis. Sed quis lectus nisl. Mauris fringilla fringilla ligula non pellentesque. Fusce turpis neque, condimentum eget felis id, tristique sodales ex. Praesent interdum mi a nisi auctor, sagittis placerat leo auctor.

Duis vulputate dictum semper. Etiam ultrices convallis egestas. Aliquam posuere pulvinar magna, ut tempus neque bibendum vel. Morbi ut enim vel nisi fringilla efficitur. Suspendisse gravida ligula ut pretium fermentum. Sed dictum lacus felis, at consequat nisl posuere in. Curabitur sed purus ac felis venenatis euismod quis et enim. Maecenas sollicitudin nulla vel ligula dapibus luctus. Proin pharetra lorem vitae hendrerit finibus. In finibus risus neque, sed pulvinar mauris egestas vitae. Maecenas dignissim, urna quis suscipit porta, lorem tortor mollis nibh, sit amet iaculis nunc sapien non tellus. 					 

Sed eu elementum odio. Vestibulum venenatis tellus ac elit finibus gravida. Donec non commodo ex. Sed venenatis sit amet dolor non facilisis. Suspendisse sit amet ultrices dolor. Fusce arcu dui, consectetur at faucibus nec, viverra at dolor. Donec condimentum odio erat, sed vestibulum mauris malesuada tincidunt. Cras convallis venenatis felis vel condimentum. In eget dapibus nunc. Mauris elementum cursus urna, id fringilla arcu euismod sit amet. Sed mollis turpis at ante porttitor gravida. Aliquam aliquam massa eget blandit feugiat.";
	
$textoinicio = "E tudo começou há um tempo atrás na ilha do sol. Destino te mandou de volta para o meu cais. Hiê ê! No coração ficou lembranças de nós dois, como ferida aberta, como tatuagem. Ô Milla! Mil e uma noites de amor com você, na praia, num barco, no farol apagado, num moinho abandonado, em Mar Grande, alto astral... Lá em Hollywood, pra de tudo rolar, vendo estrelas caindo, vendo a noite passar, eu e você, na ilha do sol, na ilha do sol.";
	//$codigo = uniqid();
	    
	#Determining in which table data will be inserted.
    
	$tabela = "usuarios_cadastrados";
	
	if($cliente == 0){
		$tipodeusuario = "convidado/a";
	}
	
	if($cliente == 1){
		$tipodeusuario = "noivo/a";
	}
	
    /*
    $checkpromocode = $pdo->prepare("SELECT * FROM promocode WHERE code = ?");
    $checkpromocode->execute(array($promocode));
    $promocoderows = $checkpromocode->rowCount();
    $fetchpromocode = $checkpromocode->fetch(PDO::FETCH_ASSOC);
    $used = $fetchpromocode['used'];
    */
    
	#Deve haver alguma maneira de evitar este tipo de repetição e resumir tal código...
	#Busca (query) que verifica primeiro se há algum email equivalente na tabela "usuarios_cadastrados"
	$stmt2 = $pdo->prepare("SELECT * FROM $tabela WHERE email = ?");
	$stmt2->execute(array($email));
	$total_rows = $stmt2->rowCount();
	
	#Busca (query) que verifica se tal nome de usuário já existe na tabela "usuarios_cadastrados"
	$stmt3 = $pdo->prepare("SELECT * FROM $tabela WHERE nomedeusuario = ?");
	$stmt3->execute(array($nomedeusuario));
	$total_rows2 = $stmt3->rowCount();
	
	$inicio = date_create($datadenascimento);
	$fim = date_create();
	$diff = date_diff($inicio, $fim);
	#input validation
	$err3 = array();
	//executando todas as validações e levantando os erros correspondentes
	/*
	if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])){
		//http://acmeextension.com/integrate-google-recaptcha-with-php/
		//Verifying if the CAPTCHA was selected and is working
		$secret = '6LfLp8oUAAAAAFWraqfwpbEVURm0SaapKirI1cLS';
		$verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
		$responseData = json_decode($verifyResponse);
		if($responseData->success){
			//$succMsg = 'Your contact request have submitted successfully.';
		}
		else{
			$err3[] = "*Robot verification failed, please try again.";
			//echo "<li>". $captchaalert . "</li>";
		}
	}else{
		$err3[] = "*Please prove you're not a robot. Verify the reCAPTCHA.";
		//echo "<li>". $captchaalert . "</li>";
	}
	*/
    
	if (empty($email))  {$err3[] = "*Digite o seu email.";} 
		else {if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {$err3[] = "*Formato de email incorreto";}
			if ($total_rows) {$err3[] = "*Email já existente. Parece que você ou outra pessoa possui uma conta com esse email.";}} 
	
	if (empty($senha))  {$err3[] = "*Crie a senha.";}
	 else {if ($senha !== $confirmarsenha) {$err3[] = "*As senhas não batem.";}}
	 
	if (empty($confirmarsenha))  {$err3[] = "*Confirme a senha.";}
	 
	if (empty($nomeprincipal))  {$err3[] = "*Digite o nome.";}
	
	if (empty($sobrenome))  {$err3[] = "*Digite o sobrenome.";}
	
	if (empty($nomedeusuario))  {$err3[] = "*Crie um nome de usuário.";}
		else {if ($total_rows2) {$err3[] = "*Este nome de usuário já existe. Crie outro.";}}
	
	if (empty($sexo))  {$err3[] = "*Selecione o sexo.";}
	
	if (empty($datadenascimento))  {$err3[] = "*Digite a data de nascimento.";}
	
	if ($diff->y < 18)  {$err3[] = "*Me parece que você tem menos de 18 anos. Por favor, contate um adulto ou responsável para continuar o cadastro.";}
	
	//if (empty($fone))  {$err3[] = "*Digite o seu telefone.";}
	
	//if (empty($whatsapp))  {$err[] = "*Selecione se o seu telefone é whatsapp ou não.";}
	
	//if (empty($endereco))  {$err3[] = "*Digite seu endereço.";}
	
	//if (empty($cidade))  {$err3[] = "*Selecione sua cidade, município ou condado.";}

	//if (empty($estado))  {$err3[] = "*Selecione o estado ou província.";}
					
	//if (empty($pais))  {$err3[] = "*Selecione seu país.";}
	
	//if (empty($ordercode))  {$err[] = "*For registering, you have to have your ordercode in hands.<br>";}
		//else {if ($total_rows3) {$err[] = "*Invalid code";}}
	
	if (empty($checkbox))  {$err3[] = "*Por favor leia os Termos de Utilização e as Políticas de Privacidade do site e marque a opção.";}
	
    /*
    if(!empty($promocode)){
        if($promocoderows == 0){
            $err3[] = "*Invalid promocode";
        }else{
            if($used == 1){
                $err3[] = "*Invalid promocode";
            }else{
                $validpromocode = true;
            }
        }
    }
    */
    
	# Prepare the query ONCE
	if (!$err3){        
        $stmt = $pdo->prepare("INSERT INTO $tabela(email, senha, nomeprincipal, sobrenome, nomedeusuario, sexo, datadenascimento, cliente, ipdousuario, codigo_ativacao, nossafotohistoria, nossahistoria, fotoinicio, textoinicio, data) VALUES (:email, :senha, :nomeprincipal, :sobrenome, :nomedeusuario, :sexo, :datadenascimento, :cliente, :ipdousuario, :codigodeativacao, :nossafotohistoria, :nossahistoria, :fotoinicio, :textoinicio, NOW())");
        # $stmt->bindParam(1, $POST['usertype'], PDO::PARAM_STR);
        $stmt->execute(array(':email' => $email, ':senha' => $senha, ':nomeprincipal' => $nomeprincipal, ':sobrenome' => $sobrenome, ':nomedeusuario' => $nomedeusuario, ':sexo' => $sexo, ':datadenascimento' => $datadenascimento, ':cliente' => $cliente, ':ipdousuario' => $ip_usuario, ':codigodeativacao' => $codigo, ':nossafotohistoria' => $fotohistoria, ':nossahistoria' => $nossahistoria, ':fotoinicio' => $fotoinicio, ':textoinicio' => $textoinicio));
        
       
		if ($stmt->rowCount()){
			/*echo '<script>alert("You\'ve been successfully registered "); location.href = "./";</script>';*/
			// Let's mail the user!
			$assunto = "Cadastro como $tipodeusuario e ativação de conta - Casamento em Detalhes";
			$mensagem = "Olá, $nomeprincipal,
Obrigado por se cadastrar em nosso site, /orangeadex/casamentoemdetalhes

Agora é preciso que você ative sua conta para obter acesso à todas as configurações e recursos do sistema e ser capaz de ter o seu próprio site de casamento rodando 24 horas por dia. Curta os melhores momentos da vida com o/a seu/sua parceiro/a. Clique neste link para ativar, ou se preferir, apenas copie e cole-o no seu navegador: /orangeadex/casamentoemdetalhes/ativacao.php?codigo=$codigo. Observação: Você tem que estar logado para que isto dê certo.

Após a ativação, desfrute o melhor dos nossos recursos.
A equipe de Casamento em Detalhes agradece!
		
Este email foi gerado automaticamente. Peço o favor de não responder ao mesmo. Sua mensagem não será lida.";
				
			mail($email, $assunto, $mensagem, "From: Casamento em Detalhes<suporte@orangeadex.tk>\nX-Mailer: PHP/" . phpversion());

//-----------------------------------------------------------------------------------------------------------------------
			//O usuário agora é logado logo após o cadastramento
			//session_start();
				
			/*
			$email=$_POST['email'];
			$nomedeusuario=$_POST['email'];
			$senha=$_POST['senha'];
			*/
			
			$stmt3 = $pdo->prepare("SELECT * FROM usuarios_cadastrados WHERE (email = ? OR nomedeusuario = ?) AND senha = ?");
			$stmt3->bindParam(1, $email, PDO::PARAM_STR); 
			$stmt3->bindParam(2, $nomedeusuario, PDO::PARAM_STR);
			$stmt3->bindParam(3, $senha, PDO::PARAM_STR);
			$stmt3->execute();  
			
			/*
			$stmt2 = $pdo->prepare("SELECT * FROM cliregistry WHERE email = ? AND senha = ?");
			$stmt2->bindParam(1, $email, PDO::PARAM_STR); 
			$stmt2->bindParam(2, $senha, PDO::PARAM_STR);
			$stmt2->execute();
			*/
			
			$row=$stmt3->fetch(PDO::FETCH_ASSOC);
			$_SESSION['email'] = $row['email'];
			/*
			$row2=$stmt2->fetch(PDO::FETCH_ASSOC);
			*/
			
			// Se a linha (row) existir, mostrar ao usuário que o mesmo se encontra logado e redirecioná-lo para outro lugar. 
			if ($stmt3->rowCount() == 1) {
				//$_SESSION['email'] = $row['email'];
				
                /*
                if(isset($validpromocode)){ if($validpromocode == true){
                    $updatepromocodetable = $pdo->prepare("UPDATE promocode SET subscriberid = ?, used = ? WHERE code = ? AND used = ?");
                    $updatepromocodetable->execute(array($row['id'], 1, $promocode, 0));
                    
                    $updateaccountstatus = $pdo->prepare("UPDATE usuarios_cadastrados SET free = ? WHERE id = ?");
                    $updateaccountstatus->execute(array(1, $row['id']));
                }}
                */
                
                if($row['ativado'] == 1){
                    //session_save_path($sessionpath);
					header('Location: /orangeadex/casamentoemdetalhes/inicio.php');
                    exit;
                }else{
                    //session_save_path($sessionpath);
					header('Location: /orangeadex/casamentoemdetalhes/ativacao.php');
                    exit;
                }
			} else {
				$incorrectLoginDetails = true;
			}
//-----------------------------------------------------------------------------------------------------------------------
		
		}else{
			echo '<script>alert("Não foi possível efetuar o seu cadastro."); </script>';
			//location.href = "./";
		}
	}
}
/*
else{
	header("Location: /orangeadex/casamentoemdetalhes");
	exit;
}
*/
?>