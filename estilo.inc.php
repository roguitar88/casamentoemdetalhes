<?php
if (realpath(__FILE__) === realpath($_SERVER['SCRIPT_FILENAME'])) header('Location: /orangeadex/casamentoemdetalhes/');

if(isset($_SESSION['email'])){
	$fotohistoria = $row['nossahistoriafoto'];
	$fotoinicio = $row['fotoinicio'];
}

if(isset($perfil)){
	$fotohistoria = $perfil['nossahistoriafoto'];
	$fotoinicio = $perfil['fotoinicio'];
}
?>
<style>
.cabecalho{
    position: relative;
    height:auto;
	overflow: auto;
    width:100%;
	margin:auto;
    border:0px solid #BBB9B9;
    /*background: rgba(171,0,170,1.00);*/
	background: rgb(<?php echo $rgbcolor1; ?>);
	background-image: linear-gradient(146deg, rgba(<?php echo $rgbcolor1; ?>,0.75) 0%, rgba(<?php echo $rgbcolor2; ?>,0.75) 100%), url("images/casaldecostas.jpg");
	background-size: cover;
}
	
.titulodapagina{
	width:100%;
	margin:auto;
	height:auto;
	padding:5%;
	background: rgb(<?php echo $rgbcolor1; ?>);
	background-image: linear-gradient(146deg, rgba(<?php echo $rgbcolor1; ?>,0.75) 0%, rgba(<?php echo $rgbcolor2; ?>,0.75) 100%), url("images/casaldecostas.jpg");
	background-size: cover;
	color:white;
	font-weight:100;
	font-family: Baskerville, "Palatino Linotype", Palatino, "Century Schoolbook L", "Times New Roman", "serif";
}

.titulodapagina p{
	text-align: center;
	font-family: 'Honey-Moon';
	font-size:300%;
}
	
.titulodapagina2{
	width:100%;
	margin:auto;
	height:500px;
	padding:5%;
	background: rgb(<?php echo $rgbcolor1; ?>);
	background-image: linear-gradient(146deg, rgba(<?php echo $rgbcolor1; ?>,0.75) 0%, rgba(<?php echo $rgbcolor2; ?>,0.75) 100%), url("images/casaldecostas.jpg");
	background-size: cover;
	color:white;
	text-align: center;
	position: relative;
	font-weight:100;
	font-family: Baskerville, "Palatino Linotype", Palatino, "Century Schoolbook L", "Times New Roman", "serif";
}	

.titulodapagina2 p{
	font-family: 'Honey-Moon';
	font-size:1000%;
	margin:0;
}	
	
/* Create an active/current tablink class */
/* css/tabs.css */
.personalizarpagina button.active {
	background: rgb(<?php echo $rgbcolor1; ?>);
	background: -webkit-linear-gradient(56deg, rgba(<?php echo $rgbcolor1; ?>,1) 0%, rgba(<?php echo $rgbcolor2; ?>,1) 100%);
	background: -o-linear-gradient(56deg, rgba(<?php echo $rgbcolor1; ?>,1) 0%, rgba(<?php echo $rgbcolor2; ?>,1) 100%);
	background: linear-gradient(146deg, rgba(<?php echo $rgbcolor1; ?>,1) 0%, rgba(<?php echo $rgbcolor2; ?>,1) 100%);
}
	
.salvarlayout:hover{
	background: rgb(<?php echo $rgbcolor1; ?>);
	background: -webkit-linear-gradient(56deg, rgba(<?php echo $rgbcolor1; ?>,0.75) 0%, rgba(<?php echo $rgbcolor2; ?>,0.75) 100%);
	background: -o-linear-gradient(56deg, rgba(<?php echo $rgbcolor1; ?>,0.75) 0%, rgba(<?php echo $rgbcolor2; ?>,0.75) 100%);
	background: linear-gradient(146deg, rgba(<?php echo $rgbcolor1; ?>,0.75) 0%, rgba(<?php echo $rgbcolor2; ?>,0.75) 100%);
}

.heart {
  fill: rgba(<?php echo $rgbcolor1; ?>,1);
  position: relative;
  top: 12px;
  width: 50px;
  animation: pulse 1s ease infinite;
}	

.footerdiv1{
    width: 100%;
    height: auto;
    overflow: auto;
    position: relative;
    margin:auto;
	background: rgb(<?php echo $rgbcolor1; ?>);
	background-image: linear-gradient(146deg, rgba(<?php echo $rgbcolor1; ?>,0.75) 0%, rgba(<?php echo $rgbcolor2; ?>,0.75) 100%), url("images/cerimonialrodape.jpg");
	background-size: cover;
	background-repeat:no-repeat;
	background-position: 30%;
}

.footer1{
	width:80%;
	height:auto;
	margin:auto;
	position:relative;
	overflow:auto;
    padding-top: 2.5%;
    padding-bottom: 2.5%;
	font-family: "Gill Sans", "Gill Sans MT", "Myriad Pro", "DejaVu Sans Condensed", Helvetica, Arial, "sans-serif";
	font-size:90%;
	color: white;
	text-align: center;
}
	
.photohalf{
	width:50%;
	padding:3%;
	float:left;
	height:410px;
	position:relative;
	background-image: url("fotos/inicio/<?php echo $fotoinicio; ?>");
	background-repeat: no-repeat;
	background-size: cover;
	background-position: center;
}

.texthalf{
	width:50%;
	padding:3%;
	float:left;
	height:410px;
	position:relative;
}

.photohalf2{
	width:50%;
	padding:3%;
	float:left;
	height:690px;
	position:relative;
	background-image: url("fotos/historia/<?php echo $fotohistoria; ?>");
	background-repeat: no-repeat;
	background-size: cover;
	background-position: center;
}

.texthalf2{
	width:50%;
	padding:3%;
	float:left;
	height:690px;
	position:relative;
}	
</style>