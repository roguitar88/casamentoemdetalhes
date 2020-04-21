<?php include "adminkey.inc.php"; ?>
<!-- The php code above is to protect the access to the admin's pages-->
<?php //require "currencylayer/converter.php"; ?>
<?php //include "pricing.inc.php"; ?>
<?php //include "exchangerate-api/exchangerate.php"; ?>
<!--aqui inicia o html-->
<!DOCTYPE html>
<html lang="en">
<head>

<?php
//include "googleanalytics.inc.php";
?>

<meta charset="utf-8">
<meta name="description" content=""/>
<meta name="keywords" content=""/>
	<link rel="stylesheet" type="text/css" href="css/index.css"/>
	<link rel="stylesheet" type="text/css" href="css/table.css"/>
    <!--<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="screen">-->
	<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
	<link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    
    <script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/searchbox.js"></script>
    <!--[if lt IE 9]>
    	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <script src="scripts/html5shiv-printshiv"></script>
    <![endif]-->
<title>ADMIN AREA | Casamento em Detalhes</title>
<?php
include "fpixels.inc.php";
?>
</head>

<!--Início do Script JivoChat-->
<?php
//this can be deleted totally, I think
include 'jivochat.inc.php';
?>
<!--Fim do Script JivoChat-->

<body>

<div id="layout" class="clearfix">
<header>
</header>
	
<main>
    <div id="conteudo">
        <a href="workerslist.php">Go to the list of workers</a><br/>
		<a href="deactivatedaccounts.php">Go to the deactivated accounts</a><br/>
        <a href="inbox.php">Go to the inbox</a><br/>
        <a href="donations.php">Donations Report</a><br/>
        <h3>List of Clients</h3>
        <?php
        $selectsubscribers = $pdo->prepare("SELECT * FROM usuarios_cadastrados WHERE desativar = ? AND cliente = ?");
        $selectsubscribers->execute(array(0, 1));
        $countallregistered = $selectsubscribers->rowCount();
        echo "No. of records: ".$countallregistered."<br/>";
        ?>
        <table class="paleBlueRows">
    		<tr style="font-weight: bold;">
            	<td>Id</td>
                <td>Pic</td>
                <td>nomedeusuario</td>
                <td>Permissions</td>
                <td>Member since</td>
                <td>Active account?</td>
				<?php if(isset($superadminpermissions)){ if($superadminpermissions == true){ ?>
                <td>Deactivate</td>
                <td>Delete</td>
                <?php }} ?>
                <td>Details</td>
            </tr>
			<?php                				
                while($fetchsubscribers = $selectsubscribers->fetch(PDO::FETCH_ASSOC)){
                
                    $id = $fetchsubscribers['id'];
                    $piclocation = $fetchsubscribers['profilepiclocation'];
                    $nomedeusuario = $fetchsubscribers['nomedeusuario'];
                    $email3 = $fetchsubscribers['email'];
                    $firstname = $fetchsubscribers['firstname'];
                    $lastname = $fetchsubscribers['surname'];
                    $phone = $fetchsubscribers['phone'];
                    $whatsapp = $fetchsubscribers['whatsapp'];
                    $address = $fetchsubscribers['address'];
                    $city = $fetchsubscribers['city'];
                    $state = $fetchsubscribers['state'];
                    $country = $fetchsubscribers['country'];
                    $gender = $fetchsubscribers['gender'];
                    $birthdate = $fetchsubscribers['birthdate'];
                    $userip = $fetchsubscribers['userip'];
                    $credential = $fetchsubscribers['credential'];
                    $registrydate = $fetchsubscribers['date'];
                    $activated = $fetchsubscribers['activated'];
					                    
                    $start = date_create($birthdate);
                    $end = date_create();
                    $diff = date_diff($start, $end);
			?>
			<tr <?php if($credential != 0){ ?> style="background:#ffbf00" <?php } ?>>
				<td><?php echo $id; ?></td>
				<td>
					<div style="background:url(<?php if(!empty($piclocation)){ echo "profilepics/".$piclocation; }else{ if($gender == "male"){ echo "profilepics/default-user.png"; } if($gender == "female"){ echo "profilepics/default-user-woman.jpg"; } } ?>); background-size:100%; background-position:center; float:left; border-radius: 50%; width: 30px; height: 30px; border:1px solid #CCC; position:relative;"></div>
				</td>
				<td><?php echo $nomedeusuario; ?></td>
				<td>
					<?php
					if($credential != 0){
						echo "Admin";
						if(isset($superadminpermissions)){ if($superadminpermissions == true AND $credential != 2){
							if($activated == 1){
					?>
					<form action="setadmin.php?id=<?php echo urlencode($id); ?>" method="post" enctype="multipart/form-data">
						<input type="submit" value="Unset as admin" name="adminbutton2"/>
					</form>
					<?php
							}}}
					}else{
						echo "Ordinary user";
						if(isset($superadminpermissions)){ if($superadminpermissions == true AND $credential != 2){
							if($activated == 1){
					?>
					<form action="setadmin.php?id=<?php echo urlencode($id); ?>" method="post" enctype="multipart/form-data">
						<input type="submit" value="Set as admin" name="adminbutton"/>
					</form>
					<?php
							}}}
					}
					?>
				</td>
				<td><?php echo $registrydate; ?></td>
				<td><?php if($activated == 1){ echo "Yes";}else{ echo "No"; } ?></td>
                
					<?php if(isset($superadminpermissions)){ if($superadminpermissions == true){ ?>
                <td>
                	<form action="deativacao.php?id=<?php echo urlencode($id); ?>" method="post" enctype="multipart/form-data">
                    	<input onClick="return confirm('Are you sure you're gonna deactivate this account?')" type="submit" value="Deactivate" name="deactivate" />
                    </form>
                </td>
					<?php }} ?>
					<?php if(isset($superadminpermissions)){ if($superadminpermissions == true){ ?>
                <td>
					<form action="deleteprofile.php?id=<?php echo urlencode($id); ?>" method="post" enctype="multipart/form-data">
						<input onClick="return confirm('All data referring to this profile will be permanently deleted and cannot be recovered thereafter. Are you sure of it?')" type="button" value="Delete" name="delete"/>
					</form>
				</td>
					<?php }} ?>
                <td>
                	<form action="showuserdata.php?userid=<?php echo urlencode($id); ?>" method="post" enctype="multipart/form-data">
						<input type="submit" value="More details" name="details"/>
					</form>
                </td>
			</tr>    
			<tr>
				<td colspan="14">
					<hr>
				</td>
			</tr>
			<?php
			} //close while
			?>
    	</table>
        <?php
		if($selectsubscribers->rowCount() == 0){
			echo "No subscribers yet to show";
		}
		?>  
    </div>
</main>

<footer>
<?php include "rodape.inc.php";?>
</footer>
</div>

</body>
</html>