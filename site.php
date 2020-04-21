<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include 'config.php';

include 'sessao.php';
//session_save_path($sessionpath);

if(isset($_SESSION['email'])){
	if($row['ativado'] == 0){
        header('Location: /orangeadex/casamentoemdetalhes/ativacao.php');
        exit;
    }
}else{
    header('Location: /orangeadex/casamentoemdetalhes/login.php');
    exit;
}
?>
<!--aqui inicia o html-->
<!DOCTYPE html>
<html lang="pt-br">
<head>
<?php include "analytics.inc.php"; ?>
    
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>-->
    
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="description" content=""/>
<meta name="keywords" content=""/>
	<link rel="stylesheet" type="text/css" href="css/index.css"/>
	<link rel="stylesheet" type="text/css" href="css/tabs2.css"/>
	<link rel="stylesheet" type="text/css" href="css/tabs.less"/>
	<link rel="stylesheet" type="text/css" href="css/tabs.css"/>
	<link rel="stylesheet" type="text/css" href="css/rdbutton.css"/>
	<link rel="stylesheet" type="text/css" href="css/rdbutton2.css"/>
	<link rel="stylesheet" type="text/css" href="css/rdbutton3.css"/>
	<link rel="stylesheet" type="text/css" href="css/coloredcheckboxes.css"/>
	<link rel="stylesheet" type="text/css" href="css/coloredcheckboxes2.css"/>
	<link rel="stylesheet" type="text/css" href="css/coloredcheckboxes3.css"/>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
	<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta.2/css/bootstrap-grid.css">-->
	<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
	<link rel="icon" href="images/favicon.ico" type="image/x-icon">
    
    <!--[if lt IE 9]>
    	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <script src="scripts/html5shiv-printshiv"></script>
    <![endif]-->
<title>Casamento em Detalhes | Alterar Site</title>

<?php include "controlswitch.inc.php"; ?>
<?php include "estilo.inc.php"; ?>
<?php //include "sharebuttons.inc.php"; ?>
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
<?php include "menulateral.inc.php"; ?>

<div class="conteudogeral clearfix">
<header>
<?php include "cabecalho.inc.php"; ?>
</header>
<!--new div-->
	
