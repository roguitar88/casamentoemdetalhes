    <div class="cabecalho">
        <!--
        <center><img src="images/affiliate.png" width="20%" height="auto" /></center>
        <br/>
        -->
        <div class="casamento">
			<div class="perfildocasal"></div>
			<div class="casamentojoaoemaria">
				<p style="font-size:110%; color:white;"><b>#<?php echo $row['nomedeusuario']; ?></b></p>
				<p style="font-size:70%; color:white;">Data: <?php if($row['datadocasamento'] != "0000-00-00 00:00:00"){ echo date("d/m/Y", strtotime($row['datadocasamento'])); }else{ echo "Não definida"; }?></p>
				<!-- date("d/m/Y") -->
				<!--
				<a href="/orangeadex/casamentoemdetalhes/logout.php">Logout</a>
				-->
			</div>
        </div>
        <div class="dadosdadireita">
			<div class="linksdotopo">
				<a target="_blank" href="home.php?perfil=<?php echo urlencode($row['nomedeusuario']); ?>"><div class="vermeusite">
					VER MEU SITE
				</div></a>
				<div class="olamundo">
					<div onclick="dropDownMenu()" class="circuloperfil dropbtn"></div>
					<div id="myDropdown" class="dropdown-content">
						<a href="logout.php">Sair</a>
						<a href="inicio.php">Início</a>
						<a href="meucasamento.php">Meu Casamento</a>
						<a href="presentes.php">Presentes</a>
						<a href="site.php">Presentes</a>
						<a href="convidados.php">Convidados</a>
					</div>
					<div class="textoolamundo">
						Olá, <?php echo $row['nomeprincipal']; ?>
					</div>
				</div>
				<div class="notificacoes">
					<img src="images/notificacoes.png" width="30%" height="auto" />
				</div>
			</div>
        </div>
    </div>

	<script>
	/* Quando o usuário clicar no botão, 
	O efeito toggle transitará entre mostrar e ocultar o conteúdo do menu dropdown */
	function dropDownMenu() {
	  document.getElementById("myDropdown").classList.toggle("show");
	}

	// O código a seguir fecha o menu dropdown caso o usuário clique em qualquer lugar fora dele.
	window.onclick = function(event) {
	  if (!event.target.matches('.dropbtn')) {
		var dropdowns = document.getElementsByClassName("dropdown-content");
		var i;
		for (i = 0; i < dropdowns.length; i++) {
		  var openDropdown = dropdowns[i];
		  if (openDropdown.classList.contains('show')) {
			openDropdown.classList.remove('show');
		  }
		}
	  }
	}
	</script>