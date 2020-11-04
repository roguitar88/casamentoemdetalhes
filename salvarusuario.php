<?php
if (realpath(__FILE__) === realpath($_SERVER['SCRIPT_FILENAME'])) header('Location: '.$urlHost); 
//https://wp-mix.com/php-protect-include-files/
if(isset($_POST['salvarusuario'])){
	session_start();
	require "config.php"; 
	include 'sessao.php';

	$nomedeusuario = filter_input(INPUT_POST, 'nomedeusuario');
	$nomedonoivo = filter_input(INPUT_POST, 'noivo');
	$nomedanoiva = filter_input(INPUT_POST, 'noiva');
	$datadocasamento = filter_input(INPUT_POST, 'datadocasamento');
	
	$err = array();
	$mensagem = array();
	
	if(empty($nomedeusuario)){
		$err[] = "Por favor, escolha um nome de usuário para o casal.";
		$mensagem[] = "Por favor, escolha um nome de usuário para o casal.";
	}

	if(empty($nomedonoivo)){
		$err[] = "Por favor, digite o nome completo do noivo.";
		$mensagem[] = "Por favor, digite o nome completo do noivo.";
	}

	if(empty($nomedanoiva)){
		$err[] = "Por favor, digite o nome completo da noiva.";
		$mensagem[] = "Por favor, digite o nome completo da noiva.";
	}
	
	if(empty($datadocasamento)){
		$err[] = "Por favor, entre com a data do casamento.";
		$mensagem[] = "Por favor, entre com a data do casamento.";
	}
	
	if(!$err || !$mensagem){
		$salvarusuario = $pdo->prepare("UPDATE usuarios_cadastrados SET nomedeusuario = ?, nomedonoivo = ?, nomedanoiva = ?, datadocasamento = ? WHERE id = ?");
		$salvarusuario->execute(array($nomedeusuario, $nomedonoivo, $nomedanoiva, $datadocasamento, $row['id']));

		header('Location: '.$urlHost.'/site.php');
		exit;
	}else{
		//$campovazio = true;
	?>
<script>
	alert('<?php foreach($mensagem as $valormensagem){ echo $valormensagem."\n"; }?>'); 
	location.href = '$urlHost/site.php';
</script>
	<?php
	}
}
?>