<?php
//Resolvi desativar as duas linhas abaixo por causa dos avisos (headers already started), etc.
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
include 'config.php'; 
session_start();
//include 'verificar_usuario.php';
//Sessão iniciada para os membros ou inscritos
include 'sessao.php';

/*
if(isset($_SESSION['email'])){
	$loggedin = true;
}
*/

if(isset($_SESSION['email'])){
    header('Location: /orangeadex/casamentoemdetalhes/inicio.php');
    exit;
}

include "cadastrar_usuario.php";
//---------------------
?>
<!--aqui inicia o html-->
<!DOCTYPE html>
<html lang="pt-br">
<head>
<!--
<script type="text/javascript">
  var onloadCallback = function() {
    alert("grecaptcha is ready!");
  };
</script>
-->
	
<!--
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
-->
	
<?php
include "analytics.inc.php";
?>

<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content=""/>
<meta name="keywords" content=""/>
	<link rel="stylesheet" type="text/css" href="css/index.css"/>
    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">-->
	<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
	<link rel="icon" href="images/favicon.ico" type="image/x-icon">
   	<link rel="stylesheet" type="text/css" href="css/checkbox_style.css"/>

<title>Casamento em Detalhes - Cadastro</title>

<!--Início do Script JivoChat-->
<?php
include "jivochat.inc.php";
?>
<!--Fim do Script JivoChat-->
<?php
include "fpixels.inc.php";
?>
</head>

<!--
<body onload="setupSearchBox('formname', 'https://www.macmillandictionary.com/', 'british');">

<script type="text/javascript">jQuery(function() {setupSearchBox('formname', 'https://www.macmillandictionary.com/', 'british'); });</script>
<div id="layout" class="clearfix">
<header>
<?php //include "header.inc.php";?>	
</header>
-->
<!--new div-->

<body>
<!--
<script>
  fbq('track', 'CompleteRegistration');
