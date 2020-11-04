<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'config.php';
session_start();
include 'sessao.php';

include 'verificar_usuario.php';

if(isset($_SESSION['email'])){
	header('Location: '.$urlHost.'/inicio.php');
}

?>
<!--aqui inicia o html-->
<!DOCTYPE html>
<html lang="pt-br">
<!-- Global site tag (gtag.js) - Google Analytics -->
<meta charset="utf-8">
<meta name="description" content="Faça o login para obter acesso às ferramentas de configuração do site"/>
<meta name="keywords" content=""/>
	<link rel="stylesheet" type="text/css" href="css/index.css"/>
	<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
	<link rel="icon" href="images/favicon.ico" type="image/x-icon">

    <!--[if lt IE 9]>
    	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <script src="scripts/html5shiv-printshiv"></script>
    <![endif]-->
<?php
//include 'analytics.inc.php';
//include 'estilo.inc.php';
?>
<title>Casamento em Detalhes - Login</title>

<?php
include "fpixels.inc.php";
?>    
</head>

<!--Início do Script JivoChat-->
<?php
include "jivochat.inc.php";
?>
<!--Fim do Script JivoChat-->

<body>

<div id="conteudo">
	<div style="margin-left:auto; margin-right:auto; width:75%; height:auto; border:0px solid #CCC;">
    	<center><br><br>
            <?php
            if(isset($err)){
				if($err){
					echo '<ul class="mensagemdevalidacao">';
					foreach($err as $value){	      			
						echo '<li>' . $value . '</li>';
					}
					echo '</ul>';
				}
			}
			
			if(isset($incorrectLogin)){
				if($incorrectLogin == true){
					?>
			<ul class="mensagemdevalidacao">
				<li>*Ou o email ou a senha estão incorretos. Verifique-os e tente novamente.</li>
			</ul>
					<?php
				}
			}		
            ?>
          <form class="formulario" name="login2" style="margin-bottom:0;" method="post" action="" enctype="multipart/form-data">
              <fieldset>
                  <img src="images/hearts.png" width=15% height="auto" />
                  <h2 class="titulo">FAZER LOGIN</h2>
				  <br/><br/>
				  <input value="" placeholder="Email ou Usuário" style="width:50%; height:30px;" class="caixadetexto" name="email" type="text" maxlength="75"><br>
				  <input class="caixadetexto" style="width:50%; height:30px;" name="senha" value="" placeholder="Senha" type="password"><br>
				  <input class="botao" name="enter" style="width: 50%;" value="Login" type="submit"><br>
				  <span style="color:black; font-family:Times New Roman; font-size:11px;">Esqueceu a senha? Clique <a href="recuperarsenha.php">aqui</a></span><br><span style="color:black; font-family:Times New Roman;font-size:11px;">Não possui conta ainda? Cadastre-se <a href="cadastro.php">aqui</a></span>
			  </fieldset>
          </form>
        </center>
    </div>
</div>
	
<div class="footerdiv clearfix">
<footer>
    <?php include "rodape.inc.php"; ?>
</footer>
</div>
</body>
</html>