<main>
    <div class="conteudoprincipal">
		<div class="tab">
          <div class="centralizador">
			  <button class="tablinks" onclick="openCity(event, 'meusite')" id="defaultOpen">Meu Site</button>
			  <button class="tablinks" onclick="openCity(event, 'configuracoes')">Configurações</button>
		  </div>
        </div>
        
        <div id="meusite" class="tabcontent">
			<div class="personalizarpagina">
				<p style="font-family:Gotham, 'Helvetica Neue', Helvetica, Arial, 'sans-serif'; font-size: 70%; font-weight:bold; margin-bottom:8px;">Personalização</p>
				<button class="tablinks2" onclick="openCity2(event, 'layout')" id="defaultOpen1">Layout</button>
				<br/><br/>
				<p style="font-family:Gotham, 'Helvetica Neue', Helvetica, Arial, 'sans-serif'; font-size: 70%; font-weight:bold; margin-bottom: 8px;">Páginas</p>
				<button class="tablinks2" onclick="openCity2(event, 'nossahistoria')"><b>Nossa História</b></button>
				<br/>
				<button class="tablinks2" onclick="openCity2(event, 'albumdefotos')"><b>Fotos</b> (Álbum de Fotos)</button>
				<br/>
				<button class="tablinks2" onclick="openCity2(event, 'locais')"><b>Locais</b></button>
				<br/>
				<button class="tablinks2" onclick="openCity2(event, 'padrinhos')"><b>Padrinhos</b></button>
				<br/>
				<button class="tablinks2" onclick="openCity2(event, 'enquetes')"><b>Enquetes</b></qb></button>
				<br/>
			<button class="tablinks2" onclick="openCity2(event, 'mensagens')"><b>Mensagens</b></button>
				<br/>
			<button class="tablinks2" onclick="openCity2(event, 'dicas')"><b>Dicas</b></button>
				<br/>
			<button class="tablinks2" onclick="openCity2(event, 'novapagina')"><b>Criar Nova Página</b></button>
			</div>
			<div id="layout" class="tabcontent2">
				<div class="boasvindas">Bem-vindo ao painel do seu site. Comece personalizando-o com cores, fontes, etc.</div>
				<div class="involucrolayout">
					<div class="escolherarte">
						<form action="salvarlayout.php" method="post" enctype="multipart/form-data">
							<div class="escolhaascores">Escolha as cores do seu site</div>
							<div class="paletadecores">
								<div>
									Padrão
									<br/>
									<div class="padrao">
									</div>
									<label class="radiobutton">
										<input name="paleta" id="padrao" class="radio2" type="radio" value="0" <?php if($row['paleta'] == 0){ echo "checked"; } ?>>
										<span class="checkmark"></span>
									</label>
								</div>
								<div>
									Talos
									<br/>
									<div class="talos">
									</div>
									<label class="radiobutton">
										<input name="paleta" id="talos" class="radio2" type="radio" value="1" <?php if($row['paleta'] == 1){ echo "checked"; } ?>>
										<span class="checkmark"></span>
									</label>
								</div>
								<div>
									Eros
									<br/>
									<div class="eros">
									</div>
									<label class="radiobutton">
										<input name="paleta" id="eros" class="radio2" type="radio" value="2" <?php if($row['paleta'] == 2){ echo "checked"; } ?>>
										<span class="checkmark"></span>
									</label>
								</div>
								<div>
									Transcendent
									<br/>
									<div class="transcendent">
									</div>
									<label class="radiobutton">
										<input name="paleta" id="transcendent" class="radio2" type="radio" value="3" <?php if($row['paleta'] == 3){ echo "checked"; } ?>>
										<span class="checkmark"></span>
									</label>
								</div>
								<div>
									Enigma
									<br/>
									<div class="enigma">
									</div>
									<label class="radiobutton">
										<input name="paleta" id="enigma" class="radio2" type="radio" value="4" <?php if($row['paleta'] == 4){ echo "checked"; } ?>>
										<span class="checkmark"></span>
									</label>
								</div>
								<div>
									Summer
									<br/>
									<div class="summer">
									</div>
									<label class="radiobutton">
										<input name="paleta" id="summer" class="radio2" type="radio" value="5" <?php if($row['paleta'] == 5){ echo "checked"; } ?>>
										<span class="checkmark"></span>
									</label>
								</div>
								<div>
									Celestial
									<br/>
									<div class="celestial">
									</div>
									<label class="radiobutton">
										<input name="paleta" id="celestial" class="radio2" type="radio" value="6" <?php if($row['paleta'] == 6){ echo "checked"; } ?>>
										<span class="checkmark"></span>
									</label>
								</div>
								<div>
									Rubi
									<br/>
									<div class="rubi">
									</div>
									<label class="radiobutton">
										<input name="paleta" id="rubi" class="radio2" type="radio" value="7" <?php if($row['paleta'] == 7){ echo "checked"; } ?>>
										<span class="checkmark"></span>
									</label>
								</div>
								<div>
									Coral
									<br/>
									<div class="coral">
									</div>
									<label class="radiobutton">
										<input name="paleta" id="coral" class="radio2" type="radio" value="8" <?php if($row['paleta'] == 8){ echo "checked"; } ?>>
										<span class="checkmark"></span>
									</label>
								</div>
								<div>
									Paraíso
									<br/>
									<div class="paraiso">
									</div>
									<label class="radiobutton">
										<input name="paleta" id="paraiso" class="radio2" type="radio" value="9" <?php if($row['paleta'] == 9){ echo "checked"; } ?>>
										<span class="checkmark"></span>
									</label>
								</div>
								<div>
									Rose
									<br/>
									<div class="rose">
									</div>
									<label class="radiobutton">
										<input name="paleta" id="rose" class="radio2" type="radio" value="10" <?php if($row['paleta'] == 10){ echo "checked"; } ?>>
										<span class="checkmark"></span>
									</label>
								</div>
								<div>
									Alecrim
									<br/>
									<div class="alecrim">
									</div>
									<label class="radiobutton">
										<input name="paleta" id="alecrim" class="radio2" type="radio" value="11" <?php if($row['paleta'] == 11){ echo "checked"; } ?>>
										<span class="checkmark"></span>
									</label>
								</div>						
							</div>
							<div class="personalizarfonte">
								<div class="fontetitulo">
									<p style="margin-bottom: 10px;">Escolha a fonte dos títulos<p/>
									<label class="radiobutton2" style="font-family: 'Great-Wishes'; font-size: 100%;">
										Texto de Exemplo
										<input type="radio" name="textoestilo" value="0" <?php if($row['textoestilo'] == 0){ echo "checked"; } ?>>
										<span class="checkmark2"></span>
									</label><br/>
									
									<label class="radiobutton2" style="font-family: 'Luna'; font-size: 100%;">
										Texto de Exemplo
										<input type="radio" name="textoestilo" value="1" <?php if($row['textoestilo'] == 1){ echo "checked"; } ?>>
										<span class="checkmark2"></span>
									</label><br/>
								
									<label class="radiobutton2" style="font-family: 'I-Love-Glitter'; font-size: 170%;">
										Texto de Exemplo
										<input type="radio" name="textoestilo" value="2" <?php if($row['textoestilo'] == 2){ echo "checked"; } ?>>
										<span class="checkmark2"></span>
									</label><br/>
								
									<label class="radiobutton2" style="font-family: 'Allisya'; font-size: 200%;">
										Texto de Exemplo
										<input type="radio" name="textoestilo" value="3" <?php if($row['textoestilo'] == 3){ echo "checked"; } ?>>
										<span class="checkmark2"></span>
									</label><br/>
								
									<label class="radiobutton2" style="font-family: 'Little-Clusters'; font-size: 140%;">
										Texto de Exemplo
										<input type="radio" name="textoestilo" value="4" <?php if($row['textoestilo'] == 4){ echo "checked"; } ?>>
										<span class="checkmark2"></span>
									</label><br/>
								
									<label class="radiobutton2" style="font-family: 'Summertime-Reguler'; font-size: 200%;">
										Texto de Exemplo
										<input type="radio" name="textoestilo" value="5" <?php if($row['textoestilo'] == 5){ echo "checked"; } ?>>
										<span class="checkmark2"></span>
									</label><br/><br/><br/><br/><br/><br/><br/><br/>
									
									Escolha a cor dos títulos<br/>
									<label class="container">
										<input class="cordotitulo" type="checkbox" name="cordotitulo" value="0" <?php if($row['cordotitulo'] == 0){ echo "checked"; } ?>>
										<span class="checkmark3" id="color1"></span>
									</label>
									<label class="container">
										<input class="cordotitulo" type="checkbox" name="cordotitulo" value="1" <?php if($row['cordotitulo'] == 1){ echo "checked"; } ?>>
										<span class="checkmark3" id="color2"></span>
									</label>
									<label class="container">
										<input class="cordotitulo" type="checkbox" name="cordotitulo" value="2" <?php if($row['cordotitulo'] == 2){ echo "checked"; } ?>>
										<span class="checkmark3" id="color3"></span>
									</label>
									<label class="container">
										<input class="cordotitulo" type="checkbox" name="cordotitulo" value="3" <?php if($row['cordotitulo'] == 3){ echo "checked"; } ?>>
										<span class="checkmark3" id="color4"></span>
									</label>
									<label class="container">
										<input class="cordotitulo" type="checkbox" name="cordotitulo" value="4" <?php if($row['cordotitulo'] == 4){ echo "checked"; } ?>>
										<span class="checkmark3" id="color5"></span>
									</label>
									<label class="container">
										<input class="cordotitulo" type="checkbox" name="cordotitulo" value="5" <?php if($row['cordotitulo'] == 5){ echo "checked"; } ?>>
										<span class="checkmark3" id="color6"></span>
									</label>
									<label class="container">
										<input class="cordotitulo" type="checkbox" name="cordotitulo" value="6" <?php if($row['cordotitulo'] == 6){ echo "checked"; } ?>>
										<span class="checkmark3" id="color7"></span>
									</label>
									<br/>
									<label class="container2">
										<input class="cordotitulo" type="checkbox" name="cordotitulo" value="7" <?php if($row['cordotitulo'] == 7){ echo "checked"; } ?>>
										<span class="checkmark4" id="color8"></span>
									</label>
									<label class="container2">
										<input class="cordotitulo" type="checkbox" name="cordotitulo" value="8" <?php if($row['cordotitulo'] == 8){ echo "checked"; } ?>>
										<span class="checkmark4" id="color9"></span>
									</label>
									<label class="container2">
										<input class="cordotitulo" type="checkbox" name="cordotitulo" value="9" <?php if($row['cordotitulo'] == 9){ echo "checked"; } ?>>
										<span class="checkmark4" id="color10"></span>
									</label>
									<label class="container2">
										<input class="cordotitulo" type="checkbox" name="cordotitulo" value="10" <?php if($row['cordotitulo'] == 10){ echo "checked"; } ?>>
										<span class="checkmark4" id="color11"></span>
									</label>
									<label class="container2">
										<input class="cordotitulo" type="checkbox" name="cordotitulo" value="11" <?php if($row['cordotitulo'] == 11){ echo "checked"; } ?>>
										<span class="checkmark4" id="color12"></span>
									</label>
									<label class="container2">
										<input class="cordotitulo" type="checkbox" name="cordotitulo" value="12" <?php if($row['cordotitulo'] == 12){ echo "checked"; } ?>>
										<span class="checkmark4" id="color13"></span>
									</label>
									<label class="container2">
										<input class="cordotitulo" type="checkbox" name="cordotitulo" value="13" <?php if($row['cordotitulo'] == 13){ echo "checked"; } ?>>
										<span class="checkmark4" id="color14"></span>
									</label>
									<br/><br/><br/><br/>
								</div>
								<div class="escolherdivisor">
									<p style="margin-bottom: 6px;">Escolha os divisores</p>
									<table class="tabeladosdivisores">
										<tr>
											<td>
												<label class="radiobutton4">
													<input class="escolhaodivisor" type="radio" name="divisor" value="0" <?php if($row['divisor'] == 0){ echo "checked"; } ?>>
													<span class="checkmark7"></span>
												</label>
											</td>
											<td>
												<p style="font-family: 'Honey-Moon'; font-size:300%; color: #BFBFBF;">C</p>
											</td>
										</tr>
										<tr>
											<td>
												<label class="radiobutton4">
													<input class="escolhaodivisor" type="radio" name="divisor" value="1" <?php if($row['divisor'] == 1){ echo "checked"; } ?>>
													<span class="checkmark7"></span>
												</label>
											</td>
											<td>
												<p style="font-family: 'Honey-Moon'; font-size:300%; color: #BFBFBF;">G</p>
											</td>
										</tr>
										<tr>
											<td>
												<label class="radiobutton4">
													<input class="escolhaodivisor" type="radio" name="divisor" value="2" <?php if($row['divisor'] == 2){ echo "checked"; } ?>>
													<span class="checkmark7"></span>
												</label>
											</td>
											<td>
												<p style="font-family: 'Honey-Moon'; font-size:300%; color: #BFBFBF;">J</p>
											</td>
										</tr>
										<tr>
											<td>
												<label class="radiobutton4">
													<input class="escolhaodivisor" type="radio" name="divisor" value="3" <?php if($row['divisor'] == 3){ echo "checked"; } ?>>
													<span class="checkmark7"></span>
												</label>
											</td>
											<td>
												<p style="font-family: 'Honey-Moon'; font-size:300%; color: #BFBFBF;">K</p>
											</td>
										</tr>
										<tr>
											<td>
												<label class="radiobutton4">
													<input class="escolhaodivisor" type="radio" name="divisor" value="4" <?php if($row['divisor'] == 4){ echo "checked"; } ?>>
													<span class="checkmark7"></span>
												</label>
											</td>
											<td>
												<p style="font-family: 'Honey-Moon'; font-size:300%; color: #BFBFBF;">L</p>
											</td>
										</tr>
										<tr>
											<td>
												<label class="radiobutton4">
													<input class="escolhaodivisor" type="radio" name="divisor" value="5" <?php if($row['divisor'] == 5){ echo "checked"; } ?>>
													<span class="checkmark7"></span>
												</label>
											</td>
											<td>
												<p style="font-family: 'Honey-Moon'; font-size:300%; color: #BFBFBF;">Q</p>
											</td>
										</tr>
										<tr>
											<td>
												<label class="radiobutton4">
													<input class="escolhaodivisor" type="radio" name="divisor" value="6" <?php if($row['divisor'] == 6){ echo "checked"; } ?>>
													<span class="checkmark7"></span>
												</label>
											</td>
											<td>
												<p style="font-family: 'Honey-Moon'; font-size:300%; color: #BFBFBF;">R</p>
											</td>
										</tr>
										<tr>
											<td>
												<label class="radiobutton4">
													<input class="escolhaodivisor" type="radio" name="divisor" value="7" <?php if($row['divisor'] == 7){ echo "checked"; } ?>>
													<span class="checkmark7"></span>
												</label>
											</td>
											<td>
												<p style="font-family: 'Honey-Moon'; font-size:300%; color: #BFBFBF;">P</p>
											</td>
										</tr>
									</table>
								</div>
								<div class="fontetexto">
									<p style="margin-bottom: 10px;">Escolha a fonte dos textos</p>
									<label class="radiobutton3" style="font-family: Cambria, 'Hoefler Text', 'Liberation Serif', Times, 'Times New Roman', 'serif'; font-size: 100%;">
										Texto de Exemplo
										<input class="fontedostextos" type="radio" name="fontetexto" value="0" <?php if($row['fontetexto'] == 0){ echo "checked"; } ?>>
										<span class="checkmark5"></span>
									</label><br/>
									
									<label class="radiobutton3" style="font-family: Consolas, 'Andale Mono', 'Lucida Console', 'Lucida Sans Typewriter', Monaco, 'Courier New', 'monospace'; font-size: 100%;">
										Texto de Exemplo
										<input class="fontedostextos" type="radio" name="fontetexto" value="1" <?php if($row['fontetexto'] == 1){ echo "checked"; } ?>>
										<span class="checkmark5"></span>
									</label><br/>
									
									<label class="radiobutton3" style="font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, 'sans-serif'; font-size: 100%;">
										Texto de Exemplo
										<input class="fontedostextos" type="radio" name="fontetexto" value="2" <?php if($row['fontetexto'] == 2){ echo "checked"; } ?>>
										<span class="checkmark5"></span>
									</label><br/>
									
									<br/><br/><br/>
									Escolha a cor dos textos<br/>
									<label class="container3">
										<input class="cordotexto" type="checkbox" name="cordotexto" value="0" <?php if($row['cordotexto'] == 0){ echo "checked"; } ?>>
										<span class="checkmark6" id="color15"></span>
									</label>
									<label class="container3">
										<input class="cordotexto" type="checkbox" name="cordotexto" value="1" <?php if($row['cordotexto'] == 1){ echo "checked"; } ?>>
										<span class="checkmark6" id="color16"></span>
									</label>
									<label class="container3">
										<input class="cordotexto" type="checkbox" name="cordotexto" value="2" <?php if($row['cordotexto'] == 2){ echo "checked"; } ?>>
										<span class="checkmark6" id="color17"></span>
									</label>
									<label class="container3">
										<input class="cordotexto" type="checkbox" name="cordotexto" value="3" <?php if($row['cordotexto'] == 3){ echo "checked"; } ?>>
										<span class="checkmark6" id="color18"></span>
									</label>
									<br/><br/><br/><br/><br/><br/><br/><br/><br/>
									<input type="submit" name="salvar" value="Salvar Layout" class="salvarlayout <?php echo $color; ?>">
									<!-- echo $color; -->
								</div>
							</div>
						</form>
					</div>
					<div class="previsualizacao">
						<p style="text-align: center;">Pré-visualização</p><br/>
						<div class="minilayout">
							<div class="titulodapagina">
								<h1 style="text-align: center; margin-bottom:0; font-weight:normal; font-size:160%; color:white;">Título da Página</h1>
								<p class="<?php echo $divisorclasse; ?>"></p>
							</div>
							<div class="partedotexto">
								<h2 class="titulodotexto" style="font-family: <?php echo $font; ?>; font-size: <?php echo $size; ?>; color: <?php echo $titlecolor; ?>;">Título do Texto</h2>
								<p class="estilotexto" style="text-align: left; font-family: <?php echo $font1; ?>; color: <?php echo $textcolor; ?>;">"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat."</p>
								<br/><br/>
								<h3 style="text-align: center; margin-bottom:3%; color:#000000; font-size:100%; font-weight:bolder;">Título Secundário</h3>
								<p class="estilotexto" style="text-align:center; font-family: <?php echo $font1; ?>; color: <?php echo $textcolor; ?>;">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident.</p>
								<br/><br/>
								<center><button class="botaodeamostra <?php echo $color; ?>">Botão</button></center>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div id="nossahistoria" class="tabcontent2">
				<h1>Nossa história</h1><br/>
				<p>Editar texto</p>
				<form enctype="multipart/form-data" method="post" action="salvarhistoria.php">
					<textarea name="historia" cols="120" rows="30">
