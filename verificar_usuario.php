<?php
if (realpath(__FILE__) === realpath($_SERVER['SCRIPT_FILENAME'])) header('Location: '.$urlHost);
//https://wp-mix.com/php-protect-include-files/

if(isset($_POST['enter'])){
    $email=filter_input(INPUT_POST, 'email');
    $nomedeusuario=filter_input(INPUT_POST, 'email');
    $senha=filter_input(INPUT_POST, 'senha');
    $stmt = $pdo->prepare("SELECT * FROM usuarios_cadastrados WHERE (email = ? OR nomedeusuario = ?) AND senha = ?");
    $stmt->bindParam(1, $email, PDO::PARAM_STR); 
    $stmt->bindParam(2, $nomedeusuario, PDO::PARAM_STR);
    $stmt->bindParam(3, $senha, PDO::PARAM_STR);
    $stmt->execute();  

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    #Validação de inputs
    $err = array();

    if (empty($email))  {$err[] = "*Digite seu email.<br>";}

    if (empty($senha))  {$err[] = "*Digite a senha.<br>";}

    //if ($stmt->rowCount() == 0) {$err[] = "*Ou o email ou a senha está incorreto/a.<br>Por favor, tente novamente.<br>";}
    // Se a linha (row) existir, mostre ao usuário que o mesmo se encontra logado e redirecione-o para outro lugar. 
    if(!$err){	
        if ($stmt->rowCount() == 1 AND $row['credencial'] == 0 AND $row['desativar'] == 0) {
            if($row['ativado'] != 0){
                $_SESSION['email'] = $row['email'];
                //header('Location: '.$urlHost);
                // session_save_path($sessionpath); 
				header('Location: '.$urlHost.'/inicio.php');
				exit;
            }else{
                $_SESSION['email'] = $row['email'];
                //Altere o local para $_SERVER[HTTP_REFERER]
                header('Location: '.$urlHost.'/ativacao.php');
                exit;
            }

        }elseif($stmt->rowCount() == 1 AND $row['credencial'] != 0 AND $row['desativar'] == 0) {
            $_SESSION['email'] = $row['email'];
            //session_save_path($sessionpath);
            header('Location: '.$urlHost.'/admin.php');
             exit;
        }else{
            $incorrectLogin = true;
        }
    }
}
?>