</script>
-->
<main>
	<!--
	<div id="subjects">
    	<?php
		/*
		include "optin_box.inc.php";
		include "youglish_plugin.inc.php";
		include "macmillan_plugin.inc.php";
		*/
		?>
    </div>
    -->
    <div class="divinscricao" align="center">
        <!--
		<a href="/orangeadex/casamentoemdetalhes">Back Home</a>
		-->
    <!--
    <div id="conteudo">
    -->
        <div align="center">
            <ul class="mensagemdevalidacao">
				<?php
                if(isset($err3)){
                    if($err3){
                        foreach($err3 as $value3){	      			
                            echo '<li>' . $value3 . '</li>';
                        }
                    }
                }
                				
                //Creio eu que as quatro linhas abaixo são desnecessárias
                if(isset($incorrectLoginDetails)){
                    if($incorrectLoginDetails == true){
                        echo '<li>Email e senha estão incorretos ou talvez você precise ativar a sua conta.</li>';
                    }
                }
                ?>
            </ul>
        </div>
     
        <div align="center">
            <form class="formulario" method="post" action="" enctype="multipart/form-data">
                <fieldset>
                	<img src="images/hearts.png" width=15% height="auto" />
                    <h2 class="titulo">CRIE SUA CONTA JÁ</h2>
                    <span style="font-size:9px; color:#960;">*Dica de senha: no mínimo 8 caracteres - números, letras maiúsculas e minúsculas</span><br/><br/>
                    
                    <table>
                        <tr>
                            <td class="alinharelementos"></td>
                            <td class="alinharelementos"><input name="usuariotipo" id="convidado" class="radio" type="radio" value="0" checked> <label class="radiolabel" for="convidado">Convidado/a</label> <input name="usuariotipo" id="noivo" class="radio" type="radio" value="1"> <label class="radiolabel" for="noivo">Noivo/a</label></td>

                        </tr>
						<tr>
                            <td class="alinharelementos"><label for="email"></label></td>
                          <td class="alinharelementos"><input id="email" name="email" type="email" maxlength="50" placeholder="Email" class="caixadetexto"></td>
                        </tr>
                        <tr>
                          <td class="alinharelementos"><label for="digitarsenha"></label></td>
                            <td class="alinharelementos"><!--<span style="font-size:9px; text-align:left;">*Paswword hint: at least 8 characters - number(s), uppercase and lowercase letter(s)</span>--><input type="password" id="digitarsenha" name="senha" placeholder="Senha*" class="caixadetexto" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required></td>
                        </tr>
                        <tr>
                            <td class="alinharelementos"><label for="redigitarsenha"></label></td>
                            <td class="alinharelementos"><input type="password" id="redigitarsenha" name="confirmarsenha" placeholder="Confirmar Senha*" class="caixadetexto"></td>
                        </tr>
                        <tr>
                            <td class="alinharelementos"><label for="nomeprincipal"></label></td>
                            <td class="alinharelementos"><input name="nomeprincipal" id="nomeprincipal" type="text" maxlength="30" placeholder="Nome" class="caixadetexto"></td>
                        </tr>
                        <tr>
                            <td class="alinharelementos"><label for="sobrenome"></label></td>
                            <td class="alinharelementos"><input name="sobrenome" id="sobrenome" type="text" maxlength="30" placeholder="Sobrenome" class="caixadetexto"></td>
                        </tr>
                        <tr>
                            <td class="alinharelementos"><label for="nomedeusuario"></label></td>
                            <td class="alinharelementos"><input name="nomedeusuario" id="nomedeusuario" type="text" maxlength="30" placeholder="Escolha um Nome de Usuário" class="caixadetexto"></td>
                        </tr>
                        <tr>
                            <td class="alinharelementos"><label for="sexo"></label></td>
                            <td class="alinharelementos">
                                <select class="caixadetexto" id="sexo" name="sexo">
                                    <option selected disabled>Sexo</option>
                                    <option value="masculino">Masculino</option>
                                    <option value="feminino">Feminino</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="alinharelementos"></td>
                            <td class="alinharelementos"><label for="datadenascimento" class="aniversario">Data de Nascimento</label><input name="datadenascimento" id="datadenascimento" type="date" maxlength="50" placeholder="Birthdate (format: mm/dd/yyyy)" class="caixadetexto"></td>
                        </tr>
                        <!--
						<tr>
                            <td class="alinharelementos"><label for="fone"></label></td>
                            <td class="alinharelementos"><input name="fone" id="fone" type="tel" maxlength="50" placeholder="Telefone, p. ex., (62)994587898" class="caixadetexto"></td>
                        </tr>
                        <tr>
                            <td class="alinharelementos"></td>
                            <td class="alinharelementos"><input name="whatsapp" id="fonesomente" class="radio" type="radio" value="0" checked> <label class="radiolabel" for="fonesomente">Only Phone</label> <input name="whatsapp" id="whatsapp" class="radio" type="radio" value="1"> <label class="radiolabel" for="whatsapp">Phone and/or Whatsapp</label></td>

                        </tr>
						<tr>
                            <td class="alinharelementos"><label for="cityId"></label></td>
                            <td class="alinharelementos">
                            	<br/>
                                <select name="country" class="countries textbox" id="countryId">
                                    <option value="">Selecionar País</option>
                                </select><br/>
                                <select name="state" class="states textbox" id="stateId">
                                    <option value="">Selecionar Estado</option>
                                </select><br/>
                                <select name="city" class="cities textbox" id="cityId">
                                    <option value="">Selecionar Cidade</option>
                                </select>
                                <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> 
                                <script src="//geodata.solutions/includes/countrystatecity.js"></script>
                            </td>
                        </tr>
                        <tr>
                            <td class="alinharelementos"><label for="state"></label></td>
                            <td class="alinharelementos">
                            	<input name="state1" id="state" type="hidden" maxlength="30" placeholder="Estado ou Província" class="caixadetexto"/>
                            </td>
                        </tr>
                        <tr>    
                            <td class="alinharelementos"><label for="city"></label></td>
                            <td class="alinharelementos">
                            	<input name="city1" id="city" type="hidden" maxlength="30" placeholder="Cidade" class="caixadetexto"/>
                            </td>
                        </tr>
                        <tr>
                            <td class="alinharelementos"><label for="endereco"></label></td>
                            <td class="alinharelementos">
                            	<input name="endereco" id="endereco" type="text" maxlength="100" placeholder="Endereço, p. ex., Av. Vieira Santos, Ap. 312, Jd. Itaipu" class="caixadetexto"/>
                            </td>
                        </tr>
						-->
                        <!--
                        <tr>
                            <td class="alinharelementos"><label for="promocode"></label></td>
                            <td class="alinharelementos">
                                <input name="promocode" id="promocode" type="text" maxlength="16" placeholder="Enter the Exemption Code (EUPEC)" class="caixadetexto"/><br/>
                                *Caso não tenha um, deixe-o em branco por favor.
                            </td>
                        </tr>
                        -->
                        <tr>
                            <td class="alinharelementos"></td>
                            <td class="alinharelementos">
                                <br/>
                                <!--<input name="submit" type="submit" value="Submit">-->
                                <input type="checkbox" id="checkboxCGI" class="css-checkbox" name="checkbox"/><label class="css-label" for="checkboxCGI">Li, reli o contrato e concordo com os <a class="link_contrato" href="/orangeadex/casamentoemdetalhes/termos.php">Termos de Utilização</a> e com as <a class="link_contrato" href="/orangeadex/casamentoemdetalhes/privacidade.php">Políticas de Privacidade</a>.</label><br/><br/>
                            </td>
                        </tr>
                        <!--
						<tr>
                        	<td class="alinharelementos">
                            </td>
                            <td class="alinharelementos">
                            	<br/>
                                <div class="g-recaptcha" data-sitekey="6LfLp8oUAAAAAPo8ncWFdomJeOuHD_E7CJtCklnT"></div>
                            </td>
                        </tr>
						-->
                        <tr>
                            <td class="alinharelementos"></td>
                            <td class="alinharelementos">
                                <input type="submit" name="submit" value="Registrar Agora" class="botao">
                                <!--<input name="reset" type="reset" value="Reset">-->
                            </td>
                        </tr>
                    </table>
                </fieldset>
          	</form>
			<!--<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>-->
        </div>
    <!--
    </div>
    -->
	</div>
</main>

<div class="footerdiv clearfix">
<footer>
    <?php include "rodape.inc.php"; ?>
</footer>
</div>
</body>
</html>