<?php echo $row['nossahistoria']; ?>
					</textarea><br/>
					<input class="submit" type="submit" name="salvarhistoria" value="Salvar" />
				</form>
				<br/><br/><br/>
				<h3>Fazer o upload ou substituir foto principal</h3>
				<form method="post" enctype="multipart/form-data" action="fotohistoria.php">
					<label for="file-4">Clique aqui para selecionar uma foto ou imagem&hellip;</label>
					<br/>
					<input type="file" name="pic" id="file-4" class="inputfile inputfile-3" data-multiple-caption="{count} files selected" multiple />
					<input class="submit" type="submit" name="historyphoto" value="Publicar Foto" />
					<span id='file-name'></span>
					<br/>
				</form>
				<br/><br/>
				<?php
				if($row['nossahistoriafoto'] == "default.jpg"){
				?>
				<div class="fotohistoria">Foto<br/>default</div>
				<!--<img src="fotos/historia/default.jpg" width="30%" height = "auto" />-->
				<?php
				}else{
				?>
				<img src="fotos/historia/<?php echo $row['nossahistoriafoto']; ?>" width="30%" height = "auto" />
				<?php
				}
				?>
			</div>
			<div id="albumdefotos" class="tabcontent2">
				<img src="images/add.png" width="20" height="auto" /> <span style="font-size: 140%; font-weight: bolder;">Adicionar fotos</span><br/>
				<form method="post" enctype="multipart/form-data" action="publicarfoto.php">
					<label for="file-4">Clique aqui para selecionar uma foto ou imagem&hellip;</label>
					<br/>
					<input type="file" name="pic" id="file-4" class="inputfile inputfile-3" data-multiple-caption="{count} files selected" multiple />
					<input class="submit" type="submit" name="postphoto" value="Publicar Foto" />
					<span id='file-name'></span>
					<br/>
				</form>
				<br/><br/>
				<img src="images/photoicon.png" width="20" height="auto" /> <span style="font-size: 140%; font-weight: bolder;">Fotos</span><br/>
				<div class="flexfotos">
				<?php
				$selecionarfotos = $pdo->prepare("SELECT * FROM fotos WHERE iddocasal = ? ORDER BY data DESC");
				$selecionarfotos->execute(array($row['id']));
				$contadordefotos = $selecionarfotos->rowCount();
				
				if($contadordefotos == 0){
					echo "<br/><br/><br/><br/><br/><center><h2 style=\"color:#CCCCCC;\">Album vazio</h2></center>";
				}else{	
					while($buscarfoto = $selecionarfotos->fetch(PDO::FETCH_ASSOC)){
						$id = $buscarfoto['id'];
				?>
					<div class="photo" style="background:url(fotos/album/<?php echo $buscarfoto['nomediretorio']; ?>); background-size:cover; background-position:center; background-repeat: no-repeat;">
						<form action="deletarfoto.php?id=<?php echo urlencode($id); ?>" enctype="multipart/form-data" method="post">
							<input class="lixeirinha" onClick="return confirm('Tem certeza? Deseja apagar realmente a foto?')" type="image" src="images/trash.png" value="Apagar foto" name="deletepic">
						</form>
						<!--<p class="lixeirinha"><img src="images/trash.png" width="8%" height="auto" /></p>-->
					</div>
				<?php
					}
				}
				?>
				</div>
			</div>
			<div id="locais" class="tabcontent2">
				<?php include "emconstrucao.inc.php"; ?>
			</div>
			<div id="padrinhos" class="tabcontent2">
				<?php include "emconstrucao.inc.php"; ?>
			</div>
			<div id="enquetes" class="tabcontent2">
				<?php include "emconstrucao.inc.php"; ?>
			</div>
			<div id="mensagens" class="tabcontent2">
				<?php include "emconstrucao.inc.php"; ?>
			</div>
			<div id="dicas" class="tabcontent2">
				<?php include "emconstrucao.inc.php"; ?>
			</div>
			<div id="novapagina" class="tabcontent2">
				<?php include "emconstrucao.inc.php"; ?>
			</div>
		</div>
        
        <div id="configuracoes" class="tabcontent">
            <p style="font-size:120%; font-weight:bolder;">Templates</p>
			<br/><br/>
			<div class="flextemplates">
				<div class="template">
					<form enctype="multipart/form-data" method="post" action="salvartemplate.php">
						<label>
						<input type="radio" name="templates" value="0" <?php if($row['template'] == 0){ echo "checked"; } ?> /> <span style="color:red; font-weight:bold;">Simpleton</span>
							<br/>
							<img src="templates/simpleton.jpg" width="100%" height="auto" />
						</label>
						<br/><br/>
				</div>
			</div>
			<div>
				<input type="submit" value="Salvar template" class="submit" name="salvartemplate" />
					</form>
			</div>
			<br/><br/><br/><br/><br/>
			<p style="font-weight:bold; font-size:110%;">Usuário do casal, ex: #carlos&amp;jessiquinha, #alfredo&amp;joana...</p>
			<form enctype="multipart/form-data" method="post" action="salvarusuario.php">
				<span style="font-size:200%; font-weight:bolder;color:red;">#</span><input type="text" name="nomedeusuario" value="<?php if(!empty($row['nomedeusuario'])){ echo $row['nomedeusuario']; }else{ ?>Ex.: waldecir&marlene<?php } ?>" /><br/>
				<p style="font-size:80%; color:saddlebrown;">*Dica: tudo minúsculo. Não precisa da hashtag (#) no início.</p>
				<br/><br/>
				<input type="text" <?php if(empty($row['nomedonoivo'])){ echo 'placeholder="Nome Completo do Noivo"'; }else{ echo 'value="'.$row['nomedonoivo'].'"'; } ?> name="noivo" /><br/><br/>
				<input type="text" <?php if(empty($row['nomedanoiva'])){ echo 'placeholder="Nome Completo da Noiva"'; }else{ echo 'value="'.$row['nomedanoiva'].'"'; } ?> name="noiva" /><br/><br/>
				<?php if($row['datadocasamento'] != "0000-00-00"){ echo "<br/>Data selecionada: ".date("d/m/Y", strtotime($row['datadocasamento']))."<br/>"; } ?>
				<p style="font-weight:bold; font-size:110%;"><?php if($row['datadocasamento'] == "0000-00-00"){ echo "Escolher "; }else{ echo "Alterar "; } ?>data do casamento</p>
				<input type="date" name="datadocasamento" /><br/><br/>
				<input type="submit" name="salvarusuario" value="Salvar" class="submit" />
			</form>
			<br/><br/>
        </div>          
        <!-- Source code: https://www.w3schools.com/howto/tryit.asp?filename=tryhow_js_tabs_close  -->
	</div>
</main>
</div>

<script>
function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}

