<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
require "config.php";
//session_save_path($sessionpath);
//Nota: Headers already sent - quando isto acontecer, verifique se o config.php está configurado para utf-8 sem BOM. Verifique também se não há algum espaço antes, entre ou após as tags php, ou algum código html anterior ou mesmo algum código php; quaisquer funções envolvendo "echo" ou "print" que produzam algum tipo de saída ou hipertexto; e verifique também se há mensagens de erros ou avisos. Todas estas causas que citei são as mais comuns que ocasionam esse tipo de problema/erro.
include 'sessao.php';

if(!isset($_SESSION['email'])){
	header('Location: '.$urlHost);
	exit;
}else{
	if($row['ativado'] != 0){
		header('Location: '.$urlHost.'/site.php');
		exit;
	}
	$loggedin = true;
}

//As linhas de código abaixo servem para impedir que o usuário ative páginas restritas caso o mesmo ainda não tenha confirmado seu próprio cadastro via email.
/*
if(!isset($_SESSION['email'])){
	header('Location:/');
	exit;
}else{
	if($row['activated'] == 0){
		header('Location: ativacao.php');	
	}	
	if($row['credential'] != 0){
		$adminpermissions = true;
	}
	$loggedin = true;
}
*/
//este código aqui é como se fosse uma chave que protege todas as páginas que precisam de login para serem acessadas.
?>
<html><head lang="pt-br">
<?php
include 'analytics.inc.php';
?>
<meta charset="utf-8">
<meta name="description" content="Ative agora a sua conta. Você está a um só passo. Verifique a caixa de entrada do seu email."/>
<meta name="keywords" content=""/>
	<link rel="stylesheet" type="text/css" href="css/index.css"/>
	<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
	<link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">

    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script> <!-- load jquery via CDN -->
    <!--[if lt IE 9]>
    	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <script src="scripts/html5shiv-printshiv"></script>
    <![endif]-->
<title>Ativar Conta | Casamento em Detalhes</title>
<link href='http://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Fredoka+One' rel='stylesheet' type='text/css'>

<!--validation through jquery, using AJAX and PHP (file:register2.php)-->
<!--<script type='text/javascript' src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>-->

<!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>-->
<script type="text/javascript" src="http://ajax.microsoft.com/ajax/jquery.validate/1.7/jquery.validate.js"></script>

<?php
include "fpixels.inc.php";
?>
</head>
<!-- Esta tag deve aparecer no cabeçalho ou logo antes do fechamento da tag body. -->
<script src="https://apis.google.com/js/platform.js" async defer>
  {lang: 'en-US'}
</script>

<!--Início do Script JivoChat-->
<?php include "jivochat.inc.php";?>
<!--Fim do Script JivoChat-->

<body>

<div class="layout clearfix">
<header>
    <center>
		<a href="<?php echo $urlHost; ?>"><img src="images/hearts.png" width="20%" height="auto" /></a>
		<br/>
		<a href="<?php echo $urlHost; ?>/logout.php">Logout</a>
	</center>
</header>
<!--new div-->

<main>
	<!--
    <div id="subjects">
    </div>
    -->
    
    <div id="conteudo">
        <br><br><br>
        <center style="font-weight: bold; font-size:18px; color: #C60;">
        <?php
		if((!isset($_GET['codigo'])) && ($row['ativado'] == 0)){
		//$code = $_GET['codigo'];
		?>
        
        Seu cadastro foi efetuado com sucesso. Mas é preciso que você ainda assim ative a sua conta. Vá até à caixa de entrada ou de spam do seu email e clique no link indicado. Nota: não efetue o logout. Verifique se o email não está na sua caixa de spam e desmarque essa opção. Se ainda assim não encontrar, clique no botão abaixo para reenviar o email. Até breve!
        <br/><br/>
			<?php
            if(isset($_POST['resend'])){
                $firstname = $row['nomeprincipal'];
				$codefromtable = $row['codigo_ativacao'];
				$subject = "Cadastro e ativação de conta - Casamento em Detalhes";
                $message = "Olá, $firstname,
Obrigado por efetuar seu cadastro em nosso site, $urlHost

Agora é preciso que você ative sua conta para obter acesso a todos os recursos do sistema. Clique no link: $urlHost/ativacao.php?codigo=$codefromtable. Se preferir, copie e cole o link direto na barra de endereço do seu navegador. Nota: Você tem que estar logado para que isto funcione.

Após a ativação, disponha dos nossos serviços.
A equipe de Casamento em Detalhes agradece e lhe deseja as boas vindas.
		
Este email foi gerado de forma automática. Por favor, não o responda.";
				
				mail($email, $subject, $message, "From: Casamento em Detalhes<suporte@orangeadex.tk>\nX-Mailer: PHP/" . phpversion());
				echo "<br/><span class=\"mensagemdevalidacao\">O link de ativação foi enviado a você novamente.</span><br/><br/>";
			}
		?>
        <form method="post" action="" enctype="multipart/form-data">
        	<input type="submit" value="Reenviar Mensagem de Confirmação" name="resend"/>
        </form>
        <?php
		}else{
			$code = $_GET['codigo'];
			$one = 1;
			if((isset($_GET['codigo'])) && ($row['ativado'] == 0) && ($row['codigo_ativacao'] == $code)){
				//$code = $_GET['codigo'];
				$activateaccount = $pdo->prepare("UPDATE usuarios_cadastrados SET ativado = ?, codigo_ativacao = ? WHERE id = ?");
				$activateaccount->execute(array($one, "", $row['id']));
				//header('Refresh:0');
				$firstname = $row['nomeprincipal'];
				$subject = "Boa! A sua conta agora está ativa! - Casamento em Detalhes";
                $message = "Olá, $firstname,
Meus parabéns!

A sua conta já está ativa e agora o céu é o limite. Curta o nosso conteúdo que tem coisa de montão pra fazer do seu casamento um momento memorável e sem igual. Nós temos as ferramentas necessárias para tornar site do seu casamento uma realidade.

A equipe de Casamento em Detalhes agradece e lhe dá as boas vindas!
		
Este email foi gerado de forma automática. Por favor, não o responda.";
				
				mail($email, $subject, $message, "From: Casamento em Detalhes<suporte@orangeadex.tk>\nX-Mailer: PHP/" . phpversion());		?>
        
        A sua conta foi ativada com sucesso. Fique a vontade para curtir e aproveitar todos os recursos do sistema, para fazer o seu casamento se tornar um sonho real.
        
        <?php
			}else{		
				if(((!isset($_GET['codigo'])) && ($row['ativado'] != 0)) OR ((isset($_GET['codigo'])) && ($row['ativado'] != 0)) ){
		?>
        <!-- Este código aqui talvez seja desnecessário por causa do cabeçalho (header) lá do início.-->
        Amigo, a sua conta já se encontra ativa em nosso sistema. Não há necessidade de você vir aqui pra checar. Vaza!! Haha.
        <?php
				}else{
		?>
        Erro! Código provavelmente incorreto ou expirado ou inexistente.
        <?php
				}
			}
		}
		?>
        
        </center>
        <br/><br/><br/><br/><br/><br/><br/><br/>
	 </div>
</main>

</div>

<div class="footerdiv clearfix">
<footer>
    <?php include "rodape.inc.php";?>
</footer>
</div>

</body>
</html>