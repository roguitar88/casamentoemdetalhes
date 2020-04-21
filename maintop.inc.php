	<div class="maintop">
		<div class="titulodapagina2">
			<br/>
			<p style="margin-bottom:-50px; -webkit-transform: rotateX(180deg); transform: rotateX(180deg);" class="<?php echo $divisorclasse; ?>"></p>
			<h2 class="titulodotexto2" style="font-family: <?php echo $font; ?>; font-size: <?php echo $size2; ?>; color: white;"><?php if(date("d.m.Y") >= date("d.m.Y", strtotime($perfil['datadocasamento']))){ echo "Parabéns!"; }else{ echo "Save the date"; } ?></h2>
			<span class="date"><?php if($perfil['datadocasamento'] != "0000-00-00 00:00:00"){ echo date("d.m.Y", strtotime($perfil['datadocasamento'])); }else{ echo "??.??.????"; } ?></span><br/>
			<p style="margin-top:-30px;" class="<?php echo $divisorclasse; ?>"></p>
		</div>
		<div class="cronometro" style="background: rgba(<?php echo $rgbcolor1; ?>,1);">
			<div class="cronometromaster">
				<?php
				if($perfil['datadocasamento'] != "0000-00-00 00:00:00" && date("d.m.Y") <= date("d.m.Y", strtotime($perfil['datadocasamento']))){
				?>
				<div class="anelzinho">
					<img src="images/rings.png" width="100%" height="auto" />
				</div>
				<div class="faltam">
					Faltam<br/>
					apenas
				</div>
				<div id="dias" class="contagemregressiva">
				</div>
				<div id="horas" class="contagemregressiva">
				</div>
				<div id="minutos" class="contagemregressiva">
				</div>
				<div id="segundos" class="contagemregressiva">
				</div>
				<?php
				}else{
				?>
				<div id="casados" class="semcronometro">
					Vá na aba "Configurações" do <a href="site.php">link</a> para inserir a data
				</div>
				<?php
				}
				?>
			</div>
		</div>
	</div>

<script>
// Set the date we're counting down to
var countDownDate = new Date("<?php echo date("F j, Y H:i:s", strtotime($perfil['datadocasamento'])); ?>").getTime();

// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();

  // Find the distance between now and the count down date
  var distance = countDownDate - now;

  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  // Display the result in the respective elements
  document.getElementById("dias").innerHTML = "<span class=\"numero\">" + days + "</span><br/><span class=\"tempo\">dias</span>";

  document.getElementById("horas").innerHTML = "<span class=\"numero\">" + hours + "</span><br/><span class=\"tempo\">horas</span>";

  document.getElementById("minutos").innerHTML = "<span class=\"numero\">" + minutes + "</span><br/><span class=\"tempo\">minutos</span>";
	
  document.getElementById("segundos").innerHTML = "<span class=\"numero\">" + seconds + "</span><br/><span class=\"tempo\">segundos</span>";
	
	// If the count down is finished, write some text
  if (distance < 0) {
    //clearInterval(x);
    document.getElementById("casados").innerHTML = "JUST MARRIED";
  }
}, 1000);
</script>