// Pega o elemento com a id="defaultOpen" e clica nele
document.getElementById("defaultOpen").click();
</script>	

<script>
function openCity2(evt, cityName2) {
  var i, tabcontent2, tablinks2;
  tabcontent2 = document.getElementsByClassName("tabcontent2");
  for (i = 0; i < tabcontent2.length; i++) {
    tabcontent2[i].style.display = "none";
  }
  tablinks2 = document.getElementsByClassName("tablinks2");
  for (i = 0; i < tablinks2.length; i++) {
    tablinks2[i].className = tablinks2[i].className.replace(" active", "");
  }
  document.getElementById(cityName2).style.display = "block";
  evt.currentTarget.className += " active";
}

// Pega o elemento com a id="defaultOpen1" e clica nele
document.getElementById("defaultOpen1").click();
</script>	
	
<script>
	$('.cordotitulo').on('change', function() {
	  $('.cordotitulo').not(this).prop('checked', false);
	});	
</script>

<script>
	$('.cordotexto').on('change', function() {
	  $('.cordotexto').not(this).prop('checked', false);
	});	
</script>

<script>
$('.radio2').click(function(){
   
    if($(this).attr("value") == "0"){
            $('.titulodapagina').css("background","rgb(89,6,99)")
            .css("background-image","linear-gradient(146deg, rgba(89,6,99,0.75) 0%, rgba(255,0,236,0.75) 100%), url('images/casaldecostas.jpg')")
			.css("background-size","cover");
			$('.botaodeamostra').css("background","rgb(89,6,99)")
			.css("background","linear-gradient(146deg, rgba(89,6,99,1) 0%, rgba(255,0,236,1) 100%)");
	}
	
    if($(this).attr("value") == "1"){
            $('.titulodapagina').css("background","rgb(255,248,253)")
            .css("background-image","linear-gradient(146deg, rgba(255,248,253,0.75) 0%, rgba(205,6,144,0.75) 100%), url('images/casaldecostas.jpg')")
			.css("background-size","cover");
			$('.botaodeamostra').css("background","rgb(255,248,253)")
			.css("background","linear-gradient(146deg, rgba(255,248,253,1) 0%, rgba(205,6,144,1) 100%)");
	}
	
    if($(this).attr("value") == "2"){
            $('.titulodapagina').css("background","rgb(19,1,38)")
            .css("background-image","linear-gradient(146deg, rgba(19,1,38,0.75) 0%, rgba(252,1,133,0.75) 100%), url('images/casaldecostas.jpg')")
			.css("background-size","cover");
			$('.botaodeamostra').css("background","rgb(9,1,38)")
			.css("background","linear-gradient(146deg, rgba(9,1,38,1) 0%, rgba(252,1,133,1) 100%)");
	}
	
    if($(this).attr("value") == "3"){
            $('.titulodapagina').css("background","rgb(250,191,210)")
            .css("background-image","linear-gradient(146deg, rgba(250,191,210,0.75) 0%, rgba(255,253,254,0.75) 100%), url('images/casaldecostas.jpg')")
			.css("background-size","cover");
			$('.botaodeamostra').css("background","rgb(250,191,210)")
			.css("background","linear-gradient(146deg, rgba(250,191,210,1) 0%, rgba(255,253,254,1) 100%)");
	}
	
    if($(this).attr("value") == "4"){
            $('.titulodapagina').css("background","rgb(191,129,149)")
            .css("background-image","linear-gradient(146deg, rgba(191,129,149,0.75) 0%, rgba(251,3,83,0.75) 100%), url('images/casaldecostas.jpg')")
			.css("background-size","cover");
			$('.botaodeamostra').css("background","rgb(191,129,149)")
			.css("background","linear-gradient(146deg, rgba(191,129,149,1) 0%, rgba(251,3,83,1) 100%)");
	}
	
    if($(this).attr("value") == "5"){
            $('.titulodapagina').css("background","rgb(235,14,85)")
            .css("background-image","linear-gradient(146deg, rgba(235,14,85,0.75) 0%, rgba(249,229,76,0.75) 100%), url('images/casaldecostas.jpg')")
			.css("background-size","cover");
			$('.botaodeamostra').css("background","rgb(235,14,85)")
			.css("background","linear-gradient(146deg, rgba(235,14,85,1) 0%, rgba(249,229,76,1) 100%)");
	}
	
    if($(this).attr("value") == "6"){
            $('.titulodapagina').css("background","rgb(89,81,251)")
            .css("background-image","linear-gradient(146deg, rgba(89,81,251,0.75) 0%, rgba(215,255,248,0.75) 100%), url('images/casaldecostas.jpg')")
			.css("background-size","cover");
			$('.botaodeamostra').css("background","rgb(89,81,251)")
			.css("background","linear-gradient(146deg, rgba(89,81,251,1) 0%, rgba(215,255,248,1) 100%)");
	}
	
    if($(this).attr("value") == "7"){
            $('.titulodapagina').css("background","rgb(255,5,52)")
            .css("background-image","linear-gradient(146deg, rgba(255,5,52,0.75) 0%, rgba(132,87,255,0.75) 100%), url('images/casaldecostas.jpg')")
			.css("background-size","cover");
			$('.botaodeamostra').css("background","rgb(255,5,52)")
			.css("background","linear-gradient(146deg, rgba(255,5,52,1) 0%, rgba(132,87,255,1) 100%)");
	}

    if($(this).attr("value") == "8"){
            $('.titulodapagina').css("background","rgb(255,91,3)")
            .css("background-image","linear-gradient(146deg, rgba(255,91,3,0.75) 0%, rgba(61,4,205,0.75) 100%), url('images/casaldecostas.jpg')")
			.css("background-size","cover");
			$('.botaodeamostra').css("background","rgb(255,91,3)")
			.css("background","linear-gradient(146deg, rgba(255,91,3,1) 0%, rgba(61,4,205,1) 100%)");
	}
	
    if($(this).attr("value") == "9"){
            $('.titulodapagina').css("background","rgb(186,78,163)")
            .css("background-image","linear-gradient(146deg, rgba(186,78,163,0.75) 0%, rgba(237,235,237,0.75) 100%), url('images/casaldecostas.jpg')")
			.css("background-size","cover");
			$('.botaodeamostra').css("background","rgb(186,78,163)")
			.css("background","linear-gradient(146deg, rgba(186,78,163,1) 0%, rgba(237,235,237,1) 100%)");
	}
	
    if($(this).attr("value") == "10"){
            $('.titulodapagina').css("background","rgb(254,101,181)")
            .css("background-image","linear-gradient(146deg, rgba(254,101,181,0.75) 0%, rgba(255,0,82,0.75) 100%), url('images/casaldecostas.jpg')")
			.css("background-size","cover");
			$('.botaodeamostra').css("background","rgb(254,101,181)")
			.css("background","linear-gradient(146deg, rgba(254,101,181,1) 0%, rgba(255,0,82,1) 100%)");
	}
	
    if($(this).attr("value") == "11"){
            $('.titulodapagina').css("background","rgb(180,249,164)")
            .css("background-image","linear-gradient(146deg, rgba(180,249,164,0.75) 0%, rgba(3,241,222,0.75) 100%), url('images/casaldecostas.jpg')")
			.css("background-size","cover");
			$('.botaodeamostra').css("background","rgb(180,249,164)")
			.css("background","linear-gradient(146deg, rgba(180,249,164,1) 0%, rgba(3,241,222,1) 100%)");
	}
	//else
       // $('div.signUp').css("background","cyan")
         // .css("color","white");
  });
