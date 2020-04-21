<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include 'config.php';

include 'sessao.php';
//session_save_path($sessionpath);

if(isset($_SESSION['email'])){
	header('Location: /orangeadex/casamentoemdetalhes/inicio.php');
	exit;
}
?>
<!--the html goes here-->
<!DOCTYPE html>
<html lang="pt-br">
<head>
<?php include "analytics.inc.php"; ?>
<meta charset="utf-8">
<!--<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">-->
<!--<base href="http://casamentoemdetalhes.com/">--><base href=".">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<!--SEO-->
<meta name="description" content="Casamento em Detalhes é um site especializado para publicação de fotos, compartilhamento de arquivos e registro de dados, e ajuda na organização do seu casamento, como uma rede social para noivos e recém-casados">
<meta name="keywords" content=""/>
	<!--CSS-->
	<link href="css/home/reset.css" rel="stylesheet">
	<link href="css/home/bootstrap.min.css" rel="stylesheet">
	<link href="css/home/home.css" rel="stylesheet">
	<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta.2/css/bootstrap-grid.css">-->
	<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
	<link rel="icon" href="images/favicon.ico" type="image/x-icon">
	
    <!--[if lt IE 9]>
    	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <script src="scripts/html5shiv-printshiv"></script>
    <![endif]-->
<title>Casamento em Detalhes | Home</title>

<?php include "jivochat.inc.php"; ?>
<?php include "fpixels.inc.php"; ?>
</head>
	
<body>
<!--
<script>
  fbq('track', 'CompleteRegistration');
</script>
-->
<!--
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v4.0&appId=496788987840316&autoLogAppEvents=1"></script>
-->
<main class="main">
<nav class="menu menuFixo" id="menu">
    <div class="container_menu">
        <div class="logo">
            <img src="images/logo_home.png" alt="logo_topo_casamento_em_detalhes" class="logo_image" title="casamento_em_detalhes">
        </div>
        <div class="container_links">
            <ul class="links_left">
                <li><a href="index.php">Home</a></li>
                <li><a href="#planos">Planos</a></li>
                <li><a href="#crieseusite">Crie o seu site</a></li>
                <li><a href="#rodape3">Contato</a></li>
            </ul>
            <ul class="links_right">
                <li><a href="login.php">Acesse</a></li>
                <li class="ativo"><a href="cadastro.php">Registre-se</a></li>
            </ul>
        </div>
    </div>
</nav><!--/menu-->            

<header class="header">
    <div class="container">
        <div class="row">
            <div class="col-8 splash">
				<img style="width:20%; height:auto;" src="images/hearts2.png" />
                <h2 class="light_white">AJUDAMOS A REALIZAR</h2>
                <h2 class="bold_white">O CASAMENTO DOS SEUS SONHOS</h2>
                <a class="bt bt-branco" href="cadastro.php">CRIAR CONTA GRÁTIS</a>
                <a class="bt bt-transparente-branco" href="#planos">CONHEÇA NOSSOS PLANOS</a>
            </div>
			<!--
			<div class="col-6">
			</div>
			-->
            <div style="text-align:center; width:100%; height:auto; margin:auto; position:relative; border: 0px solid #ccc;">
				<a href="#tenhaumlindo"><img style="margin-top: 5%; text-align:center; width:5%; height:auto;" src="images/arrowsdown.png" /></a>
			</div>
        </div>
    </div>
</header>
	
<section class="banner_segundo color_marrom">
    <div class="container">
        <div class="row">
            <div class="col-8">
                <h2 class="light" id="tenhaumlindo">TENHA UM LINDO</h2>
                <h2 class="bold">SITE DO SEU CASAMENTO</h2>
            </div>
        </div>
    </div>
</section>
	
<section class="marrom">
    <div class="container">
        <div class="row">
            <div class="col-8 splash">
                <h2 class="light_white">Encante seus convidados</h2>
                <h2 class="bold_white">com um lindo site de casamento</h2>
            </div>
            <div class="col-4">
                <a class="bt bt-branco" href="cadastro.php">CRIAR SITE DE CASAMENTO</a>
            </div>
        </div>
    </div>
</section>
	
