<?php if (realpath(__FILE__) === realpath($_SERVER['SCRIPT_FILENAME'])) header('Location: '.$urlHost); 
//https://wp-mix.com/php-protect-include-files/
?>    
    <div class="footer1">
		<img src="images/hearts2.png" width="10%" height="auto" />
		<br/>
		<p style="font-size:100%; font-weight:bolder; margin-bottom:5px;">Quem Somos</p>
		<p style="font-size:90%;">O <span style="font-weight:bolder;">Casamento em Detalhes</span> é uma empresa de asssessoria e cerimonial de casamentos que uniu suas habilidades em preparar eventos com excelência, organização e carisma com a nossa principal característica, a paixão em poder realizar sonhos. Acesse nossa homepage <a target="_blank" href="<?php echo $urlHost; ?>">aqui</a> e tenha você também seu próprio site de casamento.</p>
		<br/><br/>
		<span style="font-weight:bold;">Casamento em Detalhes <?php echo date('Y'); ?></span> - Designed by <span style="font-weight:bold;">JFC Designer</span> and developed by <a href="<?php echo $urlHost; ?>"><span style="font-weight:bold;">Rogério Soares</span></a>
    </div>