</script>
	
<script>
$('.radiobutton2 input[type=radio]').click(function(){
   
    if($(this).attr("value") == "0"){
            $('.titulodotexto').css("font-family","'Great-Wishes'")
			.css("font-size","100%");
	}
	
    if($(this).attr("value") == "1"){
            $('.titulodotexto').css("font-family","'Luna'")
			.css("font-size","70%");
	}
	
    if($(this).attr("value") == "2"){
            $('.titulodotexto').css("font-family","'I-Love-Glitter'")
			.css("font-size","150%");
	}
	
    if($(this).attr("value") == "3"){
            $('.titulodotexto').css("font-family","'Allisya'")
			.css("font-size","150%");
	}
	
    if($(this).attr("value") == "4"){
            $('.titulodotexto').css("font-family","'Little-Clusters'")
			.css("font-size","150%");
	}
	
    if($(this).attr("value") == "5"){
            $('.titulodotexto').css("font-family","'Summertime-Reguler'")
			.css("font-size","170%");
	}
 });
</script>
	
<script>
$('.cordotitulo').click(function(){
   
    if($(this).attr("value") == "0"){
            $('.titulodotexto').css("color","#000000");
	}
	
    if($(this).attr("value") == "1"){
            $('.titulodotexto').css("color","#150231");
	}
	
    if($(this).attr("value") == "2"){
            $('.titulodotexto').css("color","#970C8E");
	}
	
    if($(this).attr("value") == "3"){
            $('.titulodotexto').css("color","#FD40B6");
	}
	
    if($(this).attr("value") == "4"){
            $('.titulodotexto').css("color","#EC85C2");
	}
	
    if($(this).attr("value") == "5"){
            $('.titulodotexto').css("color","#EFA0D3");
	}
	
    if($(this).attr("value") == "6"){
            $('.titulodotexto').css("color","#E3D235");
	}
	
    if($(this).attr("value") == "7"){
            $('.titulodotexto').css("color","#3081FF");
	}
	
    if($(this).attr("value") == "8"){
            $('.titulodotexto').css("color","#FCAC00");
	}
	
    if($(this).attr("value") == "9"){
            $('.titulodotexto').css("color","#470E0E");
	}
	
    if($(this).attr("value") == "10"){
            $('.titulodotexto').css("color","#97797B");
	}
	
    if($(this).attr("value") == "11"){
            $('.titulodotexto').css("color","#045E47");
	}
	
    if($(this).attr("value") == "12"){
            $('.titulodotexto').css("color","#61B50A");
	}
	
    if($(this).attr("value") == "13"){
            $('.titulodotexto').css("color","#7D9CB3");
	}
 });