<section class="color_marrom" id="criesites">
    <div class="container">
        <div class="row hero_row">
            <div class="col-8">
                <h2 class="light">Descubra como criar</h2>
                <h2 class="bold">seu site de casamento</h2>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col text-center">
                <img src="images/home/mail-send.png" alt="icone_email" class="icone">
                <h3 class="steps">1. CONFIRME SEUS DADOS</h3>
                <p>
                    Confirme seu e-mail e conte pra gente mais detalhes sobre o seu casamento.
                </p>
            </div>
            <div class="col text-center">
                <img src="images/home/responsive-website-design-on-monitor-screen.png" alt="icone_layout" class="icone">
                <h3 class="steps">
                    2. PERSONALIZE SEU SITE
                </h3>
                <p>
                    Coloque suas fotos escolha uma playlist e deixe o site com a cara do casal!
                </p>
            </div>
            <div class="col text-center">
               <img src="images/home/giftbox.png" alt="icone_presente" class="icone">
                <h3 class="steps">
                    3. CRIE SUA LISTA DE PRESENTES
                </h3>
                <p>
                    Crie sua lista de presentes e receba os presentes que você deseja.
                </p>
            </div>
            <div class="col text-center">
                <img src="images/home/protest-megaphone.png" alt="icone_megaphone" class="icone">
                <h3 class="steps">
                    4. DIVULGUE SEU SITE
                </h3>
                <p>
                    Compartilhe seu site com quem você ama de forma rápida.
                </p>
            </div>
            <div class="col text-center">
                <img src="images/home/shake.png" alt="icone_notificações" class="icone">
                <h3 class="steps">
                    5. RECEBA AS CONFIRMAÇÕES
                </h3>
                <p>
                    Receba mensagens de carinho de seus convidados e saiba quem vai na festa!
                </p>
            </div>
        </div>
    </div>
</section>
	
<section class="color_marrom">
    <div class="container">
        <div class="row">
            <div class="col-8">
                <h2 class="light" id="crieseusite">Desfrute de todos</h2>
                <h2 class="bold">os recursos que oferecemos</h2>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-6 text-center">
                <img src="images/home/modelo-02.png" alt="imagem_modeo_dois" class="img-fluid">
                <h2>SITE PERSONALIZADO</h2>
                <p>
                    Adicione fotos, musicas, informações, curiosidades, mapas e muito mais!
                </p>
            </div>
             <div class="col-6 text-center">
                <img src="images/home/modelo-02.png" alt="imagem_modeo_dois" class="img-fluid">
                <h2>PLANEJADOR</h2>
                <p>
                    Descubra quais os próximos passos, registre e controle o seu orçamento e fornecedores.
                </p>
            </div>
            <div class="col-6 mt-5 text-right">
                <h2>Tudo isso e <span class="bold">muito mais!</span></h2>
            </div>
            <div class="col-6 mt-5 text-left">
                <a href="cadastro.php" class="bt bt-marrom">Conheça nossa ferramenta!</a>
            </div>
        </div>
    </div>
</section>
	
<section class="cinza color_marrom">
    <div class="container">
        <div class="row">
            <div class="col-8">
                <h2 class="light">Veja como é simples ter seu</h2>
                <h2 class="bold">casamento em detalhes</h2>
            </div>
        </div>
        <div class="row mt-5 mb-5">
            <div class="col">
                <img src="images/home/modelo-01.png" alt="">
            </div>
            <div class="col text-center mt-5">
                <h2 class="bold">PLANEJE-SE</h2>
                <p>
                    Crie sua lista de tarefas, cadastre seus fornecedores. Tenha todo o seu planejamento em um só lugar
                </p>
            </div>
        </div>
        <div class="row mt-5 mb-5">
            <div class="col text-center mt-5">
                <h2 class="bold">PROMOVA-SE</h2>
                <p>
                    Crie seu site de casamento, organize a hospedagem dos seus convidados e crie sua lista de presentes. Envie convites, obtenha confirmação de presença e receba os presentes da sua lista.
                </p>
            </div>
            <div class="col">
                <img src="images/home/segundo-banner.png" alt="">
           </div>
        </div>
        <div class="row mt-5">
            <div class="col">
                <img src="images/home/terceiro-banner.jpg" alt="imagem_celebre" class="img-fluid">
            </div>
            <div class="col mt-5 text-center">
                <h2 class="bold">CELEBRE</h2>
                <p>Publique as fotos da sua festa!</p>
            </div>
        </div>   
    </div>
</section>
	
