<?php
include "key.inc.php";

$referer = $_SERVER['HTTP_REFERER'];
$referer_parse = parse_url($referer);

//The $referer_parse will give some more, let's say, security
//$wwwUrlHost = "www.".$urlHost;
//if($referer_parse['host'] == $urlHost || $referer_parse['host'] == $wwwUrlHost) {
	if(!isset($_GET['id']) AND !isset($_POST['deletepic']) OR ($_GET['id'] == 0 OR is_null($_GET['id']))){
		header('Location: '.$urlHost);
		exit;
	}else{
		$id = $_GET['id'];
		$idquery = $pdo->prepare("SELECT * FROM fotos WHERE id = ? AND iddocasal = ?");
		$idquery->execute(array($_GET['id'], $row['id']));
		$row3 = $idquery->fetch();

		$fotoselecionada = $row3['nomediretorio'];
		//$nullvalue = "";
		unlink('fotos/album/'.$fotoselecionada);
			
		$deletarfoto = $pdo->prepare("DELETE FROM fotos WHERE id = ?");
		$deletarfoto->execute(array($id));
		
		header('Location: '.$urlHost.'/site.php');
		exit;
	}
//} else {
     //header('Location: '.$urlHost.'/site.php');
     //exit;
//}
?>