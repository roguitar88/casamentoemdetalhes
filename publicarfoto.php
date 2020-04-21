<?php
include "key.inc.php";

$referer = $_SERVER['HTTP_REFERER'];
$referer_parse = parse_url($referer);

//casamentoemdetalhes.orangeadex.tk
//The $referer_parse will give some more, let's say, security
//if($referer_parse['host'] == "orangeadex.heliohost.org" || $referer_parse['host'] == "www.orangeadex.heliohost.org") {
	if(isset($_POST['postphoto'])){
		$name = $_FILES['pic']['name'];
		$extension = explode('.', $name);
		$extension = end($extension);
		$type = $_FILES['pic']['type'];
		$size = $_FILES['pic']['size'] /1024/1024;
		$random_name = rand();
		$tmp = $_FILES['pic']['tmp_name'];
		
		if(!empty($name)){
			if ((strtolower($type) != "image/jpeg") && (strtolower($type) != "image/jpg") && (strtolower($type) != "image/gif") && (strtolower ($type) != "image/png")){
				$message= "Formato de imagem não suportado";
				echo "<script type='text/javascript'>alert('$message'); location.href = '/orangeadex/casamentoemdetalhes/site.php'; </script>";
			//this else if command can be deleted. We are just testing it.
			}else{
				/*
				if(!empty($row['profilepiclocation'])){
					$profilepiclocation = $row['profilepiclocation'];
					unlink('profilepics/'.$profilepiclocation);
				}
				*/
				$fotosenviadas = $pdo->prepare("SELECT * FROM fotos WHERE iddocasal = ?");
				$fotosenviadas->execute(array($row['id']));
				$numerodefotosenviadas = $fotosenviadas->rowCount();
				
				if($row['nivel'] == 0 AND $numerodefotosenviadas == 5){
					echo "<script type='text/javascript'>alert('Você já chegou ao seu limite de envio de fotos. Faça o upgrade para enviar mais fotos.'); location.href = '/orangeadex/casamentoemdetalhes/site.php';</script>";
				}elseif($row['nivel'] == 1 AND $numerodefotosenviadas == 10){
					echo "<script type='text/javascript'>alert('Você já chegou ao seu limite de envio de fotos. Faça o upgrade para enviar mais fotos.'); location.href = '/orangeadex/casamentoemdetalhes/site.php';</script>";
				}else{
					$filename = $random_name.'.'.$extension;
					move_uploaded_file($tmp, 'fotos/historia/'.$filename);
					$inserirfoto = $pdo->prepare("INSERT INTO fotos(iddocasal, nomediretorio, tamanho, data) VALUES (?, ?, ?, NOW())");
					$inserirfoto->execute(array($row['id'], $filename, $size));
					$message="Foto adicionada com sucesso"; #Esta linha também pode ser deletada.
					/*echo "<script type='text/javascript'>alert('$message\\nFoto enviada: $name\\nTamanho: $size\\nTipo: $type\\nArmazenada em: profilepics/$location');</script>";*/
					header('Location: ' . $_SERVER['HTTP_REFERER']);
					exit;
				}
			}
		}else{
			echo "<script type='text/javascript'>alert('Por favor escolha uma foto do seu computador'); location.href = '/orangeadex/casamentoemdetalhes/site.php';</script>";
		}
	}else{
		header('Location: /orangeadex/casamentoemdetalhes/site.php');
		exit;
	}
//}else {
     //header('Location: /orangeadex/casamentoemdetalhes');
     //exit;
//}
?>