<section class="color_marrom" id="planos">
    <div class="container">
        <div class="row">
            <div class="col">
                <h2>Aqui é grátis,</h2>
                <h2 class="bold">mas que tal ser GOLD?</h2>
            </div>
        </div>
        <div class="row mt-5 pt-3 pb-3">
            <div class="col borda-marrom-grossa" style="height:auto; margin-top: 20px;">
                <div class="row">
                    <div class="col text-center">
                        <h2 class="bold" style="margin-top:4%; font-size:250%;">BASIC</h2>
                    </div>
                </div>
                <ol class="list_home">
                    <li>
                        RSVP receptivo
                    </li>
                    <li>
                        Lista de presentes (de loja e virtual)
                    </li>
                    <li>
                        Email automático para agradecimento de presentes
                    </li>
                    <li>
                        Opção de casamento colaborativo (os itens de presentes serão em fornecedores para o casamento)
                    </li>
                    <li>
                        Controle o seu casamento: Planejador financeiro, input de informações e fornecedores e agenda de tarefas
                    </li>
                    <li>
                        Hashtag do casal
                    </li>
                    <li>
                        Criação do site com: 5 opções de layout para criação de site / inclusão de 3 músicas / inclusão de 5 fotos
                    </li>
                    <div class="row" style="margin-top:60%;">
                        <div class="col text-center">
                            <a class="bt bt-marrom" style="font-size:180%;" href="cadastro.php">GRATUITO</a>
                        </div>
                    </div>
                </ol>
            </div>
            <div class="col borda-marrom-grossa ml-3 mr-3 pt-3 pb-3">
               <div class="row">
                   <div class="col text-center">
                       <h2 class="bold" style="font-size:300%;">GOLD</h2>
                   </div>
               </div>
                <ol class="list_home">
                    <li>
                        RSVP receptivo
                    </li>
                    <li>
                        Lista de presentes (de loja e virtual)
                    </li>
                    <li>
                        Email automático para agradecimento de presentes
                    </li>
                    <li>
                        Opção de casamento colaborativo (os itens de presentes serão em fornecedores para o casamento)
                    </li>
                    <li>
                        Controle o seu casamento: Planejador financeiro, input de informações e fornecedores e agenda de tarefas
                    </li>
                    <li>
                        Hashtag do casal
                    </li>
                    <li>
                        Criação do site com: Todas as opções disponíveis de lyout para criação de site / inclusão de 10 músicas / inclusão de fotos ilimitadas
                    </li>
                    <li>
                        Lista em cotas de lua-de-mel (os itens de presentes serão em passeios e coisas para a lua de mel)
                    </li>
                    <li>
                        Lista de casamento personalizada (os itens de presentes serão..)
                    </li>
                </ol>
                <div class="row">
                    <div class="col text-center">
                        <a class="bt bt-marrom" style="font-size:180%;" href="cadastro.php">R$ 149,00/mês</a>
                    </div>
                </div>
            </div>
            <div class="col borda-marrom-grossa ml-3 mr-3 pt-3 pb-3" style="margin-top:20px;">
               <div class="row">
                   <div class="col text-center">
                       <h2 class="bold" style="font-size:250%;">PREMIUM</h2>
                   </div>
               </div>
                <ol class="list_home">
                    <li>
                        RSVP receptivo
                    </li>
                    <li>
                        Lista de presentes (de loja e virtual)
                    </li>
                    <li>
                        Email automático para agradecimento de presentes
                    </li>
                    <li>
                        Opção de casamento colaborativo (os itens de presentes serão em fornecedores para o casamento)
                    </li>
                    <li>
                        Controle o seu casamento: Planejador financeiro, input de informações e fornecedores e agenda de tarefas
                    </li>
                    <li>
                        Hashtag do casal
                    </li>
                    <li>
                        Criação do site com: Todas as opções disponíveis de layout para criação de site / inclusão de 6 músicas / inclusão de 10 fotos
                    </li>
                </ol>
                <div class="row">
                    <div class="col text-center" style="margin-top:50%;">
                        <a class="bt bt-marrom" style="font-size:180%;" href="cadastro.php">R$ 65,00/mês</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</main>
	
<footer>
	<div class="container_footer bt-marrom">
		<div class="mainbox">
			<div class="footerbox">
				<p style="font-size:100%; font-weight:bolder; margin-bottom:5%;">Quem Somos</p>
				<p style="font-size:90%;">O <span style="foot-weight:bolder;">Casamento em Detalhes</span> é uma empresa de asssessoria e cerimonial de casamentos que uniu suas habilidades em preparar eventos com excelência, organização e carisma com a nossa principal característica, a paixão em poder realizar sonhos.</p>
			</div>
			<div class="footerbox">
				<p style="font-size:100%; font-weight:bolder; margin-bottom:5%;">Recursos</p>
				<ul class="footer_list">
					<li><a href="#">Precisa de ajuda?</a></li>
					<li id="rodape3"><a href="#">Fale conosco</a></li>
					<li><a href="#">Sou fornecedor</a></li>
					<li><a href="termos.php">Termos de uso</a></li>
					<li><a href="privacidade.php">Privacidade</a></li>
				</ul>
			</div>
			<div class="footerbox">
				<p style="font-size:100%; font-weight:bolder; margin-bottom:5%;">Casamento em Detalhes</p>
				<ul class="footer_list">
					<li><a href="cadastro.php">Site de Casamento</a></li>
					<li><a href="cadastro.php">Lista de Presentes</a></li>
					<li><a href="cadastro.php">Planos</a></li>
				</ul>
				<img style="float:right; width:40%; height:auto;" src="images/hearts2.png" />
			</div>
		</div>
	</div>
	<div class="container_footer2 color_marrom">
		<span style="font-weight:bold;">Casamento em Detalhes 2020</span> - Designed by <span style="font-weight:bold;">JFC Designer</span> and developed by <a href="/orangeadex/casamentoemdetalhes"><span style="font-weight:bold;">Orangeade X</span></a>
	</div>
</footer>
	
<!--Scripts-->
<script src="js/home/jquery.js.transferir"></script>
<script src="js/home/bootstrap.min.js.transferir"></script>
<script src="js/home/main.js.transferir"></script>
    
</body>
</html>