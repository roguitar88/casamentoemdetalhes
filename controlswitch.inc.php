<?php if (realpath(__FILE__) === realpath($_SERVER['SCRIPT_FILENAME'])) header('Location: '.$urlHost.'/');
?>
<?php
//Paleta: cor do pano de fundo do cabeçalho e botões
if($row['paleta'] == 0){
	$color = "padrao";
	$rgbcolor1 = "89,6,99";
	$rgbcolor2 = "255,0,236";
}

if($row['paleta'] == 1){
	$color = "talos";
	$rgbcolor1 = "255,248,253";
	$rgbcolor2 = "205,6,144";
}

if($row['paleta'] == 2){
	$color = "eros";
	$rgbcolor1 = "19,1,38";
	$rgbcolor2 = "252,1,133";
}

if($row['paleta'] == 3){
	$color = "transcendent";
	$rgbcolor1 = "250,191,210";
	$rgbcolor2 = "255,253,254";
}

if($row['paleta'] == 4){
	$color = "enigma";
	$rgbcolor1 = "191,129,149";
	$rgbcolor2 = "251,3,83";
}

if($row['paleta'] == 5){
	$color = "summer";
	$rgbcolor1 = "235,14,85";
	$rgbcolor2 = "249,229,76";
}

if($row['paleta'] == 6){
	$color = "celestial";
	$rgbcolor1 = "89,81,251";
	$rgbcolor2 = "215,255,248";
}

if($row['paleta'] == 7){
	$color = "rubi";
	$rgbcolor1 = "255,5,52";
	$rgbcolor2 = "132,87,255";
}

if($row['paleta'] == 8){
	$color = "coral";
	$rgbcolor1 = "255,91,3";
	$rgbcolor2 = "61,4,205";
}

if($row['paleta'] == 9){
	$color = "paraiso";
	$rgbcolor1 = "186,78,163";
	$rgbcolor2 = "237,235,237";
}

if($row['paleta'] == 10){
	$color = "rose";
	$rgbcolor1 = "254,101,181";
	$rgbcolor2 = "255,0,82";
}

if($row['paleta'] == 11){
	$color = "alecrim";
	$rgbcolor1 = "180,249,164";
	$rgbcolor2 = "3,241,222";
}

//-----------------------------------------------------------------
//Fonte dos títulos
if($row['textoestilo'] == 0){
	$font = "'Great-Wishes'";
	$size = "100%";
}

if($row['textoestilo'] == 1){
	$font = "'Luna'";
	$size = "70%";
}

if($row['textoestilo'] == 2){
	$font = "'I-Love-Glitter'";
	$size = "150%";
}

if($row['textoestilo'] == 3){
	$font = "'Allisya'";
	$size = "150%";
}

if($row['textoestilo'] == 4){
	$font = "'Little-Clusters'";
	$size = "150%";
}

if($row['textoestilo'] == 5){
	$font = "'Summertime-Reguler'";
	$size = "170%";
}

//-----------------------------------------------------------------
//Cor dos títulos
if($row['cordotitulo'] == 0){
	$titlecolor = "#000000";
}

if($row['cordotitulo'] == 1){
	$titlecolor = "#150231";
}

if($row['cordotitulo'] == 2){
	$titlecolor = "#970C8E";
}

if($row['cordotitulo'] == 3){
	$titlecolor = "#FD40B6";
}

if($row['cordotitulo'] == 4){
	$titlecolor = "#EC85C2";
}

if($row['cordotitulo'] == 5){
	$titlecolor = "#EFA0D3";
}

if($row['cordotitulo'] == 6){
	$titlecolor = "#E3D235";
}

if($row['cordotitulo'] == 7){
	$titlecolor = "#3081FF";
}

if($row['cordotitulo'] == 8){
	$titlecolor = "#FCAC00";
}

if($row['cordotitulo'] == 9){
	$titlecolor = "#470E0E";
}

if($row['cordotitulo'] == 10){
	$titlecolor = "#97797B";
}

if($row['cordotitulo'] == 11){
	$titlecolor = "#045E47";
}

if($row['cordotitulo'] == 12){
	$titlecolor = "#61B50A";
}

if($row['cordotitulo'] == 13){
	$titlecolor = "#7D9CB3";
}

//-----------------------------------------------------------------
//Divisores
if($row['divisor'] == 0){
	$divisorclasse = "divisor";
}

if($row['divisor'] == 1){
	$divisorclasse = "divisor2";
}

if($row['divisor'] == 2){
	$divisorclasse = "divisor3";
}

if($row['divisor'] == 3){
	$divisorclasse = "divisor4";
}

if($row['divisor'] == 4){
	$divisorclasse = "divisor5";
}

if($row['divisor'] == 5){
	$divisorclasse = "divisor6";
}

if($row['divisor'] == 6){
	$divisorclasse = "divisor7";
}

if($row['divisor'] == 7){
	$divisorclasse = "divisor8";
}

//-----------------------------------------------------------------
//Fonte dos textos
if($row['fontetexto'] == 0){
	$font1 = "Cambria, 'Hoefler Text', 'Liberation Serif', Times, 'Times New Roman', 'serif'";
}

if($row['fontetexto'] == 1){
	$font1 = "Consolas, 'Andale Mono', 'Lucida Console', 'Lucida Sans Typewriter', Monaco, 'Courier New', 'monospace'";
}

if($row['fontetexto'] == 2){
	$font1 = "'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, 'sans-serif'";
}

//-----------------------------------------------------------------
//Cor dos textos
if($row['cordotexto'] == 0){
	$textcolor = "#161616";
}

if($row['cordotexto'] == 1){
	$textcolor = "#333333";
}

if($row['cordotexto'] == 2){
	$textcolor = "#686767";
}

if($row['cordotexto'] == 3){
	$textcolor = "#A7A7A7";
}
?>