</script>

<script>
$(document).ready(function() {
	$('.escolhaodivisor').click(function(){

		if($(this).attr("value") == "0"){
				$('.titulodapagina p').removeClass()
				.addClass("divisor");
		}

		if($(this).attr("value") == "1"){
				$('.titulodapagina p').removeClass()
				.addClass("divisor2");
		}

		if($(this).attr("value") == "2"){
				$('.titulodapagina p').removeClass()
				.addClass("divisor3");
		}
		
		if($(this).attr("value") == "3"){
				$('.titulodapagina p').removeClass()
				.addClass("divisor4");
		}
		
		if($(this).attr("value") == "4"){
				$('.titulodapagina p').removeClass()
				.addClass("divisor5");
		}
		
		if($(this).attr("value") == "5"){
				$('.titulodapagina p').removeClass()
				.addClass("divisor6");
		}
		
		if($(this).attr("value") == "6"){
				$('.titulodapagina p').removeClass()
				.addClass("divisor7");
		}
		
		if($(this).attr("value") == "7"){
				$('.titulodapagina p').removeClass()
				.addClass("divisor8");
		}
	 });
});
</script>

<script>
$('.fontedostextos').click(function(){
   
    if($(this).attr("value") == "0"){
            $('.estilotexto').css("font-family","Cambria, 'Hoefler Text', 'Liberation Serif', Times, 'Times New Roman', 'serif'");
	}
	
    if($(this).attr("value") == "1"){
            $('.estilotexto').css("font-family","Consolas, 'Andale Mono', 'Lucida Console', 'Lucida Sans Typewriter', Monaco, 'Courier New', 'monospace'");
	}
	
    if($(this).attr("value") == "2"){
            $('.estilotexto').css("font-family","'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, 'sans-serif'");
	}
});
</script>

<script>
$('.cordotexto').click(function(){
   
    if($(this).attr("value") == "0"){
            $('.estilotexto').css("color","#161616");
	}
	
    if($(this).attr("value") == "1"){
            $('.estilotexto').css("color","#333333");
	}
	
    if($(this).attr("value") == "2"){
            $('.estilotexto').css("color","#686767");
	}
	
    if($(this).attr("value") == "3"){
            $('.estilotexto').css("color","#A7A7A7");
	}
});
</script>

<?php include "menuativo.inc.php"; ?>

<div class="footerdiv clearfix">
<footer>
    <?php include "rodape.inc.php"; ?>
</footer>
</div>
</body>
</html>