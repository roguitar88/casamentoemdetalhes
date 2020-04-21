	<div class="whitetop">
		<div class="nomedocasal">
			#<?php echo $perfil['nomedeusuario']; ?>
		</div>
		<div class="menudosite">
			<ul class="navegacao">
				<li id="localcasamento"><a href="localcasamento.php?perfil=<?php echo urlencode($perfil['nomedeusuario']); ?>">Local do Casamento</a></li>
				<li id="enquetes"><a href="enquetes.php?perfil=<?php echo urlencode($perfil['nomedeusuario']); ?>">Enquetes</a></li>
				<li id="fotos"><a href="fotos.php?perfil=<?php echo urlencode($perfil['nomedeusuario']); ?>">Fotos</a></li>
				<li id="nossahistoria"><a href="nossahistoria.php?perfil=<?php echo urlencode($perfil['nomedeusuario']); ?>">Nossa História</a></li>
				<li id="home"><a href="home.php?perfil=<?php echo urlencode($perfil['nomedeusuario']); ?>">Início</a></li>
			</ul>
		</div>
	</div>